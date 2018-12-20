# Quicklink Drupal Module

## What is Quicklink?

The Quicklink module loads the [Quicklink library](https://github.com/GoogleChromeLabs/quicklink) and provides a Drupal
administrative interface to configure it.

## Installation

Install the module like normal. Because of licensing restrictions, the Quicklink JS library cannot be hosted on Drupal.org.
By default the module will load the Quicklink library from a CDN at `https://unpkg.com/quicklink@1.0.0/dist/quicklink.umd.js`. 
If you place a copy of this file into your local filesystem at `/quicklink/js/quicklink.umd.js`, the module will serve this 
instead.

## How do I access the Quicklink admin interface?

The Quicklink module admin interface is located at `admin/config/quicklink/quicklinkconfig`.

## What browsers does this support?

Without polyfills: Chrome, Firefox, Edge, Opera, Android Browser, Samsung Internet.

With [Intersection Observer polyfill](https://github.com/w3c/IntersectionObserver/tree/master/polyfill): Safari, IE9+

## How to ignore certain links.

You can tell Quicklink to ignore certain links by adding them into the ignore list at `admin/config/quicklink/quicklinkconfig`.
In addition, you can add a `noprefetch` attribute onto the `<a>` tag to tell the library not to prefetch this link.

## Installation via Composer

Add the following into your webroot's `composer.json` file to automatically download the `quicklink.umd.js` file so it 
can be served from your system's local filesystem.

```
  "require": {
    "GoogleChromeLabs/quicklink": "^1.0"
  },
  "repositories":[
    {
      "type":"composer",
      "url":"https://packages.drupal.org/8"
    },
    {
      "type": "package",
      "package": {
        "name": "GoogleChromeLabs/quicklink",
        "version": "1.0.0",
        "type": "drupal-library",
        "dist": {
          "url": "https://unpkg.com/quicklink@1.0.0/dist/quicklink.umd.js",
          "type": "file"
        }
      }
    }
  ]
```

You'll need to ensure that the `drupal-library` type is available under the `extras` section of the composer.json. The
code snippit below assumes that you have your webroot in a `web` subdirectory.

```
  "extra": {
    "installer-paths": {
    "web/core": ["type:drupal-core"],
    "web/libraries/{$name}": ["type:drupal-library"],
    "web/modules/contrib/{$name}": ["type:drupal-module"],
    "web/profiles/contrib/{$name}": ["type:drupal-profile"],
    "web/themes/contrib/{$name}": ["type:drupal-theme"],
    "drush/Commands/{$name}": ["type:drupal-drush"]
    },
    "patches": {}
  }   
```

After your `composer.json` is in order, you can install the library with `composer require GoogleChromeLabs/quicklink`,
and you can install the Quicklink module with `composer require drupal/quicklink`