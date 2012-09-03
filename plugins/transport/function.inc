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
 * Defines a Transport plugin to use callbacks instead of accessing a URL.
 *
 * Because we are simply calling a function, specified in the 'destination'
 * parameter, all implemented action callbacks simply return the same thing.
 */
class SourceryCallbackTransport
  extends \Drupal\sourcery\Components\Transport\Transport
  implements \Drupal\sourcery\Components\Actions\Crud {

  /**
   * Action a resource using a callback
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *  The request object
   *
   * @return mixed
   */
  protected function request(\Drupal\sourcery\Components\Request\Request $request) {
    $function = $request->requestArgs['function'];
    unset($request->requestArgs['function']);

    $args['key'] = $request->getDestination();
    $args['extra'] = $request->requestArgs;

    if (function_exists($function)) {
      return call_user_func($function, $request->requestArgs);
    }
  }

  /**
   * Request to 'create' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionCreate(\Drupal\sourcery\Components\Request\Request $request) {
    return $this->request($request);
  }

  /**
   * Request to 'delete' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionDelete(\Drupal\sourcery\Components\Request\Request $request) {
    return $this->request($request);
  }

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request) {
    return $this->request($request);
  }

  /**
   * Request to 'update' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionUpdate(\Drupal\sourcery\Components\Request\Request $request) {
    return $this->request($request);
  }

}
