<?php
    use \WRDSB\WCSSAA\Model\Club as Club;
?>

<?php get_header(); ?>

<?php $today = current_time('Y-m-d'); ?>
<?php $yesterday = date('Y-m-d', strtotime("last weekday {$today}")); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">

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
