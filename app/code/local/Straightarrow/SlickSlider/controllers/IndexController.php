<?php 
class Straightarrow_SlickSlider_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction() {
		$this->loadLayout();
		$this->renderLayout();
	}



	public function saveAction() {

		$name = ''.$this->getRequest()->getPost('name');
		
		if(isset($name)&&($name!='')) {
			$slider = Mage::getModel('slickslider/slickslider');
			$slider->setData('name', $name);
			$slider->save();
		}

		$this->_redirect('straightarrow_slickslider/index/index');
	}
}