<?php
    use \WRDSB\WCSSAA\Model\Meet as Meet;
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <?php
            $post        = get_post();
            $meet        = new Meet($post);
            $league      = $meet->getLeague();
            $league_link = "/leagues/{$league->slug}";
            $venue       = $meet->getVenue();
            $venue_link  = "/venues/{$venue->slug}"
            ?>

            <h1><?php echo $league->title; ?></h1>
            <p><a href="<?php echo $league_link; ?>">Back to <?php echo $league->title; ?></a></p>

            <div id="meet-info" class="sub-menu-heading">
                <span><?php echo $meet->title; ?></span>
            </div>
            <div style="text-align:right">
                <?php echo $meet->meet_date; ?>
                <?php echo $meet->meet_time; ?>
                @
                <?php echo $venue->title; ?>
            </div>

            <?php setup_postdata($post); ?>
            <?php the_content(); ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php	get_footer(); ?>
