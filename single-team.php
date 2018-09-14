<?php
    use \WRDSB\WCSSAA\CustomPostTypes\LeagueCPT as LeagueCPT;
    use \WRDSB\WCSSAA\CustomPostTypes\Club as Club;
    use \WRDSB\WCSSAA\CustomPostTypes\GameCPT as GameCPT;
    use \WRDSB\WCSSAA\Model\League as League;
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
        $league_id                = get_the_ID();
        $league_post              = get_post($league_id);
        $league                   = new League($post);
        $league_name              = $league->title;
        $league_slug              = $league->slug;
        $league_scheduling_system = $league->getSchedulingSystem();
        ?>

        <h1><?php echo $league_name ?></h1>

        <?php
        if ('meet' === $league_scheduling_system) {
            $meets = $league->getMeets();
            echo '<div id="meets-schedule" class="sub-menu-heading">';
            echo "<span>{$league_name} Schedule</span>";
            echo '</div>';

            if (count($meets) > 0) {
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($meets as $meet) {
                    echo $meet->getHTMLTableRow(array(
                        'show_title' => true,
                        'show_sport' => false,
                        'show_date'  => true,
                        'show_time'  => true,
                        'show_edit'  => true,
                    ));
                }

                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="textwidget">';
                echo '<p>No upcoming meets found.';
                echo '</div>';
            }
        } else {
            ?>
            <p>
            <a href="/leagues/<?php echo $league_slug ?>">Home</a>
            | 
            <a href="/leagues/<?php echo $league_id ?>/standings">Standings</a>
            | 
            <a href="/leagues/<?php echo $league_id ?>/results">Results</a>
            |
            <a href="/leagues/<?php echo $league_id ?>/schedule">Schedule</a>
            |
            <a href="/leagues/<?php echo $league_id ?>/playoffs">Playoffs</a>
            </p>

            <?php
            $games = Game::findByDate($today, $league_id);
            if (count($games) > 0) {
                echo '<div id="todays-games" class="sub-menu-heading">';
                echo "<span>Today's Games ( {$today} )</span>";
                echo '</div>';
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($games as $game) {
                    echo $game->getHTMLTableRow(array(
                        'show_sport' => false,
                        'show_date'  => false,
                        'show_time'  => true,
                        'show_edit'  => true,
                    ));
                }

                echo '</table>';
            } else {
                $games = Game::findUpcoming($league_id);
                if (count($games) > 0) {
                    echo '<div id="upcoming-games" class="sub-menu-heading">';
                    echo "<span>Upcoming Games</span>";
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($games as $game) {
                        echo $game->getHTMLTableRow(array(
                            'show_sport' => false,
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
            echo '<div style="text-align:right">';
            echo "<a href=\"/leagues/{$league_id}/schedule\">View complete schedule for {$league_name}</a>";
            echo '</div>';
            echo '</div>';

            $games = Game::findByDate($yesterday, $league_id);
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
                $games = Game::findRecent($league_id);
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
            echo '<div style="text-align:right">';
            echo "<a href=\"/leagues/{$league_id}/results\">View complete results for {$league_name}</a>";
            echo '</div>';
            echo '</div>';
        }
        ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php
    get_footer();
