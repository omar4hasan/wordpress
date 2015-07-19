<?php
/** Contact Form Block **/

class ST_Map_Block extends AQ_Block {

    //set and create block
    function __construct() {
        $block_options = array(
            'name' => '<i class="fa fa-arrows"></i> Google Map',
            'size' => 'col-md-12',
        );

        //create the block
        parent::__construct('st_map_block', $block_options);
    }

    function form($instance) {

		$args = array (
			'nopaging' => true,
			'post_type' => 'wpcf7_contact_form',
			'status' => 'publish',
		);
		$contacts = get_posts($args);

    	$contact_options = array(); $default_contact = '';
		foreach ($contacts as $contact) {
			$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
			$contact_options[$contact->ID] = htmlspecialchars($contact->post_title);
		}

        $defaults = array(
			'title' => '',
			'icon_address' => 'map-marker',
			'text_address' => 'Address',
			'address' => '121 King Street, Melbourne Victoria 3000<br />United States of America, CA 90017',
			'icon_mobile' => 'phone',
			'text_mobile' => 'Mobile Number',
			'mobile1' => ' (1005) 5999 4446',
			'mobile2'=>' (0422) 5999 4446',
			'icon_email' => 'envelope-o',
			'text_email' => 'Email',
			'email' => 'jollythemes@gmail.com',
			'skype'=>'jollythemes',
			'longitude' => '145.060508',
			'latitude' => '-37.801578',
			'zoom'=>'10',
			'image_location'=>'',
			'html'=>'',
			'contact' => $default_contact
        );
        $instance = wp_parse_args($instance, $defaults);
        extract( $instance);

        ?>

		<div class="description">
			<label for="<?php echo $block_id ?>_title">
				Title (optional)<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="">
				Choose contact form<br/>
				<?php echo aq_field_select('contact', $block_id, $contact_options, $contact); ?>
			</label>
		</div>
		<div class="cf"></div>
		<h3 style="text-align: center;">Address</h3><br />
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Icon Address<br/>
				<?php echo aq_field_input('icon_address', $block_id, $icon_address, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Text Address<br/>
				<?php echo aq_field_input('text_address', $block_id, $text_address, $size = 'full') ?>
			</label>
		</div>
		<div class="description third last">
			<label for="<?php echo $block_id ?>_title">
				Address<br/>
				<?php echo aq_field_input('address', $block_id, $address, $size = 'full') ?>
			</label>
		</div>

		<div class="cf"></div>
		<h3 style="text-align: center;">Mobile</h3><br />
		<div class="description">
			<label for="<?php echo $block_id ?>_title">
				Icon Mobile<br/>
				<?php echo aq_field_input('icon_mobile', $block_id, $icon_mobile, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Text Mobile<br/>
				<?php echo aq_field_input('text_mobile', $block_id, $text_mobile, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Mobile 1<br/>
				<?php echo aq_field_input('mobile1', $block_id, $mobile1, $size = 'full') ?>
			</label>
		</div>
		<div class="description third last">
			<label for="<?php echo $block_id ?>_title">
				Mobile 2<br/>
				<?php echo aq_field_input('mobile2', $block_id, $mobile2, $size = 'full') ?>
			</label>
		</div>

		<div class="cf"></div>
		<h3 style="text-align: center;">Email</h3><br />
		<div class="description">
			<label for="<?php echo $block_id ?>_title">
				Icon Email<br/>
				<?php echo aq_field_input('icon_email', $block_id, $icon_email, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Text Email<br/>
				<?php echo aq_field_input('text_email', $block_id, $text_email, $size = 'full') ?>
			</label>
		</div>
		<div class="description third">
			<label for="<?php echo $block_id ?>_title">
				Email<br/>
				<?php echo aq_field_input('email', $block_id, $email, $size = 'full') ?>
			</label>
		</div>
		<div class="description third last">
			<label for="<?php echo $block_id ?>_title">
				Skype<br/>
				<?php echo aq_field_input('skype', $block_id, $skype, $size = 'full') ?>
			</label>
		</div>

		<h3 style="text-align: center;">Settings Google Map</h3><br />
		<div class="cf"><code>Website convert address to latitude and longitude <a target="_blank" href="http://www.latlong.net/convert-address-to-lat-long.html">click here</a></code></div>
        <div class="description half">
			<label for="<?php echo $block_id ?>_latitude">
				Position Latitude Number (optional)<br/>
				<?php echo aq_field_input('latitude', $block_id, $latitude, $size = 'full') ?>
			</label>
		</div>
		<div class="description half last">
			<label for="<?php echo $block_id ?>_longitude">
				Position Longitude Number (optional)<br/>
				<?php echo aq_field_input('longitude', $block_id, $longitude, $size = 'full') ?>
			</label>
		</div>
		<div class="description">
			<label for="<?php echo $block_id ?>_address">
				Zoom<br/>
				<?php echo aq_field_input('zoom', $block_id, $zoom, $size = 'full') ?>
			</label>
		</div>
		<div class="descriptions">
			<label for="<?php echo $this->get_field_id('image_location') ?>">
				Icon location:
				<?php echo aq_field_upload('image_location', $block_id, $image_location) ?>
			</label>
		</div>		
		<div class="description">
			<label for="<?php echo $block_id ?>_address">
				Html<br/>
				<?php echo aq_field_textarea('html', $block_id, $html, $size = 'full') ?>
			</label>
		</div>
	<?php
    }

    function block($instance) {
        extract($instance);

        ?>
    <section id="contact" class="white-wrapper">
    	<div class="container">
    		<div class="general-title text-center wow fadeInDown">
            	<h1><?php echo $title; ?></h1>
                <hr class="jt">
            </div><!-- end general title -->

			<div class="contact_details">
				<div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
					<div class="miniboxes text-center">
						<div class="service-icon wow swing">
							<div class="dm-icon-effect-1">
								<a href="#" class=""> <i class="hovicon effect-1 sub-a fa fa-<?php echo $icon_address ?> fa-2x"></i> </a>
							</div><!-- end dm-icon-effect-1 -->
							<div class="title"><h3><?php echo $text_address ?></h3></div>
                             <p><?php echo htmlspecialchars_decode($address) ?></p>
						</div><!-- end service-icon -->
					</div><!-- end miniboxes -->
				</div><!-- end col-lg-4 -->

				<div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
					<div class="miniboxes text-center">
						<div class="service-icon wow swing">
							<div class="dm-icon-effect-1">
								<a href="#" class=""> <i class="hovicon effect-1 sub-a fa fa-<?php echo $icon_mobile ?> fa-2x"></i> </a>
							</div><!-- end dm-icon-effect-1 -->
							<div class="title"><h3><?php echo $text_mobile ?></h3></div>
                             <p><strong><?php echo $text_mobile ?>:</strong> <?php echo $mobile1 ?><br>
							<strong><?php echo $text_mobile ?>:</strong> <?php echo $mobile2 ?></p>
						</div><!-- end service-icon -->
					</div><!-- end miniboxes -->
				</div><!-- end col-lg-4 -->

				<div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
					<div class="miniboxes text-center">
						<div class="service-icon wow swing">
							<div class="dm-icon-effect-1">
								<a href="#" class=""> <i class="hovicon effect-1 sub-a fa fa-<?php echo $icon_email ?> fa-2x"></i> </a>
							</div><!-- end dm-icon-effect-1 -->
							<div class="title"><h3><?php echo $text_email ?></h3></div>
                             <p><strong><?php echo $text_email ?>:</strong> <?php echo $email ?><br>
							<strong>Skype:</strong> <?php echo $skype ?></p>
						</div><!-- end service-icon -->
					</div><!-- end miniboxes -->
				</div><!-- end col-lg-4 -->
			</div><!-- end contact_details -->

			<div class="clearfix"></div>
			<div id="message" class="wpcf7-response-output wpcf7-display-none"></div>
			<div id="contactform">
				<?php
					echo do_shortcode('[contact-form-7 id="'.$contact.'" title="contact form 2"]');
				?>
			</div>

    	</div><!-- end container -->
    </section><!-- end white wrapper -->

		<section class="map-wrapper">
			<h2 style="display:none">&nbsp;</h2>
			<div id="map"></div>
		</section><!-- end map wrapper -->
		  <script type="text/javascript">
				var locations = [
				['<?php echo htmlspecialchars_decode($html) ?>', <?php echo $latitude; ?>, <?php echo $longitude; ?>, 2]
				];

				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: <?php echo $zoom ?>,
					scrollwheel: false,
					navigationControl: true,
					mapTypeControl: false,
					scaleControl: false,
					draggable: true,
					styles: [ { "stylers": [ { "hue": "#FE7E17" }, { "gamma": 1 } ] } ],
					center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
				  mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				var infowindow = new google.maps.InfoWindow();

				var marker, i;

				for (i = 0; i < locations.length; i++) {

					marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map ,
					icon: '<?php echo $image_location ?>'
					});


				  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
					  infowindow.setContent(locations[i][0]);
					  infowindow.open(map, marker);
					}
				  })(marker, i));
				}
		  </script>
    <?php
    }
}