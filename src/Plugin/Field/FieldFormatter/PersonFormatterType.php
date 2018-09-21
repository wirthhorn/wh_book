<?php

namespace Drupal\wh_book\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the 'person_formatter_type' formatter.
 *
 * @FieldFormatter(
 *   id = "person_formatter_type",
 *   label = @Translation("Person formatter type"),
 *   field_types = {
 *     "person_field_type"
 *   }
 * )
 */
class PersonFormatterType extends EntityReferenceLabelFormatter {
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
  
    return $elements;
  }
}

