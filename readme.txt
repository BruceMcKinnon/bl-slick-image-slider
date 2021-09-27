=== WP Slick Slider and Image Carousel Pro  ===
Contributors: wponlinesupport, anoopranawat 
Tags: slick, image slider, slick slider, slick image slider, slider, image slider, header image slider, responsive image slider, responsive content slider, carousel, image carousel, carousel slider, content slider, coin slider, touch slider, text slider, responsive slider, responsive slideshow, Responsive Touch Slider, wp slider, wp image slider, wp header image slider, photo slider, responsive photo slider  
Requires at least: 3.1
Tested up to: 4.4.2

A quick, easy way to add and display mulipale WP Slick Slider and carousel using a shortcode.
 

== Description ==

Display multiple slick image slider and carousel using shortcode with category. Fully responsive, Swipe enabled, Desktop mouse dragging and  Infinite looping.
Fully accessible with arrow key navigation  Autoplay, dots, arrows etc.

It uses A custom post type and taxonomy to create a slider, with almost unlimited options and support for multiple sliders on any page.
You can also display image slider on your website header.

We have added 10 designs for slider and 6 design for carousel. You can find all designs under Slick Slider -> Pro Slider Designs. Just copy the shortcode of design that you like and use.

= You can use 2 shortcodes =

<code>[slick-slider] and [slick-carousel-slider]</code>


= Complete shortcode  is =

<code>[slick-slider  design="prodesign-1" category="8" show_content="true" limit="5"
 dots="true" arrows="true" autoplay="true" sliderheight="400"
 autoplay_interval="5000" speed="1000" effect="false" loop="true"]</code>
 
<code>[slick-carousel-slider  design="prodesign-11" category="8" limit="5"
 slidestoshow="4" slidestoscroll="1" dots="true" image_size="large" show_content="true"
 arrows="true" autoplay="true"  autoplay_interval="5000"
 speed="1000" centermode="true" variablewidth="true" loop="true"]</code> 


= Here is Template code =

<code><?php echo do_shortcode('[slick-slider]'); ?>  and
 <?php echo do_shortcode('[slick-carousel-slider]'); ?> </code>


= Use Following parameters with shortcode =

<code>[slick-slider]</code>

* **limit** : [slick-slider limit="8"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **design** : [slick-slider design="prodesign-1"] (You can select 10 design( prodesign-1, prodesign-2, prodesign-3, prodesign-4, prodesign-5 to prodesign-10 ) for your  slider. Slick Slider -> Pro Slider Designs ).
* **category**: [slick-slider category="category_ID"] ( ie Display slider by their category ID ).
* **show_content** : [slick-slider show_content="true" ] (Display content OR not. By default value is "true". Options are "ture OR false").
* **loop** : [slick-slider loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Pagination and arrows** : [slick-slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval**: [slick-slider autoplay="true" autoplay_interval="100"]
* **Slide Speed**: [slick-slider speed="3000"]
* **fade** : [slick-slider fade="true" ] (Slider Fade effect. By default effect is slide. If you set fade="true" then effect change from slide to fade ).
* **sliderheight** : [slick-slider sliderheight="400" ] (Slider height. By default given 500px height.)

= Use Following parameters with shortcode =

<code>[slick-carousel-slider]</code>

* **limit** : [slick-carousel-slider limit="8"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **design** : [slick-carousel-slider design="prodesign-11"] (You can select 6 design( prodesign-11 to prodesign-16 ) for your carousel  slider. Slick Slider -> Pro Slider Designs ).
* **category**: [slick-carousel-slider category="category_ID"] ( ie Display slider by their category ID ).
* **image_size** : [slick-carousel-slider image_size="large"] (Default is "large", values are thumbnail, medium, large, original)
* **slidestoshow** : [slick-carousel-slider slidestoshow="3" ] (Display number of images at a time. By default value is "3").
* **slidestoscroll** : [slick-carousel-slider slidestoscroll="1" ] (Scroll number of images at a time. By default value is "1").
* **show_content** : [slick-slider show_content="true" ] (Display content OR not. By default value is "true". Options are "ture OR false").
* **loop** : [slick-slider loop="true" ] (Create a Infinite loop sliding. By default value is "True". Options are "ture OR false").
* **Pagination and arrows** : [slick-carousel-slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval**: [slick-carousel-slider autoplay="true" autoplay_interval="100"]
* **Slide Speed**: [slick-carousel-slider speed="3000"]
* **centermode** : [slick-carousel-slider centermode="true" ] ( Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts. By default value is "false" ).
* **variablewidth** : [slick-carousel-slider variablewidth="true" ] (Variable width of images in slider. By default value us "false")

= Features include =

* Display unlimited number of slider and carousel with the help of category.
* Touch-enabled Navigation.
* Fully responsive. Scales with its container.
* Fully accessible with arrow key navigation.
* Responsive
* Given shortcode and template code.
* Use for header image slider.


== Installation ==

1. Upload the 'wp-slick-slider-and-carousel-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "wp-slick-slider-and-carousel-pro" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display slider

<code>[slick-slider] and [slick-carousel-slider]</code>



== Changelog ==

v2021.01 - Blocks CPT from WP search results

v2020.02 - Added missing carousel templates and disable swipebox support.

v2020.01 - Initial Release

= 1.2.1 =
* Fixed some css issues.
* Fixed responsive issue.

= 1.2 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1 =
* Fixed some bugs.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.2.1 =
* Fixed some css issues.
* Fixed responsive issue.

= 1.2 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1 =
* Fixed some bugs.

= 1.0 =
* Initial release
