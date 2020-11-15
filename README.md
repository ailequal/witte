# Witte

### Index

* [Info](#info)
* [Description](#description)
* [Guide](#guide)
* [Short codes](#short-codes)
* [Hooks](#hooks)
* [Database](#database)
* [Cache](#cache)
* [WP-Cron](#wp-cron)
* [WP-CLI](#wp-cli)
* [Languages](#languages)
* [Frequently Asked Questions](#frequently-asked-questions)
* [Changelog](#changelog)

### Info

Author: ailequal

Website: [ailequal/witte](https://github.com/ailequal/witte)

Tags: menu, dish, meal

Requires at least WordPress: 5.5.3

Tested up to WordPress: 5.5.3

Requires PHP: 7.4.12

License: MIT

This is the sort description of the plugin.

### Description

This is the long description that explain the plugin in details.

### Guide

* Brief description of how to correctly use the plugin in steps.
* Activate the plugin.
* Have fun!

### Short codes

All the short codes that the plugin makes available.

| Name                        | Parameters | Description |
| --------------------------- | ---------- | ----------- |
| [witte argument="variable"] | null       | null        |

### Hooks

All the custom hooks created to be used for this plugin and outside it.

#### Actions

**do_action('ailequal/witte/action_this_thing', $args);**

add_action('ailequal/witte/action_this_thing', 'call_back_function_from_action_hook');

| Name        | Where                        | Description |
| ----------- | ---------------------------- | ----------- |
| action_name | internal \| external \| both | description |

#### Filters

**apply_filters('ailequal/witte/filter_this_thing', $variable_to_return);**

add_filter('ailequal/witte/action_this_thing', 'call_back_function_from_filter_hook');

| Name        | Where                        | Description |
| ----------- | ---------------------------- | ----------- |
| filter_name | internal \| external \| both | description |

### Database

How the data is stored inside the database.

#### wp_options

| option_name          | option_value | Description              |
| -------------------- | ------------ | ------------------------ |
| _witte_plugin_options | array        | All main plugin options. |
| _witte_plugin_extras  | array        | Extras information.      |


#### wp_postmeta

| meta_key             | meta_value | Description                                          |
| -------------------- | ---------- | ---------------------------------------------------- |
| _witte_plugin_feature | 1          | Tells if that feature is active or not for that CPT. |

### Cache

How the cache is handled, if present.

### WP-Cron

What custom WP-Cron job event have been implemented, when and what they do.

| cron event name          | recurrence | Description |
| ------------------------ | ---------- | ----------- |
| witte_plugin/cron_hook_id | null       | null        |

### WP-CLI

What custom WP-CLI commands have been implemented and what they do.

### Languages

All the supported languages by this plugin:

* English
* Italian

### Frequently Asked Questions

###### Question?

Answer!

###### Another question?

Another answer!

### Changelog

1.0

* The main plugin files.

1.1

* Added a new feature.
* Fixed a critical bug.

1.X

* WIP

