<?php
/**
 * @file
 *  Controller for managing requests via Sourcery
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components;

/**
 * Defines a controller for managing Sourcery requests
 */
class Controller {

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
   * Perform a request against a source
   *
   * @param string $action
   *  The action to be called on this object
   * @param string $destination
   *  The key of the remote object to retrieve. This may be a full URL, or simply
   *  an identifier. Usage depends on the chosen source.
   * @param array $data [optional]
   *  An array of $data to set in the request
   * @param array $request_args [optional]
   *  Optional arguments used to construct the request
   *
   * @return mixed
   *  The result of the request
   */
  public function request($destination, $action = 'pull', $data = array(), $request_args = array()) {

    // Create the Transport plugin
    if (!isset($this->transport) || empty($this->transport)) {
      $this->setTransport();
    }

    // Create the Parser plugin
    if (!isset($this->parser) || empty($this->parser)) {
      $this->setParser();
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

    // Make sure the request has everything set correctly
    try {

      // Execute the request
      $this->transport->request($request);

      // Error
      if (isset($request->resultError)) {
        return $request->resultError;
      }

      // Result
      elseif (isset($request->resultRaw) && !empty($request->resultRaw)) {
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

    // Probably an Exception...
    return FALSE;
  }

  /**
   * Send data to a client
   *
   * Shorthand wrapper around request()
   *
   * @param string $destination
   *  The target URL or identifier
   * @param array $data
   *  An array of properties to send to the destination
   * @param array $args [optional]
   *  Optional parameters to use when constructing the request
   *
   * @return mixed
   *  The result of the request
   */
  public function push($destination, $data, $args = array()) {
    return $this->request($destination, 'push', $data, $args);
  }

  /**
   * Retrieve data from a client
   *
   * Shorthand wrapper around request()
   *
   * @param string $destination
   *  The target URL or identifier
   * @param array $data [optional]
   *  An array of properties to send to the destination
   * @param array $args [optional]
   *  Optional parameters to use when constructing the request
   *
   * @return mixed
   *  The result of the request
   */
  public function pull($destination, $data = array(), $args = array()) {
    return $this->request($destination, 'pull', $data, $args);
  }
}
