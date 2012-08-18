<?php
/**
 * @file
 *  A representation of a linked data resource
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Resource;

class Resource {

  /**
   * The resource
   */
  protected $resource;

  /**
   * Arguments required to load the resource
   *
   * @var \Xu\Component\Arg\ArgHandler();
   */
  protected $args;

  /**
   * The parser
   */
  protected $parser;

  /**
   * Constructor
   *
   * @param string $parser_type [optional]
   *  The parser type to use for this resource. It is possible to leave this
   *  empty and add the parser later, after arguments have been added.
   *
   * @return \Sourcery\Components\Resource\Resource
   */
  public function __construct($parser_type = NULL) {
    if (isset($parser_type) && !empty($parser_type)) {
      $this->attachParser($parser_type);
    }

    $this->args = sourcery_arg_handler();

    return $this;
  }

  /**
   * Provide an argument to load the resource
   *
   * @param string $key
   *  The key to use, e.g. 'uri'
   * @param mixed $value [optional]
   *  The value to use for the key. If not provided, the key will be unset.
   */
  public function arg($key, $value = NULL) {
    if (isset($value) && !is_null($value)) {
      $this->args->set($key, $value);
    }
    else {
      $this->args->delete($key);
    }
  }

  /**
   * Load a resource
   *
   * @return \Sourcery\Components\Resource\Resource
   */
  public function fetch() {
    $this->resource = $this->parser->get($this->args);
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

  /**
   * Attach a parser
   */
  public function attachParser($name) {
    $this->parser = sourcery_invoke_parser($name);
  }
}
