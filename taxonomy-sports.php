<?php get_header(); ?>

<div class="container">
<div class="row">
<div class="col-sm-12 col-lg-12">

<h1><?php echo get_queried_object()->name; ?> Schedule and Results</h1>

<?php
$first_table = true;
$new_date = false;
$game_played = false;

// Start the Loop.
while ( have_posts() ) : the_post();

	if (get_post_type() === 'game') {
		$game_sport_id    = intval(get_post_meta($post->ID, 'game_sport', true));
		$game_sport       = get_term($game_sport_id, 'sports');
		$game_sport_link  = get_term_link($game_sport_id);

		$game_date        = get_post_meta($post->ID, 'game_date', true);
		$game_time        = get_post_meta($post->ID, 'game_time', true);

		$game_venue_id    = intval(get_post_meta($post->ID, 'game_venue', true));
		$game_venue       = get_term($game_venue_id, 'venues');
		$game_venue_link  = get_term_link($game_venue_id);

		$away_team_id     = intval(get_post_meta($post->ID, 'away_team', true));
		$away_team        = get_term($away_team_id, 'teams');
		$away_team_link   = get_term_link($away_team_id);

		$home_team_id     = intval(get_post_meta($post->ID, 'home_team', true));
		$home_team        = get_term($home_team_id, 'teams');
		$home_team_link   = get_term_link($home_team_id);

		$away_score       = get_post_meta($post->ID, 'away_score', true);
		$home_score       = get_post_meta($post->ID, 'home_score', true);
		$away_scoring     = get_post_meta($post->ID, 'away_scoring', true);
		$home_scoring     = get_post_meta($post->ID, 'home_scoring', true);
		$set_scoring      = get_post_meta($post->ID, 'set_scoring', true);

		$game_played = ($away_score !== "") ? true : false;
	}
	if (get_post_type() === 'meet') {
		$game_sport_id    = intval(get_post_meta($post->ID, 'meet_sport', true));
		$game_sport       = get_term($game_sport_id, 'sports');
		$game_sport_link  = get_term_link($game_sport_id);

		$game_date        = get_post_meta($post->ID, 'meet_date', true);
		$game_time        = get_post_meta($post->ID, 'meet_time', true);

		$game_venue_id    = intval(get_post_meta($post->ID, 'meet_venue', true));
		$game_venue       = get_term($game_venue_id, 'venues');
		$game_venue_link  = get_term_link($game_venue_id);
	}

	if ($first_table === true) {
		$new_date = true;
		$current_date = $game_date;
		$first_table = false;
		if (get_post_type() === 'meet') { echo '<table width="100%">'; }
	}

	if (strtotime($game_date) > strtotime($current_date) && (get_post_type() === 'game')) {
		$new_date = true;
		$current_date = $game_date;
		echo '</table>';
	}
	?>
	
	<?php if ($new_date && (get_post_type() === 'game')) { ?>
		<table width="100%">
			<tr>
				<th colspan="5"><?php echo $game_date; ?></th>
			</tr>
	<?php } ?>
	<?php if (get_post_type() === 'game') { ?>
			<tr>
				<td>
					<a href="<?php echo esc_url($away_team_link); ?>"><?php echo $away_team->name; ?></a>
				</td>   
				<td>
					<?php if ($game_played) { ?>
						<?php echo $away_score; ?> - <?php echo $home_score; ?> 
					<?php } else { ?>
						vs
					<?php } ?>
				</td>
				<td>
					<a href="<?php echo esc_url($home_team_link); ?>"><?php echo $home_team->name; ?></a>
				</td>
				<td style="width:50%">
					<?php if ($game_played) { ?>
						<?php if ($set_scoring !== "") { ?>
							<div><?php echo $set_scoring; ?></div>
						<?php } else { ?>
							<div><?php echo $away_team->name; ?>: <?php echo $away_scoring; ?></div>
							<div><?php echo $home_team->name; ?>: <?php echo $home_scoring; ?></div>
						<?php } ?>
					<?php } else { ?>
						<?php echo $game_time; ?> @ <a href="<?php echo $game_venue_link; ?>"><?php echo $game_venue->name; ?></a>
					<?php } ?>
				</td>
				<td>
					<?php edit_post_link(__('Add/Edit Results'));?>
				</td>
			</tr>
	<?php } else { ?>
			<tr>
				<td><a href="<?php echo get_permalink(); ?>"><?php echo substr(get_the_title(), 10); ?></a></td>
				<td><?php echo $game_date; ?> <?php echo $game_time; ?> @ <a href="<?php echo $game_venue_link; ?>"><?php echo $game_venue->name; ?></a></td>
				<td><?php edit_post_link(__('Add/Edit Results'));?>
			</tr>
	<?php } ?>
	<?php $new_date = false; ?>
<?php endwhile; ?>
</table>

</div> <!-- end content area -->
</div>
</div>

<?php get_footer();
