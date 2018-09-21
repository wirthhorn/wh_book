<?php

namespace Drupal\wh_book\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;
use Drupal\Component\Utility\NestedArray;


/**
 * Plugin implementation of the 'person_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "person_widget_type",
 *   label = @Translation("Person widget type"),
 *   field_types = {
 *     "person_field_type"
 *   }
 * )
 */
class PersonWidgetType extends EntityReferenceAutocompleteWidget {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $widget = parent::formElement($items, $delta, $element, $form, $form_state);

    // $widget['quantity'] = array(
    //   '#title' => $this->t('Quantity'),
    //   '#type' => 'number',
    //   '#default_value' => 1,
    //   '#min' => 1,
    //   '#weight' => 10,
    // );

    $options = array(
      'author' => $this->t('Autor'),
      'illustrator' => $this->t('Illustrator'),
      'editor' => $this->t('Editeur'),
    );
    
     $widget['value'] = array(
      '#title' => $this->t('Rolle'),
      '#type' => 'select',
      '#options' => $options,
      '#empty_value' => '',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : null,
      '#description' => t('Wählen Sie eine Rolle aus'),

    );

    return $widget;

  }

}
