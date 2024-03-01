<?php

namespace Nitsan\NsOpenStreetmap\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/***
 *
 * This file is part of the "[Nitsan] OpenStreetMap" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017
 *
 ***/

/**
 * Address
 */
class Address extends AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * infocontent
     *
     * @var string
     */
    protected $infocontent = '';

    /**
     * latitude
     *
     * @var string
     */
    protected $latitude = '';

    /**
     * longitude
     *
     * @var string
     */
    protected $longitude = '';

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * Returns the infocontent
     *
     * @return string $infocontent
     */
    public function getInfocontent(): string
    {
        return $this->infocontent;
    }

    /**
     * Sets the infocontent
     *
     * @param string $infocontent
     * @return void
     */
    public function setInfocontent($infocontent): void
    {
        $this->infocontent = $infocontent;
    }

    /**
     * Returns the latitude
     *
     * @return string $latitude
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param string $latitude
     * @return void
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * Returns the longitude
     *
     * @return string $longitude
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude
     *
     * @param string $longitude
     * @return void
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }
}
