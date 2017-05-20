<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Banners_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareLayout()
    {
        $return = parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        return $return;
    }

  protected function _prepareForm() {
    $form = new Varien_Data_Form();
    $this->setForm($form);

    $banner_id = $this->getRequest()->getParam('id');
    $banner = Mage::getModel('slickslider/banners')->load($banner_id);


    $name = $banner->getName() ? $banner->getName() : '';
    $color_style = $banner->getColor_style() ? $banner->getColor_style() : '';
    $status = $banner->getStatus() ? $banner->getStatus() : '';
    $image = $banner->getImage() ? $banner->getImage() : '';
    $parent = $banner->getId_sac_slider_main() ? $banner->getId_sac_slider_main() : '';
    $contents = $banner->getContents() ? $banner->getContents() : '';

    $imageName = Mage::helper('slider/slider')->reImageName($image);
    $imageName = 'straightarrow/slickslider/' . $imageName;
    if($image=='') {
        $imageName = "";
    }
    $data['name'] = $name;
    $data['status'] = $status;
    $data['color_style'] = $color_style;
    $data['image'] = $imageName;
    $data['id_sac_slider_main'] = $parent;
    $data['contents'] = $contents;

    $fieldset = $form->addFieldset('banners_form', ['legend'=>'Banner Information']);
    $fieldset->addField('name', 'text', [
        'label' => 'Name',
        'class' => 'required-entry',
        'required' => true,
        'name' => 'name',
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
        ]
    ));



    $option[] = array(
        'value' => '',
        'label' => 'Please select a slider'
    );
    $slider = Mage::getModel('slickslider/slickslider')->getCollection()->addFilter('status','1');
    foreach ($slider as $value) {
        $option[] = [
            'value' => $value->getId(),
            'label' => $value->getName(),
        ];
    }

    
    if (count($option) > 1){
        $fieldset->addField('id_sac_slider_main', 'select', array(
            'label' => 'Slider',
            'name' => 'id_sac_slider_main',
            'class' => 'required-entry',
            'required' => true,
            'values' => $option
        ));
    }
    

    $fieldset->addField('color_style', 'select', array(
        'label' => 'Style',
        'name' => 'color_style',
        'values' => [
            [
                'value' => 2,
                'label' => 'Light',
            ],
            [
                'value' => 1,
                'label' => 'Dark',
            ],
            [
                'value' => 0,
                'label' => 'None',
            ],
        ]
    ));


    $fieldset->addField('image', 'image', array(
        'label' => 'Banner Image',
        'required' => true,
        'name' => 'image',
    ));


    $fieldset->addField('contents', 'editor', [
            'name' => 'contents',
            'label' => 'Contents',
            'title' => 'Contents',
            'style' => 'height:36em;max-width:100%; width:900px',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'required' => false 
        ]
    );
    

    $form->setValues($data);

    if ( Mage::registry('banners_data') ) {
      $form->setValues(Mage::registry('banners_data')->getData());
    }

    return parent::_prepareForm();
  }
}