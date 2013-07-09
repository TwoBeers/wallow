<?php

$variants = array( 'fire' , 'air' , 'water' , 'earth', 'smoke', 'clouds' );
$elements = array( 'st' => 'style', 'si' => 'sidebar', 'qu' => 'quickbar', 'po' => 'popup', 'me' => 'menu', 'av' => 'avatar' );

foreach ( $elements as $key => $element ) {

	if ( isset( $_GET[$key] ) )
		$load[$element] = in_array( preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET[$key] ), $variants )? preg_replace( '/[^a-z0-9,_-]+/i', '', $_GET[$key] ) : 'fire';
	else
		$load[$element] = false;

}

$expires_offset = 31536000;

header('Content-Type: text/css');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");

?>

/* general */

<?php if ( !$load['style'] || $load['style'] == 'air' ) { ?>

.body-air {
	color: #333;
	background: #e2e2e2 url(../images/air/bg.jpg) left top no-repeat;
}

.body-air a:hover,
.body-air .menu-item a:hover,
.body-air #credits a:hover {
	color: #d54e21;
}

.body-air a {
	color: #0080bc;
	text-decoration: none;
}

.body-air blockquote {
	border-left: 6px double #fff;
}

.body-air fieldset {
	border: 1px solid #ccc;
}

.body-air h2.posts_date {
	border-bottom: 2px groove #fff;
	color: #666;
}

.body-air legend {
	color: #aaa;
}

.body-air pre {
	border: 1px solid #f4f4f4;
}

.body-air table {
	background: #F1F1F1;
}

.body-air tfoot {
	background-color: #ddd;
}

.body-air thead {
	background-color: #fff;
}

.body-air th {
	border: 1px solid #ccc;
}

.body-air #credits {
	border-top: 2px groove #fff;
	text-align: center;
}

.body-air #header .description {
	text-shadow: 1px 1px 1px #000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}

.body-air #header a {
	color: #fff;
}

.body-air #header h1 {
	margin: 0;
	font-size: 4em;
	text-shadow: 2px 2px 5px #000;
}

.body-air #header {
	color: #fff;
}

.body-air .comment.bypostauthor {
	border-left-color: #a1d6ff;
	background: -moz-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(125,185,232,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(161,214,255,0.2)),color-stop(100%,rgba(125,185,232,0)));
	background: -webkit-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(125,185,232,0) 100%);
	background: -o-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(125,185,232,0) 100%);
	background: -ms-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(125,185,232,0) 100%);
	background: linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(125,185,232,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33a1d6ff',endColorstr='#007db9e8',GradientType=1);
}

.body-air .comment,
.body-air .trackback,
.body-air .pingback {
	background: -moz-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(125,185,232,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(128,128,128,0.2)),color-stop(100%,rgba(125,185,232,0)));
	background: -webkit-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(125,185,232,0) 100%);
	background: -o-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(125,185,232,0) 100%);
	background: -ms-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(125,185,232,0) 100%);
	background: linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(125,185,232,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33808080',endColorstr='#007db9e8',GradientType=1);
	border-top: 1px solid transparent;
	border-right: 1px solid transparent;
	border-bottom: 1px solid transparent;
}

.body-air .comment:hover {
	border-top: 1px solid #eee;
	border-right: 1px solid #eee;
	border-bottom: 1px solid #eee;
}

.body-air .comment_tools {
	background-color: #f4f4f4;
	border: 1px solid #aaa;
}

.body-air .comment {
	border-left: 3px solid #888;
}

.body-air .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-air .intr {
	color: #ccc;
}

.body-air .meta {
	color: gray;
}

.body-air .nav_pages {
	padding-top: 5px;
	border-top: 2px groove #fff;
}

.body-air .post ul li {
	border-left: 4px solid #333;
}

.body-air .sticky {
	background: -moz-linear-gradient(top,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(201,238,255,0.1)),color-stop(100%,rgba(201,238,255,0.1)));
	background: -webkit-linear-gradient(top,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -o-linear-gradient(top,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -ms-linear-gradient(top,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: linear-gradient(top,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1ac9eeff',endColorstr='#1ac9eeff',GradientType=0);
	border: 1px solid #87cefa;
	padding: 5px;
}

.body-air .storytitle a:hover {
	color: #d54e21;
}

.body-air .storytitle a {
	color: #333;
}

.body-air .tb-author-bio {
	border: 2px groove #fff;
	background: transparent;
}

.body-air .trackback,
.body-air .pingback {
	border-left: 3px solid #f4f4f4;
}

.body-air .wp-caption {
	background: #F1F1F1;
}

.body-air #breadcrumb-wrap {
	border: 2px groove #fff;
	margin-bottom: 20px;
	padding: 5px;
}

.body-air .navigation-links {
	padding: 15px 0 10px;
	border-top: 1px solid #888;
	text-align: center;
}

<?php } ?>

<?php if ( !$load['style'] || $load['style'] == 'clouds' ) { ?>

.body-clouds {
	color: #444;
	background: #000 url(../images/clouds/bg.jpg) center top repeat-y;
}

.body-clouds a:hover,
.body-clouds .menu-item a:hover,
.body-clouds #credits a:hover {
	color: #666;
}

.body-clouds a {
	color: #0080bc;
	text-decoration: none;
}

.body-clouds blockquote {
	border-left: 6px double #fff;
}

.body-clouds code {
	background-color: #ccc;
}

.body-clouds fieldset {
	border: 1px solid #ccc;
}

.body-clouds h2.posts_date {
	border-bottom: none;
	color: #fff;
}

.body-clouds legend {
	color: #aaa;
}

.body-clouds pre {
	border: 1px solid #f4f4f4;
	background-color: #ccc;
}

.body-clouds table {
	border: 1px solid #666;
}

.body-clouds tfoot {
	background-color: #ddd;
}

.body-clouds thead {
	background-color: #fff;
}

.body-clouds th {
	border: 1px solid #666;
}

.body-clouds #commentform textarea {
	width: 99%;
}

.body-clouds #content .gallery img {
	border: 1px solid #fff;
	padding: 9px;
}

.body-clouds #content .tb-author-bio {
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,0.9)),color-stop(100%,rgba(255,255,255,0.9)));
	background: -webkit-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -o-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -ms-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e6ffffff',endColorstr='#e6ffffff',GradientType=1);
	border: 1px solid #fff;
}

.body-clouds #credits {
	border-top: 2px groove #fff;
	text-align: center;
	color: #fff;
}

.body-clouds #header .description {
	text-shadow: 1px 1px 1px #000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}

.body-clouds #header a {
	color: #fff;
}

.body-clouds #header h1 {
	margin: 0;
	font-size: 4em;
	text-shadow: 2px 2px 5px #000;
}

.body-clouds #header {
	color: #fff;
	padding: 30px 0;
	text-align: center;
}

.body-clouds .comment.bypostauthor {
	border-left-color: #a1d6ff;
	background: -moz-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(161,214,255,0.2)),color-stop(100%,rgba(161,214,255,0)));
	background: -webkit-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 100%);
	background: -o-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 100%);
	background: linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33a1d6ff',endColorstr='#00a1d6ff',GradientType=1);
}

.body-clouds .comment,
.body-clouds .trackback,
.body-clouds .pingback {
	background: -moz-linear-gradient(left,rgba(203,203,203,0.6) 0,rgba(203,203,203,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(203,203,203,0.6)),color-stop(100%,rgba(203,203,203,0)));
	background: -webkit-linear-gradient(left,rgba(203,203,203,0.6) 0,rgba(203,203,203,0) 100%);
	background: -o-linear-gradient(left,rgba(203,203,203,0.6) 0,rgba(203,203,203,0) 100%);
	background: -ms-linear-gradient(left,rgba(203,203,203,0.6) 0,rgba(203,203,203,0) 100%);
	background: linear-gradient(left,rgba(203,203,203,0.6) 0,rgba(203,203,203,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99cbcbcb',endColorstr='#00cbcbcb',GradientType=1);
	border-top: 1px solid transparent;
	border-right: 1px solid transparent;
	border-bottom: 1px solid transparent;
}

.body-clouds .comment:hover {
	border-top: 1px solid #fff;
	border-right: 1px solid #fff;
	border-bottom: 1px solid #fff;
}

.body-clouds .comment_tools {
	text-align: center;
	padding: 5px;
	border-top: 1px solid #ddd;
}

.body-clouds .comment {
	border-left: 3px solid #888;
}

.body-clouds .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-clouds .hentry ul li {
	border-left: 4px solid #ddd;
}

.body-clouds .hentry,
.body-clouds .single-navigation,
.body-clouds #breadcrumb-wrap,
.body-clouds .c_list {
	padding: 10px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,0.9)),color-stop(100%,rgba(255,255,255,0.9)));
	background: -webkit-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -o-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: -ms-linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	background: linear-gradient(left,rgba(255,255,255,0.9) 0,rgba(255,255,255,0.9) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e6ffffff',endColorstr='#e6ffffff',GradientType=1);
	border: 1px solid #fff;
	margin-bottom: 20px;
}

