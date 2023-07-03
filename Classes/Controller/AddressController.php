<?php
namespace Nitsan\NsOpenStreetmap\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\ResponseInterface;
use Nitsan\NsOpenStreetmap\Domain\Repository\AddressRepository;

/***
 *
 * This file is part of the "[Nitsan] Open Street Map" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017
 *
 ***/

/**
 * AddressController
 */
class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * addressRepository
     *
     */
    protected $addressRepository;

    /**
     * contentObj
     */
    protected $contentObj = null;    

    public function __construct(AddressRepository $addressRepository){
        $this->addressRepository = $addressRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction():ResponseInterface
    {
        $configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $storageIds = '';
        $setting = $this->settings;
        $storageIds = $configuration['persistence']['storagePid'];
        $data = ['storageIds'=>$storageIds];

        $this->contentObj = $this->configurationManager->getContentObject();
        $data = $this->contentObj->data;

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