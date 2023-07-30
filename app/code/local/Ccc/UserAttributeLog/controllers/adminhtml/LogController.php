<?php
class Ccc_UserAttributeLog_Adminhtml_LogController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('userattributelog/adminhtml_log'));
        $this->renderLayout();
    }
}