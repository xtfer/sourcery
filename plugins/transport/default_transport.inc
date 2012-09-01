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
  implements \Sourcery\Components\Transport\TransportInterface {

  /**
   * Retrieve a resource from a source
   *
   * @param \Sourcery\Components\Request\Request $request
   *  The request object
   *
   * @return mixed
   */
  public function request(\Sourcery\Components\Request\Request $request) {

    // Build our $options array including the $data payload
    $options = $request->requestArgs;
    if (!isset($options['data'])) {
      $options['data'] = $request->getData();
    }

    return drupal_http_request($request->getDestination(), $options);
  }

}
