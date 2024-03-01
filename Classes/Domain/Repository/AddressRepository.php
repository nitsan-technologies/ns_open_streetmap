<?php

namespace Nitsan\NsOpenStreetmap\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

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
 * The repository for Addresses
 */
class AddressRepository extends Repository
{
    /**
     * @param array $addressId
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findAddress(array $addressId)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->in('uid', $addressId)
        );
        return $query->execute();
    }
}
