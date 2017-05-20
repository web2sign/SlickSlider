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
class Straightarrow_SlickSlider_Block_Adminhtml_Sliders_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct() {
    parent::__construct();
    $this->setId('slidersGrid');
    $this->setDefaultSort('id');
    $this->setDefaultDir('DESC');
    $this->setSaveParametersInSession(true);
  }
  protected function _prepareCollection() {
    $collection = Mage::getModel('slickslider/slickslider')->getCollection();
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
    $this->addColumn('description',
    array(
      'header' => 'Description',
      'align' =>'left',
      'index' => 'description',
    ));
    return parent::_prepareColumns();
  }

  public function getRowUrl($row) {
    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
}