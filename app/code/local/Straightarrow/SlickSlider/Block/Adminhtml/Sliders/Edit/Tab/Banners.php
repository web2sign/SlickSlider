<?php
class Straightarrow_SlickSlider_Block_Adminhtml_Sliders_Edit_Tab_Banners extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct() {
        parent::__construct();
        $this->setId('bannergrid');
        $this->setDefaultSort('banner_id');
        $this->setUseAjax(true);
        if ($this->getRequest()->getParam('id')) {
            $this->setDefaultFilter(array('in_banner' => 1));
        }
    }

    protected function _addColumnFilterToCollection($column) {
        if ($column->getId() == 'in_custom') {
            $bannerIds = $this->_getSelectedBanners();

            if (empty($bannerIds)) {
                $bannerIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('banner_id', array('in' => $bannerIds));
            } else {
                if ($bannerIds) {
                    $this->getCollection()->addFieldToFilter('banner_id', array('nin' => $bannerIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('slickslider/banners')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('in_custom', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'name' => 'in_custom',
            'align' => 'center',
            'index' => 'banner_id',
            'values' => $this->_getSelectedBanners(),
        ));

        $this->addColumn('banner_id', array(
            'header' => 'ID',
            'width' => '50px',
            'index' => 'banner_id',
            'type' => 'number',
        ));

        $this->addColumn('name', array(
            'header' => 'Name',
            'index' => 'name'
        ));

        return parent::_prepareColumns();
    }

    //return url
    public function getGridUrl() {
        return $this->getData('grid_url') ? $this->getData('grid_url') : $this->getUrl('*/*/bannersGrid', array('_current' => true, 'id' => $this->getRequest()->getParam('id')));
    }

    public function getRowUrl($row) {
        return '';
    }

    public function getSelectedSliderBanners() {

        $tm_id = $this->getRequest()->getParam('id');
        if (!isset($tm_id)) {
            return array();
        }
        $collection = Mage::getModel('slicksliders/banners')->getCollection();
        $collection->addFieldToFilter('sliders_id', $tm_id);

        $bannerIds = array();
        foreach ($collection as $obj) {
            $bannerIds[$obj->getId()] = array('order_banner_slider' => $obj->getOrderBanner());
        }
        return $bannerIds;
    }

    protected function _getSelectedBanners() {
        $banners = $this->getRequest()->getParam('banner');
        if (!is_array($banners)) {
            $banners = array_keys($this->getSelectedSliderBanners());
        }
        return $banners;
    }

}