<?php 

class Straightarrow_SlickSlider_Block_Adminhtml_Banners_OverrideImage extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	 
	public function render(Varien_Object $row)
	{
		$value =  $row->getData($this->getColumn()->getIndex());
		if(!$value) {
			return;
		}
	    $imageName = Mage::helper('slider/slider')->reImageName($value);
	    $imageName = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/straightarrow/slickslider/' . $imageName;
		return '<img style="width:100%;" src="'.$imageName.'" alt="" />';
	}
 
}
?>