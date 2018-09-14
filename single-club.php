<?php
    use \WRDSB\WCSSAA\CustomPostTypes\LeagueCPT as LeagueCPT;
    use \WRDSB\WCSSAA\Model\Club as Club;
?>

<?php get_header(); ?>

<?php $today = date('Y-m-d'); ?>
<?php $yesterday = date('Y-m-d', strtotime("last weekday {$today}")); ?>

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
                        $leagues = League::findBySeason('fall');
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
                        $clubs = Club::findAll();
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
            $club_id   = get_the_ID();
            $club_post = get_post($club_id);
            $club      = new Club($post);
            $club_name = $club->title;
            $club_slug = $club->slug;
            ?>

            <h1><?php echo $club_name ?></h1>

            <p>
            <a href="/clubs/<?php echo $club_slug ?>">Home</a>
            | 
            <a href="/clubs/<?php echo $club_id ?>/teams">Sports</a>
            | 
            <a href="/clubs/<?php echo $club_id ?>/standings">Standings</a>
            | 
            <a href="/clubs/<?php echo $club_id ?>/results">Results</a>
            |
            <a href="/clubs/<?php echo $club_id ?>/schedule">Schedule</a>
            </p>

            <?php
            $games = $club->getGamesByDate($today);
            if (count($games) > 0) {
                echo '<div id="todays-games" class="sub-menu-heading">';
                echo "<span>Today's Games ( {$today} )</span>";
                echo '</div>';
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($games as $game) {
                    echo $game->getHTMLTableRow(array(
                        'show_sport' => true,
                        'show_date'  => false,
                        'show_time'  => true,
                        'show_edit'  => true,
                    ));
                }

                echo '</table>';
            } else {
                $games = $club->getGameSchedule();
                if (count($games) > 0) {
                    echo '<div id="upcoming-games" class="sub-menu-heading">';
                    echo "<span>Upcoming Games</span>";
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($games as $game) {
                        echo $game->getHTMLTableRow(array(
                            'show_sport' => true,
                            'show_date'  => true,
                            'show_time'  => true,
                            'show_edit'  => false,
                        ));
                    }

                    echo '</table>';
                } else {
                    echo '<div id="upcoming-games" class="sub-menu-heading">';
                    echo "<span>Upcoming Games</span>";
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<p>No upcoming games found.';
                }
            }
            //echo '<div style="text-align:right">';
            //echo "<a href=\"/leagues/{$league_id}/schedule\">View complete schedule for {$league_name}</a>";
            //echo '</div>';
            echo '</div>';

            $games = $club->getGamesByDate($yesterday);
            if (count($games) > 0) {
                echo '<div id="yesterdays-games" class="sub-menu-heading">';
                echo "<span>Yesterday's Games ( {$yesterday} )</span>";
                echo '</div>';
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($games as $game) {
                    echo $game->getHTMLTableRow(array(
                        'show_sport'   => false,
                        'show_date'    => false,
                        'show_time'    => true,
                        'show_scoring' => true,
                        'show_edit'    => true,
                    ));
                }

                echo '</table>';
            } else {
                $games = $club->getGamesRecent();
                if (count($games) > 0) {
                    echo '<div id="recent-games" class="sub-menu-heading">';
                    echo '<span>Recent Games</span>';
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($games as $game) {
                        echo $game->getHTMLTableRow(array(
                            'show_sport'   => false,
                            'show_date'    => true,
                            'show_time'    => false,
                            'show_scoring' => true,
                            'show_edit'    => false,
                        ));
                    }

                    echo '</table>';
                } else {
                    echo '<div id="recent-games" class="sub-menu-heading">';
                    echo '<span>Recent Games</span>';
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<p>No recent games found.';
                }
            }
            //echo '<div style="text-align:right">';
            //echo "<a href=\"/leagues/{$league_id}/results\">View complete results for {$league_name}</a>";
            //echo '</div>';
            echo '</div>';
            ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php
    get_footer();
