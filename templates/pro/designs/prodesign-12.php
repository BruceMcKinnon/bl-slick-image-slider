<div class="slick-image-slide">  		<?php$sliderurl = get_post_meta( get_the_ID(),'wpsisac_slide_link', true );		echo ($sliderurl !='' ? '<a href="'.$sliderurl.'">' : '');		if($sliderimage_size == '' || $sliderimage_size == 'medium')  { 				 the_post_thumbnail('medium'); 			 			} elseif ($sliderimage_size == 'large') {							the_post_thumbnail('large'); 			} elseif ( $sliderimage_size == 'original') {				the_post_thumbnail('full'); 			} elseif ( $sliderimage_size == 'thumbnail') {				the_post_thumbnail('thumbnail'); 			}  else {				 the_post_thumbnail('medium'); 						}		echo ($sliderurl !='' ? '</a>' : '');	 ?>		<div class="slider-content">			<h4 class="slide-title"><?php the_title(); ?></h4>			<?php if($showContent == "true" ) { ?>				<div class="slider-short-content">					<?php the_content(); ?>							</div>			<?php } 						$sliderurl = get_post_meta( get_the_ID(),'wpsisac_slide_link', true );				if($sliderurl != '') { ?>			<div class="readmore"><a href="<?php echo $sliderurl; ?>" class="slider-readmore"><?php esc_html_e( 'Read More', 'wp-slick-slider-and-image-carousel' ); ?></a></div>				<?php } ?>			</div>	</div>