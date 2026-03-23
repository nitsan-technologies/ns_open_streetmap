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
