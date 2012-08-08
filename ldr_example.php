<?php
/**
 * @file
 *  Example usage of the LDR module
 * @copyright Copyright(c) 2012 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

/**
 * Given a URI, load it and retrieve any data
 *
 * This is based on the artistinfo.php example in the EasyRdf package.
 */
function ldr_example_resource() {
  // Add namespaces
  EasyRdf_Namespace::set('mo', 'http://purl.org/ontology/mo/');
  EasyRdf_Namespace::set('bio', 'http://purl.org/vocab/bio/0.1/');
  EasyRdf_TypeMapper::set('mo:MusicArtist', 'Model_MusicArtist');


}
