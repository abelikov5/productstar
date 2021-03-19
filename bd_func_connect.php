<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: text/html');
    
    $servername = "localhost";              // локалхост
    $username   = "mkarpov_lvp";            // имя пользователя
    $password   = "LastVisitedPagesPS21";   // пароль если существует
    $dbname     = "mkarpov_lvp";            // база данных
    
    $email = $_GET['email'];
    $mini  = $_GET['mini'];
    $url   = $_GET['url'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
       die("Ошибка подключения: " . $conn->connect_error);
    } else {  // info to check bd connection if true;
    }
    
    function bd_add ($email, $mini, $url) {
        global $conn;

        $sql = "INSERT INTO `mini_users`(`email`, `mini`, `url`) VALUES ('$email', '$mini', '$url')";

        if (mysqli_query($conn, $sql)) {  //for debug info to check bd connection
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

     function bd_select ($email, $mini, $url) {
        global $conn;
        $result = $conn->query("SELECT * FROM `mini_users` WHERE `email` = '$email' AND `mini` = '$mini'");
        $result = mysqli_fetch_array($result);
        return $result['url'];
    }

    function bd_upd($email, $mini, $url) {
        global $conn;
        $sql = "UPDATE `mini_users` SET `url` = '$url', `timestamp` = now() WHERE`email` = '$email' AND `mini` = '$mini'";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo 'false';//"Error updating record: " . $conn->error;
        }
        $conn->close();
    }
    $last_url = bd_select($email, $mini, $url);  
    
    if ($last_url == $url) {
        echo 'false';
         return 'exist';
    }
    if (!$last_url) {
        bd_add ($email, $mini, $url);
        echo 'false';
        return 'false';
    }
    if ($last_url != $url) {
        bd_upd ($email, $mini, $url);
        echo $last_url;
        return $last_url;
    }
    
    echo 'false'; 
?>          
