<?php
/**
 * @file
 *  Defines an interface for Upsert operations
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Actions;

/**
 * Source's implementing this action support upserting data at a remote endpoint.
 */
interface Upsert {

  /**
   * Request to 'upsert' an object at a remote source
   *
   * @abstract
   *
   * @param \Sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionUpsert(\Sourcery\Components\Request\Request $request);
}
