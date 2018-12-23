<?php

namespace Drupal\quicklink\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class QuicklinkConfig.
 */
class QuicklinkConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'quicklink.quicklinkconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'quicklink_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('quicklink.quicklinkconfig');
    $form['prefetch_for_anonymous_users_onl'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Prefetch for anonymous users only'),
      '#description' => $this->t('Highly recommended. Only prefetch URLs for anonymous users.'),
      '#default_value' => $config->get('prefetch_for_anonymous_users_onl'),
    ];
    $form['ignore_admin_paths'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Do not prefetch admin paths'),
      '#description' => $this->t('Highly recommended. Ignore administrative paths.'),
      '#default_value' => $config->get('ignore_admin_paths'),
    ];
    $form['ignore_hashes'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Ignore paths with hashes (#) in them'),
      '#description' => $this->t('Recommended. Prevents multiple prefetches of the same page.'),
      '#default_value' => $config->get('ignore_hashes'),
    ];
    $form['url_patterns_to_ignore'] = [
      '#type' => 'textarea',
      '#title' => $this->t('URL patterns to ignore (optional)'),
      '#description' => $this->t('Quicklink will not fetch data if the URL contains any of these patterns. One per line.'),
      '#default_value' => $config->get('url_patterns_to_ignore'),
      '#attributes' => array(
        'style'=>'max-width: 600px;'
      ),
    ];
    $form['selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Override parent selector (optional)'),
      '#description' => $this->t('Quicklink will search this CSS selector for URLs to prefetch (ex. <code>.body-inner</code>). Defaults to the whole document.'),
      '#maxlength' => 128,
      '#size' => 128,
      '#default_value' => $config->get('selector'),
      '#attributes' => array(
        'style'=>'max-width: 600px;'
      ),
    ];
    $form['allowed_domains'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Override allowed domains (optional)'),
      '#description' => $this->t('List of domains to prefetch from. If empty, Quicklink will only prefetch links from the origin domain.
        If you configure this, be sure to input the origin domain. Add <code>true</code> here to allow <em>every</em> origin.'),
      '#default_value' => $config->get('allowed_domains'),
      '#attributes' => array(
        'style'=>'max-width: 600px;'
      ),
    ];
    $form['enable_debug_mode'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable debug mode'),
      '#description' => $this->t('Log Quicklink development information to the HTML and JavaScript console. You may need to Drupal\'s cache after changing this value.'),
      '#default_value' => $config->get('enable_debug_mode'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('quicklink.quicklinkconfig')
      ->set('selector', trim($form_state->getValue('selector')))
      ->set('url_patterns_to_ignore', trim($form_state->getValue('url_patterns_to_ignore')))
      ->set('prefetch_for_anonymous_users_onl', $form_state->getValue('prefetch_for_anonymous_users_onl'))
      ->set('ignore_admin_paths', $form_state->getValue('ignore_admin_paths'))
      ->set('ignore_hashes', $form_state->getValue('ignore_hashes'))
      ->set('allowed_domains', trim($form_state->getValue('allowed_domains')))
      ->set('enable_debug_mode', $form_state->getValue('enable_debug_mode'))
      ->save();
  }

}
