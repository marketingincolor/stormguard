<?php
/**
 * The CUSTOM Template for displaying all single-location posts as per the Franchise Manager Plugin
 *
 * @package WordPress
 * @subpackage Dev Blank
 * @since Dev Blank 0.0
 */

get_header(); ?>
    <div class="small-12 large-8 columns">
        <div id="primary" class="site-content">
            <div id="content" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="entry-header">
                            <?php if ( ! post_password_required() && ! is_attachment() ) :
                                the_post_thumbnail( 'full' );
                            endif; ?>

                            <?php if ( is_single() ) : ?>
                                <br clear="all" /><br />
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            <?php else : ?>
                                <div class="meta"> </div>
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            <?php endif; // is_single() ?>

                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-meta">

                        </footer><!-- .entry-meta -->
                    </article><!-- #post -->

                    <div id="location-form" class="clearfix">
                        <h3 class="widget-title">Request a FREE Property Damage Inspection</h3>
                        <?php echo do_shortcode('[contact-form-7 title="Inspection Request SHORT '.$post->post_name.'"]');?>
                    </div>

                    <?php //comments_template( '', true ); ?>
                    <div id="location-gallery" class="clearfix hide-for-small-down">
                        <h3 class="widget-title">Gallery</h3>

                        <?php if ( is_single()  ) : ?>

                            <?php echo do_shortcode('[gallery size="news-thumb" link="file" ids="168,167,166,165,164" type="custom"]'); ?>
                        <?php else : ?>
                            <?php echo do_shortcode('[gallery for location]');?>
                        <?php endif; ?>
                    </div>

                <?php endwhile; // end of the loop. ?>

            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
    <div id="mobile-single" class="small-12 show-for-small-only columns">
        <!--Mobile Singlepage Content-->

    </div>
<?php get_sidebar('location'); ?>

<script>
( function( $ ) {
    $(function() {
        var current = window.location.href.split('/');
        var page_url = current.pop() == '' ? current[current.length - 1] : current.pop();
        var place = '<?php echo get_user_meta( $post->post_author, 'location', true ); ?>';
        //createCookie('fm-location',page_url,30);
        //createCookie('fm-name',place,30);
        eraseCookie('fm-location');
        eraseCookie('fm-name');
    });
    $("#clear-locator").click(function() {
        //event.preventDefault();
        eraseCookie('fm-location');
        eraseCookie('fm-name');
        //return false;
    });
    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = '; expires='+date.toGMTString();
        }
        else var expires = '';
        document.cookie = name+'='+value+expires+'; path=/';
    }
    function eraseCookie(name) {
        createCookie(name,'',-1);
    }
} )( jQuery );
</script>

<?php echo ( get_user_meta( $post->post_author, 'st_an', true ) ? get_user_meta( $post->post_author, 'st_an', true ) : ''); ?>
<?php echo ( get_user_meta( $post->post_author, 'sp_an', true ) ? get_user_meta( $post->post_author, 'sp_an', true ) : ''); ?>

<?php get_footer(); ?>