.body-clouds .intr {
	color: #ccc;
}

.body-clouds .multipages-navigation {
	text-align: center;
	padding: 5px;
	border-top: 1px solid #ddd;
}

.body-clouds .search-reminder {
	color: #fff;
}

.body-clouds .sticky {
	border: 1px solid #0080bc;
}

.body-clouds .storytitle a:hover {
	color: #ccc;
}

.body-clouds .storytitle a {
	color: #0080bc;
}

.body-clouds .trackback,
.body-clouds .pingback {
	border-left: 3px solid #f4f4f4;
}

.body-clouds .wp-caption p.wp-caption-text {
	background: -moz-linear-gradient(left,rgba(0,0,0,0.7) 0,rgba(0,0,0,0.7) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(0,0,0,0.7)),color-stop(100%,rgba(0,0,0,0.7)));
	background: -webkit-linear-gradient(left,rgba(0,0,0,0.7) 0,rgba(0,0,0,0.7) 100%);
	background: -o-linear-gradient(left,rgba(0,0,0,0.7) 0,rgba(0,0,0,0.7) 100%);
	background: -ms-linear-gradient(left,rgba(0,0,0,0.7) 0,rgba(0,0,0,0.7) 100%);
	background: linear-gradient(left,rgba(0,0,0,0.7) 0,rgba(0,0,0,0.7) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b3000000',endColorstr='#b3000000',GradientType=1);
	color: #fff;
}

.body-clouds .wp-caption:hover p.wp-caption-text {
	display: none;
}

.body-clouds .wp-caption {
	position: relative;
	border-radius: 0;
	border: 1px solid #fff;
}

.body-clouds h2.posts_date {
	text-shadow: 0 0 5px #000;
}

.body-clouds .navigation-links {
	padding: 15px 0 10px;
	text-align: center;
}

<?php } ?>

<?php if ( !$load['style'] || $load['style'] == 'earth' ) { ?>

.body-earth {
	color: #ccc;
	background: #080808 url(../images/earth/bg.jpg) left top no-repeat;
}

.body-earth a:hover,
.body-earth .menu-item a:hover,
.body-earth #credits a:hover,
.body-earth #content a:hover {
	color: #87cefa;
}

.body-earth a {
	color: #d54e21;
	text-decoration: none;
}

.body-earth blockquote {
	border-left: 4px double #fff;
	color: #f5deb3;
}

.body-earth fieldset {
	border: 1px solid #3f2715;
}

.body-earth h2.posts_date {
	border-bottom: 1px solid #3f2715;
	color: #d9bd8e;
}

.body-earth legend {
	color: #d9bd8e;
}

.body-earth pre {
	border: 1px solid #3f2715;
	background-color: #110b07;
}

.body-earth table {
	background-color: transparent;
	border: 3px double #3f2715;
}

.body-earth tfoot {
	background-color: #110b07;
}

.body-earth thead {
	background-color: #3f2715;
}

.body-earth th {
	border: 0;
}

.body-earth #commentlist li .avatar {
	border: 1px solid #3f2715;
}

.body-earth #content .storytitle a:hover {
	color: #d54e21;
}

.body-earth #content .storytitle a {
	color: #fff;
}

.body-earth #content .tb-author-bio {
	background: #333;
	border-style: solid none;
	border-width: 1px;
	color: #d9bd8e;
}

.body-earth #content .wp-caption a:hover,
.body-earth .nav_pages a:hover,
.body-earth #content .comment_tools a:hover {
	color: #0080bc;
}

.body-earth.no-sidebar #content {
	margin: 20px auto;
	max-width: 1024px;
	width: 74%;
}

.body-earth #credits {
	border-top: 1px solid;
	color: #d9bd8e;
	padding: 4px 1% 0 5%;
	text-align: right;
}

.body-earth #header .description {
	text-shadow: 1px 1px 1px #000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}

.body-earth #header a {
	color: #fff;
}

.body-earth #header h1 {
	margin: 0;
	font-size: 4em;
}

.body-earth #header {
	color: #bbb;
	padding-left: 50px;
	text-shadow: 3px 3px 6px #000;
}

.body-earth .comment.bypostauthor {
	border-left-color: #f5deb3;
	background: -moz-linear-gradient(left,rgba(245,222,179,0.2) 0,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(245,222,179,0.2)),color-stop(1%,rgba(245,222,179,0.2)),color-stop(100%,rgba(245,222,179,0)));
	background: -webkit-linear-gradient(left,rgba(245,222,179,0.2) 0,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%);
	background: -o-linear-gradient(left,rgba(245,222,179,0.2) 0,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%);
	background: -ms-linear-gradient(left,rgba(245,222,179,0.2) 0,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%);
	background: linear-gradient(left,rgba(245,222,179,0.2) 0,rgba(245,222,179,0.2) 1%,rgba(245,222,179,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33f5deb3',endColorstr='#00f5deb3',GradientType=1);
}

.body-earth .comment,
.body-earth .trackback,
.body-earth .pingback {
	background: -moz-linear-gradient(left,rgba(255,255,255,0.05) 0,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,0.05)),color-stop(1%,rgba(255,255,255,0.05)),color-stop(100%,rgba(244,244,244,0)));
	background: -webkit-linear-gradient(left,rgba(255,255,255,0.05) 0,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%);
	background: -o-linear-gradient(left,rgba(255,255,255,0.05) 0,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%);
	background: -ms-linear-gradient(left,rgba(255,255,255,0.05) 0,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%);
	background: linear-gradient(left,rgba(255,255,255,0.05) 0,rgba(255,255,255,0.05) 1%,rgba(244,244,244,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0dffffff',endColorstr='#00f4f4f4',GradientType=1);
	border-top: 1px solid transparent;
	border-right: 1px solid transparent;
	border-bottom: 1px solid transparent;
}

.body-earth .comment:hover {
	border-top: 1px solid #24160c;
	border-right: 1px solid #24160c;
	border-bottom: 1px solid #24160c;
}

.body-earth .comment_like .meta {
	background-color: transparent;
	border: 0;
}

.body-earth .comment_tools {
	background-color: #333;
	border-style: solid none;
	border-width: 1px;
	color: #d9bd8e;
	margin-top: 4px;
	padding: 4px;
}

.body-earth .comment {
	border-left: 3px solid #0083f2;
}

.body-earth .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-earth .intr {
	color: #ccc;
}

.body-earth .meta {
	background-color: #3f2715;
	color: #d9bd8e;
	margin-top: 4px;
	padding: 4px;
	background-color: #333;
	border-style: solid none;
	border-width: 1px;
}

.body-earth .post ul li {
	border-left: 4px solid #3f2715;
}

.body-earth .post {
	margin-bottom: 2em;
}

.body-earth .sticky {
	background: -moz-linear-gradient(left,rgba(0,0,0,0.25) 0,rgba(0,0,0,0.25) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(0,0,0,0.25)),color-stop(100%,rgba(0,0,0,0.25)));
	background: -webkit-linear-gradient(left,rgba(0,0,0,0.25) 0,rgba(0,0,0,0.25) 100%);
	background: -o-linear-gradient(left,rgba(0,0,0,0.25) 0,rgba(0,0,0,0.25) 100%);
	background: -ms-linear-gradient(left,rgba(0,0,0,0.25) 0,rgba(0,0,0,0.25) 100%);
	background: linear-gradient(left,rgba(0,0,0,0.25) 0,rgba(0,0,0,0.25) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40000000',endColorstr='#40000000',GradientType=1);
	border: 1px solid #f5deb3;
	padding: 5px;
}

.body-earth .trackback,
.pingback {
	border-left: 3px solid #0060aa;
}

.body-earth .wp-caption {
	border: 1px solid #fff;
	background-color: #d9bd8f;
	color: #555;
}

.body-earth #breadcrumb-wrap {
	background-color: #333333;
	border-style: solid none;
	border-width: 1px;
	color: #D9BD8E;
	margin-bottom: 20px;
	padding: 5px;
}

.body-earth #content .gallery img {
	border: 1px solid #fff;
	background: #D9BD8F;
	padding: 9px;
}

.body-earth .navigation-links {
	padding: 15px 0 10px;
	text-align: center;
	border-top: 1px solid #3f2715;
	color: #3f2715;
}

.body-earth .navigation-links.numeric-nav a {
	background-color: #d9bd8f;
	border: 1px solid #fff;
}

.body-earth .navigation-links.numeric-nav a:hover {
	background-color: #F5DEB3;
	border: 1px solid #fff;
}
.body-earth #tb-comment-tools-tags a {
	background-color: #d9bd8f;
	border: 1px solid #fff;
}

.body-earth #tb-comment-tools-tags a:hover {
	background-color: #F5DEB3;
}

<?php } ?>

