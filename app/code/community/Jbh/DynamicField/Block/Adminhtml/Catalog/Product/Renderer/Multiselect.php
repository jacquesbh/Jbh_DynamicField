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
 * Adminhtml_Catalog_Product_Renderer_Multiselect Block
 * @package Jbh_DynamicField
 */
class Jbh_DynamicField_Block_Adminhtml_Catalog_Product_Renderer_Multiselect extends Varien_Data_Form_Element_Multiselect
{

    /**
     * Retrieve element html
     * @access public
     * @return string
     */
    public function getElementHtml()
    {
        // The main attribute as HTML
        $html = parent::getElementHtml();

        // The "new value" field
        $oldName = $this->getData('name');
        $this->setData('name', 'jbh_dynamicfield_' . $oldName);
        $name = Varien_Data_Form_Element_Abstract::getName();
        $this->setData('name', $oldName);
        
        $htmlId = 'jbh_dynamicfield_' . $this->getHtmlId();
        $placeholder = Mage::helper('jbh_dynamicfield')->__('New value');
        $html .= <<<HTML
<input id="{$htmlId}" name="{$name}" value="" class="input-text" type="text" style="width: 274px !important;" placeholder="{$placeholder}" />
HTML;

        // Continue =)
        return $html;
    }

}
