<?php
$pass="Manuel24";
$passmd5= md5($pass);
echo $passmd5;


$pass2="Manuel224";
$pass2md5= md5($pass2);
echo "<br>". $pass2md5;

if($passmd5 == md5("Manuel24")){
    echo "<br> Contraseña correcta";
}else{
    echo "<br> Contraseña incorrecta";
}


echo"<br>Encriptacion BCRYPT <br>";
$passbcrypt =password_hash($pass,PASSWORD_DEFAULT);
echo $passbcrypt;
echo"<br><br>";
$pass2bcrypt =password_hash($pass2,PASSWORD_DEFAULT);
echo $pass2bcrypt;

if(password_verify($pass, $pass2bcrypt)){
    echo "<br>Contraseña correcta";
}else{
    echo "<br>Contraseña Incorrecta";
}
?>