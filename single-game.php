<?php
    use \WRDSB\WCSSAA\Modules\WCSSAA\CustomPostTypes\LeagueCPT as LeagueCPT;
    use \WRDSB\WCSSAA\Modules\WCSSAA\CustomPostTypes\ClubCPT as ClubCPT;
    use \WRDSB\WCSSAA\Modules\WCSSAA\Model\Game as Game;
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-2 col-lg-2" role="complementary">
            <div class="sidebar-left widget-area" role="complementary">
                <div id="sports-list" class="sub-menu-heading">
                    <span>Sports</span>
                </div>
                <div class="textwidget">
                    <ul>
                        <?php
                        $leagues = LeagueCPT::get_leagues_by_season('fall');
                        foreach ($leagues as $league) {
                            echo '<li><a href="/leagues/' . $league->slug . '">' . $league->title . '</a></li>';
                        }
                        ?>
                    </ul>
                    <div style="text-align:right">
                        <a href="/leagues/all">View all Sports</a>
                    </div>
                </div>

                <div id="teams-list" class="sub-menu-heading">
                    <span>Teams</span>
                </div>
                <div class="textwidget">
                    <ul>
                        <?php
                        $clubs = ClubCPT::get_all_clubs();
                        foreach ($clubs as $club) {
                            if ('Bye' !== $club->title) {
                                echo '<li><a href="/clubs/' . $club->slug . '">' . $club->title . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-10 col-lg-10">

            <?php
            $post        = get_post();
            $game        = new Game($post);
            $league      = $game->get_league();
            $league_link = "/leagues/{$league->slug}";
            $venue       = $game->get_venue();
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
