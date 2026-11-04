<?php

use Nitsan\NsOpenStreetmap\Controller\AddressController;
use Nitsan\NsOpenStreetmap\Evaluation\EvaluationLatitude;
use Nitsan\NsOpenStreetmap\Evaluation\EvaluationLongitude;
use Nitsan\NsOpenStreetmap\Form\Resolver\PremiumStripFlexFormNoTabsContainerResolver;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

ExtensionUtility::configurePlugin(
    'NsOpenStreetmap',
    'Map',
    [
        AddressController::class => 'list',
    ],
    // non-cacheable actions — kept as before so FE cache behaviour stays unchanged
    [
        AddressController::class => 'list',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][EvaluationLatitude::class] = '';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][EvaluationLongitude::class] = '';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1791980645] = [
    'nodeName' => 'flexFormNoTabsContainer',
    'priority' => 46,
    'class' => PremiumStripFlexFormNoTabsContainerResolver::class,
];
