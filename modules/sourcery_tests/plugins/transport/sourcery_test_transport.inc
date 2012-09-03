<?php
/**
 * @file
 *  A plugin to test sourcery's transport functions
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name'        => 'sourcery_test_transport',
  'module'      => 'sourcery_tests',
  'class'       => 'sourceryTestTransport',
  'label'       => t('Test transport'),
  'description' => t('A transport plugin to test Sourcery\'s Transport functions'),
);

/**
 * A plugin to test sourcery's transport functions.
 *
 * This plugin simulates a remote JSON request by returning JSON encoded data.
 * It does not actually run a remote request.
 */
class sourceryTestTransport
  implements \Drupal\sourcery\Components\Actions\Read {

  /**
   * Sample data to keep us happy
   *
   * @return string
   *  JSON encoded data for testing
   */
  protected function sampleData() {
    $data = array(
      'a key',
      'another key' => array(
        'some stuff', 'more stuff'
      )
    );
    return json_encode($data);
  }

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request) {
    $request->resultRaw = $this->sampleData();
  }

}
