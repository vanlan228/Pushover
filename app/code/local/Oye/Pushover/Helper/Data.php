<?php
class Oye_Pushover_Helper_Data extends Mage_Core_Helper_Abstract {
	
	// Low stock event
	const LOW_STOCK = 'low_stock';

	// Failed payment event
	const FAILED_PAYMENT = 'failed_payment';

	// Large orders event
	const LARGE_ORDERS = 'large_orders';

	// Unpaid invoices event
	const UNPAID_INVOICES = 'unpaid_invoices';

	// New order event
	const NEW_ORDER = 'new_order';

	// Out of stock event
	const OUT_OF_STOCK = 'out_of_stock';

	// Delivery time not shown event
	const DELIVERY_TIME_NOT_SHOWN = 'delivery_time_not_shown';

	// Product options disappears event
	const PRODUCT_OPTIONS_DISAPPEARS = 'product_options_disappears';

	// When delivery times change event
	const WHEN_DELIVERY_TIMES_CHANGE = 'when_delivery_times_change';

	// Notify when store goes down event
	const NOTIFY_WHEN_STORE_GOES_DOWN = 'notify_when_store_goes_down';

	public function getEventsAsArray() {
		$Events = explode(',',Mage::getStoreConfig('oye_pushover/oye_group/oye_events',Mage::app()->getStore()));
		return $Events;
	}

	public function getOrderAmount() {
		return Mage::getStoreConfig('oye_pushover/oye_group/oye_qty',Mage::app()->getStore());
	}

	public function getNotificationsAsArray() {
		$Notifications = explode(',', Mage::getStoreConfig('oye_pushover/oye_group/oye_notifications',Mage::app()->getStore()));
		return $Notifications;
	}

	public static function isEnable($code) {
		$Events = self::getEventsAsArray();
		return in_array($code, $Events);
	}

	public static function isSendEmail() {
		$Notifications = self::getNotificationsAsArray();
		return in_array('email', $Notifications);
	}

	public static function isSendPushOver() {
		$Notifications = self::getNotificationsAsArray();
		return in_array('pushover', $Notifications);
	}

}