<?php if ( !$load['style'] || $load['style'] == 'fire' ) { ?>

.body-fire {
	color: #333;
	background: #912308 url(../images/fire/bg.jpg) left top no-repeat;
}

.body-fire a:hover,
.body-fire .menu-item a:hover,
.body-fire #credits a:hover,
.body-fire #content a:hover,
.body-fire .storytitle a:hover {
	color: #d54e21;
}

.body-fire a {
	color: #0080bc;
	text-decoration: none;
}

.body-fire blockquote {
	border-left: 4px double #ccc;
}

.body-fire fieldset {
	border: 1px solid #ccc;
}

.body-fire h2.posts_date {
	border-bottom: 1px solid #ccc;
	color: #999;
}

.body-fire legend {
	color: #ccc;
}

.body-fire pre {
	border: 1px solid #ddd;
}

.body-fire table {
	background: #eee;
}

.body-fire tfoot {
	background-color: #ddd;
}

.body-fire thead {
	background-color: #fff;
}

.body-fire th {
	border: 1px solid #ccc;
}

.body-fire #content {
	border-radius: 15px;
	background-color: #f6f6f6;
	border: 1px solid #333;
}

.body-fire #credits {
	border-top: 1px solid #e8a403;
	text-align: right;
	color: #ccc;
	padding-right: 1%;
}

.body-fire #header .description {
	text-shadow: 1px 1px 1px #000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}

.body-fire #header a {
	color: #fff;
}

.body-fire #header h1 {
	margin: 0;
	font-size: 4em;
	text-shadow: 2px 2px 5px #000;
}

.body-fire #header {
	color: #fff;
}

.body-fire .comment.bypostauthor {
	border-left-color: #ffe1a1;
	background: -moz-linear-gradient(left,rgba(255,225,161,0.3) 0,rgba(255,225,161,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,225,161,0.3)),color-stop(100%,rgba(255,225,161,0)));
	background: -webkit-linear-gradient(left,rgba(255,225,161,0.3) 0,rgba(255,225,161,0) 100%);
	background: -o-linear-gradient(left,rgba(255,225,161,0.3) 0,rgba(255,225,161,0) 100%);
	background: -ms-linear-gradient(left,rgba(255,225,161,0.3) 0,rgba(255,225,161,0) 100%);
	background: linear-gradient(left,rgba(255,225,161,0.3) 0,rgba(255,225,161,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4dffe1a1',endColorstr='#00ffe1a1',GradientType=1);
}

.body-fire .comment,
.body-fire .trackback,
.body-fire .pingback {
	background: -moz-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(128,128,128,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(128,128,128,0.2)),color-stop(100%,rgba(128,128,128,0)));
	background: -webkit-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(128,128,128,0) 100%);
	background: -o-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(128,128,128,0) 100%);
	background: -ms-linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(128,128,128,0) 100%);
	background: linear-gradient(left,rgba(128,128,128,0.2) 0,rgba(128,128,128,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33808080',endColorstr='#00808080',GradientType=1);
	border-top: 1px solid transparent;
	border-right: 1px solid transparent;
	border-bottom: 1px solid transparent;
}

.body-fire .comment:hover {
	border-top: 1px solid #fff;
	border-right: 1px solid #fff;
	border-bottom: 1px solid #fff;
}

.body-fire .comment_tools {
	background-color: #fff;
	border: 1px solid #999;
}

.body-fire .comment {
	border-left: 3px solid #888;
}

.body-fire .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-fire .intr {
	color: #ccc;
}

.body-fire .meta {
	color: gray;
}

.body-fire .navigation-links {
	padding: 15px 0 10px;
	border-top: 1px solid #ccc;
	text-align: center;
}

.body-fire .post ul li {
	border-left: 4px solid #333;
}

.body-fire .sticky {
	background: -moz-linear-gradient(left,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(201,238,255,0.1)),color-stop(100%,rgba(201,238,255,0.1)));
	background: -webkit-linear-gradient(left,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -o-linear-gradient(left,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: -ms-linear-gradient(left,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	background: linear-gradient(left,rgba(201,238,255,0.1) 0,rgba(201,238,255,0.1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1ac9eeff',endColorstr='#1ac9eeff',GradientType=1);
	border: 1px solid #87cefa;
	padding: 5px;
}

.body-fire .storytitle a {
	color: #333;
}

.body-fire .tb-author-bio {
	border: 1px solid #ccc;
	background: transparent;
}

.body-fire .trackback,
.body-fire .pingback {
	border-left: 3px solid #ddd;
}

.body-fire .wp-caption {
	background: #eee;
}

.body-fire #breadcrumb-wrap {
	border-bottom: 1px solid #ccc;
	margin-bottom: 20px;
	padding: 5px;
}

.body-fire #content .gallery img {
	border: 10px solid #eee;
}

.body-fire .multipages-navigation {
	text-align: center;
}

<?php } ?>

<?php if ( !$load['style'] || $load['style'] == 'smoke' ) { ?>

.body-smoke {
	color: #fff;
	background: #000 url(../images/smoke/bg.jpg) center top repeat-y;
}

.body-smoke a:hover,
.body-smoke .menu-item a:hover,
.body-smoke #credits a:hover {
	color: #ccc;
}

.body-smoke a {
	color: #0080bc;
	text-decoration: none;
}

.body-smoke blockquote {
	border-left: 6px double #fff;
}

.body-smoke code {
	background-color: #222;
}

.body-smoke fieldset {
	border: 1px solid #ccc;
}

.body-smoke h2.posts_date {
	color: #666;
}

.body-smoke legend {
	color: #aaa;
}

.body-smoke pre {
	border: 1px solid #f4f4f4;
	background-color: #222;
}

.body-smoke table {
	border: 1px solid #666;
}

.body-smoke tfoot {
	background-color: #ddd;
}

.body-smoke thead {
	background-color: #fff;
}

.body-smoke th {
	border: 1px solid #666;
}

.body-smoke #commentform textarea {
	width: 99%;
}

.body-smoke #content .gallery img {
	border: 10px solid #222;
}

.body-smoke #content .tb-author-bio {
	border-radius: 10px;
	background: #0d0d0d;
	background: -moz-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(13,13,13,0.9)),color-stop(100%,rgba(13,13,13,0.9)));
	background: -webkit-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -o-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -ms-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	border: 5px solid #222;
}

.body-smoke #credits {
	border-top: 2px groove #fff;
	text-align: center;
}

.body-smoke #header .description {
	text-shadow: 1px 1px 1px #000;
	filter: dropshadow(color=#000000,offX=1,offY=1);
}

.body-smoke #header a {
	color: #fff;
}

.body-smoke #header h1 {
	margin: 0;
	font-size: 4em;
	text-shadow: 2px 2px 5px #000;
}

.body-smoke #header {
	color: #fff;
	padding: 30px 0;
	text-align: center;
}

.body-smoke .comment.bypostauthor {
	border-left-color: #a1d6ff;
	background: -moz-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(161,214,255,0.2)),color-stop(60%,rgba(161,214,255,0)),color-stop(100%,rgba(161,214,255,0)));
	background: -webkit-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%);
	background: -o-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%);
	background: linear-gradient(left,rgba(161,214,255,0.2) 0,rgba(161,214,255,0) 60%,rgba(161,214,255,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33a1d6ff',endColorstr='#00a1d6ff',GradientType=1);
}

.body-smoke .comment,
.body-smoke .trackback,
.body-smoke .pingback {
	background: -moz-linear-gradient(left,rgba(52,52,52,0.6) 0,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(52,52,52,0.6)),color-stop(60%,rgba(52,52,52,0)),color-stop(100%,rgba(52,52,52,0)));
	background: -webkit-linear-gradient(left,rgba(52,52,52,0.6) 0,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%);
	background: -o-linear-gradient(left,rgba(52,52,52,0.6) 0,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%);
	background: -ms-linear-gradient(left,rgba(52,52,52,0.6) 0,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%);
	background: linear-gradient(left,rgba(52,52,52,0.6) 0,rgba(52,52,52,0) 60%,rgba(52,52,52,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99343434',endColorstr='#00343434',GradientType=1);
	border-top: 1px solid transparent;
	border-right: 1px solid #0d0d0d;
	border-bottom: 1px solid transparent;
}

.body-smoke .comment:hover {
	border-top: 1px solid #666;
	border-right: 1px solid #666;
	border-bottom: 1px solid #666;
}

.body-smoke .comment_tools {
	border-radius: 0;
	border-top: 3px double #222;
	float: none;
	padding: 3px;
	text-align: center;
}

.body-smoke .comment {
	border-left: 3px solid #888;
}

.body-smoke .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-smoke .hentry ul li {
	border-left: 4px solid #333;
}

.body-smoke .hentry,
.body-smoke .c_list,
.body-smoke .nav-single,
.body-smoke .nav_pages {
	padding: 5px;
	border-radius: 10px;
	background: #0d0d0d;
	background: -moz-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(13,13,13,0.9)),color-stop(100%,rgba(13,13,13,0.9)));
	background: -webkit-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -o-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: -ms-linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	background: linear-gradient(top,rgba(13,13,13,0.9) 0,rgba(13,13,13,0.9) 100%);
	border: 5px solid #222;
	margin-bottom: 10px;
}

