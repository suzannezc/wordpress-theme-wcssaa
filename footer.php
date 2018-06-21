<?php
/**
 * The template for displaying the footer
 *
 * Displays from <div class="footer"> to </html>
 *
 * @package WordPress
 * @subpackage WRDSB
 */
?>

<div id="footer" class="footer" role="contentinfo">
	<div class="container">
		<div class="row">

			<div id="address" class="col-sm-6 col-md-3" aria-labelledby="address">
				<address>
					<h1>Waterloo Region District School Board</h1>
					<p>51 Ardelt Avenue<br />
					Kitchener, ON N2C 2R5</p>
					<p>Switchboard: 519-570-0003<br />
					<a href="https://www.wrdsb.ca/about-the-wrdsb/contact/">Contact the WRDSB</a></p>
					<p><a href="https://www.wrdsb.ca/about-the-wrdsb/contact/website-feedback/" target="_blank">Website Feedback Form</a></p>
				</address>
			</div>

			<div class="col-sm-6 col-md-3" role="region">
				<h1 id="safety">Player Safety</h1>
				<ul>
					<li><a href="http://prestohost02.inmagic.com/Presto">OPHEA Safety Guidlines</a></li>
					<li><a href="http://www.wrdsb.ca/wp-content/uploads/6012_-Prevention-and-Response-to-Student-Concussions.pdf">BP 6012 - Prevention and Response to Student Concussions</a></li>
					<li><a href="http://www.wrdsb.ca/wp-content/uploads/AP1250-Concussion-Management.pdf">AP 1250 - Concussion Management</a></li>
				</ul>

				<h1 id="volunteers">For Volunteers:</h1>
				<ul>
					<li><a href="http://www.wcssaa.ca/volunteers/concussion-training-video/">Concussion Training Video</a></li>
					<li><a href="http://www.wcssaa.ca/volunteers/concussion-training-slideshow/">Concussion Training Slideshow</a></li>
					<li><a href="http://wcssaa.ca/wp-content/uploads/Proof-of-Training-for-Volunteer-Coaches-.pdf">Proof of Concussion Training for Volunteer Coaches Form</a></li>
				</ul>
			</div>

			<div id="about" class="col-sm-6 col-md-3" role="region">
				<h1>About WCSSAA</h1>
				<h2>Contacts</h2>
				<ul>
					<li>Chair - Ryan Hume, Eastwood CI</li>
					<li>Chair Elect - Emily Dixon, Queen Elizabeth PS</li>
					<li>Past Chair - Josh Windsor, Eastwood CI</li>
				</ul>
				<h2>Governance</h2>
				<ul>
					<li>Meeting Dates</li>
					<li><a href="http://www.wrdsb.ca/wp-content/uploads/4019_WCSSA.pdf">WRDSB Policy 4019 - WCSSAA</a></li>
					<li><a href="https://www.wrdsb.ca/wp-content/uploads/1700-WCSSAA-Management-May-2017.pdf">WRDSB Procedure 1700 - WCSSAA Management</a></li>
				</ul>
			</div>

			<div id="athletic-assoc" class="col-sm-6 col-md-3" role="region">
				<h1>Athletic Assoc.</h1>
				<ul>
					<li><a href="http://www.cwossa.ca/">CWOSSA</a></li>
					<li><a href="http://www.ofsaa.on.ca/">OFSAA</a></li>
				</ul>
			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .footer -->

<div class="container" id="loginbar" role="navigation" aria_labelledby="adminbar">
	<p id="adminbar" class="copyright" style="text-align: center;">

		<?php
		// Get all the information about the site
		$sitename = get_bloginfo('name');
		$siteurl = site_url();
		$parsed_url = parse_url(network_site_url());
		$host = explode('.', $parsed_url['host']);

		// create link text
		$admin_link = '<a href="'.$siteurl.'/wp-login.php">Log into '.$sitename.'</a>';
		$corp_link  = ' &middot; Go to <a href="https://www.wrdsb.ca/">www.wrdsb.ca</a>';

		// display the login/logout link
		if ( is_user_logged_in() ) {
			wp_loginout();
		} else {
			echo $admin_link;
		}

		// display the auxilliary links
		echo $corp_link; 
		?>

	</p>
</div>

<?php wp_footer(); ?>
</body>
</html>
