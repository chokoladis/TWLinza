<?
use Bitrix\Main\Localization\Loc;
use    Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use \Bitrix\Main\Data\Cache;

Loc::loadMessages(__FILE__);

include 'include.php';

$cache = Cache::createInstance();
 
$cachePath = 'CurrenciesModule';
$cacheTtl = 86400;
$cacheKey = 'CurrList'; 
 
if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $vars = $cache->getVars();
    $CurrList = $vars["CurrList"];
}
elseif ($cache->startDataCache())
{ 

    $CurrList = Curriences::GetList();
    $CurrList = json_decode($CurrList, true);

    $vars = [
        'CurrList' => $CurrList,
    ];
     
    $cache->endDataCache($vars);
}

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);

$arrValues = array();
$arrValues_checkbox = array();

foreach($CurrList["currencies"] as $curr => $descr){
    $arrValues[$curr] = $curr;

    $arrValues_checkbox[] = array(
        $curr, $curr, 'N'
    );

}

$aTabs = array(
    array(
        "DIV"       => "edit",
        "TAB"       => Loc::getMessage("MODULE_OPTIONS_TAB_NAME"),
        "TITLE"   => Loc::getMessage("MODULE_OPTIONS_TAB_NAME"),
        "OPTIONS" => array(
            Loc::getMessage("MODULE_OPTIONS_TAB_COMMON"),
            array(
                "switch_on",
                Loc::getMessage("MODULE_OPTIONS_TAB_SWITCH_ON"),
                    "Y",
                array("checkbox")
            ),           
            array(
                "source",
                Loc::getMessage("MODULE_OPTIONS_TAB_SOURCE"),
                    "RUB",
                array("selectbox", $arrValues)
            ),
            Loc::getMessage("MODULE_OPTIONS_TAB_CURRENCIES")
        )
    )
);

foreach ( $arrValues_checkbox as $checkbox => $value ){
    array_push($aTabs[0]["OPTIONS"], array( $value[0], $value[0], 'N', array("checkbox")) );
}

if($request->isPost() && check_bitrix_sessid()){

    foreach($aTabs as $aTab){

       foreach($aTab["OPTIONS"] as $arOption){

           if(!is_array($arOption)){

               continue;
           }

           if($arOption["note"]){

                continue;
           }

           if($request["apply"]){

                $optionValue = $request->getPost($arOption[0]);

              if($arOption[0] == "switch_on"){

                  if($optionValue == ""){

                       $optionValue = "N";
                   }
               }

               Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            }elseif($request["default"]){

             Option::set($module_id, $arOption[0], $arOption[2]);
            }
       }
   }

   LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}

$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);

$tabControl->Begin();

?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

<?
    foreach($aTabs as $aTab){

        if($aTab["OPTIONS"]){

            $tabControl->BeginNextTab();

            __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
        }
    }

   $tabControl->Buttons();
  ?>

   <input type="submit" name="apply" value="<? echo(Loc::GetMessage("MODULE_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />
    <input type="submit" name="default" value="<? echo(Loc::GetMessage("MODULE_OPTIONS_INPUT_DEFAULT")); ?>" />

   <?
   echo(bitrix_sessid_post());
 ?>

</form>
<?
$tabControl->End();