<?php
/**
 * @file
 * --Description--
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'default_source',
  'module' => 'sourcery',
  'class' => 'SourceryDefaultSource',
  'label' => t('Default Source'),
  'description' => t('Basic Source.'),
);

class SourceryDefaultSource
  extends \Sourcery\Components\Source\Source
  implements \Sourcery\Components\Source\SourceInterface {

  /**
   * Overrides Source::Prepare()
   *
   * @param Sourcery\Components\Request\Request $request
   */
  public function prepare(\Sourcery\Components\Request\Request $request) {
    // Do nothing
  }

}
