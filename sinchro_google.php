<?php 
/*
* Sinchro datebase and google table, throuth google scrits && start 
*/
    $url = "https://script.google.com/macros/s/AKfycbxFiAKVxBn4RnzcQZq4DH_8eyIQKr_VMcfkGAGZme0rYK7i1V8/exec";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url.'?req=1');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($curl);
    $id = $response;
    curl_close($curl);
    
    $servername = "localhost";              // локалхост
    $username   = "a0520296_admin";         // имя пользователя
    $password   = "T33JTEes";               // пароль если существует
    $dbname     = "a0520296_congress_2021"; // база данных

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка соединения
    if ($conn->connect_error) {
       die("Ошибка подключения: " . $conn->connect_error);
    }
    
    $result = $conn->query("SELECT * FROM `users` WHERE `id` > '$id'");

    while ($row = mysqli_fetch_array($result)) {
        $tmp_url = $url.'?email='.urlencode($row['email']).'&city='.urlencode($row['city']).'&helion='.urlencode($row['region'])
.'&country='.urlencode($row['country']).'&job='.urlencode($row['place']).'&spec='.urlencode($row['post'])
.'&name='.urlencode($row['name']).'&lastname='.urlencode($row['lastname'])
.'&phone='.urlencode($row['phone']).'&id='.$row['id'].'&country='.urlencode($row['country']).'&visit='.urlencode($row['visit']);
        echo "<br>".$tmp_url.'<br>';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $tmp_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($curl);
        curl_close($curl);
        file_put_contents('sinchro_log.txt', date( "d.m.y H:i" ).PHP_EOL.$response.PHP_EOL, FILE_APPEND | LOCK_EX); 
    }

?>

