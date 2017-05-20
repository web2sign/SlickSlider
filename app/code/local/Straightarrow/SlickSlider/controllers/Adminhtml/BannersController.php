<?php 
class Straightarrow_SlickSlider_Adminhtml_BannersController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction() {
		$this->loadLayout()->_setActiveMenu('slickslider/banners')->_addBreadcrumb('Banner Manager','Banner Manager');
		return $this;
	}

	public function indexAction() {
		$this->_initAction();
		$this->renderLayout();
	}

	public function editAction() {
		$banners_id = $this->getRequest()->getParam('id');
		$BannersModel = Mage::getModel('slickslider/banners')->load($banners_id);
		if ($BannersModel->getId() || $banners_id == 0) {
			Mage::register('slickslider_data', $BannersModel);
			$this->loadLayout();
			$this->_setActiveMenu('slickslider/banners');
			$this->_addBreadcrumb('Banner Manager', 'Banner Manager');
			$this->_addBreadcrumb('Banner Description', 'Banner Description');
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent( $this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_banners_edit'))->_addLeft($this->getLayout()->createBlock('straightarrow_slickslider/adminhtml_banners_edit_tabs') );
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

		if ($postData = $this->getRequest()->getPost()) {
			try {
				$redirectBack = $this->getRequest()->getParam('back', false);
				$BannersModel = Mage::getModel('slickslider/banners');
				if( $this->getRequest()->getParam('id') <= 0 )
				$BannersModel->setCreatedTime( Mage::getSingleton('core/date')->gmtDate() );

	            if (isset($postData['image']['delete'])) {
	                Mage::helper('slider/slider')->deleteImage($postData['image']['value']);
	            }

	            $image = Mage::helper('slider/slider')->uploadImage();
	            if ($image || (isset($postData['image']['delete']) && $postData['image']['delete'])) {
	                $postData['image'] = $image;
	            } else {
	                unset($postData['image']);
	            }

				$BannersModel->addData($postData)->setUpdateTime( Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'));
				$BannersModel->save();

				Mage::getSingleton('adminhtml/session')->addSuccess('Successfully Saved');
				Mage::getSingleton('adminhtml/session')->settestData(false);
				if($redirectBack) {
			        $this->_redirect('*/*/edit', array(
			            'id'    => $BannersModel->getId(),
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
				$BannersModel = Mage::getModel('slickslider/banners');
				$BannersModel->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess('successfully deleted');
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
}