<?php
/**
 * Hero video meta fields section used in templates.
 */
?>

<!-- Creates a form section for inputting a 'Hero Video URL'. It is part of a
 container with class name sections-meta-cont. -->
<div class="sections-meta-cont">
    <strong><label for="private-temp-video"
                   class="private-temp-video"><?php _e( 'Hero Video URL',
				'the-fly-shop' ); ?></label></strong>
    <input style="width:100%;" type="url" name="private-temp-video"
           id="private-temp-video"
           value="<?php if ( isset ( $private_stored_meta['private-temp-video'] ) ) {
		       echo $private_stored_meta['private-temp-video'][0];
	       } ?>"/>
    <p class="meta-description">Add video url here. Video url is associated
        with media stored in a bucket at AWS or Google Cloud. Do not enter
        YouTube or Vimeo urls. Ensure <b>Private Water Hero Image</b> is
        empty.</p>
</div>

<div>
	<?php
	/**
	 * Variable: $private_hero_opacity
	 *
	 * Description:
	 * This variable represents the opacity value for a private hero element.
	 *
	 * Data Type:
	 * float
	 *
	 * Acceptable Values:
	 * The value should be between 0 and 1, inclusive.
	 *
	 * Usage:
	 * This variable should be used to set the opacity of a private hero element in a HTML/CSS context.
	 *
	 * Example:
	 * The opacity of the private hero element can be set using the following code:
	 *
	 * $private_hero_opacity = 0.75;
	 *
	 * <div class="private-hero" style="opacity: <?php echo $private_hero_opacity; ?>;"></div>
	 *
	 * Note: The above example code is only for illustration purposes. Actual code implementation may vary depending on the specific use case.
	 */
	$private_hero_opacity = get_post_meta( $post->ID,
		'private-hero-opacity-range',
		TRUE );
	
	if ( empty( $private_hero_opacity ) ) {
		$private_hero_opacity = 0.1;
	}
	
	?>
    <!-- Custom Range Value Meta Field -->
    <label for="private_hero_opacity"><b>Custom Range Value</b></label>
    <div style="background-color: #f5f5f5; padding: 1em;">
        <div>
            <span>The "Custom Range Value" below selects the opacity of the image or video overlay. Setting this value helps contrast logo, title, telephone against the background media.</span>
        </div>
        <label for="private_hero_opacity"><b>Custom Range Value:</b></label>
        <input type="range" name="private-hero-opacity-range"
               id="private-hero-opacity-range" min="0.1" max="1" step="0.01"
               value="<?php echo esc_attr( $private_hero_opacity ); ?>">
        <span id="private_hero_range_value_display"><?php echo esc_attr
			( $private_hero_opacity ); ?></span>
    </div>
</div>

<!-- Script renders range selector value to the right of range selector -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rangeInput = document.getElementById('private-hero-opacity-range');
        const rangeValueDisplay = document.getElementById('private_hero_range_value_display');

        rangeInput.addEventListener('input', function () {
            rangeValueDisplay.textContent = rangeInput.value;
        });
    });
</script>

<!-- This meta field generates a personalised input field for uploading a
custom fallback 'poster' image for a video. This image is utilized when the video cannot play, such as on mobile devices which do not support auto-play video.  -->
<div class="sections-meta-cont">
    <strong><label for="private-temp-video-poster"
                   class="sections-row-title"><?php _e( 'Hero Video Poster',
				'the-fly-shop' ); ?></label></strong><br>
    <input style="width:75%;" type="text" name="private-temp-video-poster"
           id="private-temp-video-poster"
           value="<?php if ( isset ( $private_stored_meta['private-temp-video-poster'] ) ) {
		       echo $private_stored_meta['private-temp-video-poster'][0];
	       } ?>"/>
    <input type="button" id="private-temp-video-poster-button"
           class="button"
           value="<?php _e( 'Choose or Upload an Image',
		       'the-fly-shop' ); ?>"/>
    <p class="meta-description">Add an image here that is used on mobile
        devices. Mobile devices do not auto-play video. The "Poster" image
        is returned on mobile devices when a video is presented on tablets
        and desktop.</p>
</div>

<!-- Sanitization -->
<?php
    // Checks for input and saves if needed
    if ( isset( $_POST['private-hero-opacity-range'] ) ) {
    update_post_meta( $post_id,
    'private-hero-opacity-range',
    sanitize_text_field( $_POST['private-hero-opacity-range'] ) );
    }

    // Checks for input and saves if needed
    if ( isset( $_POST['private-temp-video-poster'] ) ) {
    update_post_meta( $post_id,
    'private-temp-video-poster',
    $_POST['private-temp-video-poster'] );
    }

    // Checks for input and saves if needed
    if ( isset( $_POST['private-temp-video'] ) ) {
    update_post_meta( $post_id,
    'private-temp-video',
    $_POST['private-temp-video'] );
    }
    ?>

<!-- Template HTML/PHP used inside template files for rendering meta content
in browser.
 -->

<?php if ( !empty( $private_temp_video ) || !empty($private_temp_video_poster) ) : ?>
    <section id="banner" class="private-temp-hero-overlay">
        <div class="overlay"></div>
        <video id="sections-private-background-video" class="private-temp-video"
               autoplay
               playsinline loop
               muted
               poster="<?php echo $private_temp_video_poster; ?>">
            <source src="<?php echo $private_temp_video; ?>" type="video/mp4">
        </video>
        <div class="inner-background"></div>
        <div id="private-temp-hero-video" class="inner">
			<?php
			if ( ! empty( $private_waters_logo ) ) { ?>
                <img src="<?php echo $private_waters_logo; ?>"
                     class="img-responsive center-block"
                     alt="The Fly Shop Signature Travel Destination">
			<?php } ?>
            <h2><?php the_title(); ?></h2>
			<?php
			if ( ! empty( $private_waters_description ) ) { ?>
                <p class="template-description"><?php echo $private_waters_description; ?></p>
			<?php } ?>
            <h3>800 &bull; 669 &bull; 3474</h3>
        </div>
        <a href="#main" class="more scrolly">Read more here!</a>
    </section>
<?php endif;