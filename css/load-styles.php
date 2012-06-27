<?php

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

/**
 * New Wallow style generator
 *
 * @since 0.50
 * @package Wallow
 *
 */

<?php switch ( $load['style'] ) { ?>
<?php case 'fire': ?>
/*
genlook (fire style)
*/
/* Common html tags ----> */
a {
	color: #0080BC;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover, #content a:hover, .storytitle a:hover {
	color: #d54e21;
}
blockquote {
	border-left:4px double #ccc;
}
body {
	color: #333;
	background: #912308 url(../images/fire/bg.jpg) left top no-repeat;
}
h2.posts_date {
	border-bottom:1px solid #ccc;
	color:#999;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #ddd;
}
table {
	border: 1px solid #999;
	background: rgb(239,239,239); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(239,239,239,1) 0%, rgba(202,202,202,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(239,239,239,1)), color-stop(100%,rgba(202,202,202,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
thead {
	background-color:#fff;
}
tfoot {
	background-color:#ddd;
}
th {
	border:1px solid #ccc;
}
fieldset {
	border:1px solid #ccc;
}
legend {
	color: #ccc;
}
/* <---- Common html tags */
/* Post classes ----> */
.post ul li {
	border-left:4px solid #333;
}
.meta {
	color: #808080;
}
.storytitle a {
	color: #333;
}
.sticky {
	background: -moz-linear-gradient(left,  rgba(201,238,255,0.1) 0%, rgba(201,238,255,0.1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(201,238,255,0.1)), color-stop(100%,rgba(201,238,255,0.1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1ac9eeff', endColorstr='#1ac9eeff',GradientType=1 ); /* IE6-9 */
	border:1px solid #87CEFA;
	padding:5px;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
	border-top:1px solid #fff;
	border-right:1px solid #fff;
	border-bottom:1px solid #fff;
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(128,128,128,0.2) 0%, rgba(128,128,128,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(128,128,128,0.2)), color-stop(100%,rgba(128,128,128,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(128,128,128,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(128,128,128,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(128,128,128,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(128,128,128,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33808080', endColorstr='#00808080',GradientType=1 ); /* IE6-9 */
	border-top:1px solid transparent;
	border-right:1px solid transparent;
	border-bottom:1px solid transparent;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(255,225,161,0.3) 0%, rgba(255,225,161,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,225,161,0.3)), color-stop(100%,rgba(255,225,161,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(255,225,161,0.3) 0%,rgba(255,225,161,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(255,225,161,0.3) 0%,rgba(255,225,161,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(255,225,161,0.3) 0%,rgba(255,225,161,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(255,225,161,0.3) 0%,rgba(255,225,161,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4dffe1a1', endColorstr='#00ffe1a1',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #888;
}
.trackback , .pingback {
	border-left:3px solid #ddd;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools {
	background-color:#fff;
	border:1px solid #999;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#fff;
}
#header h1 {
	margin: 0;
	font-size:4em;
	text-shadow:2px 2px 5px #000;
}
#header .description {
	text-shadow: 1px 1px 1px #000000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}
#header a {
	color: #fff;
}
#content {
	border-radius: 15px;
	background-color:#F6F6F6;
	border:1px solid #333;
}
#nav_pages {
	padding-top: 10px;
	border-top: 1px solid #ccc;
}
#credits {
	border-top:1px solid #E8A403;
	float:left;
	padding-bottom:100px;
	text-align:right;
	width:99%;
	color: #ccc;
	padding-right: 1%;
}
.intr {
	color: #ccc;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	border: 1px solid #999;
	background: rgb(239,239,239); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(239,239,239,1) 0%, rgba(202,202,202,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(239,239,239,1)), color-stop(100%,rgba(202,202,202,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(239,239,239,1) 0%,rgba(202,202,202,1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
/* <---- Captions & aligment */
<?php break; ?>
<?php case 'air': ?>
/*
genlook (air style)
*/
/* Common html tags ----> */
a {
	color: #0080bc;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover {
	color: #d54e21;
}
blockquote {
	border-left:6px double #fff;
}
body {
	color: #333;
	background: #e2e2e2 url(../images/air/bg.jpg) left top no-repeat;
}
h2.posts_date {
	border-bottom:2px groove #fff;
	color:#666;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #f4f4f4;
}
/* table elements*/
table {
	border: 1px solid #aaa;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
thead {
	background-color:#fff;
}
tfoot {
	background-color:#ddd;
}
th {
	border:1px solid #ccc;
}
fieldset {
	border:1px solid #ccc;
}
legend {
	color: #aaa;
}
/* <---- Common html tags */
/* Post classes ----> */
.post ul li {
	border-left:4px solid #333;
}
.meta {
	color: #808080;
}
.storytitle a {
	color: #333;
}
.storytitle a:hover {
	color: #d54e21;
}
.sticky {
	background: -moz-linear-gradient(top,  rgba(201,238,255,0.1) 0%, rgba(201,238,255,0.1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(201,238,255,0.1)), color-stop(100%,rgba(201,238,255,0.1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(201,238,255,0.1) 0%,rgba(201,238,255,0.1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1ac9eeff', endColorstr='#1ac9eeff',GradientType=0 ); /* IE6-9 */
	border:1px solid #87CEFA;
	padding:5px;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
	border-top:1px solid #eee;
	border-right:1px solid #eee;
	border-bottom:1px solid #eee;
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(128,128,128,0.2) 0%, rgba(125,185,232,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(128,128,128,0.2)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(125,185,232,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(125,185,232,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(125,185,232,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(128,128,128,0.2) 0%,rgba(125,185,232,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33808080', endColorstr='#007db9e8',GradientType=1 ); /* IE6-9 */
	border-top:1px solid transparent;
	border-right:1px solid transparent;
	border-bottom:1px solid transparent;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(161,214,255,0.2) 0%, rgba(125,185,232,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(161,214,255,0.2)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(125,185,232,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(125,185,232,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(125,185,232,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(125,185,232,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33a1d6ff', endColorstr='#007db9e8',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #888;
}
.trackback , .pingback {
	border-left:3px solid #F4F4F4;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools {
	background-color:#f4f4f4;
	border:1px solid #aaa;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#fff;
}
#header h1 {
	margin: 0;
	font-size:4em;
	text-shadow:2px 2px 5px #000;
}
#header .description {
	text-shadow: 1px 1px 1px #000000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}
#header a {
	color: #fff;
}
#nav_pages {
	padding-top: 5px;
	border-top:2px groove #fff;
}
#credits {
	border-top:2px groove #fff;
	float:left;
	padding-bottom:100px;
	text-align:center;
	width:100%;
}
.intr {
	color: #ccc;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	border: 1px solid #aaa;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
/* <---- Captions & aligment */
<?php break; ?>
<?php case 'water': ?>
a {
	color: #fff;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover, #content a:hover, .storytitle a:hover {
	color: #D54E21;
}
blockquote {
	border-left:4px double #fff;
}
body {
	color: #333;
	background: #43a4ff url(../images/water/bg.jpg) left top no-repeat;
}
h2.posts_date {
	border-bottom:1px solid #5fb6ff;
	color:#CFE9FF;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #5FB6FF;
}
table {
	background-color:#A9D6FF;
	border:3px double #fff;
}
thead {
	background-color:#CFE9FF;
}
tfoot {
	background-color:#CFE9FF;
}
fieldset {
	border:1px solid #5fb6ff;
}
legend {
	color: #CFE9FF;
}
/* <---- Common html tags */
/* Post classes ----> */
.post ul li {
	border-left:4px solid #333;
}
.storytitle  {
	border-bottom:3px double #CFE9FF;
	margin:0 0 3px;
}
.meta {
	background: -moz-linear-gradient(left,  rgba(30,144,255,1) 0%, rgba(30,144,255,0) 60%, rgba(30,144,255,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(30,144,255,1)), color-stop(60%,rgba(30,144,255,0)), color-stop(100%,rgba(30,144,255,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e90ff', endColorstr='#001e90ff',GradientType=1 ); /* IE6-9 */
	color:#CFE9FF;
	padding:4px;
}
.storytitle a {
	color: #333;
}
.sticky {
	background: -moz-linear-gradient(top,  rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.2) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.3)), color-stop(100%,rgba(255,255,255,0.2))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.2) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.2) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.2) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.2) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4dffffff', endColorstr='#33ffffff',GradientType=0 ); /* IE6-9 */
	border:1px solid #b4e1fe;
	padding:5px;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%, rgba(255,255,255,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0.2)), color-stop(60%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(255,255,255,0.2) 0%,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(255,255,255,0.2) 0%,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(255,255,255,0.2) 0%,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(255,255,255,0.2) 0%,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33ffffff', endColorstr='#00ffffff',GradientType=1 ); /* IE6-9 */
	border-top:1px solid #4dadff;
	border-right:1px solid #4dadff;
	border-bottom:1px solid #4dadff;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(30,144,255,1) 0%, rgba(30,144,255,0) 60%, rgba(30,144,255,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(30,144,255,1)), color-stop(60%,rgba(30,144,255,0)), color-stop(100%,rgba(30,144,255,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(30,144,255,1) 0%,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e90ff', endColorstr='#001e90ff',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #0083F2;
}
.trackback , .pingback {
	border-left:3px solid #0060AA;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools {
	background-color:#5FB6FF;
	border:1px solid #fff;
	background-image: none;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#333;
}
#header h1 {
	margin: 0;
	font-size:4em;
	text-shadow:3px 3px 5px #DDFFFF;
	filter: dropshadow(color=#ffffff,offX=3,offY=3);
}
#header .description {
	text-shadow: 1px 1px 1px #fff;
	filter: dropshadow(color=#ffffff,offX=1,offY=1);
}
#header a {
	color: #333;
}
#credits {
	border-top:3px double #fff;
	float:left;
	padding-bottom:100px;
	text-align:right;
	width:99%;
	color: #CFE9FF;
	padding-right: 1%;
}
.intr {
	color: #ccc;
}
#nav_pages {
	padding-top: 10px;
	border-top: 1px solid #5fb6ff;
	color: #5fb6ff;
	width:105%;
}
#nav_pages a {
	background-color:#5FB6FF;
	border:1px solid #fff;
	padding: 3px;
	border-radius: 3px;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	border: 3px double #fff;
	background-color: #a9d6ff;
}
<?php break; ?>
<?php case 'earth': ?>
/*
genlook (earth style)
*/
/* Common html tags ----> */
a {
	color: #D54E21;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover, #content a:hover {
	color: #87CEFA;
}
#content .wp-caption a:hover, #nav_pages a:hover, #content .comment_tools a:hover {
	color: #0080BC;
}
blockquote {
	border-left:4px double #fff;
	color: #f5deb3;
}
body {
	color: #ccc;
	background: #080808 url(../images/earth/bg.jpg) left top no-repeat;
}
h2.posts_date {
	border-bottom:1px solid #3f2715;
	color:#d9bd8e;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #3f2715;
	background-color:#110B07;
}
table {
	background-color:transparent;
	border:3px double #3f2715;
}
thead {
	background-color:#3f2715;
}
tfoot {
	background-color:#110B07;
}
th {
	border: none;
}
fieldset {
	border:1px solid #3f2715;
}
legend {
	color: #D9BD8E;
}
/* <---- Common html tags */
/* Post classes ----> */
.post {
	margin-bottom:2em;
}
.post ul li {
	border-left:4px solid #3f2715;
}
.meta {
	background-color:#3f2715;
	color:#D9BD8E;
	margin-top:4px;
	padding:4px;
	background-color:#333;
	border-style:solid none;
	border-width:1px;
}
.comment_like .meta {
	background-color: transparent;
	border: none;
}
#content .storytitle a {
	color: #fff;
}
#content .storytitle a:hover  {
	color: #D54E21;
}
.sticky {
	background: -moz-linear-gradient(left,  rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.25) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(0,0,0,0.25)), color-stop(100%,rgba(0,0,0,0.25))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(0,0,0,0.25) 0%,rgba(0,0,0,0.25) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(0,0,0,0.25) 0%,rgba(0,0,0,0.25) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(0,0,0,0.25) 0%,rgba(0,0,0,0.25) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(0,0,0,0.25) 0%,rgba(0,0,0,0.25) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#40000000', endColorstr='#40000000',GradientType=1 ); /* IE6-9 */
	border:1px solid #f5deb3;
	padding:5px;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
	border-top:1px solid #24160c;
	border-right:1px solid #24160c;
	border-bottom:1px solid #24160c;
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.05) 1%, rgba(244,244,244,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0.05)), color-stop(1%,rgba(255,255,255,0.05)), color-stop(100%,rgba(244,244,244,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(255,255,255,0.05) 0%,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(255,255,255,0.05) 0%,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(255,255,255,0.05) 0%,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(255,255,255,0.05) 0%,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0dffffff', endColorstr='#00f4f4f4',GradientType=1 ); /* IE6-9 */
	border-top:1px solid transparent;
	border-right:1px solid transparent;
	border-bottom:1px solid transparent;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(245,222,179,0.2) 0%, rgba(245,222,179,0.2) 1%, rgba(245,222,179,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(245,222,179,0.2)), color-stop(1%,rgba(245,222,179,0.2)), color-stop(100%,rgba(245,222,179,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(245,222,179,0.2) 0%,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(245,222,179,0.2) 0%,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(245,222,179,0.2) 0%,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(245,222,179,0.2) 0%,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33f5deb3', endColorstr='#00f5deb3',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #0083F2;
}
#commentlist li .avatar {
	border:1px solid #3f2715;
}
.trackback , .pingback {
	border-left:3px solid #0060AA;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools {
	background-color:#D9BD8F;
	border:1px solid #fff;
	color:#555;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#bbb;
	padding-left:50px;
	text-shadow:3px 3px 6px #000;
}
#header h1 {
	margin: 0;
	font-size:4em;
}
#header .description {
	text-shadow: 1px 1px 1px #000000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}
#header a {
	color: #fff;
}
#content {
	margin-bottom:0;
	margin-left:25px;
}
#nav_pages {
	padding-top: 10px;
	border-top: 1px solid #3f2715;
	color: #3f2715;
	width:105%;
}
#nav_pages a {
	background-color:#D9BD8F;
	border:1px solid #fff;
	padding: 3px;
	border-radius: 3px;
	font-size:0.9em;
}
#credits {
	border-top:1px solid;
	clear:both;
	color:#D9BD8E;
	padding:4px 1% 90px 5%;
	text-align:right;
	width:94%;
}
.intr {
	color: #ccc;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	border: 3px solid #fff;
	background-color: #D9BD8F;
	color:#555;
}
/* <---- Captions & aligment */
<?php break; ?>
<?php case 'smoke': ?>
/*
genlook (smoke style)
*/
/* Common html tags ----> */
a {
	color: #0080bc;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover {
	color: #ccc;
}
blockquote {
	border-left:6px double #fff;
}
body {
	color: #fff;
	background: #000 url(../images/smoke/bg.jpg) center top repeat-y;
}
h2.posts_date {
	border-bottom:1px solid #666;
	color:#666;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #f4f4f4;
	background-color:#222;
}
/* table elements*/
table {
	border: 1px solid #666;
}
thead {
	background-color:#fff;
}
tfoot {
	background-color:#ddd;
}
th {
	border:1px solid #666;
}
fieldset {
	border:1px solid #ccc;
}
legend {
	color: #aaa;
}
code {
	background-color:#222;
}
/* <---- Common html tags */
/* Post classes ----> */
.hentry ul li {
	border-left:4px solid #333;
}
.meta {
	color: #808080;
}
.storytitle a {
	color: #F3F45B;
}
.storytitle a:hover {
	color: #ccc;
}
.hentry,
.c_list {
	padding:5px;
	border-radius: 10px;
	background: #0d0d0d;
	background: -moz-linear-gradient(top,  rgba(13,13,13,0.9) 0%, rgba(13,13,13,0.9) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(13,13,13,0.9)), color-stop(100%,rgba(13,13,13,0.9))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(13,13,13,0.9) 0%,rgba(13,13,13,0.9) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(13,13,13,0.9) 0%,rgba(13,13,13,0.9) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(13,13,13,0.9) 0%,rgba(13,13,13,0.9) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(13,13,13,0.9) 0%,rgba(13,13,13,0.9) 100%); /* W3C */
	border: 5px solid #222;
	margin-bottom: 10px;
}
.sticky {
	border: 5px solid #999;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
	border-top:1px solid #666;
	border-right:1px solid #666;
	border-bottom:1px solid #666;
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(52,52,52,0.6) 0%, rgba(52,52,52,0) 60%, rgba(52,52,52,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(52,52,52,0.6)), color-stop(60%,rgba(52,52,52,0)), color-stop(100%,rgba(52,52,52,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(52,52,52,0.6) 0%,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(52,52,52,0.6) 0%,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(52,52,52,0.6) 0%,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(52,52,52,0.6) 0%,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99343434', endColorstr='#00343434',GradientType=1 ); /* IE6-9 */
	border-top:1px solid transparent;
	border-right:1px solid #0D0D0D;
	border-bottom:1px solid transparent;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(161,214,255,0.2) 0%, rgba(161,214,255,0) 60%, rgba(161,214,255,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(161,214,255,0.2)), color-stop(60%,rgba(161,214,255,0)), color-stop(100%,rgba(161,214,255,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33a1d6ff', endColorstr='#00a1d6ff',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #888;
}
.trackback , .pingback {
	border-left:3px solid #F4F4F4;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools,
#nav_pages {
	border:1px solid #666;
	float: none;
	text-align: center;
	background: none repeat scroll 0 0 #0D0D0D;
	border-radius: 5px;
	padding: 3px;
}
#commentform textarea {
    width: 99%;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#fff;
	padding: 30px 0;
	text-align: center;
}
#header h1 {
	margin: 0;
	font-size:4em;
	text-shadow:2px 2px 5px #000;
}
#header .description {
	text-shadow: 1px 1px 1px #000000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}
#header a {
	color: #fff;
}
#nav_pages {
	padding-top: 5px;
	border-bottom:1px solid #666;
}
#credits {
	border-top:2px groove #fff;
	float:left;
	padding-bottom:100px;
	text-align:center;
	width:100%;
}
.intr {
	color: #ccc;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	border: 1px solid #ccc;
	background:#444;
}
/* <---- Captions & aligment */
<?php break; ?>
<?php case 'clouds': ?>
/*
genlook (clouds style)
*/
/* Common html tags ----> */
a {
	color: #0080bc;
	text-decoration: none;
}
a:hover, .menu-item a:hover, #credits a:hover {
	color: #666;
}
blockquote {
	border-left:6px double #fff;
}
body {
	color: #444;
	background: #000 url(../images/clouds/bg.jpg) center top repeat-y;
}
h2.posts_date {
	border-bottom:1px solid #666;
	color:#666;
	font-size:0.9em;
	padding-bottom:3px;
	text-align:right;
}
pre {
	border:1px solid #f4f4f4;
	background-color:#ccc;
}
/* table elements*/
table {
	border: 1px solid #666;
}
thead {
	background-color:#fff;
}
tfoot {
	background-color:#ddd;
}
th {
	border:1px solid #666;
}
fieldset {
	border:1px solid #ccc;
}
legend {
	color: #aaa;
}
code {
	background-color:#ccc;
}
/* <---- Common html tags */
/* Post classes ----> */
.hentry ul li {
	border-left:4px solid #333;
}
.meta {
	color: #808080;
}
.storytitle a {
	color: #0080bc;
}
.storytitle a:hover {
	color: #ccc;
}
.hentry,
.c_list {
	padding:10px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(left,  rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.9) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0.9)), color-stop(100%,rgba(255,255,255,0.9))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(255,255,255,0.9) 0%,rgba(255,255,255,0.9) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6ffffff', endColorstr='#e6ffffff',GradientType=1 ); /* IE6-9 */
	border: 1px solid #fff;
	margin-bottom: 10px;
}
.sticky {
	border: 1px solid #0080BC;
}
/* <---- Post classes */
/* Comment classes ----> */
.comment:hover  {
	border-top:1px solid #fff;
	border-right:1px solid #fff;
	border-bottom:1px solid #fff;
}
.comment, .trackback , .pingback  {
	background: -moz-linear-gradient(left,  rgba(203,203,203,0.6) 0%, rgba(203,203,203,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(203,203,203,0.6)), color-stop(100%,rgba(203,203,203,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(203,203,203,0.6) 0%,rgba(203,203,203,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(203,203,203,0.6) 0%,rgba(203,203,203,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(203,203,203,0.6) 0%,rgba(203,203,203,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(203,203,203,0.6) 0%,rgba(203,203,203,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99cbcbcb', endColorstr='#00cbcbcb',GradientType=1 ); /* IE6-9 */
	border-top:1px solid transparent;
	border-right:1px solid transparent;
	border-bottom:1px solid transparent;
}
.bypostauthor {
	background: -moz-linear-gradient(left,  rgba(161,214,255,0.2) 0%, rgba(161,214,255,0) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(161,214,255,0.2)), color-stop(100%,rgba(161,214,255,0))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(161,214,255,0.2) 0%,rgba(161,214,255,0) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33a1d6ff', endColorstr='#00a1d6ff',GradientType=1 ); /* IE6-9 */
}
.comment {
	border-left:3px solid #888;
}
.trackback , .pingback {
	border-left:3px solid #F4F4F4;
}
.feedback {
	color: #808080;
	text-align: right;
	clear: both;
}
.comment_tools,
#nav_pages {
	border:1px solid #0080BC;
	float: none;
	text-align: center;
	background: #eee;
	border-radius: 5px;
	padding: 3px;
}
#commentform textarea {
    width: 99%;
}
/* <---- Comment classes */
/* Other classes ----> */
#header {
	color:#fff;
	padding: 30px 0;
	text-align: center;
}
#header h1 {
	margin: 0;
	font-size:4em;
	text-shadow:2px 2px 5px #000;
}
#header .description {
	text-shadow: 1px 1px 1px #000000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}
#header a {
	color: #fff;
}
#credits {
	border-top:2px groove #fff;
	float:left;
	padding-bottom:100px;
	text-align:center;
	width:100%;
	color: #fff;
}
.intr {
	color: #ccc;
}
#content .gallery img {
    border: 1px solid #fff;
    padding: 10px;
}
/* <---- Other classes */
/* Captions & aligment ----> */
.wp-caption {
	position: relative;
	border-radius: 0;
	border:1px solid #888;
}
.wp-caption p.wp-caption-text {
	background: -moz-linear-gradient(left,  rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.7) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(0,0,0,0.7)), color-stop(100%,rgba(0,0,0,0.7))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.7) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.7) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.7) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.7) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3000000', endColorstr='#b3000000',GradientType=1 ); /* IE6-9 */
    bottom: 0;
	left:0;
    color: #fff;
    margin: 0;
    padding: 0 0 5px;
    position: absolute;
    width: 100%;
}
.wp-caption:hover p.wp-caption-text {
	display: none;
}

/* <---- Captions & aligment */
<?php break; ?>
<?php } ?>
<?php switch ( $load['sidebar'] ) { ?>
<?php case 'fire': ?>
#menu a {
	color: #87CEFA;
	text-decoration: none;
}
#menu a:hover {
	color: #d54e21;
}
#sidebarbody
{
	padding: 10px 10px 10px 18px;
	background: transparent url('../images/fire/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/fire/graph.png') -600px top no-repeat;
	height:25px;
}
#sidebarbottom
{
	background: transparent url('../images/fire/graph.png') no-repeat top left;
	height:25px;
}
.searchform {
	border: 1px solid #666;
	background: #444;
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #333;
}
#menu ul li {
	color:#ddd;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#calendar_wrap {
	border: 1px solid #666;
	background-color: #444;
	color:#ccc;
}
#wp-calendar caption {
	color: #999;
}
#wp-calendar #today {
	background-color: #333;
}
#wp-calendar thead {
	background: transparent;
}
#wp-calendar th {
	border:1px solid #555;
}
#wp-calendar tfoot {
	background: transparent;
}
<?php break; ?>
<?php case 'air': ?>
#menu a {
	color: #0080bc;
	text-decoration: none;
}
#menu a:hover {
	color: #d54e21;
}
#sidebarbody
{
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/air/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/air/graph.png') -600px top no-repeat;
	height:25px;
}
#sidebarbottom
{
	background: transparent url('../images/air/graph.png') no-repeat top left;
	height:25px;
}
.searchform {
	border: 1px solid #aaa;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #333;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#calendar_wrap {
	border: 1px solid #aaa;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
}
#wp-calendar caption {
	color: #aaa;
}
#wp-calendar #today {
	background: #aaa;
	color: #fff;
}
#wp-calendar tfoot {
	background: transparent;
}
<?php break; ?>
<?php case 'water': ?>
#menu a {
	color: #0080BC;
	text-decoration: none;
}
#menu a:hover {
	color: #d54e21;
}
#sidebarbody
{
	padding: 10px 10px 10px 18px;
	background: transparent url('../images/water/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/water/graph.png') -600px top no-repeat;
	height:50px;
}
#sidebarbottom
{
	background: transparent url('../images/water/graph.png') no-repeat top left;
	height:50px;
}
.searchform {
	border: 1px solid #fff;
	background-color: #A9D6FF;
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #333;
}
#menu ul li {
	color:#555;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#calendar_wrap {
	border: 1px solid #fff;
}
#wp-calendar caption {
	color: #fff;
}
#wp-calendar #today {
	border: 1px solid #fff;
}
#wp-calendar thead {
	border-top: 3px double #fff;
	border-bottom: 3px double #fff;
	background-color: #CFE9FF;
}
#wp-calendar th {
	border:none;
}
#wp-calendar tfoot {
	background: transparent;
}
#wp-calendar {
	border-collapse: collapse;
}
<?php break; ?>
<?php case 'earth': ?>
#menu a {
	color: #87CEFA;
	text-decoration: none;
}
#menu a:hover {
	color: #d54e21;
}
#sidebarbody
{
	padding: 1px 4px 10px 18px;
	background: transparent url('../images/earth/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/earth/graph.png') -600px top no-repeat;
	height:30px;
}
#sidebarbottom
{
	background: transparent url('../images/earth/graph.png') no-repeat top left;
	height:30px;
}
.searchform {
	border: 1px solid #3F2715;
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #333;
}
#menu ul li {
	color:#D9BD8E;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#calendar_wrap {
	border: 1px solid #3F2715;
	margin:5px 0;
}
#wp-calendar caption {
	color:#3F2715;
	padding:3px;
}
#wp-calendar #today {
	color:#fff;
}
#wp-calendar thead {
	border-top: 1px solid #D9BD8E;
	border-bottom: 1px solid #D9BD8E;
	background-color: #333;
}
#wp-calendar th {
	border:none;
}
#wp-calendar tfoot {
	background: transparent;
}
#wp-calendar {
	border-collapse: collapse;
}
<?php break; ?>
<?php case 'smoke': ?>
#menu a {
	color: #0080bc;
	text-decoration: none;
}
#menu a:hover {
	color: #fff;
}
#sidebarbody
{
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/smoke/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/smoke/graph.png') -600px top no-repeat;
	height:25px;
}
#sidebarbottom
{
	background: transparent url('../images/smoke/graph.png') no-repeat top left;
	height:25px;
}
.searchform {
	border: 1px solid #666;
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #aaa;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#menu #calendar_wrap {
	border: 1px solid #666;
}
#menu #wp-calendar caption {
	color: #aaa;
}
#menu #wp-calendar #today {
	background: #222;
	color: #fff;
}
#menu #wp-calendar tfoot {
	background: transparent;
}
#menu #wp-calendar thead {
	background: transparent;
}
<?php break; ?>
<?php case 'clouds': ?>
#menu a {
	color: #0080bc;
	text-decoration: none;
}
#menu a:hover {
	color: #888;
}
#sidebarbody
{
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/clouds/graph.png') -1200px top repeat-y;
}
#sidebartop
{
	background: transparent url('../images/clouds/graph.png') -600px top no-repeat;
	height:25px;
}
#sidebarbottom
{
	background: transparent url('../images/clouds/graph.png') no-repeat top left;
	height:25px;
}
.searchform {
	border: 1px solid #666;
}
#menu input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}
#menu ul {
	color: #666;
}
/* <---- Sidebar classes */
/* Calendar classes ----> */
#menu #calendar_wrap {
	border: 1px solid #aaa;
}
#menu #wp-calendar caption {
	color: #aaa;
}
#menu #wp-calendar #today {
	background: #aaa;
	color: #fff;
}
#menu #wp-calendar tfoot {
	background: transparent;
}
<?php break; ?>
<?php } ?>
<?php switch ( $load['pages'] ) { ?>
<?php case 'fire': ?>
.page_item a, .menu-item a {
	color: #87CEFA;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #d54e21;
}
#pages {
	background: #404040; /* Old browsers */
	background: -moz-linear-gradient(top,  #404040 0%, #6c6c6c 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#404040), color-stop(100%,#6c6c6c)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #404040 0%,#6c6c6c 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #404040 0%,#6c6c6c 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #404040 0%,#6c6c6c 100%); /* IE10+ */
	background: linear-gradient(top,  #404040 0%,#6c6c6c 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#404040', endColorstr='#6c6c6c',GradientType=0 ); /* IE6-9 */
	border-bottom:1px solid #888;
	border-top:1px solid #333;
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item{
	background: transparent url("../images/fire/pages_sep.png") right center no-repeat;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #d54e21;
}
<?php break; ?>
<?php case 'air': ?>
.page_item a, .menu-item a {
	color: #fff;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #d54e21;
}
#pages {
	background: -moz-linear-gradient(top,  rgba(87,154,209,0.8) 0%, rgba(87,154,209,0.8) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(87,154,209,0.8)), color-stop(100%,rgba(87,154,209,0.8))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(87,154,209,0.8) 0%,rgba(87,154,209,0.8) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(87,154,209,0.8) 0%,rgba(87,154,209,0.8) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(87,154,209,0.8) 0%,rgba(87,154,209,0.8) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(87,154,209,0.8) 0%,rgba(87,154,209,0.8) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cc579ad1', endColorstr='#cc579ad1',GradientType=0 ); /* IE6-9 */
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item {
	border-right:1px solid #aaa;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #d54e21;
}
<?php break; ?>
<?php case 'water': ?>
.page_item a, .menu-item a {
	color: #0080BC;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #d54e21;
}
#pages {
	background: transparent url("../images/water/head.png") left top repeat;
	border-top:1px solid #fff;
	border-bottom:1px solid #777;
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item{
	background: transparent url("../images/water/pages_sep.png") right center no-repeat;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #d54e21;
}
<?php break; ?>
<?php case 'earth': ?>
.page_item a, .menu-item a {
	color: #555;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #0080BC;
}
#rap #pages {
	background-color: #f5deb3;
	border:7px solid #fff;
	margin-left:27px;
	border-radius: 7px;
	padding:0;
}
#pages_subcont {
	padding:10px 30% 25px 5%;
	border:1px solid #a9d6ff;
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item{
	background: transparent url("../images/earth/pages_sep.png") right center no-repeat;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #0080BC;
}
<?php break; ?>
<?php case 'smoke': ?>
.page_item a, .menu-item a {
	color: #ccc;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #0080BC;
}
#pages {
	background: #131313;
	background: -moz-linear-gradient(top,  rgba(19,19,19,1) 0%, rgba(19,19,19,1) 30%, rgba(19,19,19,0.9) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(19,19,19,1)), color-stop(30%,rgba(19,19,19,1)), color-stop(100%,rgba(19,19,19,0.9))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#131313', endColorstr='#e6131313',GradientType=0 ); /* IE6-9 */
	border-bottom: 4px double #fff;
	border-top: 4px double #fff;
	box-shadow: -10px 0 10px #000;
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item {
	border-right:1px solid #aaa;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #d54e21;
}
<?php break; ?>
<?php case 'clouds': ?>
.page_item a, .menu-item a {
	color: #0080BC;
	text-decoration: none;
}
.page_item a:hover, .menu-item a:hover {
	color: #888;
}
#pages {
	background: -moz-linear-gradient(left,  rgba(255,255,255,0.5) 0%, rgba(255,255,255,0.5) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0.5)), color-stop(100%,rgba(255,255,255,0.5))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.5) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.5) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.5) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(255,255,255,0.5) 0%,rgba(255,255,255,0.5) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#80ffffff', endColorstr='#80ffffff',GradientType=1 ); /* IE6-9 */
	padding: 7px 34% 7px 0;
	border: 1px solid #fff;
	color: #666;
	box-shadow: -10px 0 10px #A9D6FF;
}
#pages_subcont {
	padding:10px 30% 25px 30px;
	border:1px solid #67B9FF;
	background: #fff;
	width: 95%;
}
#mainmenu > li.menu-item ,
#mainmenu > li.page_item {
	border-right:1px solid #aaa;
}
.current_page_ancestor .hiraquo,
.current-menu-ancestor .hiraquo {
	color: #d54e21;
}
<?php break; ?>
<?php } ?>
<?php switch ( $load['popup'] ) { ?>
<?php case 'fire': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #87CEFA;
	text-decoration: none;
}
.comment .comment a {
	color: #004867;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #d54e21;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #d54e21;
}
.footer_wig .fw_pul{
	color: #ccc;
	padding: 10px;
	border-color:#888;
	border-style:solid;
	border-width:1px;
	background: #333 url("../images/fire/pop.jpg") left top no-repeat;
	border-radius: 5px;
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	border:1px solid #888;
	background: #333 url(../images/fire/pop.jpg) left top no-repeat;
	border-radius: 5px;
	color: #ccc;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php case 'air': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #d54e21;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #d54e21;
}
.footer_wig .fw_pul{
	color: #333;
	padding: 10px;
	border-color:#aaa;
	border-style:solid;
	border-width:1px;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
	border-radius: 5px;
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	border: 1px solid #aaa;
	background: #efefef; /* Old browsers */
	background: -moz-linear-gradient(top,  #efefef 0%, #cacaca 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#cacaca)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #efefef 0%,#cacaca 100%); /* IE10+ */
	background: linear-gradient(top,  #efefef 0%,#cacaca 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#cacaca',GradientType=0 ); /* IE6-9 */
	border-radius: 3px;
	color: #333;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php case 'water': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #87CEFA;
	text-decoration: none;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #fff;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #fff;
}
.footer_wig .fw_pul{
	color: #ccc;
	padding: 10px;
	border-color:#fff;
	border-style:double;
	border-width:3px;
	background: #0080BC url("../images/water/pop.jpg") left top no-repeat;
	border-radius: 5px;
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	border:3px double #fff;
	background: #0080BC url(../images/water/pop.jpg) left top no-repeat;
	border-radius: 5px;
	color: #ccc;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php case 'earth': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #87CEFA;
	text-decoration: none;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #D54E21;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #d54e21;
}
.footer_wig .fw_pul{
	color: #ccc;
	padding: 10px;
	border:3px solid #fff;	
	background: #000 url(../images/earth/pop.jpg) left top repeat-x;
	border-radius: 5px;
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	border:3px solid #fff;	
	background: #000 url(../images/earth/pop.jpg) left top repeat-x;
	border-radius: 5px;
	color: #ccc;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php case 'smoke': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #fff;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #d54e21;
}
.footer_wig .fw_pul{
	color: #aaa;
	padding: 10px;
	background: #000000;
	background: -moz-linear-gradient(top,  rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.95) 30%, rgba(0,0,0,0.85) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.95)), color-stop(30%,rgba(0,0,0,0.95)), color-stop(100%,rgba(0,0,0,0.85))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2000000', endColorstr='#d9000000',GradientType=0 ); /* IE6-9 */
	border: 5px solid #222;
	border-radius: 5px;
	box-shadow: 1px 1px 2px #000;
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	background: #000000;
	background: -moz-linear-gradient(top,  rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.95) 30%, rgba(0,0,0,0.85) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.95)), color-stop(30%,rgba(0,0,0,0.95)), color-stop(100%,rgba(0,0,0,0.85))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2000000', endColorstr='#d9000000',GradientType=0 ); /* IE6-9 */
	border: 5px solid #222;
	border-radius: 3px;
	color: #aaa;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php case 'clouds': ?>
