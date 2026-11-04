<?php

declare(strict_types=1);

namespace Nitsan\NsOpenStreetmap\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Encodes a value as a JSON literal for safe use inside inline JavaScript.
 */
class EscapeViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function render(): string
    {
        $value = $this->renderChildren();

        return json_encode($value ?? '', JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?: '""';
    }
}
