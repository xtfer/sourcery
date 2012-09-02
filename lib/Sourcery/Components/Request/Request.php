<?php
/**
 * @file
 * --Description--
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Request;

/**
 * Placeholder for when arguments are not provided (allows arguments to be NULL)
 */
const SOURCERY_REQUEST_NO_RESULT = '#no_result';

/**
 * Defines a request type which uses a callback
 */
const SOURCERY_REQUEST_TYPE_CALLBACK = 'callback';

/**
 * Defines a request type which uses an endpoint
 */
const SOURCERY_REQUEST_TYPE_ENDPOINT = 'endpoint';

/**
 * Defines a request type where the URL is the resource
 */
const SOURCERY_REQUEST_TYPE_RESOURCE = 'resource';


/**
 * The Request object.
 *
 * This is used internally by Sourcery to track the properties of a request. It
 * is called by the Sourcerer, then passed sequentially to the Source, Transport,
 * and Parser.
 */
class Request {

  /**
   * The Action being called
   *
   * This isnt currently used anywhere.
   */
  public $action;

  /**
   * The type of request
   *
   * This currently only recognises three types:
   *  SOURCERY_REQUEST_TYPE_CALLBACK - The request is passed to a third-party inside
   * Drupal, via a function
   *  SOURCERY_REQUEST_TYPE_ENDPOINT - The request accesses a remote endpoint, to which
   * is passes arguments (e.g. an XML-RPC endpoint)
   *  SOURCERY_REQUEST_TYPE_RESOURCE - The request accesses a remote resource, where the
   * Resource URL represents the data (e.g. an RDF resource)
   */
  public $type;

  /**
   * The Destination of the object
   *
   * Usually a URL, but sometimes a function
   *
   * @var string
   */
  protected $requestDestination;

  /**
   * The request data itself
   *
   * @var array
   */
  protected $requestData = array();

  /**
   * Arguments required by the transport
   *
   * E.g. Header settings
   */
  public $requestArgs = array();

  /**
   * The result of a request.
   *
   * Contains data returned by the transport as a result of the request.
   *
   * @var mixed
   */
  public $resultRaw;

  /**
   * An error with the transport
   *
   * If the transport returns an error, it should be placed in this variable
   */
  public $resultError;

  /**
   * The parsed result
   */
  public $resultParsed;

  /**
   * Constructor
   */
  public function __construct($action = NULL) {
    if (isset($action) && !is_null($action)) {
      $this->action = $action;
    }
  }

  /**
   * @param $destination
   */
  public function setDestination($destination) {
    $this->requestDestination = $destination;
  }

  /**
   * @return mixed
   */
  public function getDestination() {
    return $this->requestDestination;
  }


  /**
   * @param $data
   */
  public function setData($data) {
    $this->requestData = $data;
  }

  /**
   * @return mixed
   */
  public function getData() {
    return $this->requestData;
  }
}
