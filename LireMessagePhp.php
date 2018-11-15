<html>

<body>
    <a href="homePhp.php"><button>Revenir a la page d'acceuil</button></a>


</body>

</html>
<?php
session_start();
$serverName = "localhost";
$serverUsername = "root";
$serverPassword = "";
$dbName = "tchat";
$conn = connectDB();

    $sql = "SELECT message,sender
            FROM messages
            WHERE id = $_SESSION[idMessage]";
    $req = $conn->query($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
    $result = $req->fetch_array();
    echo "message from ".$result["sender"]."</br> message : ". $result['message'];
    $sql = "UPDATE messages
            SET lu = 1
            WHERE id =$_SESSION[idMessage]";
    $conn->query($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());



?>
<?php
   function connectDB(){
     
    $conn = new mysqli($GLOBALS["serverName"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"],$GLOBALS["dbName"]);
        if($conn->connect_error){
            die("connection failed : " .$conn->connect_error);
        }
        return $conn;
}

?>