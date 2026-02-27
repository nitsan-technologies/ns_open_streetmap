<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied');

$plugins = [
    ['Map', 'OpenStreetMap'],
];

$signatures = [];

    $signatures[] = ExtensionUtility::registerPlugin(
       'NsOpenStreetmap',
        'Map',
        'OpenStreetMap',
        '',
        'plugins',
    );

$config = [
    'NsOpenStreetmap_Map' => $signatures[0],
];

foreach ($config as $key => $value) {
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$value] =
        'recursive,select_key';

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$value] = 'pi_flexform';

    // @extensionScannerIgnoreLine
    ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        "FILE:EXT:ns_open_streetmap/Configuration/FlexForms/FlexForm.xml",
        $value
    );
    
    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--div--;plugin,pi_flexform,',
        $value,
        'after:subheader'
    );
}