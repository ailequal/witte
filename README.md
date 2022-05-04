# witte

### Index

* [Requirements](#requirements)
* [Description](#description)
* [Short codes](#short-codes)
* [Hooks](#hooks)
* [Database](#database)
* [WP-Cron](#wp-cron)
* [Action Scheduler](#action-scheduler)
* [WP-CLI](#wp-cli)

### Requirements

Requires at least WordPress: 5.9

Tested up to WordPress: 5.9

Requires PHP: 7.4

### Description

What is there to eat?

This plugin creates a new custom post type called "course". It has associated two taxonomies:
* "course_cat"
* "course_tag".

Each course can have a generic name (the post title, for internal use only),
a featured image and the corresponding translations for all the enabled languages.

The available languages can be set from the main plugin option page.

From the plugin option page it's possible to customize the plugin template as desired.
To use the template on any page of your active theme,
it's required to manually copy these three files into the root folder of your active theme:
* witte/resources/views/header-witte.php
* witte/resources/views/page_witte.php
* witte/resources/views/footer-witte.php

The week plan option page will allow the user to plan the entire week.
The template will automatically retrieve the data related to the current day.
If needed, the template can be customized as you may like.
The template will auto reload the page after a minute if the GET parameter "reload=1" is passed.

There are a few custom hooks available inside the plugin:
* apply_filters('witte_language_options', $optionsDefault);
* ...
