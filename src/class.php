<?php

  // Basic example of declaring a Class
  // Instantiating a Class (Creating an Object)
  // Accessing a method inside a Class

  // Declar Class
  class Test {

    // When defining a variable inside a class you must use 'var'
    // 'var' is not needed (it's optional) outside a class in the global scope
    // Theses are 'Insatnce Variables' or 'Attributes' or 'Properties'
    var $first_name;
    var $last_name;

    // Set another, this time with a default variable
    var $arm_count = 2;

    // Declare a method inside the Class
    function class_method() {
      echo "Hello from inside a Class<br>";
    }

    // $this
    function class_this() {
      // Use $this to reference something from this INSTANCE (not the actual class)
      echo htmlentities("Hello from inside the Class '" . get_class($this) . "'") . "<br>";
    }

    // access another method within this Class Instance using $this
    function method_this() {
      $this->class_this();
    }

    // ======================================
    // Simple example of using OO programming
    function full_name() {
      return $this->first_name . " " . $this->last_name;
    }
  }

// Instantiate an instance of the Class
$class = new Test;

// Access a method inside that Class
$class->class_method();

// Instantiate a different instance of the same Class
$person = new Test;

// Access the same method inside this instance of the Class
$person->class_method();

$class->class_this();

echo "<br>";

$class->method_this();

echo "<hr>";

// There is no '$' before the instance variable you want to reference
// Putting a '$' would make it a dynamic variable (variable variable)
// Adding parenthesis tells it whether it is accessing a variable or a method. e.g. arm_count();
echo $person->arm_count . "<br>";

// We can also set a variable in the same way
$person->arm_count = 4;

// The following demonstrates the use of different instances in OO programming.
// 'arm_count' has a different value in each instance
echo $person->arm_count . "<br>";
echo $class->arm_count . "<br>";

echo "<hr>";

// ==============================
// Good example of OO programming
$class->first_name = "Kate";
$class->last_name = "Beckinsale";
$person->first_name = "Mila";
$person->last_name = "Kunis";

echo $class->full_name() . "<br>";
echo $person->full_name() . "<br>";
// =============================

echo "<hr>";

// Show all defined vars OF THE CLASS (not instance), whether they have a value or not.
// Shows the value if it has one
$vars = get_class_vars('Test');
foreach($vars as $var => $value) {
  echo "{$var}: {$value}<br>";
}


?>
