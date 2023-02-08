<?php

Class Curriences
{     
    public function GetCurriences(){
        global $USER; 
        //Подключение по токену

        include "install/connect_service.php";

        $NAME_IB = $ourData["result"]["name"];
        $code_IB = translit($NAME_IB);

        $Filter_IB = CIBlock::GetList(
            Array(),
            Array("NAME"=>$NAME_IB),
            false);

        if($res_filter_IB = $Filter_IB->Fetch())
        {
            $ID_NEW_IB = $res_filter_IB["ID"];
        }
        else{
            // echo "<script>console.log(Инфоблока с наименованием ". $NAME_IB ." нет /n Для создания инфоблока необходимо переустановить модуль);</script>";
        }

        $main_section = $ID_NEW_IB ;
        $main_section_ingreds = $ID_NEW_INGRS_IB;
        $categories = $ourData["result"]["categories"];
        $products = $ourData["result"]["products"];

        $ingredients = $ourData["result"]["ingredients"];
        $ingredientsGroups = $ourData["result"]["ingredientsGroups"];
        $ingredientsSchemes = $ourData["result"]["ingredientsSchemes"];

        include "create_category_products.php";
        include "create_ingredients.php";
        
        return true;
        
    }
    
    
    function AgentUpdateRkeeper(){
        CRkeeperUpdates::GetData();
        return "CRkeeperUpdates::AgentUpdateRkeeper();";
    }
}

?>