<?php


class Straightarrow_SlickSlider_Block_Adminhtml_Addbutton extends Mage_Core_Block_Template {

    /**
     * prepare block's layout
     *
     * @return Magestore_Bannerslider_Block_Adminhtml_Addbutton
     */
    public function _prepareLayout() {
        return parent::_prepareLayout();
    }
    
    public function getUrlAddBanner(){                        
        $url = Mage::getSingleton('adminhtml/url')->getUrl('straightarrow_slickslider_admin/adminhtml_index/banners');
        return $url.'sliderid/'.$this->getRequest()->getParam('id');
    }
    
    public function getBanner($id){
        return Mage::getModel('slickslider/banners')->load($id);
    }
}