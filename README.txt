=== Automatic Menu Updater ===
Contributors: vishnusomanus
Tags: menu, API, automatic update, cron, WordPress menu
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin that automatically updates WordPress menus via API calls. It supports multi-level menus, all menu attributes, and customizable cron intervals.

== Description ==

Automatic Menu Updater dynamically updates WordPress menus from an API, supporting hierarchy, attributes, and customizable cron intervals.

== Features ==

API Integration: Fetches menu data from an external API.

Multi-Level Menus: Supports hierarchical (nested) menu structures.

All Menu Attributes: Handles titles, URLs, classes, targets, descriptions, and more.

Cron Scheduling: Updates menus at customizable intervals (e.g., every minute, hourly, daily).

Sample API: Includes a built-in sample API endpoint for testing.

== Installation ==

Download the plugin files and place them in the wp-content/plugins/auto-menu-updater directory.

Activate the plugin through the Plugins page in the WordPress admin.

Go to Settings > Menu Updater to configure the plugin.

== Configuration ==

API URL: Enter the URL of the API that provides the menu data.

Select Menu: Choose the WordPress menu to update.

Cron Interval: Set how often the menu should be updated (e.g., every minute, hourly, daily).

== Sample API ==

The plugin includes a sample API endpoint for testing:

Endpoint: /wp-json/amu/v1/sample-menu

[
    {
        "title": "Home",
        "url": "https://example.com/",
        "parent_id": 0,
        "classes": ["home-link"],
        "target": "_self",
        "description": "Go to the homepage",
        "attr_title": "Homepage",
        "xfn": "nofollow",
        "object_id": 0,
        "object": "custom",
        "type": "custom",
        "order": 1
    }
]

== Usage ==

Set Up the API:

Ensure your API returns menu data in the required JSON format.

Configure the Plugin:

Go to Settings > Menu Updater.

Enter the API URL and select the menu to update.

Choose the desired cron interval.

Test the Plugin:

Use the sample API endpoint to test the plugin.

Verify that the selected menu is updated correctly.

== Cron Intervals ==

The plugin supports the following cron intervals:

Every Minute

Every 5 Minutes

Every 10 Minutes

Every 15 Minutes

Every 30 Minutes

Every Hour

Every Day

Every Week

Every Month

== Customization ==

Custom API: Replace the sample API with your own API endpoint.

Custom Cron Intervals: Add new intervals by modifying the add_custom_cron_intervals method in the AMU_Cron_Handler class.

== Troubleshooting ==

Menu Not Updating:

Check the API URL and ensure it returns valid JSON.

Verify that the selected menu exists in WordPress.

Cron Not Running:

Ensure the cron interval is set correctly.

Check the WordPress cron system using a plugin like WP Crontrol.

== Changelog ==

= 1.1 =

Added support for multi-level menus.

Added all menu attributes (e.g., classes, targets, descriptions).

Added a sample API endpoint for testing.

Added a cron interval dropdown in the settings page.

= 1.0 =

Initial release with basic menu updating functionality.

== Contributing ==

Contributions are welcome! Please open an issue or submit a pull request on GitHub.

== Support ==

For support, please open an issue on GitHub or contact the developer directly.