=== smart User Slug Hider ===
Contributors: petersplugins, smartware.cc
Donate link:http://petersplugins.com/make-a-donation/
Tags: author, authors, user, users, url, link, security, secure, login, permalink, authorlink, author link, userlink, user link, authorpage, author page
Requires at least: 3.0
Tested up to: 4.7
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Hide usernames in author pages URLs to enhance security

== Description ==

> This Plugin replaces user names with 16 digits coded strings.

See also [Plugin Homepage](http://petersplugins.com/free-wordpress-plugins/smart-user-slug-hider/)

For author page URLs WordPress uses the pattern example.com/author/name where 'name' represents the users login name. This means that the **login names from all your users are publicly visible**. This is the already half of the infomations needed to log in...

The smart User Slug Hider Plugin changes all author page URLs from e.g. example.com/author/admin to something like example.com/author/e9e716def73f76ac.

The codes are generated automatically and its impossible to make conclusions about the user names. The WordPress default URLs (like example.com/author/admin) will cause a 404 (not found) error. The plugin does not make any changes to your database. Deactivating the Plugin restores the default WordPress behavior.

There are **no settings and no need to change anything**.

= Shortcodes =

The plugin adds three shortcodes you can use in your posts:

* **[smart_user_slug]** the user slug of the post author - e.g. e9e716def73f76ac
* **[smart_user_url]** the url of the post author's profile page - e.g. example.com/author/e9e716def73f76ac
* **[smart_user_link]** adds a link to the post author's profile page

= Theme Functions =

The plugin adds two functions that can be used in theme files:

* `get_smart_user_slug( $author_id )` to **get** the user slug for the author - the parameter $author_id is optional, if omitted the author's ID of the current post is used
* `the_smart_user_slug( $author_id )` to **display** the user slug for the author - the parameter $author_id is optional, if omitted the author's ID of the current post is used

= Do you like the smart User Slug Hider Plugin? =

Thanks, I appreciate that. You don't need to make a donation. No money, no beer, no coffee. Please, just [tell the world that you like what I'm doing](http://petersplugins.com/make-a-donation/)! And that's all.

= More plugins from Peter =

* **[404page](https://wordpress.org/plugins/404page/)** - Define any of your WordPress pages as 404 error page 
* **[hashtagger](https://wordpress.org/plugins/hashtagger/)** - Tag your posts by using #hashtags
* **[smart Custom Display Name](https://wordpress.org/plugins/smart-custom-display-name/)** - Set your Display Name to anything you like
* [See all](https://profiles.wordpress.org/petersplugins/#content-plugins)

== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins' -> 'Add New'
1. Search for 'smart User Slug Hider'
1. Activate the plugin through the 'Plugins' menu in WordPress

= Manually from wordpress.org =

1. Download smart User Slug Hider from wordpress.org and unzip the archive
1. Upload the `smart-user-slug-hider` folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

Nothing yet.

== Screenshots ==

There's nothing to see...

== Changelog ==

= 1.2 (2016-10-04) =
* Shortcodes added: `[smart_user_slug]`, `[smart_user_url]`, `[smart_user_link]`
* Theme Functions added: `get_smart_user_slug()`, `the_smart_user_slug()`

= 1.1 (2016-06-30) =
* Code optimization
* Plugin info page added

= 1.0 (2014-10-02) =
* Initial Release (tanks to [joeymalek](https://profiles.wordpress.org/joeymalek/) for drawing my attention to this problem)

== Upgrade Notice ==

= 1.2 =
Shortcodes and Theme Functions added

= 1.1 =
* Code optimization, Plugin info page added, no functional changes