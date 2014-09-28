<?php

class Oye_Pushover_Model_Observer {
	protected $_token;
	protected $_userkey;

	public function sendNewOrderNotification($observer) {
		if (Oye_Pushover_Helper_Data::isEnable(Oye_Pushover_Helper_Data::NEW_ORDER)) {
			$event = $observer->getEvent();
      		$order = $observer->getEvent()->getOrder(); 
      		if (Oye_Pushover_Helper_Data::isSendPushOver()) {
    			$this->_sendNotificationViaPushover(__("New Order #%s from %s. Total : %s", $order->getIncrementId(), $order->getCustomerFirstname().' '.$order->getCustomerLastname(), $order->getGrandTotal().' '.$order->getOrderCurrencyCode()));
    		}
		}

		if (Oye_Pushover_Helper_Data::isEnable(Oye_Pushover_Helper_Data::LARGE_ORDERS)) {
			$event = $observer->getEvent();
      		$order = $observer->getEvent()->getOrder(); 
      		$amount = $order->getGrandTotal();
      		$defaultAmount = Mage::helper('oye_pushover')->getOrderAmount();

      		if (Oye_Pushover_Helper_Data::isSendPushOver() && $amount >= $defaultAmount ) {
    			$this->_sendNotificationViaPushover(__("Order #%s bigger then %s.", $order->getIncrementId(), $defaultAmount.' '.$order->getOrderCurrencyCode()));
    		}
		}
	}

	public function sendLowStockNotification($observer)
    {
    	if (Oye_Pushover_Helper_Data::isEnable(Oye_Pushover_Helper_Data::LOW_STOCK)) {
	        if (Oye_Pushover_Helper_Data::isSendPushOver()) {
		        $stockItem = $observer->getEvent()->getItem();
		        if($stockItem->getQty() < $stockItem->getNotifyStockQty()){
		            $product = Mage::getModel('catalog/product')->load($stockItem->getProductId());
		            $message = "{$product->getName()} : {$product->getSku()} just Ran out of stock.\n";
		            $message .= "Low Stock Date: {$stockItem->getLowStockDate()}\n";
		            $this->_sendNotificationViaPushover($message);
		        }
		    }
    	}

    	if (Oye_Pushover_Helper_Data::isEnable(Oye_Pushover_Helper_Data::OUT_OF_STOCK)) {
	        if (Oye_Pushover_Helper_Data::isSendPushOver()) {
		        $stockItem = $observer->getEvent()->getItem();
	            $product = Mage::getModel('catalog/product')->load($stockItem->getProductId());
	            if ( !$product->isAvailable() ) {
	            	$message = "{$product->getName()} : {$product->getSku()} out of stock.\n";
	            	$this->_sendNotificationViaPushover($message);
	            }
		    }
    	}
    }

	protected function _sendNotificationViaPushover($message) {
		try {
			$this->_token = Mage::getStoreConfig('oye_pushover/oye_group/oye_token',Mage::app()->getStore());
      		$this->_userkey = Mage::getStoreConfig('oye_pushover/oye_group/oye_userkey',Mage::app()->getStore());
	    	$push = new Pushover_Api(); 
	    	$push->setToken($this->_token); 
	    	$push->setUser($this->_userkey);   
	    	$push->setMessage($message); 
	    	$push->setDebug(true);
	    	if ($push->validateUser() == false) {
	    		Mage::log('Notes : No user active : ', null, 'pushover.log');
	    		return false;
	    	} 
	    	$go = $push->send();
	    } catch(Exception $e) {
	    	Mage::log('Error '.$e->getMessage(), null, 'pushover.log');
	    }
    }

    protected function _sendNotificationViaEmail($message) {

    } 
}