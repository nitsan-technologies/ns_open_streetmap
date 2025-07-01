<?php

$EM_CONF['ns_open_streetmap'] = [
    'title' => 'TYPO3 OpenStreetMap Integration',
    'description' => 'Easily embed interactive maps from OpenStreetMap into your TYPO3 website. Supports multiple map styles, location markers, popups, and over 10 customization options—fully compatible with TYPO3 v12 and v13.',
		
    'category' => 'plugin',
    'author' => 'Team T3Planet',
    'author_email' => 'info@t3planet.de',
    'author_company' => 'T3Planet',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'version' => '13.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-13.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
