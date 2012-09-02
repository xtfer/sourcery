<?php
/**
 * @file
 *  A Sourcery plugin to fetch data using drupal_http_request
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'default_transport',
  'module' => 'sourcery',
  'class' => 'SourceryDefaultTransport',
  'label' => t('Default Transport'),
  'description' => t('Parser to fetch resources using drupal_http_request().'),
);

/**
 * A transport for drupal_http_request
 */
class SourceryDefaultTransport
  extends \Sourcery\Components\Transport\Transport
  implements \Sourcery\Components\Actions\Read {

  /**
   * Options array for drupal_http_request
   */
  protected $options = array();

  /**
   * The destination URL
   */
  protected $url;

  /**
   * Retrieve a resource from a source
   */
  protected function request(\Sourcery\Components\Request\Request $request) {
    $result = drupal_http_request($this->url, $this->options);
    if ($result->code != 200) {
      watchdog('sourcery', 'Request failed with error code: @code', array('@code' => $result->code), WATCHDOG_NOTICE);
      $request->resultError = $result;
    }
    else {
      $request->resultRaw = $result;
    }
  }

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Sourcery\Components\Request\Request $request) {

    // Build our $options array including the $data payload
    $this->options = $request->requestArgs;
    if (!isset($options['data'])) {
      $this->options['data'] = $request->getData();
    }

    // Set the destination
    $this->url = $request->getDestination();

    $this->request($request);
  }
}
