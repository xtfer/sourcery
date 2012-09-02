<?php
/**
 * @file
 *  Special interface to capture all CRUD functions in one place.
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Actions;

/**
 * Source's implementing this action support all CRUD functions at a remote endpoint.
 *
 * This is just a shortcut for the Create, Read, Update and Delete interfaces
 */
interface Crud
  extends \Sourcery\Components\Actions\Create,
  \Sourcery\Components\Actions\Read,
  \Sourcery\Components\Actions\Update,
  \Sourcery\Components\Actions\Delete {

  // Nothing to do
}
