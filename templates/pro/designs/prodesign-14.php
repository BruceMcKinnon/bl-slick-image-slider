<div class="slick-image-slide">	<div class="slide-wrap">		<?php$sliderurl = get_post_meta( get_the_ID(),'wpsisac_slide_link', true );		echo ($sliderurl !='' ? '<a href="'.$sliderurl.'">' : '');		if($sliderimage_size == '' || $sliderimage_size == 'medium')  { 				 the_post_thumbnail('medium'); 			 			} elseif ($sliderimage_size == 'large') {							the_post_thumbnail('large'); 			} elseif ( $sliderimage_size == 'original') {				the_post_thumbnail('full'); 			} elseif ( $sliderimage_size == 'thumbnail') {				the_post_thumbnail('thumbnail'); 			}  else {				 the_post_thumbnail('medium'); 						}		echo ($sliderurl !='' ? '</a>' : '');	 ?>		<div class="slider-content">			<div class="slider-content-inner">			<h4 class="slide-title">			<?php $sliderurl = get_post_meta( get_the_ID(),'wpsisac_slide_link', true );				if($sliderurl != '') { ?>			<a href="<?php echo $sliderurl; ?>" ><?php the_title(); ?></a>				<?php } else { the_title();} ?>			</h4>					</div>			</div>			</div>	</div>