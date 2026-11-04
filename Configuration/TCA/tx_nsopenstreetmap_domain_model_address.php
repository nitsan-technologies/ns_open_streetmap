<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'default_sortby' => 'title ASC',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:ns_open_streetmap/Resources/Public/assets/Icons/tx_nsopenstreetmap_domain_model_address.gif',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                title, --palette--;;data,
                --div--;LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address.info_window,
                    infocontent,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    sys_language_uid, l10n_parent, l10n_diffsource,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden, --palette--;;time
            ',
        ],
    ],
    'palettes' => [
        'data' => ['showitem' => 'latitude, longitude'],
        'time' => ['showitem' => 'starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_nsopenstreetmap_domain_model_address',
                'foreign_table_where' => 'AND {#tx_nsopenstreetmap_domain_model_address}.{#pid}=###CURRENT_PID### AND {#tx_nsopenstreetmap_domain_model_address}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'infocontent' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address.infocontent',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'latitude' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address.latitude',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,' . \Nitsan\NsOpenStreetmap\Evaluation\EvaluationLatitude::class,
                'required' => true,
            ],
        ],
        'longitude' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_open_streetmap/Resources/Private/Language/locallang_db.xlf:tx_nsopenstreetmap_domain_model_address.longitude',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,' . \Nitsan\NsOpenStreetmap\Evaluation\EvaluationLongitude::class,
                'required' => true,
            ],
        ],
    ],
];
