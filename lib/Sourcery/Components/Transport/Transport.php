<?php
/**
 * @file
 *  Basic Transport Object
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Transport;

/**
 * Defines a Transport object on which to base other Transport plugins
 */
class Transport
  implements \Sourcery\Components\Transport\TransportInterface {

  /**
   * Optionally, modify the $request object before firing
   */
  public function prepare(\Sourcery\Components\Request\Request $request) {
    // Nothing do to by default, however it would be a good place to check
    // $request->action and determine (for example) which HTTP method to
    // use.
  }

  /**
   * Retrieve a resource from a source
   *
   * @param \Sourcery\Components\Request\Request $request
   *  The request object
   *
   * @return mixed
   */
  public function request(\Sourcery\Components\Request\Request $request) {
    // Do nothing by default.
  }

}
