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
            'Authorization: lzozhtu6beY6WS0buhhze5ch8MOpwhK5uKrxsTmwvrcaEekd8NnYbb2UOsUM7Xh3'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function notifRegister($nowa, $nama, $kuota, $expired, $image, $type) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://jogja.wablas.com/api/send-image',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'phone' => $nowa,
            'image' => $image,
            'caption' => "Halo {$nama},\n\n*Kamu Berhasil Registrasi!*\nType Member: {$type}\nKuota: {$kuota}\nExpired: {$expired}"
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: lzozhtu6beY6WS0buhhze5ch8MOpwhK5uKrxsTmwvrcaEekd8NnYbb2UOsUM7Xh3'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

?>