.body-smoke .intr {
	color: #ccc;
}

.body-smoke .meta {
	color: gray;
}

.body-smoke .sticky {
	border: 5px solid #999;
}

.body-smoke .storytitle a:hover {
	color: #ccc;
}

.body-smoke .storytitle a {
	color: #fff;
}

.body-smoke .trackback,
.body-smoke .pingback {
	border-left: 3px solid #f4f4f4;
}

.body-smoke .wp-caption {
	border: 0;
	background: #222;
	border-radius: 0;
}

.body-smoke .navigation-links {
	padding: 15px 0 10px;
	text-align: center;
}

<?php } ?>

<?php if ( !$load['style'] || $load['style'] == 'water' ) { ?>

.body-water {
	color: #333;
	background: #43a4ff url(../images/water/bg.jpg) left top no-repeat;
}

.body-water a:hover,
.body-water .menu-item a:hover,
.body-water #credits a:hover,
.body-water #content a:hover,
.body-water .storytitle a:hover {
	color: #d54e21;
}

.body-water a {
	color: #fff;
	text-decoration: none;
}

.body-water blockquote {
	border-left: 4px double #fff;
}

.body-water fieldset {
	border: 1px solid #5fb6ff;
}

.body-water h2.posts_date {
	border-bottom: 1px solid #5fb6ff;
	color: #cfe9ff;
}

.body-water legend {
	color: #cfe9ff;
}

.body-water pre {
	border: 1px solid #5fb6ff;
}

.body-water table {
	background-color: #a9d6ff;
}

.body-water tfoot {
	background-color: #cfe9ff;
}

.body-water thead {
	background-color: #cfe9ff;
}

.body-water #credits {
	border-top: 3px double #fff;
	text-align: right;
	color: #cfe9ff;
	padding-right: 1%;
}

.body-water #header .description {
	text-shadow: 1px 1px 1px #fff;
	filter: dropshadow(color=#ffffff,offX=1,offY=1);
}

.body-water #header a {
	color: #333;
}

.body-water #header h1 {
	margin: 0;
	font-size: 4em;
	text-shadow: 3px 3px 5px #dff;
	filter: dropshadow(color=#ffffff,offX=3,offY=3);
}

.body-water #header {
	color: #333;
}

.body-water .comment.bypostauthor {
	border-left-color: #1e90ff;
	background: -moz-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(30,144,255,1)),color-stop(60%,rgba(30,144,255,0)),color-stop(100%,rgba(30,144,255,0)));
	background: -webkit-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -o-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e90ff',endColorstr='#001e90ff',GradientType=1);
}

.body-water .comment,
.body-water .trackback,
.body-water .pingback {
	background: -moz-linear-gradient(left,rgba(255,255,255,0.2) 0,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,0.2)),color-stop(60%,rgba(255,255,255,0)),color-stop(100%,rgba(255,255,255,0)));
	background: -webkit-linear-gradient(left,rgba(255,255,255,0.2) 0,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%);
	background: -o-linear-gradient(left,rgba(255,255,255,0.2) 0,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(255,255,255,0.2) 0,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%);
	background: linear-gradient(left,rgba(255,255,255,0.2) 0,rgba(255,255,255,0) 60%,rgba(255,255,255,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff',endColorstr='#00ffffff',GradientType=1);
	border-top: 1px solid #4dadff;
	border-right: 1px solid #4dadff;
	border-bottom: 1px solid #4dadff;
}

.body-water .comment {
	border-left: 3px solid #0083f2;
}

.body-water .feedback {
	color: gray;
	text-align: right;
	clear: both;
}

.body-water .intr {
	color: #ccc;
}

.body-water .meta {
	background: -moz-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(30,144,255,1)),color-stop(60%,rgba(30,144,255,0)),color-stop(100%,rgba(30,144,255,0)));
	background: -webkit-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -o-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e90ff',endColorstr='#001e90ff',GradientType=1);
	color: #cfe9ff;
	padding: 4px;
}

.body-water .nav_pages a {
	background-color: #5fb6ff;
	border: 1px solid #fff;
	padding: 3px;
	border-radius: 3px;
}

.body-water .nav_pages {
	padding-top: 10px;
	border-top: 1px solid #5fb6ff;
	color: #5fb6ff;
	width: 105%;
}

.body-water .post ul li {
	border-left: 4px solid #333;
}

.body-water .sticky {
	background: -moz-linear-gradient(top,rgba(255,255,255,0.3) 0,rgba(255,255,255,0.2) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(255,255,255,0.3)),color-stop(100%,rgba(255,255,255,0.2)));
	background: -webkit-linear-gradient(top,rgba(255,255,255,0.3) 0,rgba(255,255,255,0.2) 100%);
	background: -o-linear-gradient(top,rgba(255,255,255,0.3) 0,rgba(255,255,255,0.2) 100%);
	background: -ms-linear-gradient(top,rgba(255,255,255,0.3) 0,rgba(255,255,255,0.2) 100%);
	background: linear-gradient(top,rgba(255,255,255,0.3) 0,rgba(255,255,255,0.2) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4dffffff',endColorstr='#33ffffff',GradientType=0);
	border: 1px solid #b4e1fe;
	padding: 5px;
}

.body-water .storytitle a {
	color: #333;
}

.body-water .storytitle {
	border-bottom: 3px double #cfe9ff;
	margin: 0 0 3px;
}

.body-water .tb-author-bio {
	border: 1px solid #cfe9ff;
	background: -moz-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(30,144,255,1)),color-stop(60%,rgba(30,144,255,0)),color-stop(100%,rgba(30,144,255,0)));
	background: -webkit-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -o-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: -ms-linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
	background: linear-gradient(left,rgba(30,144,255,1) 0,rgba(30,144,255,0) 60%,rgba(30,144,255,0) 100%);
}

.body-water .trackback,
.body-water .pingback {
	border-left: 3px solid #0060aa;
}

.body-water .wp-caption {
	background-color: #a9d6ff;
	border-radius: 0;
}

.body-water #breadcrumb-wrap {
	background-color: #A9D6FF;
	border: 3px double #FFFFFF;
	padding: 5px;
	margin-bottom: 20px;
}

.body-water #content .gallery img {
	border: 10px solid #A9D6FF;
}

.body-water h2.posts_date {
	text-shadow: 0 0 5px #000;
}

.body-water .navigation-links {
	padding: 15px 0 10px;
	border-top: 1px solid #4DADFF;
	text-align: center;
}

<?php } ?>

/* sidebar */

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'air' ) { ?>

.sidebar-air #primary-sidebar {
	color: #333;
}

.sidebar-air #primary-sidebar a:hover {
	color: #d54e21;
}

.sidebar-air #primary-sidebar a {
	color: #0080bc;
	text-decoration: none;
}

.sidebar-air #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-air #primary-sidebar #calendar_wrap {
	border: 1px solid #aaa;
	background: #efefef;
	background: -moz-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#efefef),color-stop(100%,#cacaca));
	background: -webkit-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -o-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -ms-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: linear-gradient(top,#efefef 0,#cacaca 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#efefef',endColorstr='#cacaca',GradientType=0);
}

.sidebar-air #sidebarbody {
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/air/graph.png') -1200px top repeat-y;
}

.sidebar-air #sidebarbottom {
	background: transparent url('../images/air/graph.png') no-repeat top left;
	height: 25px;
}

.sidebar-air #sidebartop {
	background: transparent url('../images/air/graph.png') -600px top no-repeat;
	height: 25px;
}

.sidebar-air #primary-sidebar #wp-calendar #today {
	background: #aaa;
	color: #fff;
}

.sidebar-air #primary-sidebar #wp-calendar caption {
	color: #aaa;
}

.sidebar-air #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-air #primary-sidebar .searchform {
	border: 1px solid #aaa;
	background: #efefef;
	background: -moz-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#efefef),color-stop(100%,#cacaca));
	background: -webkit-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -o-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -ms-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: linear-gradient(top,#efefef 0,#cacaca 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#efefef',endColorstr='#cacaca',GradientType=0);
}

.sidebar-air #primary-sidebar .tb-author-bio {
	border: 1px solid #ccc;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'clouds' ) { ?>

.sidebar-clouds #primary-sidebar {
	color: #666;
}

.sidebar-clouds #primary-sidebar a:hover {
	color: #888;
}

.sidebar-clouds #primary-sidebar a {
	color: #0080bc;
	text-decoration: none;
}

.sidebar-clouds #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-clouds #primary-sidebar #calendar_wrap {
	border: 1px solid #aaa;
}

.sidebar-clouds #sidebarbody {
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/clouds/graph.png') -1200px top repeat-y;
}

.sidebar-clouds #sidebarbottom {
	background: transparent url('../images/clouds/graph.png') no-repeat top left;
	height: 25px;
}

