<?php
/**
 * @file
 *  Example Source
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

$plugin = array(
  'name' => 'sourcery_example_source',
  'module' => 'sourcery',
  'class' => 'SourceryExampleSource',
  'label' => t('Example source'),
  'description' => t('Retrieve content BBC Music.'),
);

class SourceryExampleSource
  extends \Drupal\sourcery\Components\Source\Source
  implements \Drupal\sourcery\Components\Source\SourceCollectionInterface,
  \Drupal\sourcery\Components\Actions\Read {

  /**
   * Set a Collection property on the object.
   *
   *
   * @param string $collection_name
   *  Name of the collection to use
   */
  public function setCollection($collection_name) {
    $this->collection = $collection_name;
  }

  /**
   * Implements prepare()
   *
   * This gets the $collection value, if set, and uses it to
   *
   * @param Drupal\sourcery\Components\Request\Request $request
   */
  public function prepare(\Drupal\sourcery\Components\Request\Request $request) {

    // We're storing the key as the destination, so swap it out
    $key = $request->getDestination();

    // Set a collection
    isset($this->collection) ? $collection = $this->collection : $collection = 'artists';

    // Setup a base URL
    $base_url = 'http://www.bbc.co.uk/music/' . $collection . '/';

    // Rebuild the destination using the base url we are providing
    $request->setDestination($base_url . $key .'.json');
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
  }

}
