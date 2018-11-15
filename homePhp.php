<html>

<body>
    <div id="content-message">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="text" name="message"> <input type="submit">
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
    $messages="";

    $message = isset($_POST['message']) ? $_POST['message'] : NULL;
    showMessage($conn);
    if(empty($_POST["message"])){
       
    }else{
        insertMessage($_POST["message"], $conn);
         showMessage($conn);
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
            echo "connection succes";
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
