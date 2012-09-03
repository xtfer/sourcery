<?php
/**
 * @file
 *  A plugin to test Sourcery's Source functions
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name'        => 'sourcery_test_source',
  'module'      => 'sourcery_tests',
  'class'       => 'SourceryTestSource',
  'label'       => t('Test Source'),
  'description' => t('A plugin to test Sourcery\'s Source functions'),
);

/**
 * A plugin to test Sourcery's Source functions
  */
class SourceryTestSource
  implements \Drupal\sourcery\Components\Actions\Read {

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request) {
    // Do nothing
  }

}
