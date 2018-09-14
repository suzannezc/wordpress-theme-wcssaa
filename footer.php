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
            </div>

            <div id="about" class="col-sm-6 col-md-3" role="region">
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
        if (is_user_logged_in()) {
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
