<?php
/**
 * @file
 *  Defines an interface for Update operations
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Actions;

/**
 * Source's implementing this action support updating data at a remote endpoint.
 */
interface Update {

  /**
   * Request to 'update' an object at a remote source
   *
   * @abstract
   *
   * @param \Sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionUpdate(\Sourcery\Components\Request\Request $request);
}
