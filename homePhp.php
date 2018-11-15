<?php   
    session_start();
    ?>
<html>

<body>
    <div id="content-message">
        <?php
            echo "session actuelle avec : " .$_SESSION["login_user"];
        ?>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <button type="submit" name="afficherUsers" value="AfficherUsers"> afficher les users </button>
    </form>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <button type="submit" name="afficherMessages" value="AfficherMessages"> afficher les messages </button>
    </form>
    </div>


</body>

</html>

<?php   
    
    $serverName = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $dbName = "tchat";
    $conn = connectDB();

    if (isset($_POST['afficherUsers']) && $_POST['afficherUsers'] == 'AfficherUsers'){
    $sql = "SELECT name, surname,id 
            FROM users";
    $req = $conn->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
    echo "<div id='content-users'>";
    while($row = $req->fetch_assoc()){
        echo "<div class='users'>" .$row["name"]."<form action='' method='POST'><button type='submit' name='sendMessage' value='$row[id]'>send message</button></form>    </div>";   
    }
    echo "</div>";
    }
    if (isset($_POST['afficherMessages']) && $_POST['afficherMessages'] == 'AfficherMessages'){
        $sql = "SELECT message, sender, id
                FROM messages
                WHERE receiver = '$_SESSION[login_user]' AND lu = 0";
        $req = $conn->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
        if(mysqli_num_rows($req)){
        echo "<div id='content-messages'>";
        while($row = $req->fetch_assoc()){
            echo "<div class='new-message'> Nouveau message de " .$row["sender"]." <form action='' method='POST'><button type ='submit' name='message' value ='$row[id]'>lire message</button></form></div>";   
        }
        echo "</div>";
    }else{
        echo "pas de nouveau message";
    }
    }
    
        if(isset($_POST["message"])){
            $_SESSION["idMessage"] = $_POST["message"];
            header("location: LireMessagePhp.php");
           
        }
        if(isset($_POST["sendMessage"])){
            $_SESSION["idReceiver"] = $_POST["sendMessage"];
            header("location: SendMessagePhp.php");
        }
    
    

?>
<?php   
    function insertMessage($Message,$conn){
      
        $sql = "INSERT INTO messages (sender, receiver, message )
        VALUES ('a','b','$Message ')";
    if( $conn->query($sql) === TRUE ){
        echo "New messages created " ;
    } else {
        echo "err" .$sql . "<br>" .$conn->error;
    }
    }

    function connectDB(){
     
        $conn = new mysqli($GLOBALS["serverName"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"],$GLOBALS["dbName"]);
            if($conn->connect_error){
                die("connection failed : " .$conn->connect_error);
            }
            return $conn;
    }

    function showMessage($conn){
        $sql = "SELECT message
        FROM messages";
if($result = $conn->query($sql)){
    while($row = $result->fetch_assoc()){
        {
           echo "<br>message : " . $row["message"];
        }
    }
}
    }


?>
