<?php
/**
 * This file is part of Jbh_DynamicField for Magento.
 *
 * @license Lesser General Public License v3 (http://www.gnu.org/licenses/lgpl-3.0.txt)
 * @author Jacques Bodin-Hullin <jacques@bodin-hullin.net>
 * @category Jbh
 * @package Jbh_DynamicField
 * @copyright Copyright (c) 2013 Jacques Bodin-Hullin (http://jacques.sh/)
 */

/**
 * Catalog_Product_Attribute_Backend_Multiselect Model
 * @package Jbh_DynamicField
 */
class Jbh_DynamicField_Model_Catalog_Product_Attribute_Backend_Multiselect extends Mage_Eav_Model_Entity_Attribute_Backend_Array
{

    /**
     * Before save method
     *
     * @param Varien_Object $object
     * @return Jbh_DynamicField_Model_Catalog_Product_Attribute_Backend_Multiselect
     */
    public function beforeSave($object)
    {
        // Main attribute code
        $mainCode = $this->getAttribute()->getAttributeCode();

        // Dynamic attribute code
        $code = 'jbh_dynamicfield_' . $mainCode;

        // If we have a new value, we save it.
        if ($value = $object->getData($code)) {

            // Save the new option
            $this->getAttribute()->setOption(array(
                'value' => array(array($value))
            ))->save();

            // Get the new option ID
            foreach ($this->getAttribute()->getSource()->getAllOptions(false) as $option) {
                if ($option['label'] === $value) {
                    $id = $option['value'];
                    break;
                }
            }

            // Event :')
            Mage::dispatchEvent('jbh_dynamicfield_attribute_' . $mainCode . '_option_added', array(
                'object' => $object,
                'code'   => $code,
                'option' => new Varien_Object(array(
                    'value' => $value,
                    'id'    => $id
                ))
            ));

            // Set the new data
            $oldValue = $object->getData($mainCode);
            array_push($oldValue, $id);
            $object->setData($mainCode, $oldValue);
        }

        // Continue =)
        return parent::beforeSave($object);
    }

}
