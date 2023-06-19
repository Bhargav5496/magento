<?php 

class Bhargav_Brand_Model_Observer extends Mage_Core_Model_Abstract
{
    public function saveRewriteUrlKey(Varien_Event_Observer $observer)
    {
        $brand = $observer->getData('brand'); 

        $urlKey = $brand->url_key;
        $rewriteUrl = $urlKey;

        $rewrite = Mage::getModel('core/url_rewrite')->getCollection()
            ->addFieldToFilter('request_path', $rewriteUrl)
            ->getFirstItem();

        if (!$rewrite->getId()) {
            $rewrite->setStoreId(0) 
                ->setIdPath('brand/' . $brand->getId())
                ->setRequestPath($rewriteUrl)
                ->setTargetPath('brand/index/view/id/' . $brand->getId())
                ->setIsSystem(0)
                ->save();
        }
    }

}