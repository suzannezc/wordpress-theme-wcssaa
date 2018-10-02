<?php
use \WRDSB\WCSSAA\Model\League as League;
use \WRDSB\WCSSAA\Model\Team as Team;
?>

<?php get_header(); ?>

<?php $today = current_time('Y-m-d'); ?>
<?php $yesterday = date('Y-m-d', strtotime("last weekday {$today}")); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

        <?php
        $team_id                = get_the_ID();
        $team_post              = get_post($team_id);
        $team                   = new Team($team_post);
        $team_name              = $team->title;
        $team_slug              = $team->slug;
        $league                 = $team->getLeague();
        $league_scheduling_system = $league->getSchedulingSystem();
        ?>

        <h1><?php echo $team_name ?> (<?php echo $league->title?>)</h1>

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
            <a href="/teams/<?php echo $team_slug ?>">Home</a>
            | 
            <a href="/teams/<?php echo $team_id ?>/standings">Standings</a>
            | 
            <a href="/teams/<?php echo $team_id ?>/results">Results</a>
            |
            <a href="/teams/<?php echo $team_id ?>/schedule">Schedule</a>
            |
            <a href="/teams/<?php echo $team_id ?>/playoffs">Playoffs</a>
            </p>

            <?php
            $games = $team->getGamesByDate($today);
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
                $games = $team->getUpcomingGames();
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
            echo "<a href=\"/leagues/{$league->ID}/schedule\">View complete schedule for {$league->title}</a>";
            echo '</div>';
            echo '</div>';

            $games = $team->getGamesByDate($yesterday);
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
                $games = $team->getRecentGames();
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
            echo "<a href=\"/leagues/{$league->ID}/results\">View complete results for {$league->title}</a>";
            echo '</div>';
            echo '</div>';
        }
        ?>

        </div> <!-- end content area -->
    </div> <!-- end row -->
</div> <!-- end container -->

<?php
    get_footer();