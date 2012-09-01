<?php
/**
 * @file
 *  Defines an interface for a Source
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Source;

/**
 * Defines an interface for a Source
 *
 * Every Source plugin needs to define this interface to be recognised by the
 * Sourcery. The base \Sourcery\Components\Source\Source object implements this
 * interface, so it can be extended to ensure that base methods are all fulfilled.
 */
interface SourceInterface {

  /**
   * Specifies a Parser plugin to be used for this Source
   *
   * @abstract
   *
   * @param null $optional_parser [optional]
   *  Allow the caller to specify an optional parser plugin. It is up to the
   *  implementation to decide whether to accept that parser, or use its own.
   *
   * @return string
   *  The name of the Parser plugin to use.
   */
  public function useParser($optional_parser = NULL);

  /**
   * Specifies a default Transport to be used for this Source
   *
   * @abstract
   *
   * @param null $optional_transport [optional]
   *  Allow the caller to specify an optional transport plugin. It is up to the
   *  implementation to decide whether to accept that plugin, or use its own.
   *
   * @return
   *  The name of the Transport plugin to use.
   */
  public function useTransport($optional_transport = NULL);

  /**
   * Modify the Request prior to sending
   *
   * Give the Source an opportunity to alter the Request before it gets execute
   * for example, to modify the destination, set request arguments, or add
   * required elements to the data array.
   *
   * For example...
   *  - Pass a set of parameters for accessing a resource into the Source object
   *  - Load default parameters from the Source object
   *  - Do any other setup required to prepare a Source for use
   *
   * @param \Sourcery\Components\Request\Request $request
   *  A request object
   */
  public function prepare(\Sourcery\Components\Request\Request $request);
}
