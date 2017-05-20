<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Banners_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  public function __construct() {
    parent::__construct();
    $this->setId('banners_tabs');
    $this->setDestElementId('edit_form');
    $this->setTitle('Manage Banner');
  }

  protected function _beforeToHtml() {
    $this->addTab('information_section', [
      'label' => 'Banner Information',
      'title' => 'Banner Information',
      'content' => $this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_banners_edit_tab_form')->toHtml()
    ]);
    return parent::_beforeToHtml();
  }
}