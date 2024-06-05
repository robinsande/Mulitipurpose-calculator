<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multipurpose Calculator</title>
    <style>
        /* Optional styling for a cleaner look */
        label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Multipurpose Calculator</h1>
    <form method="post">
        <div class="form-group">
            <label for="num1">Number 1:</label>
            <input type="number" name="num1" id="num1" required>
        </div>
        <div class="form-group">
            <label for="num2">Number 2 (optional):</label>
            <input type="number" name="num2" id="num2">
        </div>
        <div class="form-group">
            <label for="operator">Operation:</label>
            <select name="operator" id="operator">
                <option value="+">Addition</option>
                <option value="-">Subtraction</option>
                <option value="*">Multiplication</option>
                <option value="/">Division</option>
                <option value="^">Exponentiation</option>
                <option value="%">Percentage</option>
                <option value="sqrt">Square Root</option>
                <option value="log">Logarithm</option>
            </select>
        </div>
        <input type="submit" value="Calculate">
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $num1 = $_POST["num1"];
  $num2 = isset($_POST["num2"]) ? $_POST["num2"] : null;
  $operator = $_POST["operator"];


  if (!is_numeric($num1) || ($num2 !== null && !is_numeric($num2))) {
    $error = "Please enter valid numbers.";
  } else {
    $result = "";
    switch ($operator) {
      case "+":
        $result = $num1 + $num2;
        break;
      case "-":
        $result = $num1 - $num2;
        break;
      case "*":
        $result = $num1 * $num2;
        break;
      case "/":
        if ($num2 == 0) {
          $error = "Division by zero is not allowed.";
        } else {
          $result = $num1 / $num2;
        }
        break;
      case "^":
        $result = pow($num1, $num2);
        break;
      case "%":
        if ($num2 == 0) {
          $error = "Cannot calculate percentage of zero.";
        } else {
          $result = ($num1 / 100) * $num2;
        }
        break;
      case "sqrt":
        if ($num1 < 0) {
          $error = "Square root of a negative number is not allowed.";
        } else {
          $result = sqrt($num1);
        }
        break;
      case "log":
        if ($num1 <= 0) {
          $error = "Logarithm of a non-positive number is not allowed.";
        } else {
          $result = log($num1, 10);
        }
        break;
    }
  }
}
if (isset($error)) {
    echo "<p style='color: red;'>Error: $error</p>";
  } 
  else if (isset($result)) {
      echo "<script>alert('The result is: $result');</script>";
  }
?>
</body>
</html>