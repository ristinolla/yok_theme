<?php
/**
*
* Shortcodes
*/

//COLUMNATION LIKE BOOTSTRAP

// ROW
function row_shortcode( $atts, $content = null ) {
   return '<div class="row">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'row', 'row_shortcode' );

// COL2
function col2_shortcode( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-6 ">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'col2', 'col2_shortcode' );

// COL3
function col3_shortcode( $atts, $content = null ) {
   return '<div class="col-xs-12 col-md-4">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'col3', 'col3_shortcode' );

// COL4
function col4_shortcode( $atts, $content = null ) {
   return '<div class="col-xs-12 col-md-3">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'col4', 'col4_shortcode' );



// [fancyframe id="foo-value" linktext="ragreg" class=""]
function fancyframe_func( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'id' => 'fancyedstuff',
		'linktext' => 'Click to see something!',
		'class' => 'button',
	), $atts ) );

	return '<a id="inline" class="'. $class .' fancy-link" href="#' . $id . '">'  . $linktext . '</a><div style="display:none"><div id="' . $id . '">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'fancyframe', 'fancyframe_func' );

// [popupstuff id="diudiu"]
function popupstuff_func( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'id' => 'popupstuff',
	), $atts ) );

	return '<div style="display:none"><div id="' . $id . '">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'popupstuff', 'popupstuff_func' );

//hidden stuff toggle button [hide_button id="tama" class=""]
function hide_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => 'hiddenstuff',
		'class' => 'button',
	), $atts ) );
   return '<a class="' . $class . '" onClick=toggleStuff("' . $id .'")>' . do_shortcode($content) . '</a>';
}
add_shortcode( 'hide_button', 'hide_button_shortcode' );


//hidden stuff [hidden_stuff id="tama"]
function hidden_stuff_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => 'hiddenstuff',
	), $atts ) );
   return '<div class="hidden-stuff" style="display:none;" id="' . $id .'">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'hidden_stuff', 'hidden_stuff_shortcode' );

//Google Maps Shortcode 
function fn_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '400px',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe>';
}
add_shortcode("googlemap", "fn_googleMaps");

