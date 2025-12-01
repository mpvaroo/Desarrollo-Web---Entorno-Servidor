<?php
class Persona
{
    private $nombre;
    private $apellido;
    private $edad;

    private static $numperson = 0;

    public function __construct($n, $a, $e)
    {
        $this->nombre   = $n;
        $this->apellido = $a;
        $this->edad     = $e;
        self::$numperson++;
    }

    public function __destruct()
    {
        self::$numperson--;
    }

    public static function numPerson(): int
    {
        return self::$numperson;
    }

    // Métodos mágicos para acceder a propiedades privadas
    public function __get(string $nombre)
    {
        return $this->$nombre;
    }

    public function __set(string $nombre, mixed $value)
    {
        $this->$nombre = $value;
        return $this;
    }

    // Representación en texto del objeto
    public function __toString()
    {
        return "Mi nombre es " . $this->nombre . " " . $this->apellido .
            " y tengo " . $this->edad . " años";
    }

    public function __clone(): void
    {
        $this->edad = 0;
        self::$numperson++;
    }

    public function __call(string $nombre, array $arguments): mixed
    {
        if ($nombre == "Modificar") {
            if (count($arguments = 1)) {
                $this->nombre = $arguments[0];
                $this->apellido = $arguments[1];
            }
            if (count($arguments = 2)) {
                $this->nombre = $arguments[0];
                $this->apellido = $arguments[1];
            }
            if (count($arguments = 3)) {
                $this->nombre = $arguments[0];
                $this->apellido = $arguments[1];
                $this->edad = $arguments[2];
            }
        }
        if($nombre== "calcular"){
            
        }
    }
}
