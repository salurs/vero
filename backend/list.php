<?php

    header('Content-Type: application/json; charset=utf-8');

    $inputJSON = file_get_contents('php://input');
    $inputs = json_decode($inputJSON, true);

    $access_token = $inputs['access_token'] ?? '';

    if($access_token === ''){
        echo json_encode(['status' => false, 'message' => "Token required", 'data' => []]);
        exit; 
    }
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://api.baubuddy.de/dev/index.php/v1/tasks/select',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $access_token"
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo json_encode(['status' => false, 'message' => "cURL Error #:" . $err, 'data' => []]);
        exit;
      }

    $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $response = json_decode($response, true);

    $status = true;
    $message = 'Successfully';
    if (!str_starts_with($httpStatus, '2')) {
        $status = false;
        $message = $response['error']['message'] ?? 'Some Errors!';
    }

    echo json_encode(['status' => $status, 'message' => $message, 'data' => $response]);
    exit;
    