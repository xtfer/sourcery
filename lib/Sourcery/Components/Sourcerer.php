<?php
/**
 * @file
 *  Controller for managing requests using Sourcery
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components;

/**
 * Define a default action
 */
const SOURCERY_DEFAULT_ACTION = 'read';

/**
 * Defines a controller for managing Sourcery requests
 */
class Sourcerer {

  /**
   * The Source object
   *
   * @var \Sourcery\Components\Source\SourceInterface
   */
  protected $source;

  /**
   * The Transport
   *
   * @var \Sourcery\Components\Transport\TransportInterface
   */
  protected $transport;

  /**
   * The Parser
   *
   * @var \Sourcery\Components\Parser\ParserInterface
   */
  protected $parser;

  /**
   * Constructor
   *
   * @param string $source_name
   *  The name of the Source plugin to use
   */
  public function __construct($source_name = SOURCERY_DEFAULT_SOURCE_PLUGIN) {
    $this->setSource($source_name);
  }

  /**
   * Set the source plugin
   *
   * @param string $source_name
   *  The name of the source plugin to use
   */
  public function setSource($source_name) {
    $source = sourcery_invoke_source($source_name);
    $this->source = $source;
  }

  /**
   * Set the transport plugin
   *
   * This can be called after instantiating this object to set the Transport
   * manually.
   *
   * @param string $transport_name
   *  Name of the Transport plugin to use
   */
  public function setTransport($transport_name = NULL) {
    if (!isset($transport_name) || empty($transport_name)) {
      $transport_name = $this->source->useTransport();
    }
    $this->transport = sourcery_invoke_transport($transport_name);
  }

  /**
   * Set the parser plugin
   *
   * This can be called after instantiating this object to set the Parser plugin
   * to use.
   *
   * @param $parser_name
   */
  public function setParser($parser_name = NULL) {
    if (!isset($parser_name) || empty($parser_name)) {
      $parser_name = $this->source->useParser();
    }
    $this->parser = sourcery_invoke_parser($parser_name);
  }

  /**
   * Set a collection parameter on the Source
   *
   * This will only work for Source plugins which implement the interface
   * \Sourcery\Components\Source\SourceCollectionInterface
   *
   * @param string $collection_name
   *  Name of the collection to use
   */
  public function setCollection($collection_name) {
    if ($this->source instanceof \Sourcery\Components\Source\SourceCollectionInterface){
      $this->source->setCollection($collection_name);
    }
  }

  /**
   * Convert an $action request to an Interface name
   *
   * @param string $action
   *  The name of the action requested
   *
   * @return string|bool
   *  The name of the corresponding Interface, or FALSE if none exists
   */
  protected function actionToInterface($action) {
    $interface = '\Sourcery\Actions\action' . ucfirst($action);
    if (interface_exists($interface)) {
      return $interface;
    }
    return FALSE;
  }

  /**
   * Perform a request against a source
   *
   * @param string $destination
   *  The key of the remote object to retrieve. This may be a full URL, or simply
   *  an identifier. Usage depends on the chosen source.
   * @param string $action
   *  The action to be called on this object
   * @param array $data [optional]
   *  An array of $data to set in the request
   * @param array $request_args [optional]
   *  Optional arguments used to construct the request
   *
   * @throws \Exception
   *
   * @return mixed
   *  The result of the request
   */
  public function request($destination, $action = SOURCERY_DEFAULT_ACTION, $data = array(), $request_args = array()) {

    // Only proceed if the Action requested actually has a corresponding interface
    // Anything else is unsupported
    $task = $this->actionToInterface($action);
    if (isset($task) && !empty($task)) {

      // Check that the Source supports the requested action
      if (!$this->source instanceof $action) {
        watchdog('sourcery', 'The Sourcery Source did not support the Action requested', array(), WATCHDOG_ERROR);
        return FALSE;
      }

      // Create the Transport plugin
      if (!isset($this->transport) || empty($this->transport)) {
        $this->setTransport();
      }

      // Check that the transport supports the requested action
      if (!$this->transport instanceof $action) {
        watchdog('sourcery', 'The Sourcery Transport did not support the Action requested', array(), WATCHDOG_ERROR);
        return FALSE;
      }

      // Prepare the Request object
      $request = new \Sourcery\Components\Request\Request($action);
      $request->setDestination($destination);
      $request->setData($data);
      $request->requestArgs = $request_args;

      // Give the Source an opportunity to alter the Request before it gets executed
      // for example, to modify the destination, set request arguments, or add
      // required elements to the data array
      $this->source->prepare($request);

      // Give the Transport an opportunity to alter the Request before it gets executed
      $this->transport->prepare($request);

      // Attempt to complete the request
      try {

        // Give the Source one more chance to change the request before execution
        // This call actionACTION_NAME on the $source. Assuming the $source is an
        // instance of the interface defining this action, this function will be
        // called, however it can simply do nothing.
        if (method_exists($this->source, $task)) {
          call_user_func(array($this->source, $task), $request);
        }

        // Execute the request
        // This calls actionACTION_NAME on the $transport
        if (method_exists($this->transport, $task)) {
          call_user_func(array($this->transport, $task), $request);
        }
        else {
          // Something has gone horribly wrong. Previous "instanceof" checks
          // should stop this from happening.
          throw new \Exception("Attempted to call an Action on a Transport which doesn't implement it");
        }

        // Error
        if (isset($request->resultError)) {
          return $request->resultError;
        }

        // Result
        elseif (isset($request->resultRaw) && !empty($request->resultRaw)) {

          // Create the Parser plugin, if not already set
          if (!isset($this->parser) || empty($this->parser)) {
            $this->setParser();
          }

          $this->parser->extract($request);
          return $request->resultParsed;
        }

        // No error and no result
        return FALSE;
      }
      catch (Exception $e) {
        // Preflight probably failed, or some other exception
        watchdog_exception('sourcery', $e);
      }
    }

    // Probably an Error...
    throw new \Exception('Unknown error in Sourcery');
  }
}
