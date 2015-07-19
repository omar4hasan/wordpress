<script type="text/javascript" src="<?php echo get_template_directory_uri() . "/switcher/jquery.miniColors.min.js"; ?>"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/switcher/jquery.miniColors.css"; ?>" />

<script type="text/javascript">
	var theme = "<?php echo get_stylesheet_directory_uri(); ?>";
</script>

<script type="text/javascript">
	
	$j(document).ready(function() {
		$j("#switcher .handle").click(function() {
			$j("#switcher").toggleClass("open");
		});

		$j("#switcher input.color").miniColors();

		$j("#applyChanges").click(function() {

			// Colors
			var main = $j("#main-color").val().replace("#", "");
			var page = $j("#page-color").val().replace("#", "");
			var menu = $j("#menu-color").val().replace("#", "");
			var submenu = $j("#submenu-color").val().replace("#", "");
			var toparea = $j("#toparea-color").val().replace("#", "");
			var footerarea = $j("#footerarea-color").val().replace("#", "");
			var topbar = $j("#topbar-color").val().replace("#", "");

			// Fonts
			var textfont = $j("#text-font").val();
			var menufont = $j("#menu-font").val();
			var pagetitlefont = $j("#pagetitle-font").val();
			var pagesubtitlefont = $j("#pagesubtitle-font").val();

			var loader = $j("#loader");
			var body = $j("body");

			var query = "<?php echo home_url(); ?>/?thb_custom_resource=1&amp;resource_uri=custom-styles&met_main_color="+main;
			query += "&met_body_background_color="+page;
			query += "&met_menu_background_color="+menu;
			query += "&met_submenu_background_color="+submenu;
			query += "&met_topwidgetarea_background_color="+toparea;
			query += "&met_footerwidgetarea_background_color="+footerarea;
			query += "&met_topbar_background_color="+topbar;

			query += "&met_font_text="+textfont;
			query += "&met_font_menu="+menufont;
			query += "&met_font_pagetitle="+pagetitlefont;
			query += "&met_font_pagesubtitle="+pagesubtitlefont;
			
			var link = $j("<link rel='stylesheet' href='"+query+"'/>");

			loader.show();

			setTimeout(function() {
				$j('head').append(link);
				loader.hide();
			}, 500);

			return false;
		});

	});
	
</script>
<style type="text/css">
	#switcher {
		background: #fff;
		color: #333;
		font: normal 12px/1.5 Helvetica, Arial, sans-serif;
		padding: 20px;
		border-top: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		border-right: 1px solid #ccc;
		-webkit-border-top-right-radius: 5px;
		-webkit-border-bottom-right-radius: 5px;
		-moz-border-radius-topright: 5px;
		-moz-border-radius-bottomright: 5px;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;

		position: fixed;
		top: 80px;
		left: -441px;
		width: 400px;
		z-index: 999999;
		box-shadow: 0 2px 0 rgba(0,0,0,.10);

		-webkit-transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;

	}

	#switcher.open {
		left: 0;
	}

	#switcher .handle {
		-webkit-border-top-right-radius: 5px;
		-webkit-border-bottom-right-radius: 5px;
		-moz-border-radius-topright: 5px;
		-moz-border-radius-bottomright: 5px;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;

		height: 32px;
		width: 33px;
		padding: 5px;
		display: block;
		cursor: pointer;
		position:absolute;
		right: -44px;
		border-top: 1px solid #ccc;
		border-right: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		background: #fff url(<?php echo get_template_directory_uri(); ?>/switcher/images/colorwheel.png) 6px center no-repeat;
		box-shadow: 0 2px 0 rgba(0,0,0,.10);
	}

	#switcher div {
		clear: both;
	}

	#switcher p {
		clear: both;
		color: #888;
		margin-bottom: 1.5em;
	}
	
	#switcher p strong {
		font-weight: bold;
		color: #222;
	}

	#switcher h1 {
		font-size: 18px;
		font-weight: bold;
		margin-bottom: 12px;
	}

	#switcher h2 {
		font-weight: bold;
		margin: 24px 0 12px 0;
		border-bottom: 1px solid #ddd;
		font-size: 20px;
	}
	
	#switcher label {
		float: left;
		width: 180px;
		color: #888;
		margin-top: 3px;
	}

	#switcher select {
		float: left;
		margin-top: 3px;
	}
	
	#switcher .swrow {
		clear: both;
		display: block;
		margin-bottom: 8px;
	}

	#switcher input {
		/*display: none;*/
		border: 1px solid #ccc;
		color: #888;
		font-size: 11px;
		padding: 3px 2px;
		letter-spacing: 1px;
		text-transform: uppercase;
		font-family: inherit;
	}

	#switcher #applyChanges {
		font-family: inherit;
		font-weight: bold;
		background: #eee;
		border: 1px solid #ccc;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		padding: 4px 10px;
		margin-top: 30px;
		margin-left: 0px;
		cursor: pointer;
		color: #666;
		float: left;
		text-shadow: 1px solid #fff;
		box-shadow: inset 0 -3px 5px rgba(0,0,0,.1);
	}

	#switcher #applyChanges:hover {
		background: #f7f7f7;
		color: #666;
	}

	#switcher #applyChanges:active {
		background: #ddd;
		color: #888;
		text-shadow: -1px solid #333;
		box-shadow: inset 0 3px 5px rgba(0,0,0,.05);
		padding-top: 5px;
		padding-bottom: 3px;
	}

	#switcher #loader {
		margin-top: 36px;
		margin-left: 10px;
		float: left;
		display: none;
	}
