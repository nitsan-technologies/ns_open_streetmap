<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Nitsan\NsOpenStreetmap\Controller\AddressController;

defined('TYPO3') || die('Access denied.');

ExtensionUtility::configurePlugin(
    'NsOpenStreetmap',
    'Map',
    [
        AddressController::class => 'list',
    ],
    // non-cacheable actions
    [
        AddressController::class => 'list',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1791980645] = [
    'nodeName' => 'flexFormNoTabsContainer',
    'priority' => 46,
    'class' => \Nitsan\NsOpenStreetmap\Form\Resolver\PremiumStripFlexFormNoTabsContainerResolver::class,
];
