<?php
/**
 * @file
 *  The transport interface for sourcery
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Drupal\sourcery\Components\Transport;

/**
 * Defines an interface for a Transport
 *
 * A Transport is a wrapper around the transport mechanism used to retrieve a
 * Source. This could be drupal_http_request, or Guzzle, or some other mechanism.
 */
interface TransportInterface {

  /**
   * Optionally, modify the $request object before firing
   */
  public function prepare(\Drupal\sourcery\Components\Request\Request $request);
}