</style>

<div id="switcher">
	<span class="handle"></span>
	<h1>Pick your own style!</h1>
	<p>Hi there! Have fun picking your own style for Metropolis, and keep in mind that these are only few of the <strong>many customization options</strong> available (including lots fonts from the Google Webfonts library, and the ability to upload your own)!</p>
	<div>
		<h2>Colors</h2>
		<span class="swrow">
			<label for="">Highlight color</label>
			<?php
				$value = thb_get_option("_main_color");
			?>
			<input class="color" id="main-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Top bar background</label>
			<?php
				$value = thb_get_option("_topbar_background_color");
			?>
			<input class="color" id="topbar-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Menu background</label>
			<?php
				$value = thb_get_option("_menu_background_color");
			?>
			<input class="color" id="menu-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Submenu background</label>
			<?php
				$value = thb_get_option("_submenu_background_color");
			?>
			<input class="color" id="submenu-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Top widget area background</label>
			<?php
				$value = thb_get_option("_topwidgetarea_background_color");
			?>
			<input class="color" id="toparea-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Page container background</label>
			<?php
				$value = thb_get_option("_body_background_color");
			?>
			<input class="color" id="page-color" value="<?php echo $value; ?>">
		</span>
		<span class="swrow">
			<label for="">Footer widget area background</label>
			<?php
				$value = thb_get_option("_footerwidgetarea_background_color");
			?>
			<input class="color" id="footerarea-color" value="<?php echo $value; ?>">
		</span>
	</div>
	<div>
		<h2>Fonts</h2>
		<?php $fonts = getFonts(); ?>
		<span class="swrow">
			<label for="">Text font</label>
			<?php
				$value = thb_get_option("_font_text");
			?>
			<select id="text-font">
				<?php echo getStructuredOptionsFromArray($fonts, $value); ?>
			</select>
		</span>
		<span class="swrow">
			<label for="">Menu font</label>
			<?php
				$value = thb_get_option("_font_menu");
			?>
			<select id="menu-font">
				<?php echo getStructuredOptionsFromArray($fonts, $value); ?>
			</select>
		</span>
		<span class="swrow">
			<label for="">Page title font</label>
			<?php
				$value = thb_get_option("_font_pagetitle");
			?>
			<select id="pagetitle-font">
				<?php echo getStructuredOptionsFromArray($fonts, $value); ?>
			</select>
		</span>
		<span class="swrow">
			<label for="">Page subtitle font</label>
			<?php
				$value = thb_get_option("_font_pagesubtitle");
			?>
			<select id="pagesubtitle-font">
				<?php echo getStructuredOptionsFromArray($fonts, $value); ?>
			</select>
		</span>
		<br><br><p>And many other over which you'll have full control (<strong>size</strong>, <strong>weight</strong>, <strong>style</strong> and <strong>color</strong>)!</p>
	</div>
	<div>
		<a id="applyChanges">Apply all changes</a>
		<span id="loader"><img src="<?php echo get_stylesheet_directory_uri(); ?>/switcher/images/ajax-loader.gif" /></span>
	</div>
</div>