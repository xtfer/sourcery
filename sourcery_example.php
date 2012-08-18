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
class SourceryExampleModel_MusicArtist extends EasyRdf_Resource {

  function birthEvent() {
    foreach ($this->all('bio:event') as $event) {
      if (in_array('bio:Birth', $event->types())) {
        return $event;
      }
    }
    return NULL;
  }

  function age() {
    $birth = $this->birthEvent();
    if ($birth) {
      $year = substr($birth->get('bio:date'), 0, 4);
      if ($year) {
        return date('Y') - $year;
      }
    }
    return 'unknown';
  }
}

function sourcery_example_resource() {

  // Add namespaces
  EasyRdf_Namespace::set('mo', 'http://purl.org/ontology/mo/');
  EasyRdf_Namespace::set('bio', 'http://purl.org/vocab/bio/0.1/');

  // Maps an RDF type ('mo:MusicArtist') to a PHP class ('SourceryExampleModel_MusicArtist')
  EasyRdf_TypeMapper::set('mo:MusicArtist', 'SourceryExampleModel_MusicArtist');

  // Start a new Sourcery resource, specifiying the type of parser to use
  $source = sourcery_resource('easyrdf');
  // Provide arguments required by the Parser, this is usually a URI
  $source->arg('uri', 'http://www.bbc.co.uk/music/artists/70248960-cb53-4ea4-943a-edb18f7d336f.rdf');
  // Fetch the source document
  $source->fetch();
  // Return the stored resource from the SourceryResource object, which in this
  // case is an EasyRdf object.
  $graph = $source->resource();

  // From here on, we are working with an EasyRdf_Graph object...
  $graph->load();
  $artist = $graph->primaryTopic();

  // Dump the data
  echo '<dl>
    <dt>Artist Name:</dt><dd>' . $artist->get('foaf:name') . '</dd>
    <dt>Type:</dt><dd>' . join(', ', $artist->types()) . '</dd>
    <dt>Homepage:</dt><dd>' . link_to($artist->get('foaf:homepage')) . '</dd>
    <dt>Wikipedia page:</dt><dd>' . link_to($artist->get('mo:wikipedia')) . '</dd>';

  if ($artist->is_a('mo:SoloMusicArtist')) {
    echo "  <dt>Age:</dt>";
    echo "  <dd>" . $artist->age() . "</dd>\n";
  }

  echo '</dl>';

  if (isset($graph)) {
    echo $graph->dump();
  }
}
