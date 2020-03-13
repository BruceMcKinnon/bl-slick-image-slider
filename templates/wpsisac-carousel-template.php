<?php

function pro_get_wpsisac_carousel_slider( $atts, $content = null ) {

  extract( shortcode_atts ( array (
    "limit"     => '',
    "category" => '',
    "design" => '',
    "image_size" => '', 
    "show_content" => '',   
    "slidestoshow" => '',
    "loop" =>  '',
    "slidestoscroll" => '',   
    "dots"          => '',
    "arrows"        => '',
    "autoplay"        => '',  
    "autoplay_interval"  => '',
    "speed"             => '',
    "centermode"        => '',  
    "variablewidth"    => '',
  ), $atts ) );

  //fb_log(print_r($atts,true));

  if ( $limit ) { 
    $posts_per_page = $limit; 
  } else {
    $posts_per_page = '-1';
  }
  if( $category ) { 
    $cat = $category; 
  } else {
    $cat = '';
  } 

  if( $design ) { 
    $sliderdesign = $design; 
  } else {
    $sliderdesign = 'prodesign-11';
  } 
  
  if( $image_size ) { 
    $sliderimage_size = $image_size; 
  } else {
    $sliderimage_size = 'large';
  } 
    
  if( $loop ) { 
    $loopslider = $loop; 
  } else {
    $loopslider = 'true';
  } 


  if( $dots ) { 
    $dotsv = $dots; 
  } else {
    $dotsv = 'true';
  }

  if( $arrows ) {
    $arrowsv = $arrows; 
  } else {
    $arrowsv = 'true';
  } 

  if( $autoplay ) { 
    $autoplayv = $autoplay;
  } else {
    $autoplayv = 'true';
  } 

  if( $autoplay_interval ) { 
    $autoplayIntervalv = $autoplay_interval; 
  } else {
    $autoplayIntervalv = '3000';
  } 

  if( $speed ) { 
    $speedv = $speed;
  } else {
    $speedv = '300';
  }

  if( $show_content ) { 
    $showContent = $show_content; 
  } else {
    $showContent = 'true';
  }
  
  if( $slidestoshow ) { 
    $slidestoshowv = $slidestoshow;
  } else {
    $slidestoshowv = '3';
  }
  
  if( $slidestoscroll ) { 
    $slidestoscrollv = $slidestoscroll;
  } else {
    $slidestoscrollv = '1';
  }
  
  if( $centermode ) { 
    $centermodev = $centermode;
  } else {
    $centermodev = 'false';
  }

  if( $variablewidth ) { 
    $variablewidthv = $variablewidth;
  } else {
    $variablewidthv = 'false';
  }
  
   if( $css_ease ) { 
    $css_easev = $css_ease;
  } else {
    $css_easev = 'ease';
  } 

  ob_start();

  $unique     = wpsisac_pro_get_unique();
  $post_type    = 'slick_slider';
  $orderby    = 'post_date';
  $order      = 'DESC';   

  $args = array ( 
    'post_type'      => $post_type, 
    'orderby'        => $orderby, 
    'order'          => $order,
    'posts_per_page' => $posts_per_page,  
  );

  if ( $cat != "" ) {
    $args['tax_query'] = array( array( 'taxonomy' => 'wpsisac_slider-category', 'field' => 'id', 'terms' => $cat) );
  }  

  $query = new WP_Query($args);
  $post_count = $query->post_count;         

  if ( $query->have_posts() ) {
    $carousel_class = "wpsisac-pro-slick-carousal-".$unique." wpsisac-slick-carousal ".$sliderdesign;

    if( $centermodev == 'true' ) { 
      $carousel_class .= ' center';
    } elseif ( $variablewidthv == 'true' ) { 
      $carousel_class .= ' variablewidthv'; 
    } else { 
      $carousel_class .= ' simplecarousal';
    }
    $carousel_class .= '"'; ?>
    <div class="<?php echo($carousel_class); ?> ">

      <?php while ( $query->have_posts() ) {
        $query->the_post();
        // BMcK - Include themeable templates
        $themed_design = get_template_directory() . '/bl-slick-slider-templates/' . $sliderdesign . '.php';
        fb_log($themed_design);
        if ( file_exists($themed_design) ) {
          fb_log('using '.$themed_design);
          include($themed_design);

        } else {
          switch ($sliderdesign) {
           case "prodesign-11":
            include('pro/designs/prodesign-11.php');
            break;
          case "prodesign-12":
            include('pro/designs/prodesign-12.php');
            break;
          case "prodesign-13":
            include('pro/designs/prodesign-13.php');
            break;
          case "prodesign-14":
            include('pro/designs/prodesign-14.php');
            break;
          case "prodesign-15":
            include('pro/designs/prodesign-15.php');
            break;
          case "prodesign-16":
            include('pro/designs/prodesign-16.php');
            break;      
           default:    
            include('pro/designs/prodesign-11.php');
          }
        }
      } ?>

    </div><!-- #post-## -->   

  <?php
  }
  wp_reset_query();
  ?>

  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.wpsisac-pro-slick-carousal-<?php echo $unique; ?>').slick({
        dots: <?php echo $dotsv; ?>,
        infinite: <?php echo $loopslider; ?>,
        arrows: <?php echo $arrowsv; ?>,
        speed: <?php echo $speedv; ?>,
        autoplay: <?php echo $autoplayv; ?>,    

        autoplaySpeed: <?php echo $autoplayIntervalv; ?>,
        slidesToShow: <?php echo $slidestoshowv; ?>,
        slidesToScroll: <?php echo $slidestoscrollv; ?>,
        centerMode: <?php echo $centermodev; ?>,
        variableWidth :<?php echo $variablewidthv; ?>,
        /*ease :<?php echo $css_easev; ?>,*/
        responsive: [
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: <?php echo $loopslider; ?>,
            dots: false
          }
        },
        {
          breakpoint: 641,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: <?php echo $loopslider; ?>,
            dots: false
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: <?php echo $loopslider; ?>,
            dots: false
          }
        }
      ]
      });
    });
  </script> 
  <?php 
  return ob_get_clean();
}

add_shortcode('slick-carousel-slider','pro_get_wpsisac_carousel_slider');
