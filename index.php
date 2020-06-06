<?php
//check the validity of the email
if($_POST['submit']){
    if(!$_POST['email']) $error.="<br />please enter your email";
    
    else if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) $error.="<br />please enter a valid email";
    
     if(!$_POST['password']) $error.="<br />please enter your password";
    //Check the validite of PassWord
    else {
        if(strlen($_POST['password'])<8) $error.="<br />please enter at least 8 caracters password";
        
        if(!preg_match('`[A-Z]`', $_POST['password']))$error.="<br />please enter at least one capital letter in password";
    }
    //Print the Errot If there is an error
    if($error) echo "there is a error :".$error;
    //If there is not a error ...
    else{
        //Connect With the DataBase and Check if the email was reister before in DataBase
        $link= mysqli_connect("localhost","root","","note");
        $query ="SELECT * FROM `note` WHERE email='".mysqli_real_escape_string($link ,$_POST['email'])."'";
        
        $result= mysqli_query($link, $query);
        $results= mysqli_num_rows($result);
        //Tell the user a message if hisregister before  
        if($results) echo "that email address is already registered , Do you Want To logIn ?.";
        //If he don't register Before ...
        else {
            $query="INSERT INTO `note` (`email`, `password`)VALUES('".mysqli_real_escape_string($link ,$_POST['email'])."', '".$_POST['password']."')";
            mysqli_query($link, $query);
            echo "you SignUp";
        }
    }
}

?>
<form method="post">
    <input type="email" name="email" id="email"/>
    <input type="password" name="password" id="password"/>
    <input type="submit" name="submit" value="SignUp"/>
</form>