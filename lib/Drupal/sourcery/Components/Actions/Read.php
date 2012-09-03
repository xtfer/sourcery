<?php
/**
 * @file
 *  Defines an interface for Read operations
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Drupal\sourcery\Components\Actions;

/**
 * Source's implementing this action support reading data at a remote endpoint.
 */
interface Read {

  /**
   * Request to 'read' an object at a remote source
   *
   * @abstract
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionRead(\Drupal\sourcery\Components\Request\Request $request);
}
