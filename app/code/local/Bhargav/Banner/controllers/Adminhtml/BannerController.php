<?php
class Bhargav_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
    public function uploadImagesAction()
    {
        try{

            $images = $_FILES['images'];

            if($images['error'][0]!=0){
                throw new Exception("Please select the banner image.", 1);
            }
            foreach ($images['name'] as $key => $type) {
                $extension = pathinfo($type, PATHINFO_EXTENSION);
            }


            foreach ($images['tmp_name'] as $index => $tmpName) {
                $model = Mage::getModel('banner/banner');
                $groupId = $this->getRequest()->getParam('group_id');
                $model->group_id = $groupId;
                $model->created_at = date("Y-M-D h:i:s");
                $model->save();
                
                $uploader = new Mage_Core_Model_File_Uploader('images[' . $index . ']');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $uploadDir = Mage::getBaseDir('media') . DS . 'Banner' . DS . 'original';

                $uploadedFilePath = $uploadDir . DS . $uploader->getUploadedFileName();
                if ($uploader->save($uploadDir, $model->getId().".".$extension)) {
                    $model->image = $model->getId().".".$extension;
                    $model->save();
                }
            }

            // echo "<pre>";print_r(Mage::getModel('banner/banner')->getCollection()->getItems());die;

            foreach (Mage::getModel('banner/banner')->getCollection()->getItems() as $data) {
                $originalImagePath = 'media/Banner/original/' . $data->image; 
                $height = $data->getHeight(); 
                $width = $data->getWidth();

                $resizedImagePath = 'media/Banner/resized/' . $data->image; 

                $imageObj = new Varien_Image($originalImagePath);
                $imageObj->constrainOnly(true);
                $imageObj->keepAspectRatio(true);
                $imageObj->keepFrame(false);
                $imageObj->resize($width, $height);
                $imageObj->save($resizedImagePath);
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Image was successfully uploaded'));
        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/adminhtml_group/edit',array('group_id'=>$this->getRequest()->getParam('group_id')));
    }

    public function saveGridaction()
    {
        try {
            $groupId = $this->getRequest()->getParam('group_id');

            $data = $this->getRequest()->getPost();
            foreach ($data['status'] as $id => $value) {
                $model = Mage::getModel('banner/banner');
                $model->setId($id);
                $model->status = $value;
                $model->save();
            }

            foreach ($data['position'] as $id => $value) {
                $model = Mage::getModel('banner/banner');
                $model->setId($id);
                $model->position = $value; 
                $model->save();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Status and position(s) updated.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/adminhtml_group/edit',array('group_id'=>$this->getRequest()->getParam('group_id')));
    }
}