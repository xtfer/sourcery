<?php
/**
 * @file
 *  A Sourcery plugin to action data using a function
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'function',
  'module' => 'sourcery',
  'class' => 'SourceryCallbackTransport',
  'label' => t('Callback'),
  'description' => t('Parser to fetch resources using a callback.'),
);

/**
 * Defines a Transport plugin to use callbacks instead of accessing a URL
 */
class SourceryCallbackTransport
  extends \Sourcery\Components\Transport\Transport
  implements \Sourcery\Components\Transport\TransportInterface {

  /**
   * Action a resource using a callback
   *
   * Implements TransportInterface:transport()
   *
   * @param \Sourcery\Components\Request\Request $request
   *  The request object
   *
   * @return mixed
   */
  public function request(\Sourcery\Components\Request\Request $request) {
    if (function_exists($request->getDestination())) {
      return call_user_func($request->getDestination(), $request->requestArgs);
    }
  }

}
