'use strict';

(function () {
  Drupal.behaviors.quicklink = {
    'attach': function attachQuicklink(context, settings) {

      function hydrateQuicklinkConfig() {
        settings.quicklink.quicklinkConfig = settings.quicklink.quicklinkConfig || {};

        var quicklinkConfig = settings.quicklink.quicklinkConfig;

        quicklinkConfig.ignores = [];

        // Loop through all the patters to ignore, and generate ES5 functions to populate quicklinkConfig.
        for (var i = 0; i < settings.quicklink.url_patterns_to_ignore.length; i++) {
          var pattern = settings.quicklink.url_patterns_to_ignore[i];

          (function(i, pattern) {
            if (pattern.length) {
              quicklinkConfig.ignores.push(function(uri) { return uri.includes(pattern) });
            }
          })(i, pattern);
        }

        // Ignore links that have a noprefetch attribute.
        quicklinkConfig.ignores.push((uri, elem) => elem.hasAttribute('noprefetch'));

        // Ignore links that have a download attribute.
        quicklinkConfig.ignores.push((uri, elem) => elem.hasAttribute('download'));

        if (settings.quicklink.selector) {
          quicklinkConfig.el = context.querySelector(settings.quicklink.selector);
        }

        if (settings.quicklink.allowed_domains) {
          quicklinkConfig.origins = settings.quicklink.allowed_domains;
        }
      }

      if (!settings.quicklink.quicklinkConfig) {
        hydrateQuicklinkConfig()
      }

      // Update element to context every time Drupal.behaviors is run.
      settings.quicklink.quicklinkConfig.el = context;

      if (window.quicklink) {
        quicklink(settings.quicklink.quicklinkConfig);
      }
    },
  };
})();
