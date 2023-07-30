<?php

class Ccc_Category_Model_Input_Practice extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('category/input_practice');
    }

    public function formateBirthTime()
    {
        $time = $this->getData('birth_time');

        $hour   = sprintf('%02d', $time[0]);
        $minute = sprintf('%02d', $time[1]);
        $second = sprintf('%02d', $time[2]);

        $formatedTime = $hour . ':' . $minute . ':' . $second;
        $this->addData(['birth_time' => $formatedTime]);
        return $this;
    }

    public function saveImage()
    {
        if ($_FILES['input_practice']['tmp_name']['image'] == null) {
            return $this;
        }

        $uploadedFile    = $_FILES['input_practice']['tmp_name']['image'];
        $destinationPath = Mage::getBaseDir('media') . DS . 'input' . DS . 'practice';
        $fileName        = $_FILES['input_practice']['name']['image'];
        $fileExtension   = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName     = $this->getId() . '.' . $fileExtension;

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $fileObject = new Varien_File_Uploader('input_practice[image]');
        $fileObject->save($destinationPath, $newFileName);

        $this->image = $newFileName;

        return $this->save();
    }
}
