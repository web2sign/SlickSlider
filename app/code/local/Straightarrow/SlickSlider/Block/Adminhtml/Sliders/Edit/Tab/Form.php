<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Sliders_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm() {
    $form = new Varien_Data_Form();
    $this->setForm($form);

    $slider_id = $this->getRequest()->getParam('id');
    $slider = Mage::getModel('slickslider/slickslider')->load($slider_id);


    $name = $slider->getName() ? $slider->getName() : '';
    $description = $slider->getDescription() ? $slider->getDescription() : '';
    $status = $slider->getStatus() ? $slider->getStatus() : '';
    $position = $slider->getPosition() ? $slider->getPosition() : 'before_content';
    $params = $slider->getParams() ? $slider->getParams() : '';
    $page = $slider->getPage() ? $slider->getPage() : '';


    $fieldset = $form->addFieldset('sliders_form', ['legend'=>'Slider Information']);
    $fieldset->addField('name', 'text', [
        'label' => 'Name',
        'class' => 'required-entry',
        'required' => true,
        'name' => 'name',
        'value'=>$name
      ]
    );

    $fieldset->addField('description', 'textarea', [
        'label' => 'Description',
        'required' => false,
        'name' => 'description',
        'value' => $description
      ]
    );

    $fieldset->addField('status', 'select', array(
        'label' => 'Status',
        'name' => 'status',
        'values' => [
            [
                'value' => 1,
                'label' => 'Enabled',
            ],
            [
                'value' => 0,
                'label' => 'Disabled',
            ],
        ],
        'value'=>$status
    ));

    $_page_option = Mage::getModel('cms/page')->getCollection()->toOptionArray();
    $_page_all = ['value'=>'_all', 'label'=>'All'];
    $_page_option[0] = $_page_all;
    $fieldset->addField('page', 'select', array(
        'label' => 'Page',
        'name' => 'page',
        'values' => $_page_option,
        'value'=>$page
    ));




    $fieldset->addField('position', 'select', array(
        'label' => 'Position',
        'name' => 'position',
        'values' => [
            [
                'value' => 'header',
                'label' => 'Header',
            ],
            [
                'value' => 'content',
                'label' => 'Content',
            ],
            [
                'value' => 'footer',
                'label' => 'Footer',
            ]
        ],
        'value'=>$position
    ));


    $fieldset->addField('params', 'textarea', [
        'label' => 'Slick Parameters',
        'required' => false,
        'name' => 'params',
        'value'=>$params
      ]
    );

    if ( Mage::registry('sliders_data') )
    {
      $form->setValues(Mage::registry('sliders_data')->getData());
    }

    return parent::_prepareForm();
  }
}