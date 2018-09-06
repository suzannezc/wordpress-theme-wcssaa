<?php get_header(); ?>

<div class="container">
<div class="row">
<div class="col-sm-12 col-lg-12">

<?php // check if the post has a Post Thumbnail assigned to it.
if ( has_post_thumbnail() ) {
echo '<div class="featuredimage">';
the_post_thumbnail('wrdsb-full-width');
echo '</div>';
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1><?php the_title(); ?></h1>
<p><?php the_content(__('Read more'));?></p>

<?php endwhile; else: ?>
<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
<?php endif; ?>

</div> <!-- end content area -->
</div>
</div>

<?php get_footer();