.sidebar-clouds #sidebartop {
	background: transparent url('../images/clouds/graph.png') -600px top no-repeat;
	height: 25px;
}

.sidebar-clouds #primary-sidebar #wp-calendar #today {
	background: #aaa;
	color: #fff;
}

.sidebar-clouds #primary-sidebar #wp-calendar caption {
	color: #aaa;
}

.sidebar-clouds #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-clouds #primary-sidebar .searchform {
	border: 1px solid #666;
}

.sidebar-clouds #primary-sidebar .tb-author-bio {
	border: 1px solid #aaa;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'earth' ) { ?>

.sidebar-earth #primary-sidebar {
	color: #d9bd8e;
}

.sidebar-earth #primary-sidebar a:hover {
	color: #d54e21;
}

.sidebar-earth #primary-sidebar a {
	color: #87cefa;
	text-decoration: none;
}

.sidebar-earth #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-earth #primary-sidebar #calendar_wrap {
	border: 1px solid #3f2715;
	margin: 5px 0;
}

.sidebar-earth #sidebarbody {
	padding: 1px 4px 10px 20px;
	background: transparent url('../images/earth/graph.png') -1200px top repeat-y;
}

.sidebar-earth #sidebarbottom {
	background: transparent url('../images/earth/graph.png') no-repeat top left;
	height: 30px;
}

.sidebar-earth #sidebartop {
	background: transparent url('../images/earth/graph.png') -600px top no-repeat;
	height: 30px;
}

.sidebar-earth #primary-sidebar #wp-calendar #today {
	color: #fff;
}

.sidebar-earth #primary-sidebar #wp-calendar caption {
	color: #3f2715;
	padding: 3px;
}

.sidebar-earth #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-earth #primary-sidebar #wp-calendar thead {
	border-top: 1px solid #d9bd8e;
	border-bottom: 1px solid #d9bd8e;
	background-color: #333;
}

.sidebar-earth #primary-sidebar #wp-calendar th {
	border: 0;
}

.sidebar-earth #primary-sidebar #wp-calendar {
	border-collapse: collapse;
}

.sidebar-earth #primary-sidebar .searchform {
	border: 1px solid #3f2715;
}

.sidebar-earth #primary-sidebar .tb-author-bio {
	border: 1px solid #222;
	background: transparent;
}

.sidebar-earth #primary-sidebar .widgettitle {
	color: #ccc;
}

<?php } ?>

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'fire' ) { ?>

.sidebar-fire #primary-sidebar {
	color: #ddd;
}

.sidebar-fire #primary-sidebar a {
	color: #87cefa;
	text-decoration: none;
}

.sidebar-fire #primary-sidebar a:hover {
	color: #d54e21;
}

.sidebar-fire #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-fire #primary-sidebar #calendar_wrap {
	border: 1px solid #666;
	background-color: #444;
	color: #ccc;
}

.sidebar-fire #sidebarbody {
	padding: 10px 10px 10px 18px;
	background: transparent url('../images/fire/graph.png') -1200px top repeat-y;
}

.sidebar-fire #sidebartop {
	background: transparent url('../images/fire/graph.png') -600px top no-repeat;
	height: 25px;
}

.sidebar-fire #sidebarbottom {
	background: transparent url('../images/fire/graph.png') no-repeat top left;
	height: 25px;
}

.sidebar-fire #primary-sidebar #wp-calendar caption {
	color: #999;
}

.sidebar-fire #primary-sidebar #wp-calendar #today {
	background-color: #333;
}

.sidebar-fire #primary-sidebar #wp-calendar thead {
	background: transparent;
}

.sidebar-fire #primary-sidebar #wp-calendar th {
	border: 1px solid #555;
}

.sidebar-fire #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-fire #primary-sidebar .searchform {
	border: 1px solid #666;
	background: #444;
}

.sidebar-fire #primary-sidebar .tb-author-bio {
	border: 1px solid #555;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'smoke' ) { ?>

.sidebar-smoke #primary-sidebar {
	color: #aaa;
}

.sidebar-smoke #primary-sidebar a:hover {
	color: #fff;
}

.sidebar-smoke #primary-sidebar a {
	color: #0080bc;
	text-decoration: none;
}

.sidebar-smoke #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-smoke #primary-sidebar #calendar_wrap {
	border: 1px solid #666;
}

.sidebar-smoke #sidebarbody {
	padding: 10px 10px 10px 29px;
	background: transparent url('../images/smoke/graph.png') -1200px top repeat-y;
}

.sidebar-smoke #sidebarbottom {
	background: transparent url('../images/smoke/graph.png') no-repeat top left;
	height: 25px;
}

.sidebar-smoke #sidebartop {
	background: transparent url('../images/smoke/graph.png') -600px top no-repeat;
	height: 25px;
}

.sidebar-smoke #primary-sidebar #wp-calendar #today {
	background: #222;
	color: #fff;
}

.sidebar-smoke #primary-sidebar #wp-calendar caption {
	color: #aaa;
}

.sidebar-smoke #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-smoke #primary-sidebar #wp-calendar thead {
	background: transparent;
}

.sidebar-smoke #primary-sidebar .searchform {
	border: 1px solid #666;
}

.sidebar-smoke #primary-sidebar .tb-author-bio {
	border: 1px solid #666;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['sidebar'] || $load['sidebar'] == 'water' ) { ?>

.sidebar-water #primary-sidebar {
	color: #555;
}

.sidebar-water #primary-sidebar a:hover {
	color: #d54e21;
}

.sidebar-water #primary-sidebar a {
	color: #0080bc;
	text-decoration: none;
}

.sidebar-water #primary-sidebar input#s {
	width: 50%;
	background: #eee;
	border: 1px solid #999;
	color: #000;
}

.sidebar-water #primary-sidebar #calendar_wrap {
	border: 1px solid #fff;
}

.sidebar-water #sidebarbody {
	padding: 10px 10px 10px 18px;
	background: transparent url('../images/water/graph.png') -1200px top repeat-y;
}

.sidebar-water #sidebarbottom {
	background: transparent url('../images/water/graph.png') no-repeat top left;
	height: 50px;
}

.sidebar-water #sidebartop {
	background: transparent url('../images/water/graph.png') -600px top no-repeat;
	height: 50px;
}

.sidebar-water #primary-sidebar #wp-calendar #today {
	border: 1px solid #fff;
}

.sidebar-water #primary-sidebar #wp-calendar caption {
	color: #fff;
}

.sidebar-water #primary-sidebar #wp-calendar tfoot {
	background: transparent;
}

.sidebar-water #primary-sidebar #wp-calendar thead {
	border-top: 3px double #fff;
	border-bottom: 3px double #fff;
	background-color: #cfe9ff;
}

.sidebar-water #primary-sidebar #wp-calendar th {
	border: 0;
}

.sidebar-water #primary-sidebar #wp-calendar {
	border-collapse: collapse;
}

.sidebar-water #primary-sidebar .searchform {
	border: 1px solid #fff;
	background-color: #a9d6ff;
}

.sidebar-water #primary-sidebar .tb-author-bio {
	border: 1px solid #fff;
	background: transparent;
}

<?php } ?>

/* menu */

<?php if ( !$load['menu'] || $load['menu'] == 'air' ) { ?>

.menu-air #primary_menu {
	background: -moz-linear-gradient(top,rgba(87,154,209,0.8) 0,rgba(87,154,209,0.8) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(87,154,209,0.8)),color-stop(100%,rgba(87,154,209,0.8)));
	background: -webkit-linear-gradient(top,rgba(87,154,209,0.8) 0,rgba(87,154,209,0.8) 100%);
	background: -o-linear-gradient(top,rgba(87,154,209,0.8) 0,rgba(87,154,209,0.8) 100%);
	background: -ms-linear-gradient(top,rgba(87,154,209,0.8) 0,rgba(87,154,209,0.8) 100%);
	background: linear-gradient(top,rgba(87,154,209,0.8) 0,rgba(87,154,209,0.8) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#cc579ad1',endColorstr='#cc579ad1',GradientType=0);
}

.menu-air #mainmenu>li.menu-item,
.menu-air #mainmenu>li.page_item {
	border-right: 1px solid #aaa;
}

.menu-air #primary_menu .current_page_ancestor .hiraquo,
.menu-air #primary_menu .current-menu-ancestor .hiraquo {
	color: #d54e21;
}

.menu-air #primary_menu .page_item a,
.menu-air #primary_menu .menu-item a {
	color: #fff;
	text-decoration: none;
}

.menu-air #primary_menu .page_item a:hover,
.menu-air #primary_menu .menu-item a:hover {
	color: #d54e21;
}

<?php } ?>

