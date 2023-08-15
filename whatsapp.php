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
            'Authorization: wGb8cNRwZUcGMqMoN8V12dxEDEiu9DY6xHUUGrj72302UgKZAfHsSspWoBXhBiwD'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function notifRegister($nowa, $nama, $kuota, $expired, $image) {
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
            'caption' => "Halo {$nama},\n\nKamu Berhasil Registrasi!\nKuota: {$kuota}\nExpired: {$expired}"
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: wGb8cNRwZUcGMqMoN8V12dxEDEiu9DY6xHUUGrj72302UgKZAfHsSspWoBXhBiwD'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

?>