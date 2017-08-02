<?php
/**
 * @package Denovi
 * @version 2.0
 */
/*
Plugin Name: Denovi
Plugin URI: http://wordpress.org/plugins/denovi
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in a poetry by Kocho Racin: Denovi. When activated you will randomly see a lyric from <cite>Denovi</cite> in the upper right of your admin screen on every page.
Author: Ilir Saiti
Version: 2.0
Author URI: http://snippetsblog.com/
*/

function denovi_get_lyric() {
	/** These are the lyrics of Denovi */
	$lyrics = "Kako na vratot gerdan, niski kamenja studeni, taka na pleski denovi, legnale ta natezale.
Denovi li se - denovi, argatski maki golemi!
Stani si utro porano, dojdi si vecer podocna
Nautro radost ponesi, navecer taga donesi
Aj, pust da e, pust da bi ostanal zivotot kuceski!
Rodi se covek - rob bidi, rodi se covek - skot umri
Skotski cel zivot raboti, za drugi, tugi imoti.
Za tugi beli dvorovi, kopaj si crni grobovi!
Za sebe samo 'rgaj si, za sebe maki trgaj si
Nizi si gerdan denovi, nizi si alki kovani,
Nizi si sindjir zelezen, okolu vratot navezen!";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function denovi() {
	$chosen = denovi_get_lyric();
	echo "<p id='denovii'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'denovi' );

// We need some CSS to position the paragraph
function denovi_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#denovii {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'denovi_css' );

?>
