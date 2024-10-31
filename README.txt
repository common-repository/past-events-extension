=== Past Events Extension ===
Contributors: toddhalfpenny
Donate link: https://datamad.co.uk/donate
Tags: tyler, events, past, session, conference
Requires at least: 3.0.1
Tested up to: 4.8.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds "Past Events" support to sites running the Tyler events theme.

== Description ==

Adds "Past Events" support to sites running the excellent [Tyler](https://www.showthemes.com/new-event-wordpress-theme-tyler) events theme.

Can set sessions to be "Past Session", and so hidden from "schedule" page. Instead the past sessions are now listed on a "past-sessions" page.

=== Features ===

* Set Sessions to "Past Session" state, thus removing them from appearing in the default schedule
* Built-in 'past-sessions' page that lists all the past sessions.
* Past sessions can easily be identified through the admin sessions listing

> With the [PRO](https://datamad.co.uk/wordpress-plugins/past-events-extension/) version you get even more options
>
> [Pro version](https://datamad.co.uk/wordpress-plugins/past-events-extension/) key features;
>
> * Past Sessions Listing Shortcode - Supports date-ranges so you can have multiple past events listings, each on there own page, with full control over the rest of the page content
>
> * Additional Video setting - Add embedded video for each past-session (e.g. from Vimeo, YouTube); ideal to show off past presentations.
>
> * Additional Slide-deck link setting - Add a link to slide-decks used for each session.
>
> * Enhanced Single-Session page - Shows the embedded video and slide links


=== Demo Video ===
https://www.youtube.com/watch?v=BnGk1htUUSM

=== How To ===

* Install and activate the plugin
* In each session admin screen set the "Status" to "Past Session"
* View past sessions at the new auto created "past-sessions" page. e.g at https://example.com/past-sessions.


== Installation ==

1. Upload `past-events-extension.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= What event themes are supported? =

In v1.0.0 only the [Tyler](https://www.showthemes.com/new-event-wordpress-theme-tyler) event theme is supported

= Where are my past sessions shown? =

These are shown at https://YOUR-WEBSITE/past-sessions.
If you have the [PRO](https://datamad.co.uk/wordpress-plugins/past-events-extension) version you can use the shortocde `[pee_past_sessions]` to output. Full documentation can be found [here](https://datamad.co.uk/wordpress-plugins/past-events-extension)

= What about mulitple past events? =

The FREE version only supports a single list of past sessions. The [PRO](https://datamad.co.uk/wordpress-plugins/past-events-extension) version offers support for multiple, unlimited past events.

= Can I have a menu item? =

Absolutely. Add a custom link pointing to the `/past-sessions` page on your site.
e.g. `https://YOUR-WEBSITE/past-sessions`

== Screenshots ==

1. Past Sessions shown in admin listing.
2. Setting a session to be a Past Session.
3. Session Assets can be added in the PRO version - Embedded in the single session page.

== Changelog ==

= 1.0.1 =
* Bugfix - Fixed ordering of past sessions.
* Bugfix - Remove Jetpack's related posts from past-sessions.
* Bugfix - No longer limting past-session retrival count.


= 1.0.0 =
* First drop.

