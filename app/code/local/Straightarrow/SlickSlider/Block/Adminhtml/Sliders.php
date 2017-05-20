<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Sliders extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        //where is the controller
        $this->_controller = 'adminhtml_sliders';
        $this->_blockGroup = 'straightarrow_slickslider';
        //text in the admin header
        $this->_headerText = 'Manage Slider';
        //value of the add button
        $this->_addButtonLabel = 'Add Slider';

        parent::__construct();
    }
}