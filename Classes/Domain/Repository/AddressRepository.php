<?php

declare(strict_types=1);

namespace Nitsan\NsOpenStreetmap\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Addresses
 */
class AddressRepository extends Repository
{
    /**
     * @param list<int|string> $addressId
     * @return QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findAddress(array $addressId): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching(
            $query->in('uid', $addressId)
        );
        return $query->execute();
    }
}
