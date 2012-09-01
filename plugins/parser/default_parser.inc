<?php
/**
 * @file
 *  A Sourcery plugin to fetch data using drupal_http_request
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'default_parser',
  'module' => 'sourcery',
  'class' => 'SourceryDefaultParser',
  'label' => t('Default Parser'),
  'description' => t('Basic parser.'),
);

/**
 * Default Parser plugin
 *
 * This plugin merely returns data passed into it, without change.
 */
class SourceryDefaultParser
  implements \Sourcery\Components\Parser\ParserInterface {

  /**
   * Implements \Sourcery\Components\Interfaces\ParserInterface::extract
   *
   * @param $data
   *  The fetched data from which to extract keys
   *
   * @return mixed
   */
  public function extract($data) {
    // This is the basic parser, there's no manipulation we can do on this
    // object.
    return $data;
  }

}
