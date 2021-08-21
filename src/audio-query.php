<?php
if (isset($_GET['text'])){
    $text = $_GET['text'];
    $file = fopen("debug.txt","w+");
    fwrite($file,$text);

    $curlcmd = curl_init();
    $headers = array(
        "Content-Type: application/json",
        "Accept: audio/wav",
        'Authorization: Basic '. base64_encode("apikey:OliQc6vE2wDnGGtxx1Q7BQoXRhv5C_d60DKXRqoExK5U")
    );

    $data = array(
        "text" => "$text"
    );


    foreach (glob("*.wav") as $filename) {
        //echo "$filename size " . filesize($filename) . "\n";
        fwrite($file, "\nfile $filename size: ".filesize($filename)."\n");
        fwrite($file, "\n result unlink $filename: ",unlink($filename));

    }

    $time = time();
    $filename = "result_$time.wav";
    $output = fopen($filename,"w");
    $opts = array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST=>true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FILE => $output
    );
    curl_setopt_array($curlcmd,$opts);
    $url = 'https://api.us-east.text-to-speech.watson.cloud.ibm.com/instances/e143b601-2f83-43e2-b8b0-3110025ad2e0/v1/synthesize';
    fwrite($file,"\nURL: ".$url);

    curl_setopt($curlcmd, CURLOPT_URL,$url);
    $response = curl_exec($curlcmd);
    curl_close($curlcmd);
    fclose($output);
    fclose($file);

    echo $filename;
}