<?php
require_once 'persona.php';

$p = new Persona("Pepe", "Sanchez", 25);

echo "<br>" . Persona::numPerson();

$p1 = new Persona("Maria", "Sanchez", 22);
echo "<br>" . Persona::numPerson();

unset($p1);
echo "<br>" . Persona::numPerson();

echo "<br>=================<br>";


$p->nombre = "Alejandro";  
echo $p->nombre;            

echo "<br>=================<br>";

echo $p;
$p2= clone($p);
echo $p2;
$p2->nombre="Juan";
echo$p;
echo $p2;
echo"<br>".Persona::numPerson();
$p->Modificar("Miguel", "Rodriguez, 98");
echo $p."<br>";
$p_json=json_encode($p);
var_dump($p_jason);
$p3=json_decode($p_jason);
echo"<br>";
var_dump($p3);

?>
