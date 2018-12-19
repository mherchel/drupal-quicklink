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