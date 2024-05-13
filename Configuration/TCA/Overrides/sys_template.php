<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') or die();

$extKey = 'ns_open_streetmap';

ExtensionManagementUtility::addStaticFile(
    $extKey,
    'Configuration/TypoScript',
    'OpenStreetMap'
);

ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_nsopenstreetmap_domain_model_address',
    'EXT:ns_open_streetmap/Resources/Private/Language/locallang_csh_tx_nsopenstreetmap_domain_model_address.xlf'
);
ExtensionManagementUtility::allowTableOnStandardPages('tx_nsopenstreetmap_domain_model_address');
