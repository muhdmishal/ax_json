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
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('api_key'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
?>