<?php if ( !$load['menu'] || $load['menu'] == 'clouds' ) { ?>

.menu-clouds #primary_menu {
	background: -moz-linear-gradient(left,rgba(255,255,255,0.5) 0,rgba(255,255,255,0.5) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(255,255,255,0.5)),color-stop(100%,rgba(255,255,255,0.5)));
	background: -webkit-linear-gradient(left,rgba(255,255,255,0.5) 0,rgba(255,255,255,0.5) 100%);
	background: -o-linear-gradient(left,rgba(255,255,255,0.5) 0,rgba(255,255,255,0.5) 100%);
	background: -ms-linear-gradient(left,rgba(255,255,255,0.5) 0,rgba(255,255,255,0.5) 100%);
	background: linear-gradient(left,rgba(255,255,255,0.5) 0,rgba(255,255,255,0.5) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80ffffff',endColorstr='#80ffffff',GradientType=1);
	padding: 7px 0;
	border-color: #FFFFFF;
	border-style: solid none solid none;
	border-width: 1px;
	color: #666;
	box-shadow: -10px 0 10px #a9d6ff;
}

.menu-clouds #mainmenu>li.menu-item,
.menu-clouds #mainmenu>li.page_item {
	border-right: 1px solid #aaa;
}

.menu-clouds #primary_menu-in {
	padding: 10px 28% 10px 30px;
	border-color: #67B9FF;
	border-style: solid none solid none;
	border-width: 1px;
	background: #fff;
}

.no-sidebar.menu-clouds #primary_menu-in {
	padding-right: 30px;
}

.menu-clouds #primary_menu .current_page_ancestor .hiraquo,
.menu-clouds #primary_menu .current-menu-ancestor .hiraquo {
	color: #d54e21;
}

.menu-clouds #primary_menu .page_item a,
.menu-clouds #primary_menu .menu-item a {
	color: #0080bc;
	text-decoration: none;
}

.menu-clouds #primary_menu .page_item a:hover,
.menu-clouds #primary_menu .menu-item a:hover {
	color: #888;
}

<?php } ?>

<?php if ( !$load['menu'] || $load['menu'] == 'earth' ) { ?>

.menu-earth #primary_menu {
	padding: 0;
}

.menu-earth #mainmenu>li.menu-item,
.menu-earth #mainmenu>li.page_item {
	background: transparent url("../images/earth/pages_sep.png") right center no-repeat;
}

.menu-earth #primary_menu-in {
	border-radius: 7px;
	background-color: #f5deb3;
	padding: 10px 28% 10px 30px;
	border: 1px solid #a9d6ff;
}

.menu-earth #primary_menu-out {
	background: #fff;
	border-radius: 10px;
	margin: 0 30px;
	padding: 7px;
}

.menu-earth #primary_menu .current_page_ancestor .hiraquo,
.menu-earth #primary_menu .current-menu-ancestor .hiraquo {
	color: #0080bc;
}

.menu-earth #primary_menu .page_item a,
.menu-earth #primary_menu .menu-item a {
	color: #555;
	text-decoration: none;
}

.menu-earth #primary_menu .page_item a:hover,
.menu-earth #primary_menu .menu-item a:hover {
	color: #0080bc;
}

<?php } ?>

<?php if ( !$load['menu'] || $load['menu'] == 'fire' ) { ?>

.menu-fire #primary_menu {
	background: #404040;
	background: -moz-linear-gradient(top,#404040 0,#6c6c6c 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#404040),color-stop(100%,#6c6c6c));
	background: -webkit-linear-gradient(top,#404040 0,#6c6c6c 100%);
	background: -o-linear-gradient(top,#404040 0,#6c6c6c 100%);
	background: -ms-linear-gradient(top,#404040 0,#6c6c6c 100%);
	background: linear-gradient(top,#404040 0,#6c6c6c 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#404040',endColorstr='#6c6c6c',GradientType=0);
	border-bottom: 1px solid #888;
	border-top: 1px solid #333;
}

.menu-fire #mainmenu>li.menu-item,
.menu-fire #mainmenu>li.page_item {
	background: transparent url("../images/fire/pages_sep.png") right center no-repeat;
}

.menu-fire #primary_menu .current_page_ancestor .hiraquo,
.menu-fire #primary_menu .current-menu-ancestor .hiraquo {
	color: #d54e21;
}

.menu-fire #primary_menu .page_item a,
.menu-fire #primary_menu .menu-item a {
	color: #87cefa;
	text-decoration: none;
}

.menu-fire #primary_menu .page_item a:hover,
.menu-fire #primary_menu .menu-item a:hover {
	color: #d54e21;
}

<?php } ?>

<?php if ( !$load['menu'] || $load['menu'] == 'smoke' ) { ?>

.menu-smoke #primary_menu {
	background: #131313;
	background: -moz-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(19,19,19,1)),color-stop(30%,rgba(19,19,19,1)),color-stop(100%,rgba(19,19,19,0.9)));
	background: -webkit-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -o-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -ms-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#131313',endColorstr='#e6131313',GradientType=0);
	border-bottom: 4px double #fff;
	border-top: 4px double #fff;
	box-shadow: -10px 0 10px #000;
}

.menu-smoke #mainmenu>li.menu-item,
.menu-smoke #mainmenu>li.page_item {
	border-right: 1px solid #aaa;
}

.menu-smoke #primary_menu .current_page_ancestor .hiraquo,
.menu-smoke #primary_menu .current-menu-ancestor .hiraquo {
	color: #d54e21;
}

.menu-smoke #primary_menu .page_item a,
.menu-smoke #primary_menu .menu-item a {
	color: #ccc;
	text-decoration: none;
}

.menu-smoke #primary_menu .page_item a:hover,
.menu-smoke #primary_menu .menu-item a:hover {
	color: #0080bc;
}

<?php } ?>

<?php if ( !$load['menu'] || $load['menu'] == 'water' ) { ?>

.menu-water #primary_menu {
	background: transparent url("../images/water/head.png") left top repeat;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #777;
}

.menu-water #mainmenu>li.menu-item,
.menu-water #mainmenu>li.page_item {
	background: transparent url("../images/water/pages_sep.png") right center no-repeat;
}

.menu-water #primary_menu .current_page_ancestor .hiraquo,
.menu-water #primary_menu .current-menu-ancestor .hiraquo {
	color: #d54e21;
}

.menu-water #primary_menu .page_item a,
.menu-water #primary_menu .menu-item a {
	color: #0080bc;
	text-decoration: none;
}

.menu-water #primary_menu .page_item a:hover,
.menu-water #primary_menu .menu-item a:hover {
	color: #d54e21;
}

<?php } ?>

/* quickbar */

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'air' ) { ?>

.quickbar-air #quickbar {
	background: #888;
	background: -moz-linear-gradient(top,#888 0,#bebebe 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#888),color-stop(100%,#bebebe));
	background: -webkit-linear-gradient(top,#888 0,#bebebe 100%);
	background: -o-linear-gradient(top,#888 0,#bebebe 100%);
	background: -ms-linear-gradient(top,#888 0,#bebebe 100%);
	background: linear-gradient(top,#888 0,#bebebe 100%);
	border-top: 2px groove #fff;
	color: #333;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 0;
	height: 54px;
	width: 100%;
	left: 0;
}

.quickbar-air #avatar_cont {
	margin-top: -46px;
	float: left;
}

.quickbar-air #micronav .prev a,
.quickbar-air #micronav .next a,
.quickbar-air #micronav .up a,
.quickbar-air #micronav .home a,
.quickbar-air #micronav .down a {
	background-image: url(../images/air/micronav.png);
}

.quickbar-air #micronav {
	background: url(../images/air/micronav.png) no-repeat scroll center -96px transparent;
}

.quickbar-air #qb_right {
	float: right;
	height: 34px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-air .footer_wig:hover h4 {
	color: #fff;
}

.quickbar-air .footer_wig {
	background: url("../images/air/menu_sep.png") no-repeat right top transparent;
}

<?php } ?>

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'clouds' ) { ?>

.quickbar-clouds #quickbar {
	color: #222;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 10px;
	height: 54px;
	width: 96%;
	left: 2%;
	border-radius: 10px;
	box-shadow: 0 0 10px #000;
	background: #dcdcdc;
	background: -moz-linear-gradient(left,rgba(220,220,220,0.9) 0,rgba(220,220,220,0.9) 100%);
	background: -webkit-gradient(linear,left top,right top,color-stop(0,rgba(220,220,220,0.9)),color-stop(100%,rgba(220,220,220,0.9)));
	background: -webkit-linear-gradient(left,rgba(220,220,220,0.9) 0,rgba(220,220,220,0.9) 100%);
	background: -o-linear-gradient(left,rgba(220,220,220,0.9) 0,rgba(220,220,220,0.9) 100%);
	background: -ms-linear-gradient(left,rgba(220,220,220,0.9) 0,rgba(220,220,220,0.9) 100%);
	background: linear-gradient(left,rgba(220,220,220,0.9) 0,rgba(220,220,220,0.9) 100%);
	border: 1px solid #fff;
}

.quickbar-clouds #avatar_cont {
	margin-top: -46px;
	float: left;
}

