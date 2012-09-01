<?php
/**
 * @file
 *  Defines a basic Source which plugins can extend.
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Sourcery\Components\Source;

/**
 * Defines a basic Source which other plugins can extend
 */
class Source
  implements \Sourcery\Components\Source\SourceInterface {

  /**
   * Stores the active collection
   *
   * Note this can't actually be set unless the object implements
   * \Sourcery\Components\Source\SourceCollectionInterface
   *
   * @var string
   */
  protected $collection;

  /**
   * Specifies a default Parser plugin to be used for this Source
   *
   * @param null $optional_parser [optional]
   *
   * @return string
   *  The name of the default Parser plugin
   */
  public function useParser($optional_parser = NULL) {
    if (!isset($optional_parser) || is_null($optional_parser)) {
      return SOURCERY_DEFAULT_PARSER_PLUGIN;
    }
    return $optional_parser;
  }

  /**
   * Specifies a default Transport to be used for this Source
   *
   * @param null $optional_transport [optional]
   *
   * @return string
   *  The name of the default Transport plugin
   */
  public function useTransport($optional_transport = NULL) {
    if (!isset($optional_transport) || is_null($optional_transport)) {
      return SOURCERY_DEFAULT_TRANSPORT_PLUGIN;
    }
    return $optional_transport;
  }

  /**
   * Make the Source available for use
   *
   * This may do any of three things:
   *  - Pass a set of parameters for accessing a resource into the Source object
   *  - Load default parameters from the Source object
   *  - Do any other setup required to prepare a Source for use
   *
   * @param \Sourcery\Components\Request\Request $request
   *  A request object
   */
  public function prepare(\Sourcery\Components\Request\Request $request) {
    // Nothing to do here
  }
}
