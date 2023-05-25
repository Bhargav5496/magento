<?php 

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
        parent::__construct();
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('bhargav')->__('Bhargav Information'));
	}

	public function getBhargav()
    {
        return Mage::registry('current_bhargav');
    }

    protected function _beforeToHtml()
    {
        $bhargav = Mage::registry('current_bhargav');
        $setModel = Mage::getModel('eav/entity_attribute_set');

        if (!($setId = $bhargav->getAttributeSetId())) {
            $setId = $this->getRequest()->getParam('set', null);
        }

        if ($setModel->load($setId)->getAttributeSetId()) {
            
            $bhargavAttributes = Mage::getResourceModel('bhargav/bhargav_attribute_collection');

            if (!$bhargav->getId()) {
                foreach ($bhargavAttributes as $attribute) {
                    $default = $attribute->getDefaultValue();
                    if ($default != '') {
                        $bhargav->setData($attribute->getAttributeCode(), $default);
                    }
                }
            }

            $groupCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
                ->setAttributeSetFilter($setId)
                ->setSortOrder()
                ->load();

            $defaultGroupId = 0;
            foreach ($groupCollection as $group) {
                if ($defaultGroupId == 0 or $group->getIsDefault()) {
                    $defaultGroupId = $group->getId();
                }

            }	

            foreach ($groupCollection as $group) {
                $attributes = array();
                foreach ($bhargavAttributes as $attribute) {
                    if ($bhargav->checkInGroup($attribute->getId(),$setId, $group->getId())) {
                        $attributes[] = $attribute;
                    }
                }

                if (!$attributes) {
                    continue;
                }

                $active = $defaultGroupId == $group->getId();
                $block = $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_edit_tab_attributes')
                    ->setGroup($group)
                    ->setAttributes($attributes)
                    ->setAddHiddenFields($active)
                    ->toHtml();

                $this->addTab('group_' . $group->getId(), array(
                    'label'     => Mage::helper('bhargav')->__($group->getAttributeGroupName()),
                    'content'   => $block,
                    'active'    => $active
                ));
            }
        } else {
            $this->addTab('set', array(
                'label'     => Mage::helper('bhargav')->__('Settings'),
                'content'   => $this->_translateHtml($this->getLayout()
                    ->createBlock('bhargav/adminhtml_bhargav_edit_tab_setting')->toHtml()),
                'active'    => true
            ));
        }
      return parent::_beforeToHtml();
    }

    protected function _translateHtml($html)
    {
        Mage::getSingleton('core/translate_inline')->processResponseBody($html);
        return $html;
    }
}