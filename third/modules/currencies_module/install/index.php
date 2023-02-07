<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

    Class currencies_module extends CModule
    {
        var $MODULE_ID = "currencies_module";
        var $MODULE_VERSION;
        var $MODULE_VERSION_DATE;
        var $MODULE_NAME;
        var $MODULE_DESCRIPTION;
        var $MODULE_CSS;

        function currencies_module()
        {
            $arModuleVersion = array();

            $path = str_replace("\\", "/", __FILE__);
            $path = substr($path, 0, strlen($path) - strlen("/index.php"));
            include($path."/version.php");

            if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
            {
                $this->MODULE_VERSION = $arModuleVersion["VERSION"];
                $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
            }

            $this->MODULE_NAME = "currencies_module – модуль с компонентом";
            $this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом dev:currencies";
        }

        function InstallFiles()
        {
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/currencies_module/install/components",
                        $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
            return true;
        }

        function UnInstallFiles()
        {
            DeleteDirFilesEx("/local/components/dev");
            return true;
        }

        function DoInstall()
        {
            global $DOCUMENT_ROOT, $APPLICATION;
            $this->InstallFiles();
            RegisterModule("currencies_module");
            $APPLICATION->IncludeAdminFile("Установка модуля currencies_module", $DOCUMENT_ROOT."/local/modules/currencies_module/install/step.php");
        }

        function DoUninstall()
        {
            global $DOCUMENT_ROOT, $APPLICATION;
            $this->UnInstallFiles();
            UnRegisterModule("currencies_module");
            $APPLICATION->IncludeAdminFile("Деинсталляция модуля currencies_module", $DOCUMENT_ROOT."/local/modules/currencies_module/install/unstep.php");
        }
    }
?>