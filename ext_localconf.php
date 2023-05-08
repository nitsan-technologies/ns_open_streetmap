<?php
defined('TYPO3') || die('Access denied.');
$_EXTKEY = 'ns_open_streetmap';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_open_streetmap/Configuration/TSconfig/ContentElementWizard.tsconfig">');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'NsOpenStreetmap',
    'Map',
    [
        \Nitsan\NsOpenStreetmap\Controller\AddressController::class => 'list',
    ],
    // non-cacheable actions
    [
        \Nitsan\NsOpenStreetmap\Controller\AddressController::class => 'list',
    ]
);

/* set iconidentifier */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$typeArray = [
    'ext-open-street-map-icon',
];
foreach ($typeArray as $currentType) {
    $iconRegistry->registerIcon(
        $currentType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:'. $_EXTKEY .'/Resources/Public/assets/Icons/ns_open_streetmap.svg']
    );
}
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;
