<?php
/**
 * @file
 *  The parser interface for sourcery
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Parser;

interface ParserInterface {

  /**
   * Retrieve a resource from a source
   *
   * @param $args
   *  Arguments to load the resource
   *
   * @abstract
   * @return mixed
   */
  public function get($args);
}
