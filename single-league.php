<?php get_header(); ?>

<?php $today = date( 'Y-m-d' ); ?>
<?php $yesterday = date( 'Y-m-d', strtotime( "last weekday {$today}" ) ); ?>

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
						$leagues = WCSSAA_League_CPT::get_leagues_by_season( 'fall' );
						foreach ( $leagues as $league ) {
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
						$teams = get_terms( array(
							'taxonomy'   => 'organizations',
							'hide_empty' => false,
						) );
						foreach ( $teams as $team ) {
							echo '<li><a href="/organizations/' . $team->slug . '">' . $team->name . '</a></li>';
						}
						?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm-10 col-lg-10">
		<?php
		$league_id   = get_the_ID();
		$league_post = get_post( $league_id );
		$league      = new WCSSAA_League( $post );
		$league_name = $league->title;
		$league_slug = $league->slug;
		?>

		<h1><?php echo $league_name ?></h1>
		<p>
			<a href="/leagues/<?php echo $league_slug ?>">Home</a>
			| 
			<a href="/leagues/<?php echo $league_id ?>/standings">Standings</a>
			| 
			<a href="/leagues/<?php echo $league_id ?>/results">Results</a>
			|
			<a href="/leagues/<?php echo $league_id ?>/schedule">Schedule</a>
		</p>
			<!--
			<div id="featured-game" class="sub-menu-heading">
				<span>Featured Game</span>
			</div>
			-->

			<?php
			$games = WCSSAA_Game_CPT::get_games_by_date( $today, $league_id );
			if ( count( $games ) > 0 ) {
				echo '<div id="todays-games" class="sub-menu-heading">';
				echo "<span>Today's Games ( {$today} )</span>";
				echo '</div>';
				echo '<div class="textwidget">';
				echo '<table width="100%">';

				foreach ( $games as $game ) {
					echo $game->get_html_table_row( array(
						'show_sport' => false,
						'show_date'  => false,
						'show_time'  => true,
						'show_edit'  => true,
					));
				}

				echo '</table>';

			} else {
				$games = WCSSAA_Game_CPT::get_upcoming_games( $league_id );
				if ( count( $games ) > 0 ) {
					echo '<div id="upcoming-games" class="sub-menu-heading">';
					echo "<span>Upcoming Games</span>";
					echo '</div>';
					echo '<div class="textwidget">';
					echo '<table width="100%">';

					foreach ( $games as $game ) {
						echo $game->get_html_table_row( array(
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
			?>

			<?php
			$games = WCSSAA_Game_CPT::get_games_by_date( $yesterday, $league_id );
			if ( count( $games ) > 0 ) {
				echo '<div id="yesterdays-games" class="sub-menu-heading">';
				echo "<span>Yesterday's Games ( {$yesterday} )</span>";
				echo '</div>';
				echo '<div class="textwidget">';
				echo '<table width="100%">';

				foreach ( $games as $game ) {
					echo $game->get_html_table_row( array(
						'show_sport' => false,
						'show_date'  => false,
						'show_time'  => true,
						'show_edit'  => true,
					));
				}

				echo '</table>';

			} else {
				$games = WCSSAA_Game_CPT::get_recent_games( $league_id );
				if ( count( $games ) > 0 ) {
					echo '<div id="recent-games" class="sub-menu-heading">';
					echo '<span>Recent Games</span>';
					echo '</div>';
					echo '<div class="textwidget">';
					echo '<table width="100%">';

					foreach ( $games as $game ) {
						echo $game->get_html_table_row( array(
							'show_sport' => false,
							'show_date'  => true,
							'show_time'  => false,
							'show_edit'  => false,
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
			?>

		</div> <!-- end content area -->
	</div> <!-- end row -->
</div> <!-- end container -->

<?php
	get_footer();
