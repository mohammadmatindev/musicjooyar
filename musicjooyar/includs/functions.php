<?php

function send_json($things, $code = 200)
{
    header("content-Type:application/json");
    http_response_code($code);
    echo json_encode($things);
    exit;
}

function send_sms_bot($token, $phone, $code)
{

    $params = [
        'to' => $token,
        'text' => " YOUR NUMBERPHONE IS " . $phone . " AND YOUR CODE IS " . $code,
    ];




    $ch = curl_init('https://notificator.ir/api/v1/send');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

    $result = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($result);

    return $result;

}

function token_genarator($len){
    $text = "QWERTYUIOPASDFGHJKLZXCVBNMmnbvcxzlkjhgfdsapoiuytrewq1234567890[]";
    $res = "";
    for($i=0;$i<=$len;$i++){
        $res .= $text[random_int(0, strlen($text) - 1)];
    }
    return $res;
}




