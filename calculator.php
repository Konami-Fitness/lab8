<?php

interface Exponent {
	public function power($o1, $o2);
}

abstract class Operation2 {
  protected $operand_1;
  protected $operand_2;
  public function __construct($o1, $o2) {
    // Make sure we're working with numbers...
    if (!is_numeric($o1) || !is_numeric($o2)) {
      throw new Exception('Non-numeric operand.');
    }

    // Assign passed values to member variables
    $this->operand_1 = $o1;
    $this->operand_2 = $o2;
  }
  public abstract function operate();
  public abstract function getEquation();
}

// Addition subclass inherits from Operation
class Addition extends Operation2 {
  public function operate() {
    return $this->operand_1 + $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
  }
}


// Add subclasses for Subtraction, Multiplication and Division here
class Subtraction extends Operation2 {
  public function operate() {
    return $this->operand_1 - $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Multiplication extends Operation2 {
  public function operate() {
    return $this->operand_1 * $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Division extends Operation2 {
  public function operate() {
    return $this->operand_1 / $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Exponent2 extends Operation1 implements Exponent {
  public function power($o1, $o2) {
    return pow($o1, $o2);
  }
  public function operate() {
    return power($this->operand_1, 2);
  }
  public function getEquation() {
    return $this->operand_1 . ' ^ 2 = ' . $this->operate();
  }

}

class ExponentY extends Operation2 implements Exponent{
  public function power($o1, $o2) {
    return pow($o1, $o2);
  }
  public function operate() {
    return power($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return $this->operand_1 . ' ^ ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

<<<<<<< Updated upstream
// Some debugs - uncomment these to see what is happening...
=======
//Some debugs - uncomment these to see what is happening...
>>>>>>> Stashed changes
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";


// Check to make sure that POST was received
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Instantiate an object for each operation based on the values returned on the form
// For example, check to make sure that $_POST is set and then check its value and
// instantiate its object
//
// The Add is done below.  Go ahead and finish the remiannig functions.
// Then tell me if there is a way to do this without the ifs
// We might cover such a way on Tuesday...

  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    }

// Put code for subtraction, multiplication, and division here
    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtraction($o1, $o2);
    }

    if (isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
      $op = new Division($o1, $o2);
    }

    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiplication($o1, $o2);
    }

    if (isset($_POST['expo']) && $_POST['expo'] == 'Exponent') {
      $op = new Exponent($o1, $o2);
    }
  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
<title>PHP Calculator</title>
</head>
<body>
	<h1>Konami Calculator</h1>
  <pre id="result">
  <?php
    if (isset($op)) {
      try {
        echo $op->getEquation();
      }
      catch (Exception $e) {
        $err[] = $e->getMessage();
      }
    }

    foreach($err as $error) {
        echo $error . "\n";
    }
  ?>
  </pre>
  <form method="post" action="calculator.php">
    <input type="text" name="op1" id="name" value="" autofocus/>
    <input type="text" name="op2" id="name" value="" />
    <br/>
    <!-- Only one of these will be set with their respective value at a time -->
<<<<<<< Updated upstream
    <input type="submit" name="add" value="Add" />
    <input type="submit" name="sub" value="Subtract" />
    <input type="submit" name="mult" value="Multiply" />
    <input type="submit" name="divi" value="Divide" />
    <input type="submit" name="expo" value="Exponent" />
=======
		<div class="left">
			<div class="leftrow">
				<input type="submit" name="add" value="Add" />
		    <input type="submit" name="sub" value="Subtract" />
		    <input type="submit" name="mult" value="Multiply" />
			</div>
			<div class="leftrowend">
				<input type="submit" name="divi" value="Divide" />
		    <input type="submit" name="expo" value="Exponent" />
			</div>
		</div>
		<div class="right">
			<div class="rightrow">
				<input type="submit" name="square" value="Square" />
				<input type="submit" name="sqrt" value="Sqrt" />
		    <input type="submit" name="log10" value="Log10" />
			</div>
			<div class="rightrow">
				<input type="submit" name="ln" value="Ln" />
		    <input type="submit" name="tenexp" value="10^x" />
		    <input type="submit" name="eexp" value="e^x" />
			</div>
			<div class="rightrow">
				<input type="submit" name="sin" value="Sin" />
		    <input type="submit" name="cos" value="Cos" />
		    <input type="submit" name="tan" value="Tan" />
			</div>
		</div>
>>>>>>> Stashed changes
  </form>
</body>
</html>
