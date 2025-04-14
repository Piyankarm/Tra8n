<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get inputs
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? ''; // Format: dd-mm-yyyy

if ($from && $to && $date) {
    $url = "https://cttrainsapi.confirmtkt.com/api/v1/trains/search?sourceStationCode=$from&destinationStationCode=$to&addAvailabilityCache=true&excludeMultiTicketAlternates=false&excludeBoostAlternates=false&sortBy=DEFAULT&dateOfJourney=$date";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
} else {
    echo json_encode(["error" => "Missing parameters"]);
}