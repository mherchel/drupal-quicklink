'use strict';

(function () {
  Drupal.behaviors.quicklink = {
    'attach': function attachQuicklink(context, settings) {

      function hydrateQuicklinkConfig() {
        var quicklinkConfig = {};

        quicklinkConfig.ignores = [];

        // Loop through all the patters to ignore, and generate functions to populate quicklinkConfig.
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

        quicklinkConfig.el = context;

        if (settings.quicklink.selector) {
          quicklinkConfig.el = context.querySelector(drupalSettings.quicklink.selector);
        }

        if (settings.quicklink.allowed_domains) {
          quicklinkConfig.origins = drupalSettings.quicklink.allowed_domains;
        }

        return quicklinkConfig;
      }

      var quicklinkConfig = quicklinkConfig || hydrateQuicklinkConfig();

      if (window.quicklink) {
        quicklink(quicklinkConfig);
      }
    },
  };
})();
