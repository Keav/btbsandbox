<?php

  // Both class variables AND methods can be set as one of pubclic, protected or private

  class Car {
    var $wheels = 4;
    public $doors = 4;

    public function wheelsdoors() {
      return $this->wheels + $this->doors;
    }
  }


  class CompactCar extends Car {
    var $doors = 2;
  }

  $car1 = new Car();
  $car2 = new CompactCar();

  echo $car1->wheels . "<br>";
  echo $car1->doors . "<br>";
  echo $car1->wheelsdoors() . "<br>";

  echo "<br>";

  echo $car2->wheels . "<br>";
  echo $car2->doors . "<br>";
  echo $car2->wheelsdoors() . "<br>";

  echo "<hr>";
  // =============================
  // Static modifiers

  // We instantiate an OBJECT

  // NORMAL VARS AND METHODS ARE ACCESSED NORMALLY
  // INSTANCE VARS AND METHODS ARE ACCESSED WITH INSTANCE NOTATION $class->$value;
  // STATIC VARS AND METHODS MUST ALL BE ACCESSED USING STATIC NOTATION Class::$value;

  // Normally you reference an 'instance' to access a class (instance) method or variable.
  // e.g. $car = new Car();
  // $car->wheels;

  // However, if the variable or method is 'static' we can access it directly in the class without an instance
  // Note: with static methods you can't use $this!

  class Vehicle {

    public static $wheels = 4;

    public static function lorry() {
      // $wheels = 12; // If a NORMAL var is declared here, it can be accessed normally; but mixing normal and static vars and methods is probably not a good idea.
      // If trying to use a static variable, you must use the static :: notation, even within a method
      echo Vehicle::$wheels . "<br>";
    }
  }

  echo Vehicle::$wheels . "<br>";
  Vehicle::lorry();

  Vehicle::$wheels = 18;

  echo Vehicle::$wheels . "<br>";

  Vehicle::lorry();

  echo "<hr>";

  // Using static variables with class extension is NOT the same as using different instances
  // Take this example:

  class One {
    static $foo;
  }

  class Two extends One { }
  class Three extends One { }

  One::$foo=1;
  Two::$foo=2;
  Three::$foo=3;

  echo One::$foo; // 3
  echo Two::$foo; // 3
  Echo Three::$foo; // 3

  // All results come back as '3' because static $foo only really exists in one place 'One'.
?>