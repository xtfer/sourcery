<?php
/**
 * @file
 *  A Sourcery plugin to fetch data using drupal_http_request
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'json_parser',
  'module' => 'sourcery',
  'class' => 'SourceryJsonParser',
  'label' => t('JSON Parser'),
  'description' => t('Converts data from JSON'),
);

/**
 * Default Parser plugin
 *
 * This plugin merely returns data passed into it, without change.
 */
class SourceryJsonParser
  implements \Sourcery\Components\Parser\ParserInterface {

  /**
   * Implements \Sourcery\Components\Parser\ParserInterface::extract
   *
   * @param $raw_data
   *  The fetched data from which to extract keys
   *
   * @return mixed
   */
  public function extract($raw_data) {
    $data = json_decode($raw_data);
    return $data;
  }

}
