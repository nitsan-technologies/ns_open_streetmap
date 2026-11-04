<?php

defined('TYPO3') || die('Access denied');

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$pluginSignature = ExtensionUtility::registerPlugin(
    'NsOpenStreetmap',
    'Map',
    'OpenStreetMap',
    '',
    'plugins',
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,pi_flexform,pages,',
    $pluginSignature,
    'after:subheader'
);

$flexFile = 'FILE:EXT:ns_open_streetmap/Configuration/FlexForms/FlexForm.xml';

// Type-specific FlexForm. Use a string ds — v14 migrates ds['default'] to this form anyway.
$GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['columnsOverrides']['pi_flexform']['config']['ds'] = $flexFile;

// Legacy ds map when Core still uses the array form (typical on v12/v13).
if (is_array($GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds'] ?? null)) {
    $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,' . $pluginSignature] = $flexFile;
}