#pages .children a, .sub-menu a, .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}
#pages .children a:hover, .sub-menu a:hover, .fw_pul a:hover {
	color: #888;
}
.current_page_item > a,
.current-menu-item > a,
.current-cat > a {
	color: #d54e21;
}
.footer_wig .fw_pul{
	padding: 10px;
	border-radius: 5px;
	box-shadow: 1px 1px 2px #000;
	background: #fff;
	border: 2px solid #ccc;
	color: #666;	
}
#mainmenu > li.page_item > ul.children,
#mainmenu > li.menu-item > ul.sub-menu {
	border-radius: 3px;
	background: #fff;
    border: 2px solid #ccc;
    color: #666;	
	z-index:2;
}
#mainmenu ul.sub-menu, #mainmenu ul.children {
	margin:0px;
	padding:0px;
}<?php break; ?>
<?php } ?>
<?php switch ( $load['quickbar'] ) { ?>
<?php case 'fire': ?>
#quickbar {
	color: #ccc;
	margin: 0 0 10px;
	padding: 0;
	bottom: 0;
	height:56px;
	width:100%;
	left: 0;
}
#qb_left {
	background: transparent url(../images/fire/qb.png) left -112px no-repeat;
	float:left;
	height:56px;
	margin-left:1%;
	width:2%;
}
#qb_center {
	background: transparent url(../images/fire/qb.png) left top repeat-x;
	float:left;
	height:56px;
	width:83%;
}
#qb_right {
	background: transparent url(../images/fire/qb.png) right -56px no-repeat;
	float:left;
	height:36px;
	width:13%;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig {
	background:url("../images/fire/menu_sep.png") no-repeat right top transparent;
}
.footer_wig:hover h4{
	color: #fff;
}
#avatar_cont {
	margin-top:-46px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/fire/micronav.png);
}
#micronav {
	background: url(../images/fire/micronav.png) no-repeat scroll center -96px transparent;
}
<?php break; ?>
<?php case 'air': ?>
#quickbar {
	background: #888888; /* Old browsers */
	background: -moz-linear-gradient(top,  #888888 0%, #bebebe 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#888888), color-stop(100%,#bebebe)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #888888 0%,#bebebe 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #888888 0%,#bebebe 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #888888 0%,#bebebe 100%); /* IE10+ */
	background: linear-gradient(top,  #888888 0%,#bebebe 100%); /* W3C */
	border-top: 2px groove #fff;
	color: #333;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 0;
	height:54px;
	width:100%;
	left: 0;
}
#qb_right {
	background: transparent url(../images/air/grey-s.png) right center no-repeat;
	float:right;
	height:34px;
	width:13%;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig {
	background:url("../images/air/menu_sep.png") no-repeat right top transparent;
}
.footer_wig:hover h4{
	color: #fff;
}
#avatar_cont {
	margin-top:-46px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/air/micronav.png);
}
#micronav {
	background: url(../images/air/micronav.png) no-repeat scroll center -96px transparent;
}
<?php break; ?>
<?php case 'water': ?>
#quickbar {
	background: transparent url(../images/water/qb.png) left top repeat-x;
	color: #555;
	margin: 0 0 10px;
	padding: 0;
	bottom: 0;
	height:63px;
	width:100%;
	left: 0;
}
#qb_left {
	float:left;
	height:56px;
	margin-left:1%;
	width:1%;
}
#qb_center {
	float:left;
	height:56px;
	width:81%;
}
#qb_right {
	background: transparent url(../images/air/grey-s.png) right center no-repeat;
	float:right;
	height:36px;
	width:16%;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig {
	background:url("../images/water/menu_sep.png") no-repeat right top transparent;
}
.footer_wig:hover h4{
	color: #0080BC;
}
#avatar_cont {
	margin-top:-46px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/water/micronav.png);
}
#micronav {
	background: url(../images/water/micronav.png) no-repeat scroll center -96px transparent;
}
<?php break; ?>
<?php case 'earth': ?>
#quickbar {
	background: transparent url(../images/earth/qb.png) left top repeat-x;
	color: #555;
	margin: 0 0 10px;
	padding: 0;
	bottom: 0;
	height:65px;
	width:97%;
	right:0;
}
#qb_left {
	float:left;
	height:56px;
	margin-left:0;
	width:0;
}
#qb_center {
	float:left;
	height:59px;
	width:82%;
	padding-top: 10px;
}
#qb_right {
	background: transparent url(../images/earth/grey-s.png) right center no-repeat;
	float:right;
	height:27px;
	width:17%;
	padding: 16px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig {
	background:url("../images/earth/menu_sep.png") no-repeat right 3px transparent;
}
.footer_wig:hover h4{
	color: #0080BC;
}
#avatar_cont {
	margin-left:-30px;
	margin-top:-30px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/earth/micronav.png);
}
#micronav {
	top: -4px;
	background: url(../images/earth/micronav.png) no-repeat scroll center -96px transparent;
}
<?php break; ?>
<?php case 'smoke': ?>
#quickbar {
	background: #131313;
	background: -moz-linear-gradient(top,  rgba(19,19,19,1) 0%, rgba(19,19,19,1) 30%, rgba(19,19,19,0.9) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(19,19,19,1)), color-stop(30%,rgba(19,19,19,1)), color-stop(100%,rgba(19,19,19,0.9))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* IE10+ */
	background: linear-gradient(top,  rgba(19,19,19,1) 0%,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%); /* W3C */
	border-bottom: 4px double #fff;
	border-top: 4px double #fff;
	color: #ccc;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 10px;
	height:54px;
	width:100%;
	box-shadow: -10px 0 10px #000;
	left: 0;
}
#qb_right {
	background: transparent url(../images/smoke/grey-s.png) right center no-repeat;
	float:right;
	height:34px;
	width:13%;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig {
	background:url("../images/smoke/menu_sep.png") no-repeat right top transparent;
}
.footer_wig:hover h4{
	color: #fff;
}
#avatar_cont {
	margin-top:-46px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/smoke/micronav.png);
}
#micronav {
	background: url(../images/smoke/micronav.png) no-repeat scroll center -96px transparent;
}
<?php break; ?>
<?php case 'clouds': ?>
#quickbar {
	color: #222;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 10px;
	height:54px;
	width:96%;
	left:2%;
	border-radius: 10px;
	box-shadow: 0 0 10px #000;
	background: rgb(220,220,220);
	background: -moz-linear-gradient(left,  rgba(220,220,220,0.9) 0%, rgba(220,220,220,0.9) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(220,220,220,0.9)), color-stop(100%,rgba(220,220,220,0.9))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  rgba(220,220,220,0.9) 0%,rgba(220,220,220,0.9) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  rgba(220,220,220,0.9) 0%,rgba(220,220,220,0.9) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  rgba(220,220,220,0.9) 0%,rgba(220,220,220,0.9) 100%); /* IE10+ */
	background: linear-gradient(left,  rgba(220,220,220,0.9) 0%,rgba(220,220,220,0.9) 100%); /* W3C */
    border: 1px solid #fff;
}
#qb_right {
	background: transparent url(../images/clouds/grey-s.png) right center no-repeat;
	float:right;
	height:34px;
	width:13%;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}
.footer_wig:hover h4{
	color: #666;
}
.footer_wig h4{
	border-radius: 7px;
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #0080bc;
    padding: 5px;
}
#avatar_cont {
	margin-top:-46px;
	float:left;
}
#micronav .prev a,
#micronav .next a,
#micronav .up a,
#micronav .home a,
#micronav .down a {
	background-image: url(../images/clouds/micronav.png);
}
#micronav {
	background: url(../images/clouds/micronav.png) no-repeat scroll center -96px transparent;
}

<?php break; ?>
<?php } ?>
<?php switch ( $load['avatar'] ) { ?>
<?php case 'fire': ?>
#avatar_cont {
	background:url("../images/fire/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php case 'air': ?>
#avatar_cont {
	background:url("../images/air/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php case 'water': ?>
#avatar_cont {
	background:url("../images/water/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php case 'earth': ?>
#avatar_cont {
	background:url("../images/earth/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php case 'smoke': ?>
#avatar_cont {
	background:url("../images/smoke/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php case 'clouds': ?>
#avatar_cont {
	background:url("../images/clouds/ava.png") no-repeat scroll center center transparent;
}
<?php break; ?>
<?php } ?>
<?php
exit;
