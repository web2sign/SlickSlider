<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Sliders_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  public function __construct() {
    parent::__construct();
    $this->setId('sliders_tabs');
    $this->setDestElementId('edit_form');
    $this->setTitle('Manage Slider');
  }

  protected function _beforeToHtml() {
    $this->addTab('information_section', [
      'label' => 'Information',
      'title' => 'Information',
      'content' => $this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_sliders_edit_tab_form')->toHtml()
    ]);

    #if ($this->getRequest()->getParam('active_tab') == 'banners') {
    #    $this->addTab('banner_section', array(
    #        'label' => 'Banners',
    #        'title' => 'Banners',
    #        'url' => $this->getUrl('*/*/banners', array('_current' => true, 'id' => $this->getRequest()->getParam('id'))),
    #        'class' => 'ajax',
    #        'active' => true,
    #    ));
    #} else {
    #    $this->addTab('banner_section', array(
    #        'label' => 'Banners',
    #        'title' => 'Banners',
    #        'url' => $this->getUrl('*/*/banners', array('_current' => true, 'id' => $this->getRequest()->getParam('id'))),
    #        'class' => 'ajax',
    #    ));
    #}

    #echo $this->getUrl('*/*/banners', array('_current' => true, 'id' => $this->getRequest()->getParam('id')));

    return parent::_beforeToHtml();
  }
}