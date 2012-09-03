<?php
/**
 * @file
 *  Defines an interface for Create operations
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Drupal\sourcery\Components\Actions;

/**
 * Source's implementing this action support creating data at a remote endpoint.
 */
interface Create {

  /**
   * Request to 'create' an object at a remote source
   *
   * @abstract
   *
   * @param \Drupal\sourcery\Components\Request\Request $request
   *
   * @return mixed
   */
  public function actionCreate(\Drupal\sourcery\Components\Request\Request $request);
}
