'use strict';
(function () {
  Drupal.behaviors.quicklink = {
    'attach': function attachQuicklink(context) {

      const quicklinkConfig = {};
      quicklinkConfig.ignores = [];

      for (let i = 0; i < drupalSettings.quicklink.url_patterns_to_exclude.length; i++) {
        let pattern = drupalSettings.quicklink.url_patterns_to_exclude[i];
        quicklinkConfig.ignores.push(uri => uri.includes(pattern));
      }

      // Ignore links that have a noprefetch attribute.
      quicklinkConfig.ignores.push((uri, elem) => elem.hasAttribute('noprefetch'));

      quicklinkConfig.el = drupalSettings.quicklink.selector || context;

      if (drupalSettings.quicklink.allowed_domains) {
          quicklinkConfig.origins = drupalSettings.quicklink.allowed_domains;
      }

      if (window.quicklink) {
        quicklink(quicklinkConfig);
      }
    },
  };
})();
