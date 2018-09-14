<?php
    use \WRDSB\WCSSAA\Model\Club as Club;
    use \WRDSB\WCSSAA\CustomPostTypes\GameCPT as GameCPT;
    use \WRDSB\WCSSAA\CustomPostTypes\LeagueCPT as LeagueCPT;
    use \WRDSB\WCSSAA\CustomPostTypes\MeetCPT as MeetCPT;
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

        <div class="col-sm-7 col-lg-7">

            <!--
            <div id="featured-game" class="sub-menu-heading">
                <span>Featured Game</span>
            </div>
            <?php // check if the post has a Post Thumbnail assigned to it.
            //if ( has_post_thumbnail() ) {
                //echo '<div class="featuredimage">';
                //the_post_thumbnail('wrdsb-full-width');
                //echo '</div>';
            //}
            ?>
            -->

            <?php
            $meets = Meet::findByDate($today);
            if (count($meets) > 0) {
                echo '<div id="todays-meets" class="sub-menu-heading">';
                echo "<span>Today's Meets ( {$today} )</span>";
                echo '</div>';
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($meets as $meet) {
                    echo $meet->getHTMLTableRow(array(
                        'show_title' => false,
                        'show_sport' => true,
                        'show_date'  => false,
                        'show_time'  => true,
                        'show_edit'  => true,
                    ));
                }

                echo '</table>';
            }

            if (count($meets) < 10) {
                $meets = Meet::findByDate();
                if (count($meets) > 0) {
                    echo '<div id="upcoming-meets" class="sub-menu-heading">';
                    echo "<span>Upcoming Meets</span>";
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($meets as $meet) {
                        echo $meet->getHTMLTableRow(array(
                            'show_title' => false,
                            'show_sport' => true,
                            'show_date'  => true,
                            'show_time'  => true,
                            'show_edit'  => false,
                        ));
                    }
                    echo '</table>';
                } else {
                    echo '<div id="upcoming-meets" class="sub-menu-heading">';
                    echo "<span>Upcoming Meets</span>";
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<p>No upcoming meets found.';
                }
            }
            //echo '<div style="text-align:right">';
            //echo '<a href="/meets/all">View complete schedule of meets</a>';
            //echo '</div>';
            echo '</div>';
            ?>

            <?php
            $games = Game::findByDate($today);
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
            }

            if (count($games) < 10) {
                $games = Game::findUpcoming();
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
            //echo '<a href="/games/all">View complete schedule of games</a>';
            //echo '</div>';
            echo '</div>';
            ?>

            <?php
            $meets = Meet::findByDate($yesterday);
            if (count($meets) > 0) {
                echo '<div id="yesterdays-meets" class="sub-menu-heading">';
                echo "<span>Yesterday's Meets ( {$yesterday} )</span>";
                echo '</div>';
                echo '<div class="textwidget">';
                echo '<table width="100%">';

                foreach ($meets as $meet) {
                    echo $meet->getHTMLTableRow(array(
                        'show_title' => false,
                        'show_sport' => true,
                        'show_date'  => false,
                        'show_time'  => true,
                        'show_edit'  => true,
                    ));
                }

                echo '</table>';
            }

            if (count($meets) < 10) {
                $meets = Meet::findRecent();
                if (count($meets) > 0) {
                    echo '<div id="recent-meets" class="sub-menu-heading">';
                    echo '<span>Recent Meets</span>';
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($meets as $meet) {
                        echo $meet->getHTMLTableRow(array(
                            'show_title' => false,
                            'show_sport' => true,
                            'show_date'  => true,
                            'show_time'  => false,
                            'show_edit'  => false,
                        ));
                    }

                    echo '</table>';
                } else {
                    echo '<div id="recent-meets" class="sub-menu-heading">';
                    echo '<span>Recent Meets</span>';
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<p>No recent meets found.';
                }
            }
            //echo '<div style="text-align:right">';
            //echo '<a href="/meets/all">View complete meet results</a>';
            //echo '</div>';
            echo '</div>';
            ?>

            <?php
            $games = Game::findByDate($yesterday);
            if (count($games) > 0) {
                echo '<div id="yesterdays-games" class="sub-menu-heading">';
                echo "<span>Yesterday's Games ( {$yesterday} )</span>";
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
            }

            if (count($games) < 10) {
                $games = Game::findRecent();
                if (count($games) > 0) {
                    echo '<div id="recent-games" class="sub-menu-heading">';
                    echo '<span>Recent Games</span>';
                    echo '</div>';
                    echo '<div class="textwidget">';
                    echo '<table width="100%">';

                    foreach ($games as $game) {
                        echo $game->getHTMLTableRow(array(
                            'show_sport'   => true,
                            'show_date'    => true,
                            'show_time'    => false,
                            'show_scoring' => false,
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
            //echo '<a href="/games/all">View complete game results</a>';
            //echo '</div>';
            echo '</div>';
            ?>

        </div> <!-- end content area -->

        <div class="col-sm-3 col-lg-3" role="complementary">
            <div class="sidebar-right widget-area" role="complementary">
                <?php
                $the_query = new WP_Query(array(
                    'category_name'  => 'news',
                    'posts_per_page' => 1,
                ));
                if ($the_query->have_posts()) {
                    ?>
                    <div id="news" class="sub-menu-heading">
                        <span>News</span>
                    </div>
                    <div class="textwidget">
                        <?php
                        $the_query->the_post();
                        echo '<h1>';
                        the_title();
                        echo '</h1>';
                        echo '<p>';
                        the_content(__('Read more'));
                        echo '</p>';
                        ?>
                    </div>
                    <div style="text-align:right">
                        <a href="/news">View past news</a>
                    </div>
                    <?php
                }
                ?>

                <div id="twitter" class="sub-menu-heading">
                    <span>Follow Us</span>
                </div>

                <div class="textwidget">
                    <a class="twitter-timeline" data-height="600" href="https://twitter.com/wcssaa">Tweets by wcssaa</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>

            </div>
        </div>

</div> <!-- end row -->
</div> <!-- end container -->

<?php
    get_footer();
