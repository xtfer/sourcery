<?php
/**
 * @file
 *  A Sourcery plugin to map data to the EasyRDF library
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'easyrdf',
  'module' => 'sourcery',
  'class' => 'EasyRdfParser',
  'label' => t('EasyRdf'),
  'description' => t('Parser to extract RDF resources using the EasyRdf library.'),
  'requirements' => array(
    'easyrdf'
  )
);

/**
 * A parser for EasyRdf
 */
class EasyRdfParser
  implements SourceryParserInterface {

  /**
   * Implements ParserInterface:get()
   */
  public function get($args) {

  }
}
