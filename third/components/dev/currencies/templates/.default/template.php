<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>

<h3>Отношение <?=$arResult["source"]?> к другим валютам</h3>

<ul>
	<?php
		foreach($arResult["quotes"] as $curr => $val){
			?>
				<li><?=$curr?> - <?=$val?></li>
			<?
		}
	?>
</ul>