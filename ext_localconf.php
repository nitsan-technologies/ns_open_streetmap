<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Nitsan\NsOpenStreetmap\Controller\AddressController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') || die('Access denied.');
$_EXTKEY = 'ns_open_streetmap';

ExtensionUtility::configurePlugin(
    'NsOpenStreetmap',
    'Map',
    [
        AddressController::class => 'list',
    ],
    // non-cacheable actions
    [
        AddressController::class => 'list',
    ]
);

/* set iconidentifier */
$iconRegistry = GeneralUtility::makeInstance(
    IconRegistry::class
);
$iconRegistry->registerIcon(
    'ext-open-street-map-icon',
    SvgIconProvider::class,
    ['source' => 'EXT:'. $_EXTKEY .'/Resources/Public/assets/Icons/ns_open_streetmap.svg']
);
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;

// Register the class to be available in 'eval' of TCA
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Nitsan\NsOpenStreetmap\Evaluation\EvaluationLatitude::class] = '';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Nitsan\NsOpenStreetmap\Evaluation\EvaluationLongitude::class] = '';
