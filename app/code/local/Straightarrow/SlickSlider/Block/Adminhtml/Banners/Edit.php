<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Banners_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
  public function __construct() {
    parent::__construct();

    $this->_formScripts[] = " function saveAndContinueEdit(){
            editForm.submit($('edit_form').action+'back/edit/');
        }
    ";
    $this->_objectId = 'id';
    //vwe assign the same blockGroup as the Grid Container
    $this->_blockGroup = 'straightarrow_slickslider';
    //and the same controller
    $this->_controller = 'adminhtml_banners';
    //define the label for the save and delete button
    $this->_updateButton('save', 'label','Save Banner');
    $this->_updateButton('delete', 'label', 'Delete Banner');
    $this->_addButton('save_and_continue', array(
         'label' => 'Save And Continue Edit',
         'onclick' => 'saveAndContinueEdit( \''.$this->getSaveAndContinueUrl().'\' )',
         'class' => 'save' 
     ), -100);
  }

  /* Here, we're looking if we have transmitted a form object,
  to update the good text in the header of the page (edit or add) */
  public function getHeaderText() {

    if( $this->getRequest()->getParam('id') ) {
      return 'Edit Banner';
    } else {
      return 'Add Banner';
    }
  }
}