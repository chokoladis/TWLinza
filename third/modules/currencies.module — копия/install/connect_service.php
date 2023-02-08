<?
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/live?source={source}&currencies={currencies}",
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
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

?>
