<?php
function generateDescription($prompt) {
    $apiKey = 'AIzaSyDo0Mf9AowDEG1s7ZcWXACsx4NputmPH9w'; // ✅ Your Gemini API key
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey"; // ✅ Fixed here

    $data = [
        'contents' => [
            ['parts' => [['text' => $prompt]]]
        ]
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json",
            'content' => json_encode($data)
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if (!$result) {
        return "❌ Gemini API request failed.";
    }

    $response = json_decode($result, true);

    return $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from Gemini.';
}
?>
