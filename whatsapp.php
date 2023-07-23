<?php 

function notifLogin($nowa, $nama, $kuota, $expired) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://jogja.wablas.com/api/send-message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'phone' => $nowa,
            'message' => "Halo {$nama},\n\nKamu Berhasil Check-in!\nSisa Kuota: {$kuota}\nExpired: {$expired} Hari lagi"
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: token'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

?>