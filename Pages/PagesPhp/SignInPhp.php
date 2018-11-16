<?php
session_start();
require '..\..\DataBase/DataBasePhp.php';
require '..\..\Tests/TestSignInPhp.php';
require '..\PagesHtml/SignInHtml.html';

$conn = connectDB();

if($isNoErr){
    insertUser($conn, $name, $surname, $email, $password);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    
        $conn->close();
    echo "<div id='inscription-conf'>felicitations vous etes bien inscrits !</br>
            <a href='http://127.0.0.1/chat/Index.php'><button id='button-conf'>Ok</button></a>
          </div>";   
}


?>
