<?php

/**
 * Add Lobster font
 */
function themage_preprocess_html(&$variables) {
	drupal_add_css('http://fonts.googleapis.com/css?family=Lobster', array('type' => 'external'));
}

