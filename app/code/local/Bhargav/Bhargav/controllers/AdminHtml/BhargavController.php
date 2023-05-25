<?php 

class Bhargav_Bhargav_Adminhtml_BhargavController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('bhargav');
		$this->_title('Bhargav Grid');
		$this->_addContent($this->getLayout()->createBlock('bhargav/adminhtml_bhargav'));
		$this->renderLayout();
	}

	protected function _initBhargav()
    {
        $this->_title($this->__('Bhargav'))
            ->_title($this->__('Manage Bhargavs'));

        $bhargavId = (int) $this->getRequest()->getParam('id');
        $bhargav   = Mage::getModel('bhargav/bhargav')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($bhargavId);

        if (!$bhargavId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $bhargav->setAttributeSetId($setId);
            }
        }

        Mage::register('current_bhargav', $bhargav);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $bhargav;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$bhargavId = (int) $this->getRequest()->getParam('id');
        $bhargav   = $this->_initBhargav();
        
        if ($bhargavId && !$bhargav->getId()) {
            $this->_getSession()->addError(Mage::helper('bhargav')->__('This bhargav no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($bhargav->getName());

        $this->loadLayout();

        $this->_setActiveMenu('bhargav/bhargav');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $bhargavData = $this->getRequest()->getPost('account');            
            $bhargav = Mage::getSingleton('bhargav/bhargav');
            $bhargav->setAttributeSetId($setId);

            if ($bhargavId = $this->getRequest()->getParam('id')) {
                if (!$bhargav->load($bhargavId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $bhargav->addData($bhargavData);

            $bhargav->save();

            Mage::getSingleton('core/session')->addSuccess("bhargav data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $bhargavModel = Mage::getModel('bhargav/bhargav');

            if (!($bhargavId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$bhargavModel->load($bhargavId)) {
                throw new Exception('bhargav does not exist');
            }

            if (!$bhargavModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The bhargav has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}