<?php
class Straightarrow_SlickSlider_Model_SlickSlider extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('slickslider/slickslider');
     }
}