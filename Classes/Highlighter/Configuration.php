<?php
namespace TYPO3\Beautyofcode\Highlighter;

/***************************************************************
 * Copyright notice
 *
 * (c) 2014 Thomas Juhnke <typo3@van-tomas.de>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * Configuration
 *
 * @package \TYPO3\Beautyofcode\Highlighter
 * @author Thomas Juhnke <typo3@van-tomas.de>
 * @license http://www.gnu.org/licenses/gpl.html
 *          GNU General Public License, version 3 or later
 * @link http://www.van-tomas.de/
 */
class Configuration implements ConfigurationInterface {

	/**
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 *
	 * @var array
	 */
	protected $settings;

	/**
	 *
	 * @var \TYPO3\Beautyofcode\Highlighter\ConfigurationInterface
	 */
	protected $configuration;


	/**
	 * injectObjectManager
	 *
	 * @param ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * injectConfiguration
	 *
	 * @param ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfiguration(ConfigurationManagerInterface $configurationManager) {
		$configuration = $configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		$this->settings = ArrayUtility::getValueByPath($configuration, 'plugin./tx_beautyofcode./settings.');
	}

	/**
	 * initializeObject
	 *
	 * @return void
	 */
	public function initializeObject() {
		$this->configuration = $this->objectManager->get(
			'TYPO3\\Beautyofcode\\Highlighter\\Configuration\\' . $this->settings['library'],
			$this->settings
		);
	}


	/**
	 * getFailSafeBrushAlias
	 *
	 * @param string $brushAlias
	 * @return string
	 */
	public function getFailSafeBrushAlias($brushAlias) {
		return $this->configuration->getFailSafeBrushAlias($brushAlias);
	}

	/**
	 * hasBrushIdentifier
	 *
	 * @param string $brushIdentifier
	 * @return boolean
	 */
	public function hasBrushIdentifier($brushIdentifier) {
		return $this->configuration->hasBrushIdentifier($brushIdentifier);
	}

	/**
	 * hasBrushAlias
	 *
	 * @param string $brushAlias
	 * @return boolean
	 */
	public function hasBrushAlias($brushAlias) {
		return $this->configuration->hasBrushAlias($brushAlias);
	}

	/**
	 * getBrushIdentifierAliasAndLabel
	 *
	 * @param string $brushIdentifier
	 * @return array
	 */
	public function getBrushIdentifierAliasAndLabel($brushIdentifier) {
		return $this->configuration->getBrushIdentifierAliasAndLabel($brushIdentifier);
	}

	/**
	 * getAutoloaderBrushMap
	 *
	 * @return array
	 */
	public function getAutoloaderBrushMap() {
		return $this->configuration->getAutoloaderBrushMap();
	}

	/**
	 * getClassAttributeString
	 *
	 * @param \TYPO3\Beautyofcode\Domain\Model\Flexform $flexform
	 * @return string
	 */
	public function getClassAttributeString(\TYPO3\Beautyofcode\Domain\Model\Flexform $flexform) {
		return $this->configuration->getClassAttributeString($flexform);
	}
}
?>