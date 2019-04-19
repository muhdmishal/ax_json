<?php

namespace Drupal\ax_json\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SiteAPISiteInformationForm extends SiteInformationForm
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $site_config = $this->config('system.site');

    $form = parent::buildForm($form, $form_state);

    $form['site_api'] = [
      '#type' => 'details',
      '#title' => t('Site API'),
      '#open' => TRUE,
    ];
    $form['site_api']['api_key'] = [
      '#type' => 'textfield',
      '#title' => t('API Key'),
      '#default_value' => $site_config->get('siteapikey') ? $site_config->get('siteapikey') : $this->t('No API Key yet'),
      '#description' => $this->t('The API key for this site.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $api_key = $form_state->getValue('api_key');

    // Check if API key field is having default value.
    if ($api_key != 'No API Key yet') {
      $this->config('system.site')
        ->set('siteapikey', $api_key)
        ->save();

      drupal_set_message('Site API Key has been saved with ' . $api_key);
    }

    parent::submitForm($form, $form_state);
  }
}
