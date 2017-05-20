<?php
class Straightarrow_SlickSlider_Model_Mysql4_Banners extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
     {
         $this->_init('slickslider/banners', 'id');
     }
}