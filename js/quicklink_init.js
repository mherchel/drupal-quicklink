'use strict';
(function () {
  Drupal.behaviors.quicklink = {
    'attach': function attachQuicklink(context) {

      const quicklinkConfig = {};
      quicklinkConfig.ignores = [];

      for (let i = 0; i < drupalSettings.quicklink.url_patterns_to_ignore.length; i++) {
        let pattern = drupalSettings.quicklink.url_patterns_to_ignore[i];

        if (pattern.length) {
          quicklinkConfig.ignores.push(uri => uri.includes(pattern));
        }
      }

      // Ignore links that have a noprefetch attribute.
      quicklinkConfig.ignores.push((uri, elem) => elem.hasAttribute('noprefetch'));

      // Ignore links that have a download attribute.
      quicklinkConfig.ignores.push((uri, elem) => elem.hasAttribute('download'));

      quicklinkConfig.el = context;

      if (drupalSettings.quicklink.selector) {
        quicklinkConfig.el = context.querySelector(drupalSettings.quicklink.selector);
      }

      if (drupalSettings.quicklink.allowed_domains) {
          quicklinkConfig.origins = drupalSettings.quicklink.allowed_domains;
      }

      if (window.quicklink) {
        quicklink(quicklinkConfig);
      }
    },
  };
})();
