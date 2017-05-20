<?php
class Straightarrow_SlickSlider_Model_Mysql4_SlickSlider_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
 {
     public function _construct()
     {
         parent::_construct();
         $this->_init('slickslider/slickslider');
     }
}