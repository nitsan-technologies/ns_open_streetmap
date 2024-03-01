<?php

defined('TYPO3') or die();


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'ns_open_streetmap',
    'Configuration/TypoScript',
    '[Nitsan] OpenStreetMap'
);