.quickbar-clouds #micronav .prev a,
.quickbar-clouds #micronav .next a,
.quickbar-clouds #micronav .up a,
.quickbar-clouds #micronav .home a,
.quickbar-clouds #micronav .down a {
	background-image: url(../images/clouds/micronav.png);
}

.quickbar-clouds #micronav {
	background: url(../images/clouds/micronav.png) no-repeat scroll center -96px transparent;
}

.quickbar-clouds #qb_right {
	float: right;
	height: 34px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-clouds .footer_wig h4 {
	border-radius: 7px;
	background: none repeat scroll 0 0 #fff;
	border: 1px solid #0080bc;
	padding: 5px;
}

.quickbar-clouds .footer_wig:hover h4 {
	color: #666;
}

<?php } ?>

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'earth' ) { ?>

.quickbar-earth #quickbar {
	background: transparent url(../images/earth/qb.png) left top repeat-x;
	color: #555;
	margin: 0 0 10px;
	padding: 0;
	bottom: 0;
	height: 65px;
	width: 97%;
	right: 0;
}

.quickbar-earth #avatar_cont {
	margin-left: -30px;
	margin-top: -30px;
	float: left;
}

.quickbar-earth #micronav .prev a,
.quickbar-earth #micronav .next a,
.quickbar-earth #micronav .up a,
.quickbar-earth #micronav .home a,
.quickbar-earth #micronav .down a {
	background-image: url(../images/earth/micronav.png);
}

.quickbar-earth #micronav {
	top: 3px;
	background: url(../images/earth/micronav.png) no-repeat scroll center -96px transparent;
}

.quickbar-earth #qb_center {
	float: left;
	height: 59px;
	padding-top: 10px;
}

.quickbar-earth #qb_left {
	float: left;
	height: 56px;
	margin-left: 0;
	width: 0;
}

.quickbar-earth #qb_right {
	float: right;
	height: 40px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-earth .footer_wig:hover h4 {
	color: #0080bc;
}

.quickbar-earth .footer_wig {
	background: url("../images/earth/menu_sep.png") no-repeat right 3px transparent;
}

<?php } ?>

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'fire' ) { ?>

.quickbar-fire #quickbar {
	color: #ccc;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 10px;
	height: 54px;
	width: 96%;
	left: 2%;
	border-radius: 10px;
	background: #414141; /* Old browsers */
	background: -moz-linear-gradient(top,  #414141 0%, #5a5a5a 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#414141), color-stop(100%,#5a5a5a)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #414141 0%,#5a5a5a 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #414141 0%,#5a5a5a 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #414141 0%,#5a5a5a 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #414141 0%,#5a5a5a 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#414141', endColorstr='#5a5a5a',GradientType=0 ); /* IE6-9 */
	border: 1px solid #888;
}

.quickbar-fire #avatar_cont {
	margin-top: -46px;
	float: left;
}

.quickbar-fire #micronav .prev a,
.quickbar-fire #micronav .next a,
.quickbar-fire #micronav .up a,
.quickbar-fire #micronav .home a,
.quickbar-fire #micronav .down a {
	background-image: url(../images/fire/micronav.png);
}

.quickbar-fire #micronav {
	background: url(../images/fire/micronav.png) no-repeat scroll center -96px transparent;
}

.quickbar-fire #qb_center {
	float: left;
	height: 56px;
}

.quickbar-fire #qb_left {
}

.quickbar-fire #qb_right {
	float: right;
	height: 36px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-fire .footer_wig:hover h4 {
	color: #fff;
}

.quickbar-fire .footer_wig {
	background: url("../images/fire/menu_sep.png") no-repeat right top transparent;
}

<?php } ?>

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'smoke' ) { ?>

.quickbar-smoke #quickbar {
	background: #131313;
	background: -moz-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(19,19,19,1)),color-stop(30%,rgba(19,19,19,1)),color-stop(100%,rgba(19,19,19,0.9)));
	background: -webkit-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -o-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: -ms-linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	background: linear-gradient(top,rgba(19,19,19,1) 0,rgba(19,19,19,1) 30%,rgba(19,19,19,0.9) 100%);
	border-bottom: 4px double #fff;
	border-top: 4px double #fff;
	color: #ccc;
	margin: 10px 0 0 0;
	padding: 0;
	bottom: 10px;
	height: 54px;
	width: 100%;
	box-shadow: -10px 0 10px #000;
	left: 0;
}

.quickbar-smoke #avatar_cont {
	margin-top: -46px;
	float: left;
}

.quickbar-smoke #micronav .prev a,
.quickbar-smoke #micronav .next a,
.quickbar-smoke #micronav .up a,
.quickbar-smoke #micronav .home a,
.quickbar-smoke #micronav .down a {
	background-image: url(../images/smoke/micronav.png);
}

.quickbar-smoke #micronav {
	background: url(../images/smoke/micronav.png) no-repeat scroll center -96px transparent;
}

.quickbar-smoke #qb_right {
	float: right;
	height: 34px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-smoke .footer_wig:hover h4 {
	color: #fff;
}

.quickbar-smoke .footer_wig {
	background: url("../images/smoke/menu_sep.png") no-repeat right top transparent;
}

<?php } ?>

<?php if ( !$load['quickbar'] || $load['quickbar'] == 'water' ) { ?>

.quickbar-water #quickbar {
	background: transparent url(../images/water/qb.png) left top repeat-x;
	color: #555;
	margin: 0 0 10px;
	padding: 0;
	bottom: 0;
	height: 63px;
	width: 100%;
	left: 0;
}

.quickbar-water #avatar_cont {
	margin-top: -46px;
	float: left;
}

.quickbar-water #micronav .prev a,
.quickbar-water #micronav .next a,
.quickbar-water #micronav .up a,
.quickbar-water #micronav .home a,
.quickbar-water #micronav .down a {
	background-image: url(../images/water/micronav.png);
}

.quickbar-water #micronav {
	background: url(../images/water/micronav.png) no-repeat scroll center -96px transparent;
	margin-top: -4px;
}

.quickbar-water #qb_center {
	float: left;
	height: 56px;
}

.quickbar-water #qb_left {
	float: left;
	height: 56px;
	margin-left: 1%;
	width: 1%;
}

.quickbar-water #qb_right {
	float: right;
	height: 36px;
	padding: 10px 0;
	text-align: center;
	font-weight: bold;
}

.quickbar-water .footer_wig:hover h4 {
	color: #0080bc;
}

.quickbar-water .footer_wig {
	background: url("../images/water/menu_sep.png") no-repeat right top transparent;
}

.quickbar-water #quickbar a {
	color: #aaa;
}

<?php } ?>

/* popup */

<?php if ( !$load['popup'] || $load['popup'] == 'air' ) { ?>

.popup-air #primary_menu .children a,
.popup-air #primary_menu .sub-menu a,
.popup-air #quickbar .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}

.popup-air #primary_menu .children a:hover,
.popup-air #primary_menu .sub-menu a:hover,
.popup-air #quickbar .fw_pul a:hover {
	color: #d54e21;
}

.popup-air .current_page_item>a,
.popup-air .current-menu-item>a,
.popup-air .current-cat>a {
	color: #d54e21;
}

.popup-air .footer_wig .fw_pul {
	color: #333;
	padding: 10px;
	border-color: #aaa;
	border-style: solid;
	border-width: 1px;
	background: #efefef;
	background: -moz-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#efefef),color-stop(100%,#cacaca));
	background: -webkit-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -o-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -ms-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: linear-gradient(top,#efefef 0,#cacaca 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#efefef',endColorstr='#cacaca',GradientType=0);
	border-radius: 5px;
}

.popup-air #mainmenu>li.page_item>ul.children,
.popup-air #mainmenu>li.menu-item>ul.sub-menu {
	border: 1px solid #aaa;
	background: #efefef;
	background: -moz-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#efefef),color-stop(100%,#cacaca));
	background: -webkit-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -o-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: -ms-linear-gradient(top,#efefef 0,#cacaca 100%);
	background: linear-gradient(top,#efefef 0,#cacaca 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#efefef',endColorstr='#cacaca',GradientType=0);
	border-radius: 3px;
	color: #333;
}

.popup-air #mainmenu ul.sub-menu,
.popup-air #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

.popup-air .footer_wig .tb-author-bio {
	border: 2px groove #fff;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['popup'] || $load['popup'] == 'clouds' ) { ?>

.popup-clouds #primary_menu .children a,
.popup-clouds #primary_menu .sub-menu a,
.popup-clouds #quickbar .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}

.popup-clouds #primary_menu .children a:hover,
.popup-clouds #primary_menu .sub-menu a:hover,
.popup-clouds #quickbar .fw_pul a:hover {
	color: #888;
}

.popup-clouds .current_page_item>a,
.popup-clouds .current-menu-item>a,
.popup-clouds .current-cat>a {
	color: #d54e21;
}

.popup-clouds .footer_wig .fw_pul {
	padding: 10px;
	border-radius: 5px;
	box-shadow: 1px 1px 2px #000;
	background: #fff;
	border: 2px solid #ccc;
	color: #666;
}

.popup-clouds #mainmenu>li.page_item>ul.children,
.popup-clouds #mainmenu>li.menu-item>ul.sub-menu {
	border-radius: 3px;
	background: #fff;
	border: 2px solid #ccc;
	color: #666;
	z-index: 2;
}

.popup-clouds #mainmenu ul.sub-menu,
.popup-clouds #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

<?php } ?>

