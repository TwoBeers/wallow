<?php
/**
 * New Wallow style generator
 *
 * @since 0.50
 * @package Wallow
 *
 */


$variants = array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds' );

$load['avatar'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['av'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['av'] ) : 'fire';
$load['pages'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['pa'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['pa'] ) : 'fire';
$load['popup'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['po'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['po'] ) : 'fire';
$load['quickbar'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['qu'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['qu'] ) : 'fire';
$load['sidebar'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['si'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['si'] ) : 'fire';
$load['style'] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['st'] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET['st'] ) : 'fire';

$expires_offset = 31536000;

header('Content-Type: text/css');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");

?>

<?php require_once("variants/{$load['style']}/main.css"); ?>
<?php require_once("variants/{$load['sidebar']}/sidebar.css"); ?>
<?php require_once("variants/{$load['pages']}/menu.css"); ?>
<?php require_once("variants/{$load['popup']}/popup.css"); ?>
<?php require_once("variants/{$load['quickbar']}/quickbar.css"); ?>
<?php require_once("variants/{$load['avatar']}/avatar.css"); ?>


<?php
exit;
