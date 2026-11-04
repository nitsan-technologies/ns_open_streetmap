<?php

declare(strict_types=1);

namespace Nitsan\NsOpenStreetmap\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Address
 */
class Address extends AbstractEntity
{
    protected string $title = '';

    protected string $infocontent = '';

    protected string $latitude = '';

    protected string $longitude = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getInfocontent(): string
    {
        return $this->infocontent;
    }

    public function setInfocontent(string $infocontent): void
    {
        $this->infocontent = $infocontent;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }
}