<?php if ( !$load['popup'] || $load['popup'] == 'earth' ) { ?>

.popup-clouds .footer_wig .tb-author-bio {
	border: 1px solid #aaa;
	background: transparent;
}

.popup-earth #primary_menu .children a,
.popup-earth #primary_menu .sub-menu a,
.popup-earth #quickbar .fw_pul a {
	color: #87cefa;
	text-decoration: none;
}

.popup-earth #primary_menu .children a:hover,
.popup-earth #primary_menu .sub-menu a:hover,
.popup-earth #quickbar .fw_pul a:hover {
	color: #d54e21;
}

.popup-earth .current_page_item>a,
.popup-earth .current-menu-item>a,
.popup-earth .current-cat>a {
	color: #d54e21;
}

.popup-earth .footer_wig .fw_pul {
	color: #ccc;
	padding: 10px;
	border: 3px solid #fff;
	background: #000 url(../images/earth/pop.jpg) left top repeat-x;
	border-radius: 5px;
}

.popup-earth #mainmenu>li.page_item>ul.children,
.popup-earth #mainmenu>li.menu-item>ul.sub-menu {
	border: 3px solid #fff;
	background: #000 url(../images/earth/pop.jpg) left top repeat-x;
	border-radius: 5px;
	color: #ccc;
}

.popup-earth #mainmenu ul.sub-menu,
.popup-earth #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

.popup-earth .footer_wig .tb-author-bio {
	border: 1px solid #222;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['popup'] || $load['popup'] == 'fire' ) { ?>

.popup-fire #primary_menu .children a,
.popup-fire #primary_menu .sub-menu a,
.popup-fire #quickbar .fw_pul a {
	color: #87cefa;
	text-decoration: none;
}

.popup-fire .comment .comment a {
	color: #004867;
}

.popup-fire #primary_menu .children a:hover,
.popup-fire #primary_menu .sub-menu a:hover,
.popup-fire #quickbar .fw_pul a:hover {
	color: #d54e21;
}

.popup-fire .current_page_item>a,
.popup-fire .current-menu-item>a,
.popup-fire .current-cat>a {
	color: #d54e21;
}

.popup-fire .footer_wig .fw_pul {
	color: #ccc;
	padding: 10px;
	border-color: #888;
	border-style: solid;
	border-width: 1px;
	border-radius: 5px;
	background: #5a5a5a; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #5a5a5a 0%, #414141 30%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#5a5a5a), color-stop(30%,#414141)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* Opera 11.10+ */
	background: -ms-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* IE10+ */
	background: linear-gradient(135deg,  #5a5a5a 0%,#414141 30%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5a5a5a', endColorstr='#414141',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

.popup-fire #mainmenu>li.page_item>ul.children,
.popup-fire #mainmenu>li.menu-item>ul.sub-menu {
	border: 1px solid #888;
	border-radius: 5px;
	color: #ccc;
	background: #5a5a5a; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #5a5a5a 0%, #414141 30%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#5a5a5a), color-stop(30%,#414141)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* Opera 11.10+ */
	background: -ms-linear-gradient(-45deg,  #5a5a5a 0%,#414141 30%); /* IE10+ */
	background: linear-gradient(135deg,  #5a5a5a 0%,#414141 30%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5a5a5a', endColorstr='#414141',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

.popup-fire #mainmenu ul.sub-menu,
.popup-fire #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

.popup-fire .footer_wig .tb-author-bio {
	border: 1px solid #555;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['popup'] || $load['popup'] == 'smoke' ) { ?>

.popup-smoke #primary_menu .children a,
.popup-smoke #primary_menu .sub-menu a,
.popup-smoke #quickbar .fw_pul a {
	color: #0080bc;
	text-decoration: none;
}

.popup-smoke #primary_menu .children a:hover,
.popup-smoke #primary_menu .sub-menu a:hover,
.popup-smoke #quickbar .fw_pul a:hover {
	color: #fff;
}

.popup-smoke .current_page_item>a,
.popup-smoke .current-menu-item>a,
.popup-smoke .current-cat>a {
	color: #d54e21;
}

.popup-smoke .footer_wig .fw_pul {
	color: #aaa;
	padding: 10px;
	background: #000;
	background: -moz-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(0,0,0,0.95)),color-stop(30%,rgba(0,0,0,0.95)),color-stop(100%,rgba(0,0,0,0.85)));
	background: -webkit-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -o-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -ms-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2000000',endColorstr='#d9000000',GradientType=0);
	border: 5px solid #222;
	border-radius: 5px;
	box-shadow: 1px 1px 2px #000;
}

.popup-smoke #mainmenu>li.page_item>ul.children,
.popup-smoke #mainmenu>li.menu-item>ul.sub-menu {
	background: #000;
	background: -moz-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(0,0,0,0.95)),color-stop(30%,rgba(0,0,0,0.95)),color-stop(100%,rgba(0,0,0,0.85)));
	background: -webkit-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -o-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: -ms-linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	background: linear-gradient(top,rgba(0,0,0,0.95) 0,rgba(0,0,0,0.95) 30%,rgba(0,0,0,0.85) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2000000',endColorstr='#d9000000',GradientType=0);
	border: 5px solid #222;
	border-radius: 3px;
	color: #aaa;
}

.popup-smoke #mainmenu ul.sub-menu,
.popup-smoke #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

.popup-smoke .footer_wig .tb-author-bio {
	border: 1px solid #666;
	background: transparent;
}

<?php } ?>

<?php if ( !$load['popup'] || $load['popup'] == 'water' ) { ?>

.popup-water #primary_menu .children a,
.popup-water #primary_menu .sub-menu a,
.popup-water #quickbar .fw_pul a {
	color: #fff;
	text-decoration: none;
}

.popup-water #primary_menu .children a:hover,
.popup-water #primary_menu .sub-menu a:hover,
.popup-water #quickbar .fw_pul a:hover {
	color: #87cefa;
}

.popup-water .current_page_item>a,
.popup-water .current-menu-item>a,
.popup-water .current-cat>a {
	color: #fff;
}

.popup-water .footer_wig .fw_pul {
	color: #ccc;
	padding: 10px;
	border-color: #fff;
	border-style: double;
	border-width: 3px;
	background: #28e5f8; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #28e5f8 0%, #0080bd 30%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#28e5f8), color-stop(30%,#0080bd)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* Opera 11.10+ */
	background: -ms-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* IE10+ */
	background: linear-gradient(135deg,  #28e5f8 0%,#0080bd 30%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#28e5f8', endColorstr='#0080bd',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	border-radius: 5px;
}

.popup-water #mainmenu>li.page_item>ul.children,
.popup-water #mainmenu>li.menu-item>ul.sub-menu {
	border: 3px double #fff;
	background: #28e5f8; /* Old browsers */
	background: -moz-linear-gradient(-45deg,  #28e5f8 0%, #0080bd 30%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#28e5f8), color-stop(30%,#0080bd)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* Opera 11.10+ */
	background: -ms-linear-gradient(-45deg,  #28e5f8 0%,#0080bd 30%); /* IE10+ */
	background: linear-gradient(135deg,  #28e5f8 0%,#0080bd 30%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#28e5f8', endColorstr='#0080bd',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	border-radius: 5px;
	color: #ccc;
}

.popup-water #mainmenu ul.sub-menu,
.popup-water #mainmenu ul.children {
	margin: 0;
	padding: 0;
}

.popup-water .footer_wig .tb-author-bio {
	border: 1px solid #cfe9ff;
	background: transparent;
}

<?php } ?>

/* avatar */

<?php if ( !$load['avatar'] || $load['avatar'] == 'air' ) { ?>

.avatar-air #avatar_cont {
	background: url("../images/air/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php if ( !$load['avatar'] || $load['avatar'] == 'clouds' ) { ?>

.avatar-clouds #avatar_cont {
	background: url("../images/clouds/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php if ( !$load['avatar'] || $load['avatar'] == 'earth' ) { ?>

.avatar-earth #avatar_cont {
	background: url("../images/earth/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php if ( !$load['avatar'] || $load['avatar'] == 'fire' ) { ?>

.avatar-fire #avatar_cont {
	background: url("../images/fire/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php if ( !$load['avatar'] || $load['avatar'] == 'smoke' ) { ?>

.avatar-smoke #avatar_cont {
	background: url("../images/smoke/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php if ( !$load['avatar'] || $load['avatar'] == 'water' ) { ?>

.avatar-water #avatar_cont {
	background: url("../images/water/ava.png") no-repeat scroll center center transparent;
}

<?php } ?>

<?php
exit;
