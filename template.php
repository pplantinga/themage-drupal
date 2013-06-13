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

/**
 * Implements template_preprocess_node
 */
function themage_preprocess_node(&$vars) {
	$vars['submitted'] = themage_submitted( $vars['name'], $vars['created'] );
}

/**
 * Implements template_preprocess_comment
 */
function themage_preprocess_comment(&$vars) {
	$vars['submitted'] = themage_submitted( $vars['author'], $vars['comment']->created );
}

/**
 * Add html5 time element to time
 */
function themage_submitted( $author, $datetime ) {
	$date_string = format_date( $datetime, 'custom', 'F j, Y' );
	$time_string = format_date( $datetime, 'custom', 'c' );
	return t('Submitted by !username on !datetime',
		array(
			'!username' => $author,
			'!datetime' => "<time datetime='$time_string'>$date_string</time>",
		)
	);
}

/**
 * Implements template_preprocess_block
 */
function themage_preprocess_block(&$vars) {
	#print_r( $vars );
	$vars['attributes_array']['role'] = 'complementary';
}

/**
 * Implements template_breadcrumb
 */
function themage_breadcrumb(&$vars) {
	$breadcrumb = $vars['breadcrumb'];

	if ( empty($breadcrumb) || !theme_get_setting('breadcrumb_display') )
		return;

	if ( theme_get_setting('breadcrumb_title') )
		$breadcrumb[] = drupal_get_title();

	$breadcrumb_string = implode( theme_get_setting('breadcrumb_separator'), $breadcrumb );

	return theme_get_setting('breadcrumb_prefix') . $breadcrumb_string;
}
