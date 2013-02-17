# Dynamic field

Ce project est un module Magento.  
Mes excuses pour nos amis anglophones mais les explications sont en français.

## Comment utiliser un champ dynamique ?

Tout d'abord il faut vouloir un attribut à options tel qu'un attribut de type `select` ou `multiselect`.

Une fois que votre attribut est identifié il suffit de lui ajouter les deux options suivantes dans sa création.

### `input_renderer`

Il s'agit de la colonne `frontend_input_renderer` utilisée dans la table `catalog_eav_attribute`.

Les valeurs possibles sont :

*    `jbh_dynamicfield/adminhtml_catalog_product_renderer_select` : Quand votre champ est de type `select`.
*    `jbh_dynamicfield/adminhtml_catalog_product_renderer_multiselect` : Quand votre champ est de type `multiselect`.

### `backend`

Il s'agit de la colonne `backend_model` utilisée dans la table `eav_attribute`.

Les valeurs possibles sont :

*    `jbh_dynamicfield/catalog_product_attribute_backend_select` : Quand votre champ est de type `select`.
*    `jbh_dynamicfield/catalog_product_attribute_backend_multiselect` : Quand votre champ est de type `multiselect`.

## Exemple d'attribut à valeur multiple

```php
<?php
/* ... */
// Add the attribute `baz` with some fields
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'baz', array(
    'label'                      => 'The Baz', // The label ;)
    'group'                      => 'General', // The group (in the admin page)
    'input'                      => 'multiselect', // Used for the input type
    'required'                   => true, // Is it required?
    //'source'                     => '', // Used for a source model
    'backend'                    => 'jbh_dynamicfield/catalog_product_attribute_backend_multiselect', // Used for a backend model (before and after save, before and after load of the product)
    'input_renderer'             => 'jbh_dynamicfield/adminhtml_catalog_product_renderer_multiselect', // Used for a custom input renderer (admin only)
    //'frontend'                   => '', // Used for a frontend model (like the image frontend model with the getUrl method)
    //'class'                      => '', // Used for a backend HTML class (usefull for javascript validation – with the 'validate-email' class for example)
    'comparable'                 => false, // Comparable? (on front, via the comparable products).
    //'default'                    => '', // The default value
    'filterable'                 => false, // Filterable? (on front, in the category view or search)
    //'apply_to'                   => '', // Used for product type restrictions
    'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE, // The scope
    'is_configurable'            => false, // Is it a configurable attribute?
    'is_html_allowed_on_front'   => false, // Is HTML allowed on front?
    //'note'                       => '', // Maybe a simple note below the input field in admin
    'searchable'                 => false, // Is it searchable?
    'sort_order'                 => '', // Which position on the admin page?
    'type'                       => 'varchar', // The attribute type (varchar, text, int...)
    'unique'                     => false, // Is it unique?
    'used_for_sort_by'           => false, // Is it used for the 'sort by' select on a catalog/search page?
    'used_in_product_listing'    => true, // In Flat?
    'user_defined'               => false, // Is it user defined? If false the attribute isn't removable.
    'visible'                    => true, // Is it visible? If true the field appears in admin product page.
    'visible_in_advanced_search' => false, // Is it visible on advanced search?
    'wysiwyg_enabled'            => false, // Is Wywiwyg enable? (use 'editor' input if you put true ;))
));
```

