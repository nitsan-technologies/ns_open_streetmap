<?php
namespace Nitsan\NsOpenStreetmap\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\ResponseInterface;

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
     * @var \Nitsan\NsOpenStreetmap\Domain\Repository\AddressRepository
     */
    protected $addressRepository = null;

    /**
     * contentObj
     */
    protected $contentObj = null;    
    /**
     * @param \Nitsan\NsOpenStreetmap\Domain\Repository\AddressRepository $addressRepository
     */
    public function injectAddressRepository(\Nitsan\NsOpenStreetmap\Domain\Repository\AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction()
    {
        $configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $storageIds = '';
        $setting = $this->settings;
        $showResult = $setting['showresult'] ?? null;
        if($showResult != 1){
            $storageIds = $configuration['persistence']['storagePid'];
        }
        $data = ['storageIds'=>$storageIds];

        $this->contentObj = $this->configurationManager->getContentObject();
        $data = $this->contentObj->data;

        if (empty($this->settings['address'])) {
            $address = $this->addressRepository->findAll()->toArray();
        } else {
            $addressId = GeneralUtility::trimExplode(',', $this->settings['address']);
            $address = $this->addressRepository->findAddress($addressId)->toArray();
        }
        $this->view->assign('locations', $address);
        $this->view->assign('data', $data);
        return $this->htmlResponse();
    }
}