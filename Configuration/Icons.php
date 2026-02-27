<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'ext-open-street-map-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:ns_open_streetmap/Resources/Public/assets/Icons/ns_open_streetmap.svg',
    ],
];
