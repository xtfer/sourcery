<?php
/**
 * @file
 *  Example Parser to demonstrate parsing JSON data.
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'sourcery_example_parser',
  'module' => 'sourcery',
  'class' => 'SourceryExampleParser',
  'label' => t('Example JSON Parser'),
  'description' => t('Converts data from JSON'),
);

/**
 * Example Parser
 *
 * This is identical to the JSON Parser in Sourcery.
 */
class SourceryExampleParser
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
