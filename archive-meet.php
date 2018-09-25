<?php get_header(); ?>

<div class="container">
<div class="row">
<div class="col-sm-12 col-lg-12">

<h1>Full Schedule and Results</h1>

<table>
	<?php // Start the Loop.
	while ( have_posts() ) : the_post();

		$game_sport_id    = intval(get_post_meta($post->ID, 'game_sport', true));
		$game_sport       = get_term($game_sport_id, 'sports');
		$game_sport_link  = get_term_link($game_sport_id);

		$away_team_id     = intval(get_post_meta($post->ID, 'away_team', true));
		$away_team        = get_term($away_team_id, 'teams');
		$away_team_link   = get_term_link($away_team_id);

		$home_team_id     = intval(get_post_meta($post->ID, 'home_team', true));
		$home_team        = get_term($home_team_id, 'teams');
		$home_team_link   = get_term_link($home_team_id);

		$game_venue_id    = intval(get_post_meta($post->ID, 'game_venue', true));
		$game_venue       = get_term($game_venue_id, 'venues');
		$game_venue_link  = get_term_link($game_venue_id);

		$game_date        = get_post_meta($post->ID, 'game_date', true);
		$game_time        = get_post_meta($post->ID, 'game_time', true);

		$away_score       = get_post_meta($post->ID, 'away_score', true);
		$home_score       = get_post_meta($post->ID, 'home_score', true);
		$away_scoring     = get_post_meta($post->ID, 'away_scoring', true);
		$home_scoring     = get_post_meta($post->ID, 'home_scoring', true);
	?>
		<tr>
			<th colspan="4"><?php echo $game_date; ?></th>
		</tr>
		<tr>
			<td>
				<a href="<?php echo esc_url($away_team_link); ?>"><?php echo $away_team->name; ?></a>
			</td>   
			<td>
				<?php if ($away_score === "") { ?>
					vs
				<?php } else { ?>
					<?php echo $away_score; ?> - <?php echo $home_score; ?> 
				<?php } ?>
			</td>
			<td>
				<a href="<?php echo esc_url($home_team_link); ?>"><?php echo $home_team->name; ?></a>
			</td>
			<td>
				<?php echo $game_time; ?>
			</td>
		</tr>
	<?php endwhile; ?>
</table>

</div> <!-- end content area -->
</div>
</div>

<?php get_footer();
