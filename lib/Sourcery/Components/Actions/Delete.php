<?php
/**
 * @file
 *  Defines an interface for Delete operations
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Actions;

/**
 * Source's implementing this action support deleting data at a remote endpoint.
 */
interface Delete {

  /**
   * Request to 'delete' an object at a remote source
   *
   * @abstract
   *
   * @param \Sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionDelete(\Sourcery\Components\Request\Request $request);
}
