<?php

Class Curriences
{     
    public function GetCurrencyPair($source,$currencies){
      
        $currencies_str = '';

        if (is_array($currencies)){

            foreach ($currencies as $val){
                $currencies_str[] .= $val;
            }

            $currencies = substr($currencies_str,-1);

        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/currency_data/live?source=$source&currencies=$currencies",
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

        // $cacheFile = 'cache' . DIRECTORY_SEPARATOR . md5('currency_list');
    
        // if (file_exists($cacheFile)) {
        //     $fh = fopen($cacheFile, 'r');
        //     $size = filesize($cacheFile);
        //     // $cacheTime = trim(fgets($fh));
        //     $cacheTime = filemtime($cacheFile);
    
        //     // if data was cached recently, return cached data
        //     if ($cacheTime > strtotime('-1 day')) {
        //         return fread($fh, $size);
        //     }
    
        //     // else delete cache file
        //     fclose($fh);
        //     unlink($cacheFile);
        // }

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
    
        
        // $fh = fopen($cacheFile, 'w');
        // fwrite($fh, time() . "\n");
        // fwrite($fh, $response);
        // fclose($fh);
    
        return $response;
    }
    
}

?>