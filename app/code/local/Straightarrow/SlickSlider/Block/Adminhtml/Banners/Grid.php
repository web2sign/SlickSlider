<?php
/**
 * Straightarrow_SlickSlider
 *
 * @category Straightarrow
 * @package Straightarrow_SlickSlider
 * @author Roy Vincent Niepes <web2sign@gmail.com>
 * @copyright Copyright (c) 2015 straihtarrow.com.ph, Ltd (http://straihtarrow.com)
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */

/**
 * MenuManager menu grid
 *
 * @category    Striaghtarrow
 * @package     Straightarrow_SlickSlider
 */
class Straightarrow_SlickSlider_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct() {
    parent::__construct();
    $this->setId('bannersGrid');
    $this->setDefaultSort('id');
    $this->setDefaultDir('DESC');
    $this->setSaveParametersInSession(true);
  }
  protected function _prepareCollection() {
    $collection = Mage::getModel('slickslider/banners')->getCollection();



    $this->setCollection($collection);
    return parent::_prepareCollection();
  }

  protected function _prepareColumns() {
    $this->addColumn('id',
    array(
      'header' => 'ID',
      'align' =>'right',
      'width' => '50px',
      'index' => 'id',
    ));
    $this->addColumn('name',
    array(
      'header' => 'Name',
      'align' =>'left',
      'index' => 'name',
    ));
    $this->addColumn('id_sac_slider_main',
    array(
      'header' => 'Slider ID',
      'align' =>'left',
      'index' => 'id_sac_slider_main',
      'width'=>'50px',
    ));
    $this->addColumn('status',
    array(
      'header' => 'Status',
      'align' =>'left',
      'index' => 'status',
      'width'=>'70px',
      'renderer' => 'Straightarrow_SlickSlider_Block_Adminhtml_Banners_OverrideStatus'
    ));
    $this->addColumn('image',
    array(
      'header' => 'Image',
      'align' =>'left',
      'index' => 'image',
      'width'=>'70px',
      'renderer' => 'Straightarrow_SlickSlider_Block_Adminhtml_Banners_OverrideImage'
    ));
    return parent::_prepareColumns();
  }

  public function getRowUrl($row) {
    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
}