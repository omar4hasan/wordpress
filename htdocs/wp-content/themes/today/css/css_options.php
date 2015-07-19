<?php
header("Content-type: text/css");
require_once('../../../../wp-load.php');
?>
<?php
$patterns 		= of_get_option('patterns');
$image  		= get_stylesheet_directory_uri() . '/images/patterns/';
$type           = of_get_option('type_background');
$font 			= of_get_option('font_pred');
$color 			= of_get_option('color_picker');

switch ($type) {
    case "pattern":
        echo '
body {
	background: url("' . $image . '' . $patterns . '.png");
    }
';
        break;  
}

echo '
body, h1, h2, h3, h4, h5, h6 {
	font-family: "' . $font . '", sans-serif;
	}
';

echo '
a,
.list-nav ul li a:hover,
.widget_calendar tfoot>tr>td#prev a:hover, 
.widget_calendar tfoot>tr>td#next a:hover,
.short-one-art h2 a:hover,
.short-three-art h2 a:hover,
.short-four-art h2 a:hover,
h2.bl1page-title a:hover,
h2.bl2page-title a:hover,
#footer a:hover {
	color:' . $color . ';
	}
';

echo '
.blog-cover-cat,
.slider-left-cat,
.slider-right-cat,
.feat-content-cat,
.reply a:hover,
.pagination a:hover, 
.pagination .current, 
.tagcloud a:hover, 
.button-send#submitmail:hover,
.highlight,
.button-link a,
.single-tag a:hover,
ul.tabs li a,
a.pp_download,
p.form-submit input#submit:hover,
.slicknav_btn,
#wizemenu > ul > li:hover > a, 
#wizemenu > ul > li.active > a, 
#wizemenu > ul > li > a:active, 
#wizemenu > ul ul li a:hover {
	background:' . $color . ';
	}
';

echo '
.sidebarnav h3, 
.short-title h3,
.title-head h1,
.widget-blog-two-cover span,
.short-two-art span,
.short-three-cover span,
.short-five-cover span,
.short-five-coverM span {
	border-bottom:2px ' . $color . ' solid;
	}
';

echo '
#menu-search #search-button {
	background:' . $color . ' url("../images/search-header.png");
	}
';

echo '
span.widget-blog-two-cover-link,
span.short-two-link,
span.short-three-link,
span.short-five-link {
	border-bottom:0px;
	}
';

echo of_get_option('custom_css');
?>