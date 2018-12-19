<?php

namespace Drupal\quicklink\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class QuicklinkForm.
 */
class QuicklinkForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'quicklink_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['exclude_selectors'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Exclude selectors'),
      '#maxlength' => 500,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
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
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
