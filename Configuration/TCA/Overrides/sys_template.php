<?php
defined('TYPO3') or die();


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ns_open_streetmap', 'Configuration/TypoScript', '[Nitsan] OpenStreetMap');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsopenstreetmap_domain_model_address', 'EXT:ns_open_streetmap/Resources/Private/Language/locallang_csh_tx_nsopenstreetmap_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsopenstreetmap_domain_model_address');
