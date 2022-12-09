<?php
defined('TYPO3_MODE') or die();

$extKey = 'ns_open_streetmap';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', '[Nitsan] OpenStreetMap');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsopenstreetmap_domain_model_address', 'EXT:ns_open_streetmap/Resources/Private/Language/locallang_csh_tx_nsopenstreetmap_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsopenstreetmap_domain_model_address');
