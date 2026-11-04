<?php

declare(strict_types=1);

namespace Nitsan\NsOpenStreetmap\Controller;

use Nitsan\NsOpenStreetmap\Domain\Repository\AddressRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

/**
 * AddressController
 */
class AddressController extends ActionController
{
    protected AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @throws InvalidQueryException
     */
    public function listAction(): ResponseInterface
    {
        $currentContentObject = $this->request->getAttribute('currentContentObject');
        $data = $currentContentObject->data;

        if (empty($this->settings['address'])) {
            $address = $this->addressRepository->findAll()->toArray();
        } else {
            $addressId = GeneralUtility::trimExplode(',', $this->settings['address']);
            $address = $this->addressRepository->findAddress($addressId)->toArray();
        }
        $this->view->assignMultiple(
            [
                'locations' => $address,
                'data' => $data,
            ]
        );
        return $this->htmlResponse();
    }
}
