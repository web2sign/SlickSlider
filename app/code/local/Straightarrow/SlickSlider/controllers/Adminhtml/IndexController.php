<?php 
class Straightarrow_SlickSlider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction() {
		$this->loadLayout()->_setActiveMenu('slickslider/set_time')->_addBreadcrumb('Slick Slider Manager','Slick Slider Manager');
		return $this;
	}

	public function indexAction() {
		$this->_initAction();
		$this->renderLayout();
	}

	public function editAction() {
		$slicksliderId = $this->getRequest()->getParam('id');
		$slicksliderModel = Mage::getModel('slickslider/slickslider')->load($slicksliderId);
		if ($slicksliderModel->getId() || $slicksliderId == 0) {
			Mage::register('slickslider_data', $slicksliderModel);
			$this->loadLayout();
			$this->_setActiveMenu('slickslider/set_time');
			$this->_addBreadcrumb('SlickSlider Manager', 'SlickSlider Manager');
			$this->_addBreadcrumb('SlickSlider Description', 'SlickSlider Description');
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent( $this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_sliders_edit'))->_addLeft($this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_sliders_edit_tabs') );
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError('Test does not exist');
			$this->_redirect('*/*/');
		}

	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {

		$position = $this->getRequest()->getPost('position');

		if ($this->getRequest()->getPost()) {
			try {

				$postData = $this->getRequest()->getPost();
				$redirectBack   = $this->getRequest()->getParam('back', false);
				
				$slicksliderModel = Mage::getModel('slickslider/slickslider');
				//echo '<pre>'; var_dump($postData);	die('test');

				if( $this->getRequest()->getParam('id') <= 0 )
				$slicksliderModel->setCreatedTime( Mage::getSingleton('core/date')->gmtDate() );
				$slicksliderModel->addData($postData)->setUpdateTime( Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'));
				$slicksliderModel->save();

				Mage::getSingleton('adminhtml/session')->addSuccess('Successfully Saved');
				Mage::getSingleton('adminhtml/session')->settestData(false);
				if($redirectBack) {
			        $this->_redirect('*/*/edit', array(
			            'id'    =>  $slicksliderModel->getId(),
			            '_current'=>true
			        ));
				} else {
					$this->_redirect('*/*/');
				}
				return;
			} catch (Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->settestData($this->getRequest()->getPost());
				$this->_redirect('*/*/edit',array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}

	public function deleteAction() {
		if($this->getRequest()->getParam('id') > 0)
		{
			try
			{
				$slicksliderModel = Mage::getModel('slickslider/slickslider');
				$slicksliderModel->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess('Successfully Deleted');
				$this->_redirect('*/*/');
			}
			catch (Exception $e)
			{
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}


    protected function bannersAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('sliders.edit.tab.banners');
        //$this->setBanners( $this->getRequest()->getPost('banners', null) );
                
        $this->renderLayout();
    }

    public function bannersgridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('sliders.edit.tab.banners');
        $this->setBanners($this->getRequest()->getPost('banners', null));
        $this->renderLayout();
    }
}