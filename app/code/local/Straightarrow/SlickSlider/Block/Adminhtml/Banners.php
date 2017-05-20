<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Banners extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        //where is the controller
        $this->_controller = 'adminhtml_banners';
        $this->_blockGroup = 'straightarrow_slickslider';
        //text in the admin header
        $this->_headerText = 'Manage Banners';
        //value of the add button
        $this->_addButtonLabel = 'Add Banner';

        parent::__construct();
    }
}

