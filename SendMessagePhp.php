<html>

<body>
    <a href="homePhp.php"><button>revenir page home</button></a>
    <div>Nouveau message a <?php   ?> </div>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="text" name="message">
        <button type="submit" name="send" value="Send"> envoyer </button>
    </form>
    


</body>

</html>



<?php
session_start();
$serverName = "localhost";
$serverUsername = "root";
$serverPassword = "";
$dbName = "tchat";
$conn = connectDB();

    $sql = "SELECT email FROM users WHERE id = $_SESSION[idReceiver]";
    $req = $conn->query($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
    $result = $req->fetch_array();
    $receiverEmail = $result["email"];

    if(isset($_POST["send"]) && $_POST["send"] == "Send"){
        $sql = "INSERT INTO messages (sender, receiver, message) VALUES ('test', '$receiverEmail', '$_POST[message]')";
        $conn->query($sql) or die("Erreur SQL !". $sql .'<br/>'. mysqli_error());
    }

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