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
    $form['selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Parent selector (Optional)'),
      '#description' => $this->t('Quicklink will search this CSS selector for URLs to prefetch (ex. <code>.body-inner</code>). Defaults to the whole document.'),
      '#maxlength' => 128,
      '#size' => 64,
      '#default_value' => $config->get('selector'),
    ];
    $form['url_patterns_to_ignore'] = [
      '#type' => 'textarea',
      '#title' => $this->t('URL patterns to ignore (Optional)'),
      '#description' => $this->t('Quicklink will not fetch data if the URL contains any of these patterns. One per line.'),
      '#default_value' => $config->get('url_patterns_to_ignore'),
    ];
    $form['allowed_domains'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Additional Allowed Domains (Optional)'),
      '#description' => $this->t('List of domains to prefetch from (in addition to origin domain).'),
      '#default_value' => $config->get('allowed_domains'),
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
      ->set('url_patterns_to_ignore', $form_state->getValue('url_patterns_to_ignore'))
      ->set('prefetch_for_anonymous_users_onl', $form_state->getValue('prefetch_for_anonymous_users_onl'))
      ->set('allowed_domains', $form_state->getValue('allowed_domains'))
      ->save();
  }

}
