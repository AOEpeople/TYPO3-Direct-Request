<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TYPO3_CONF_VARS['EXTCONF']['tx_feuserregister']['addObserver'][] = 'EXT:' . $_EXTKEY . 'observers/class.tx_pagemailerfeuserregisterconnector_observer.php:tx_pagemailerfeuserregisterconnector_observer';
?>