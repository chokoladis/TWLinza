<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));

// $arComponentParameters = array(
// 	"PARAMETERS" => array(
// 		"USE_CAPTCHA" => Array(
// 			"NAME" => GetMessage("MFP_CAPTCHA"), 
// 			"TYPE" => "CHECKBOX",
// 			"DEFAULT" => "Y", 
// 			"PARENT" => "BASE",
// 		),
// 		"OK_TEXT" => Array(
// 			"NAME" => GetMessage("MFP_OK_MESSAGE"), 
// 			"TYPE" => "STRING",
// 			"DEFAULT" => GetMessage("MFP_OK_TEXT"), 
// 			"PARENT" => "BASE",
// 		)

// 	)
// );


?>