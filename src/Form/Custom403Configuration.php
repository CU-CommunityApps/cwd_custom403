<?php

namespace Drupal\cwd_custom403\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TwoFiveLiveConfiguration.
 */
class Custom403Configuration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'cwd_custom403.custom403_configuration',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom403_configuration';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('cwd_custom403.custom403_configuration');
    $form['403_custom_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for 403 page'),
      '#default_value' => $config->get('403_custom_text'),
      '#size' => 200,
      '#maxlength' => 255,
      // '#description' => $this->t('Mapping: field machine name for the localist image'),
      '#required' => true,
    ];
    $form['403_use_cornell'] =[
      '#type' => 'checkbox',
      '#title' => $this->t('Site uses Cornell SSO login'),
      '#default_value' => $config->get('403_use_cornell'),
    ];
    $form['403_use_drupal'] =[
      '#type' => 'checkbox',
      '#title' => $this->t('Site uses Drupal login'),
      '#default_value' => $config->get('403_use_drupal'),
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
    $this->config('cwd_custom403.custom403_configuration')
      ->set('403_custom_text', $form_state->getValue('403_custom_text'))
      ->set('403_use_cornell', $form_state->getValue('403_use_cornell'))
      ->set('403_use_drupal', $form_state->getValue('403_use_drupal'))
      ->save();
  }

}
