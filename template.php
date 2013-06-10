<?php

function themage_preprocess_html(&$vars) {
	// Add Lobster font
	drupal_add_css('http://fonts.googleapis.com/css?family=Lobster', array('type' => 'external'));

	$vars['html_attributes_array'] = array();
  $vars['body_attributes_array'] = array();
 
  // HTML element attributes.
  $vars['html_attributes_array']['lang'] = $vars['language']->language;
  $vars['html_attributes_array']['dir']  = $vars['language']->dir;
 
  // Adds RDF namespace prefix bindings in the form of an RDFa 1.1 prefix
  // attribute inside the html element.
  if (function_exists('rdf_get_namespaces')) {
    $vars['rdf'] = new stdClass;
    foreach (rdf_get_namespaces() as $prefix => $uri) {
      $vars['rdf']->prefix .= $prefix . ': ' . $uri . "\n";
    }
    $vars['html_attributes_array']['prefix'] = $vars['rdf']->prefix;
  }
 
  // BODY element attributes.
  $vars['body_attributes_array']['class'] = $vars['classes_array'];
  $vars['body_attributes_array'] += $vars['attributes_array'];
  $vars['attributes_array'] = '';
}

function themage_process_html(&$vars) {
  // Flatten out html_attributes and body_attributes.
  $vars['html_attributes'] = drupal_attributes($vars['html_attributes_array']);
  $vars['body_attributes'] = drupal_attributes($vars['body_attributes_array']);
}

function themage_html_head_alter(&$head_elements) {
  // Simplify the meta charset declaration.
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );
}

function themage_preprocess_region(&$vars) {
	if ( $vars['region'] == 'sidebar_first' || $vars['region'] == 'sidebar_second' ) {
		$vars['classes_array'][] = 'sidebar';
	}
}

function themage_preprocess_node(&$vars) {
	// Add html5 time element
	$vars['submitted'] = t('Submitted by !username on <time datetime="!time">!date</time>',
		array(
			'!username' => $vars['name'],
			'!time' => $vars['date'],
			'!date' => $vars['date'],
		)
	);
}
