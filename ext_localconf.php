<?php

use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Nitsan\NsOpenStreetmap\Controller\AddressController;
use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;

defined('TYPO3_MODE') || die('Access denied.');
$_EXTKEY = 'ns_open_streetmap';
if (version_compare(TYPO3_branch, '11.0', '>=')) {
    $moduleClass = AddressController::class;
} else {
    $moduleClass = 'Address';
}
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_open_streetmap/Configuration/TSconfig/ContentElementWizard.tsconfig">');

ExtensionUtility::configurePlugin(
    'Nitsan.NsOpenStreetmap',
    'Map',
    [
        $moduleClass => 'list',
    ],
    // non-cacheable actions
    [
        $moduleClass => 'list',
    ]
);

/* set iconidentifier */
$iconRegistry = GeneralUtility::makeInstance(
    IconRegistry::class
);
$typeArray = [
    'ext-open-street-map-icon',
];
foreach ($typeArray as $currentType) {
    $iconRegistry->registerIcon(
        $currentType,
        BitmapIconProvider::class,
        ['source' => 'EXT:'. $_EXTKEY .'/Resources/Public/assets/Icons/ns_open_streetmap.svg']
    );
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/ContentElementWizard.tsconfig">'
);

// Register the class to be available in 'eval' of TCA
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Nitsan\NsOpenStreetmap\Evaluation\EvaluationLatitude::class] = '';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Nitsan\NsOpenStreetmap\Evaluation\EvaluationLongitude::class] = '';