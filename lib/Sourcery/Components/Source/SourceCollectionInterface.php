<?php
/**
 * @file
 *  Defines an interface for setting a collection property on a source
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Source;

/**
 * Defines an interface for supporting Collections on Sources.
 *
 * This interface should be implemented if the Source supports multiple
 * collections. Note this is only a convenience, as this defines no further
 * functionality.
 */
interface SourceCollectionInterface {

  /**
   * Set a Collection property on the object.
   *
   * @abstract
   *
   * @param string $collection_name
   *  Name of the collection to use
   */
  public function setCollection($collection_name);
}
