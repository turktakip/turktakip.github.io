<?php
/**
 * The template for displaying all pages.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>
	
<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		
			<div class="entry-content" itemprop="mainContentOfPage">
				<?php 
					while ( have_posts() ){
						the_post();							// Post Loop
						mfn_builder_print( get_the_ID() );	// Content Builder & WordPress Editor Content
					}
				?>
			</div>
			
			<?php if( mfn_opts_get('page-comments') ): ?>
				<div class="section section-page-comments">
					<div class="section_wrapper clearfix">
					
						<div class="column one comments">
							<?php comments_template( '', true ); ?>
						</div>
						
					</div>
				</div>
			<?php endif; ?>
	
		</div>
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar(); ?>

	</div>
</div>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3jlW9rwe1wnOPgZwo7wUgDRdb2On7yQX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
<?php get_footer(); ?>