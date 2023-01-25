<?php
defined('TYPO3_MODE') or die();

$extKey = 'ns_open_streetmap';

// register plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nitsan.NsOpenStreetmap',
    'Map',
    'OpenStreetMap'
);

// Flexform
$pluginSignature = str_replace('_', '', $extKey) . '_map';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $extKey . '/Configuration/FlexForms/FlexForm.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key';