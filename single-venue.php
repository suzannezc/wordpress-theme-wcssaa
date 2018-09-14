<?php
    use \WRDSB\WCSSAA\CustomPostTypes\LeagueCPT as LeagueCPT;
    use \WRDSB\WCSSAA\CustomPostTypes\Club as Club;
    use \WRDSB\WCSSAA\Model\Venue as Venue;
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
