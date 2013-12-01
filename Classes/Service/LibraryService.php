<?php
namespace TYPO3\Beautyofcode\Service;

/***************************************************************
 * Copyright notice
 *
 * (c) 2013 Thomas Juhnke <tommy@van-tomas.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the textfile GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Library service implementation which initializes a concrete syntax highlighter library
 *
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class LibraryService implements \TYPO3\Beautyofcode\Service\LibraryServiceInterface {

	/**
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
	 */
	protected $objectManager;

	/**
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 *
	 * @var \TYPO3\Beautyofcode\Service\AbstractLibraryService
	 */
	protected $concreteLibraryService;

	/**
	 *
	 * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\Beautyofcode\Service\VersionAssetServiceInterface::setConfigurationManager()
	 */
	public function setConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}


	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\Beautyofcode\Service\LibraryServiceInterface::configure()
	 */
	public function configure($library) {
		$this->concreteLibraryService = $this->objectManager->get('TYPO3\\Beautyofcode\\Service\\' . ucfirst($library) . 'LibraryService');

		$this->concreteLibraryService->setConfigurationManager($this->configurationManager);

		$this->concreteLibraryService->configure();
	}

	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\Beautyofcode\Service\LibraryServiceInterface::load()
	 */
	public function load() {
		$this->concreteLibraryService->load();
	}

	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\Beautyofcode\Service\LibraryServiceInterface::pushClassAttributeConfiguration()
	 */
	public function pushClassAttributeConfiguration($key, $value) {
		$this->concreteLibraryService->pushClassAttributeConfiguration($key, $value);
	}


	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\Beautyofcode\Service\LibraryServiceInterface::getClassAttributeConfiguration()
	 */
	public function getClassAttributeConfiguration() {
		return $this->concreteLibraryService->getClassAttributeConfiguration();
	}
}
?>