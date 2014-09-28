<?php
class Oye_Pushover_Model_System_Config_Source_Notifications {

    public function toOptionArray()
    {
        return array(
			array('value' => 'email', 'label'=> Mage::helper('oye_pushover')->__('Email')),
			array('value' => 'pushover', 'label'=> Mage::helper('oye_pushover')->__('Pushover'))
		);
    }

}
