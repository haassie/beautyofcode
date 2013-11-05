<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
	$_EXTKEY,
	'Configuration/TypoScript/Static/',
	'beautyOfCode Syntax Highlighter'
);

\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tt_content');

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:beautyofcode/Resources/Private/Language/locallang_db.xml:tt_content.list_type_pi1',
		$_EXTKEY . '_pi1'
	),
	'list_type'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi1',
	'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/flexform_ds_pi1.xml'
);

if (TYPO3_MODE == 'BE') {
	$wizardIcon = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Utility/class.tx_beautyofcode_pi1_wizicon.php';
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_beautyofcode_pi1_wizicon'] = $wizardIcon;
}
?>