<?php

namespace Drupal\wh_book\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;
use Drupal\Core\Validation\Plugin\Validation\Constraint\AllowedValuesConstraint;


 /**
 * @FieldType(
 *   id = "person_field_type",
 *   label = @Translation("Person field type"),
 *   description = @Translation("My Field Type"),
 *   default_widget = "person_widget_type",
 *   default_formatter = "person_formatter_type",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList",
 * )
 */

class PersonFieldType extends EntityReferenceItem {

  // /**
  //  * {@inheritdoc}
  //  */
  // public static function defaultStorageSettings() {
  //   return array(
  //     'target_type' => \Drupal::moduleHandler()->moduleExists('node') ? 'node' : 'user',
  //     'title' => '',
  //   ) + parent::defaultStorageSettings();
  // }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'target_id';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    

    $properties = parent::propertyDefinitions($field_definition);
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Rolle'));
    // $quantity_definition = DataDefinition::create('integer')
    //   ->setLabel(new TranslatableMarkup('Quantity'))
    //   ->setRequired(TRUE);
    // $properties['quantity'] = $quantity_definition;
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // $schema['columns'] = array(
    //   'title' => array(
    //     'type' => 'varchar',
    //     'length' => 255,
    //   ),
    //   'target_id' => $schema['columns']['target_id'],
    // );

    $schema = parent::schema($field_definition);
    // $schema['columns']['quantity'] = array(
    //   'type' => 'int',
    //   'size' => 'tiny',
    //   'unsigned' => TRUE,
    // );
    $schema['columns']['value'] = array(
      'type' => 'varchar',
      'length' => 60,
      'not null' => FALSE,
      'default' => '',
    );
   // $schema['indexes']['value'] = array('value');

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = FieldItemBase::getConstraints();
    // Remove the 'AllowedValuesConstraint' validation constraint because entity
    // reference fields already use the 'ValidReference' constraint.
    foreach ($constraints as $key => $constraint) {
      if ($constraint instanceof AllowedValuesConstraint) {
        unset($constraints[$key]);
      }
    }
    return $constraints;
  }

  public static function formProcessMergeParent($element) {
    $parents = $element['#parents'];
    array_pop($parents);
    $element['#parents'] = $parents;
    return NULL;
  }

  /**
   * Ajax callback for the handler settings form.
   *
   * @see static::fieldSettingsForm()
   */
  public static function settingsAjax($form, FormStateInterface $form_state) {
    return null;
  }

  /**
   * Submit handler for the non-JS case.
   *
   * @see static::fieldSettingsForm()
   */
  public static function settingsAjaxSubmit($form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public static function getPreconfiguredOptions() {
    $options = array();

    
    return $options;
  }


  // /**
  //  * {@inheritdoc}
  //  */
  // public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
  //   $manager = \Drupal::service('plugin.manager.entity_reference_selection');
  //   if ($referenceable = $manager->getSelectionHandler($field_definition)->getReferenceableEntities()) {
  //     $random = new Random();
  //     $group = array_rand($referenceable);
  //     $values['target_id'] = array_rand($referenceable[$group]);
  //     $values['title'] = $random->sentences(2);
  //     return $values;
  //   }
  // }


  // /**
  //  * {@inheritdoc}
  //  */
  // public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
  //   $elements = [];

  //   $elements['max_length'] = [
  //     '#type' => 'number',
  //     '#title' => t('Maximum length'),
  //     '#default_value' => $this->getSetting('max_length'),
  //     '#required' => TRUE,
  //     '#description' => t('The maximum length of the field in characters.'),
  //     '#min' => 1,
  //     '#disabled' => $has_data,
  //   ];

  //   return $elements;
  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function isEmpty() {
  //   $value = $this->get('value')->getValue();
  //   return $value === NULL || $value === '';
  // }

}
