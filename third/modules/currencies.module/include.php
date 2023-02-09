<?php

Class Curriences
{     
    public function GetCurrencyPair($source,$currencies){
      
        $currencies_str = '';

        if (is_array($currencies)){

            foreach ($currencies as $val){
                $currencies_str[] .= $val.',';
            }

            $currencies = substr($currencies_str,-1);

        }

        $curl = curl_init();

        $url = 'https://api.apilayer.com/currency_data/live?currencies='.$currencies.'&source='.$source;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: rF9Cq4uGI01Qd2rvoHUaDR1jl0Qajc9a"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;
    }

    public function GetList(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/currency_data/list",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: rF9Cq4uGI01Qd2rvoHUaDR1jl0Qajc9a"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
    
    
        return $response;
    }
}

?>