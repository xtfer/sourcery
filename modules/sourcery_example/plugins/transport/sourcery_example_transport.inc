<?php
/**
 * @file
 *  A Sourcery plugin to fetch data using drupal_http_request
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'sourcery_example_transport',
  'module' => 'sourcery_example',
  'class' => 'SourceryExampleTransport',
  'label' => t('Example Transport'),
  'description' => t('Demonstrates a Transport plugin'),
);

/**
 * Example Transport
 *
 * This is a simplified version of the default transport plugin
 */
class SourceryExampleTransport
  extends \Drupal\sourcery\Components\Transport\Transport
  implements \Drupal\sourcery\Components\Actions\Read {

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request) {
    $url = $request->getDestination();
    $options = $request->requestArgs;

    return drupal_http_request($url, $options);
  }

}
