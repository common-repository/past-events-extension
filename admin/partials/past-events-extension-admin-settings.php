<?php
/**
 * Provide a admin area view for the plugin
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/admin/partials
 */

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"></div>
	<h2>Past Events Extension: Options</h2>
	<form method="post" action="options.php">

		<table class="form-table pee-form-table">

			<?php if ( pee_fs()->is_not_paying() ) { ?>
			<tr>
				<td>
					<h3>Pro features...</h3>
					<ul class="pee-pro-features">
						<li>Past Session List Shortcode - With optional date ranges. Ideal for repeating events, e.g. have one page for each event, with custom content</li>
						<li>Single Past Session Pages - Each past session has it's own page, with Videos embedding and Slide decks.</li>
					</ul>
					<a href="<?php echo pee_fs()->get_upgrade_url(); ?>" class="button-primary" >Upgrade Now</button>
				</td>
			</tr>
			<?php } ?>

			<tr>
				<td><h3>Rate this plugin</h3><p><a href="http://wordpress.org/support/view/plugin-reviews/past-events-extension?rate=5#postform" title="Rate me">If you like me, please rate me</a>... or maybe even <a href="http://datamad.co.uk/donate/" title="Show you love">donate to the author</a>... </p><p>or perhaps just spread the good word <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wordpress.org/extend/plugins/past-events-extension/" data-text="Using the Past Events Extension WordPress plugin and lovin' it" data-via="toddhalfpenny" data-count="none">Tweet</a>
				</p>
				</td>
			</tr>
			<tr>
				<td>
					<h3>Video How To</h3>
					<iframe width="560" height="315" src="https://www.youtube.com/embed/BnGk1htUUSM" frameborder="0" allowfullscreen></iframe>
				</td>
			</tr>
		</table>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p></td></tr>
	</form>
</div>
