<?php 
function pro_get_wpsisac_slider( $atts, $content = null ){          

  $params = shortcode_atts(array(
	  "limit"    => '',
		"category" => '',
		"design" => '',
		"show_content" => '',  
		"loop"   => '',	
		"dots"     			=> '',
		"arrows"     		=> '',
		"autoplay"     		=> '',	
		"autoplay_interval"  => '',
		"speed"             => '',
		"fade"		        => '',
		"hover_pause"		        => '',
		"sliderheight"     => '500',
		"orderby"     => '',
		"as_nav_for"     => ''
	), $atts);

  if( $params['limit'] ) { 
		$posts_per_page = $params['limit']; 
	} else {
		$posts_per_page = '-1';
	}
	
	if( $params['category'] ) { 
		$cat = $params['category']; 
	} else {
		$cat = '';
	}	

	if( $params['loop'] ) { 
		$loopslider = $params['loop']; 
	} else {
		$loopslider = 'true';
	}	

	if ( $params['design'] ) { 
		$slidercdesign = $params['design']; 
	} else {
		$slidercdesign = 'prodesign-1';
	}	

    if( $params['show_content'] ) { 
        $showContent = $params['show_content']; 
    } else {
        $showContent = 'true';
    }


	if( $params['dots'] ) { 
		$dotsv = $params['dots']; 
	} else {
		$dotsv = 'true';
	}

	if( $params['arrows'] ) {
		$arrowsv = $params['arrows']; 
	} else {
		$arrowsv = 'true';
	}	

	if( $params['autoplay'] ) { 
		$autoplayv = $params['autoplay'];
	} else {
		$autoplayv = 'true';
	}	

	if( $params['autoplay_interval'] ) { 
		$autoplayIntervalv = $params['autoplay_interval']; 
	} else {
		$autoplayIntervalv = '3000';
	}	

	if( $params['speed'] ) { 
		$speedv = $params['speed'];
	} else {
		$speedv = '300';
	}
	if( $params['fade'] ) { 
		$fadev = $params['fade'];
	} else {
		$fadev = 'false';
	}
	if( $params['hoverPause'] ) { 
		$hoverPausev = $params['hoverPause'];
	} else {
		$hoverPausev = 'false';
	}
if( $params['sliderheight'] ) { 
		$sliderheightv = $params['sliderheight'];
	} else {
		$sliderheightv = '400px';
	}
	
	if( $params['orderby'] ) { 
			$orderbyv = $params['orderby'];
		} else {
			$orderbyv = 'post_date';
		}
	ob_start();	

	$unique			= wpsisac_pro_get_unique();
	$post_type 		= 'slick_slider';
	//$orderbyv 		= 'post_date';
	$order 			= 'DESC';		

	$args = array ( 
		'post_type'      => $post_type, 
		'orderby'        => $orderbyv, 
		'order'          => $order,
		'posts_per_page' => $posts_per_page,  
	);

	if ($cat != ""){
		$args['tax_query'] = array( array( 'taxonomy' => 'wpsisac_slider-category', 'field' => 'id', 'terms' => $cat) );
	} 
						
//fb_log(print_r($args,true));      
      $query = new WP_Query($args);
      $post_count = $query->post_count;         

             if ( $query->have_posts() ) :
			 ?>
		<div class="wpsisac-pro-slick-slider-<?php echo $unique; ?> wpsisac-slick-slider <?php echo $slidercdesign; ?>">
				<?php while ( $query->have_posts() ) : $query->the_post();
        // BMcK - Include themeable templates
        $themed_design = get_template_directory() . '/bl-slick-slider-templates/'.$slidercdesign.'.php';
//fb_log($themed_design);
        if ( file_exists($themed_design) ) {
//fb_log('using '.$themed_design);
            include($themed_design);
        } else {
  				switch ($slidercdesign) {
  				case "prodesign-1":
  					include('pro/designs/prodesign-1.php');
  					break;	
  				case "prodesign-2":
  					include('pro/designs/prodesign-2.php');
  					break;
                  case "prodesign-3":
  					include('pro/designs/prodesign-3.php');
  					break;
  				case "prodesign-4":
  					include('pro/designs/prodesign-4.php');
  					break;
  				case "prodesign-5":
  					include('pro/designs/prodesign-5.php');
  					break;	
                  case "prodesign-6":
  					include('pro/designs/prodesign-6.php');
  					break;
  				 case "prodesign-7":
  					include('pro/designs/prodesign-7.php');
  					break;
  				 case "prodesign-8":
  					include('pro/designs/prodesign-8.php');
  					break;
  				 case "prodesign-9":
  					include('pro/designs/prodesign-9.php');
  					break;			
  				 default:		 

  						include('pro/designs/prodesign-1.php');

  					}
          }

					endwhile; ?>

		  </div>
<?php if($slidercdesign == 'prodesign-4' || $slidercdesign == 'prodesign-5' || $slidercdesign == 'prodesign-6') { ?>
			<div class="wpsisac-pro-slider-nav-<?php echo $unique; ?> wpsisac-slider-nav <?php echo $slidercdesign; ?>">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="slick-image-nav">
						<?php the_post_thumbnail('large'); ?>
						</div>
						<?php endwhile; ?>
			</div>
		  

		  <?php
}
            endif; 
             wp_reset_query(); 
?>
<script type="text/javascript">

		jQuery(document).ready(function(){
		jQuery('.wpsisac-pro-slick-slider-<?php echo $unique; ?>').slick({

			dots: <?php echo $dotsv; ?>,
			 infinite: <?php echo $loopslider; ?>,
			arrows: <?php echo $arrowsv; ?>,
			speed: <?php echo $speedv; ?>,
			autoplay: <?php echo $autoplayv; ?>,				
			fade: <?php echo $fadev; ?>,
			autoplaySpeed: <?php echo $autoplayIntervalv; ?>,	
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: false,
			prevArrow: '<button type="button" class="slick-prev"></button>',
			nextArrow: '<button type="button" class="slick-next"></button>',
			asNavFor: '<?php echo $params['as_for_nav'] ?>',
			pauseOnHover: <?php echo $hoverPausev; ?>
	});
	<?php if($slidercdesign == 'prodesign-4' || $slidercdesign == 'prodesign-5' || $slidercdesign == 'prodesign-6') { ?>
		jQuery('.wpsisac-pro-slider-nav-<?php echo $unique; ?>').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  asNavFor: '<?php echo $params['as_for_nav'] ?>',
		  dots: false,
		  centerMode: true,	
		 infinite: <?php echo $loopslider; ?>,	
		  focusOnSelect: true,		
		  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
		 infinite: <?php echo $loopslider; ?>,
        dots: false
      }
    },
    {
      breakpoint: 640,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
		 infinite: <?php echo $loopslider; ?>,
		 dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
		 infinite: <?php echo $loopslider; ?>,
        slidesToScroll: 1,
		 dots: false
      }
    }
  ]
	});
	<?php } ?>
	});

	</script>	
<?php			 

		return ob_get_clean();			             

	}

add_shortcode('slick-slider','pro_get_wpsisac_slider');