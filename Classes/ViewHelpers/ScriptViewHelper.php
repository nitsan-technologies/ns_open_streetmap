<?php

declare(strict_types=1);

namespace Nitsan\NsOpenStreetmap\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Renders a HTML-script value by moving it into a temporary file and adding it to the page.
 */
class ScriptViewHelper extends AbstractViewHelper
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
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterFile(
            GeneralUtility::writeJavaScriptContentToTemporaryFile((string)$this->renderChildren()),
            'text/javascript',
            true,
            false,
            '',
            true
        );

        return '';
    }
}
