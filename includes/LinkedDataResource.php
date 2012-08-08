<?php
/**
 * @file
 *  A representation of a Linked Data Resource
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
class LinkedDataResource {

  /**
   * The resource
   */
  protected $resource;

  /**
   * Constructor
   *
   * @return \LinkedDataResource
   */
  public function __construct() {
    $this->loadDependencies();

    return $this;
  }

  /**
   * Load dependencies
   *
   * @todo do this properly
   */
  protected function loadDependencies() {
    try {
      require_once('/sites/all/libraries/easyrdf/lib/EasyRdf.php');
      if (!class_exists('EasyRdf_graph')) {
        throw new Exception("EasyRdf could not be found.");
      }
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Load a URI
   *
   * @param string $uri
   *  The URI to load
   *
   * @return \LinkedDataResource
   */
  public function load($uri) {
    $this->resource = new EasyRdf_Graph($uri);
    return $this;
  }

  /**
   * Access the resource
   *
   * @return \EasyRdf_graph
   */
  public function resource() {
    return $this->resource;
  }
}
