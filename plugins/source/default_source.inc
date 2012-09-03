<?php
/**
 * @file
 *  Defines a basic Source.
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

/**
 * The default Source plugin.
 *
 * This can be used in combination with the default Transport plugin to retrieve
 * a resource using a simple HTTP GET.
 */
class SourceryDefaultSource
  extends \Drupal\sourcery\Components\Source\Source
  implements \Drupal\sourcery\Components\Actions\Read {

  /**
   * Overrides Source::Prepare()
   *
   * @param Drupal\sourcery\Components\Request\Request $request
   */
  public function prepare(\Drupal\sourcery\Components\Request\Request $request) {
    // Do nothing
  }

  /**
   * Request to 'read' an object at a remote source
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request) {
    // Do nothing
    // Even though we implement actionRead(), there is actually nothing for
    // us to do in this context.
  }

}
