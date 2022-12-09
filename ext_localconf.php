<?php
defined('TYPO3_MODE') || die('Access denied.');
$_EXTKEY = 'ns_open_streetmap';
if (version_compare(TYPO3_branch, '11.0', '>=')) {
    $moduleClass = \Nitsan\NsOpenStreetmap\Controller\AddressController::class;
} else {
    $moduleClass = 'Address';
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_open_streetmap/Configuration/TSconfig/ContentElementWizard.tsconfig">');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
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

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['ns_open_streetmap'] = \Nitsan\NsOpenStreetmap\Hooks\PageLayoutView::class;