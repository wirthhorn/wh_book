<?php

namespace Drupal\wh_book\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'wh_book.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $data = $this->get_field_data('books');
    $form['wh_book_fields'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Select fields you want to delete'),
      '#description' => $this->t('Here are all fields listet from the content type book. Select which fields you want to delete. (If you want to add one of these fields later, you can import here /admin/config/development/configuration/single/import the two yml-files of the field from module-code in wh_{module}\config\install\)'),
      '#options' => $data['form_options'],
      '#default_value' =>  $data['from_values'],
    ];
    $form['actions']['submit']['#value'] = $this->t('Delete Fields');
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

    //loop over fields and delete selected ones
    foreach($form_state->getValue('wh_book_fields') as $field_name => $checked){
      if($checked === $field_name){
        $this->delete_field($field_name);
        drupal_set_message('field '.$field_name.' is deleted now');
      }
    }
  }

  public function get_field_data($content_type){
    $data = array();

    //get list of all content_type fields
    $listFields = array();
    $entityManager = \Drupal::service('entity_field.manager');
    $fields = $entityManager->getFieldDefinitions('node', $content_type);
    foreach ($fields as $field_name => $field_definition) {
      if (!empty($field_definition->getTargetBundle())) {               
        $data['field_list'][$field_name]['type'] = $field_definition->getType();
        $data['field_list'][$field_name]['label'] = $field_definition->getLabel();      
        $data['form_options'][$field_name] = $field_name;
        $data['from_values'][$field_name] = 0;
      }
    }
    return $data;
  }

  //delete field
  public function delete_field($field_name){
    $field = FieldConfig::loadByName('node', 'books', $field_name);
    if (!empty($field)) {
      $field->delete();
    }

    $field_storage = FieldStorageConfig::loadByName('node', $field_name);
    if (!empty($field_storage)) {
      $field_storage->delete();
    }
  }

}
