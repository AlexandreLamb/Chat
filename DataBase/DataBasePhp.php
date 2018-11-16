<?php
// Definiton des constantes de la DB
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'tchat');
?>

<?php
function connectDB(){  
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
        if($conn->connect_error){
            die("connection failed : " .$conn->connect_error);
        }
        return $conn;
}

?>

<?php
//Fonction de modification de la base de donnée
function insertUser($conn,$Name, $Surname, $Email, $Password){
    $Password = md5($conn->real_escape_string($Password));
    $sql = "INSERT INTO users (name, surname, email, password)
            VALUES ('$Name', '$Surname', '$Email', '$Password')";
           $conn->query($sql) or die("Erreur SQL !". $sql .'<br/>'. mysqli_error());
}


function searchEmail($conn,$email){
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