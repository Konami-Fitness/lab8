<?php 
interface Exponent {
  public function expo();
}

abstract class Operation1 {
  protected $operand_1;
  public function __construct($o1) {
    if (!is_numeric($o1)) {
      throw new Exception('Non-numeric operand.');
    }

    $this->operand_1 = $o1;
  }
  public abstract function operate();
  public abstract function getEquation();
}

class Square extends Operation1 implements Exponent {
  public function operate() {}
  public function expo() {
    return pow($this->operand_1, 2); 
  }
  public function getEquation() {
    return $this->operand_1 . '^2 ' . ' = ' . $this->expo();
  }
}

class Log10 extends Operation1 {
  public function operate() {
    return log10($this->operand_1);
  }
  public function getEquation() {
    return 'log10(' . $this->operand_1 .') = ' . $this->operate();
  }
}

class Ln extends Operation1 {
  public function operate() {
    return log($this->operand_1, exp(1));
  }
  public function getEquation() {
    return 'ln(' . $this->operand_1 .') = ' . $this->operate();
  }
}

class Tenexp extends Operation1 implements Exponent{
  public function operate() {}
  public function expo() {
    return pow(10, $this->operand_1);
  }
  public function getEquation() {
    return '10^' . $this->operand_1 . ' = ' . $this->expo();
  }
}

class Eexp extends Operation1 {
  public function operate() {
    return exp($this->operand_1);
  }
  public function getEquation() {
    return 'e^' . $this->operand_1 . ' = ' . $this->operate();
  }
}

class Sin extends Operation1 {
  public function operate() {
    return sin($this->operand_1);
  }
  public function getEquation() {
    return 'sin(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

class Cos extends Operation1 {
  public function operate() {
    return cos($this->operand_1);
  }
  public function getEquation() {
    return 'cos(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

class Tan extends Operation1 {
  public function operate() {
    return tan($this->operand_1);
  }
  public function getEquation() {
    return 'tan(' . $this->operand_1 . ') = ' . $this->operate();
  }
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

// Addition subclass inherits from Operation2
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

class ExponentClass extends Operation2 {
  public function operate() {
    return pow($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return $this->operand_1 . ' ^ ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

// Some debugs - uncomment these to see what is happening...
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

    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtraction($o1, $o2);
    }

    if (isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
      $op = new Division($o1, $o2);
    }

    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiplication($o1, $o2);
    }

    if (isset($_POST['square']) && $_POST['square'] == 'Square') {
      $op = new Square($o1);
    }

    if (isset($_POST['expo']) && $_POST['expo'] == 'Exponent') {
      $op = new ExponentClass($o1);
    }

    if (isset($_POST['log10']) && $_POST['log10'] == 'Log10') {
      $op = new Log10($o1);
    }

    if (isset($_POST['ln']) && $_POST['ln'] == 'Ln') {
      $op = new Ln($o1);
    }

    if (isset($_POST['tenexp']) && $_POST['tenexp'] == '10^x') {
      $op = new Tenexp($o1);
    }

    if (isset($_POST['eexp']) && $_POST['eexp'] == 'Eexp') {
      $op = new Eexp($o1);
    }

    if (isset($_POST['sin']) && $_POST['sin'] == 'Sin') {
      $op = new Sin($o1);
    }

    if (isset($_POST['cos']) && $_POST['cos'] == 'Cos') {
      $op = new Cos($o1);
    }

    if (isset($_POST['tan']) && $_POST['tan'] == 'Tan') {
      $op = new Tan($o1);
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
    <input type="text" name="op1" id="name" value="" />
    <input type="text" name="op2" id="name" value="" />
    <br/>
    <!-- Only one of these will be set with their respective value at a time -->
    <input type="submit" name="add" value="Add" />  
    <input type="submit" name="sub" value="Subtract" />  
    <input type="submit" name="mult" value="Multiply" />  
    <input type="submit" name="divi" value="Divide" />
    <input type="submit" name="square" value="Square" />
    <input type="submit" name="expo" value="Exponent" />
    <input type="submit" name="log10" value="Log10" />
    <input type="submit" name="ln" value="Ln" />
    <input type="submit" name="tenexp" value="10^x" />
    <input type="submit" name="eexp" value="e^x" />
    <input type="submit" name="sin" value="Sin" />
    <input type="submit" name="cos" value="Cos" />
    <input type="submit" name="tan" value="Tan" />  
  </form>
</body>
</html>

