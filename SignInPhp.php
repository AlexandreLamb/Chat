<?php
session_start();


$serverName = "localhost";
$serverUsername = "root";
$serverPassword = "";
$dbName = "tchat";
$conn = connectDB();

$name ="";
$surname ="";
$email ="";
$password ="";

$nameErr ="";
$surnameErr ="";
$emailErr ="";
$passwordErr ="";
$passwordConfErr="";

$isNoErr = FALSE;
   
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription'){
    $isNoErr = TRUE;
    if (empty($_POST["name"])) {
        $isNoErr= FALSE; 
        $GLOBALS["nameErr"] = "Name is required";
       
      } else {
        $GLOBALS["name"] = test_input($_POST["name"]);
      }
      if (empty($_POST["surname"])) {
        $isNoErr= FALSE; 
        $GLOBALS["surnameErr"] = "Surname is required";

      } else {
        $GLOBALS["surname"] = test_input($_POST["surname"]);
       
      }
      if (empty($_POST["email"])) {
        $isNoErr= FALSE; 
        $GLOBALS["emailErr"] = "Email is required";

      } else {
       
        $GLOBALS["email"] = test_input($_POST["email"]);
        /*if(!searchEmail($GLOBALS["email"],$conn)){
            $GLOBALS["emailErr"] = "Email is already existing";
            $isNoErr = FALSE;
        }*/

      }
      if (empty($_POST["password"])) {
        $isNoErr= FALSE;
        $GLOBALS["passwordErr"] = "Passsword is required";      
      } else {
        $GLOBALS["password"] = test_input($_POST["password"]);
      }
      if ($_POST["password"] != $_POST["passwordConf"] ) {
        $isNoErr= FALSE; 
        $GLOBALS["passwordConfErr"] = "Passsword should be the same";
      }   
}


if($isNoErr){
    echo "ee";
    
    insertUser($conn, $name, $surname, $email, $password);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    echo "<div id='inscription-conf'>felicitations vous etes bien inscrits !</br>
            <a href='http://127.0.0.1/chat/LogginHtml.html'><button id='button-conf'>Ok</button></a>
          </div>";   
}


?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="InscriptionsCSS.css" />
</head>
<body>
    <div id="title"> Inscription </div>
    <form id="form-inscriptions" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" class="input-inscriptions" name="name" placeholder="Nom" value="<?php echo $name;?>">
        <span class="error">*
            <?php echo $nameErr;?></span>
        <br><br>
        <input type="text" class="input-inscriptions" name="surname" placeholder="Prenom" value="<?php echo $surname;?>">
        <span class="error">*
            <?php echo $surnameErr;?></span>
        <br><br>
        <input type="email" class="input-inscriptions" name="email" placeholder="email" value="<?php echo $email;?>">
        <span class="error">*
            <?php echo $emailErr;?></span>
        <br><br>
        <input type="password" class="input-inscriptions" name="password" placeholder="password">
        <span class="error">*
            <?php echo $passwordErr;?></span>
        <br><br>
        <input type="password" class="input-inscriptions" name="passwordConf" placeholder="password">
        <span class="error">*
            <?php echo $passwordConfErr;?></span>
        <br><br>

        <input type="submit" class="button-inscriptions" name ="inscription" value="Inscription">
    </form>

</body>

</html>
<?php

function connectDB(){
     
    $conn = new mysqli($GLOBALS["serverName"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"],$GLOBALS["dbName"]);
        if($conn->connect_error){
            die("connection failed : " .$conn->connect_error);
        }
        return $conn;
}

function insertUser($conn, $Name, $Surname, $Email, $Password){
    $Password = md5($conn->real_escape_string($Password));
    $sql = "SELECT id FROM users WHERE email='$Email'";
    $req = $conn->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
    $nb = mysqli_num_rows($req);
    if($nb == 0){
    $sql = "INSERT INTO users (name, surname, email, password)
            VALUES ('$Name', '$Surname', '$Email', '$Password')";
           $conn->query($sql) or die("Erreur SQL !". $sql .'<br/>'. mysqli_error());
            $id = $conn->insert_id;
            $_SESSION['id'] = $id;
    }
    else{
        $GLOBALS["emailErr"]= "email deja utilise !";
    }
        
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function searchEmail($email,$conn){
    $sql = "SELECT email
            FROM users";
    if($result = $conn->query($sql)){
        while($row = $result->fetch_assoc()){
            if( $row["email"] ==$email ){
                return FALSE;
            }
        }
    }
    return TRUE;
}
  
?>