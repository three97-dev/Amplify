<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">
							<?php bloginfo( 'name' ); ?>
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://www.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							All Rights Reserved
							&copy;
							<img src="https://amplify-solutions.ca/wp-content/uploads/2021/02/Silver-Partner-White@2x.png" class="microsoft-logo" />
							<br/>
							<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>


					</div><!-- .footer-credits -->

				<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>
	<script>
        var slideIndex = 1;
        showSlides(1, 1);
        function plusSlides(n, no) {
          showSlides(slideIndex += n, no);
        }

        function showSlides(n, no) {
          var i;
          var x = document.getElementsByClassName("image-sliderfade");
          var dots = document.getElementsByClassName("dot"); 
          if (n > x.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = x.length}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }
          x[slideIndex-1].style.display = "block";
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.
                                    replace(" active", "");
          }  
          dots[slideIndex - 1].className += " active";
        }
    </script>
	</body>
</html>
