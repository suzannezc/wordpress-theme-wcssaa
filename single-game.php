<?php
    use \WRDSB\WCSSAA\Model\Game as Game;
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <?php
            $post        = get_post();
            $game        = new Game($post);
            $league      = $game->getLeague();
            $league_link = "/leagues/{$league->slug}";
            $venue       = $game->getVenue();
            $venue_link  = "/venues/{$venue->slug}"
            ?>

            <h1><?php echo $league->title; ?></h1>
            <p><a href="<?php echo $league_link; ?>">Back to <?php echo $league->title; ?></a></p>

            <div id="game-info" class="sub-menu-heading">
                <span><?php echo $game->title; ?></span>
            </div>
            <div style="text-align:right">
                <?php echo $game->game_date; ?>
                <?php echo $game->game_time; ?>
                @
                <?php echo $venue->title; ?>
            </div>

            <?php setup_postdata($post); ?>
            <?php the_content(); ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php	get_footer(); ?>
