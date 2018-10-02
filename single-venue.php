<?php
    use \WRDSB\WCSSAA\Model\Venue as Venue;
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <?php
            $post        = get_post();
            $venue       = new Venue($post);
            $venue_link  = "/venues/{$venue->slug}"
            ?>

            <h1><?php echo $venue->title; ?></h1>

            <?php setup_postdata($post); ?>
            <?php the_content(); ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php	get_footer(); ?>
