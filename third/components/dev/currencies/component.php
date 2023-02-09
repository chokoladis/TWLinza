<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

use \Bitrix\Main\Loader;
use \Bitrix\Main\Loader\Loc;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Data\Cache;

include_once 'local/modules/currencies.module/include.php';

$cache = Cache::createInstance();

$cachePath = 'CurrenciesModule';
$cacheTtl = 86400;
$cacheKey = 'CurrParams';

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $vars = $cache->getVars();
    $params = $vars["params"];

}
elseif ($cache->startDataCache())
{ 
    $CurrAllOpts = \Bitrix\Main\Config\Option::getForModule(
        "currencies.module",
        's1'
    );

    foreach ($CurrAllOpts as $opt => $value){
        if($value != NULL && $opt != 'switch_on'){
            $params[$opt] = $value;
        }
    }

    $vars = [
        'params' => $params,
    ];
    
    $cache->endDataCache($vars);
}


$cache_CurrPair = Cache::createInstance();

$cachePath = 'CurrenciesModule';
$cacheTtl = 3600;
$cacheKey = 'CurrPair22';

if ($cache_CurrPair->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $vars = $cache_CurrPair->getVars();
    $CurrPairJson = $vars["CurrPairJson"];

}
elseif ($cache_CurrPair->startDataCache())
{ 
    
    $CurriencesPair = '';

    foreach($params as $param => $val){
        if ($param != 'source' && $param != 'switch_on'){
            $CurriencesPair .= $param.',';
        }
    }

    $CurriencesPair = substr($CurriencesPair,0, -1);

    $Curriences = New Curriences;
    $CurrPairJson = $Curriences->GetCurrencyPair($params['source'],$CurriencesPair);

    $vars = [
        'CurrPairJson' => $CurrPairJson,
    ];
    
    $cache_CurrPair->endDataCache($vars);
}

$arResult = json_decode($CurrPairJson,true);

$this->IncludeComponentTemplate();
