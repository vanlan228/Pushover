<?php
class Oye_Pushover_Model_System_Config_Source_Events {

    public function toOptionArray()
    {
        return array(
            array('value' => 'low_stock', 'label'=> Mage::helper('oye_pushover')->__('Low stock')),
            array('value' => 'failed_payment', 'label'=> Mage::helper('oye_pushover')->__('Failed payment')),
            array('value' => 'large_orders', 'label'=> Mage::helper('oye_pushover')->__('Large orders')),
            array('value' => 'unpaid_invoices', 'label'=> Mage::helper('oye_pushover')->__('Unpaid invoices')),
            array('value' => 'new_order', 'label'=> Mage::helper('oye_pushover')->__('New order')),
            array('value' => 'out_of_stock', 'label'=> Mage::helper('oye_pushover')->__('Out of stock')),
            array('value' => 'delivery_time_not_shown', 'label'=> Mage::helper('oye_pushover')->__('Delivery time not shown')),
            array('value' => 'product_options_disappears', 'label'=> Mage::helper('oye_pushover')->__('Product options disappears')),
            array('value' => 'when_delivery_times_change', 'label'=> Mage::helper('oye_pushover')->__('When delivery times change')),
            array('value' => 'notify_when_store_goes_down', 'label'=> Mage::helper('oye_pushover')->__('Notify when store goes down'))
        );
    }

}
