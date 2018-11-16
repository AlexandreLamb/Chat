<?php

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
        $nameErr = "Name is required";
       
      } else {
        $name = test_input($_POST["name"]);
      }
      if (empty($_POST["surname"])) {
        $isNoErr= FALSE; 
        $surnameErr = "Surname is required";

      } else {
        $surname = test_input($_POST["surname"]);
       
      }
      if (empty($_POST["email"])) {
        $isNoErr= FALSE; 
        $emailErr = "Email is required";

      } else {
          if(searchEmail($conn,$_POST["email"])){     
            $email = test_input($_POST["email"]);
          }
          else{
              $emailErr = "Adresse email deja utilisé";
              $isNoErr = FALSE;
          }
      }
      if (empty($_POST["password"])) {
        $isNoErr= FALSE;
        $passwordErr = "Passsword is required";      
      } else {
        $password = test_input($_POST["password"]);
      }
      if ($_POST["password"] != $_POST["passwordConf"] ) {
        $isNoErr= FALSE; 
        $passwordConfErr = "Passsword should be the same";
      }   
}


function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>