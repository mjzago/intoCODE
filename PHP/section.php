<section>
  <h1>Before you start, please select the background color</h1>
      <?php
         if(isset($_GET['color'])){
          $color = $_GET['color'];
          if($color == 'grey'){
              echo '<style>body {background-color: grey;}</style>';
          } elseif ($color == 'DarkSeaGreen'){
              echo '<style>body {background-color: DarkSeaGreen;}</style>';
            } elseif ($color == 'LightCoral'){
              echo '<style>body {background-color: LightCoral;}</style>';
             } elseif ($color == 'pink'){
          echo '<style>body {background-color: pink;}</style>';
      }}
      
      ?>
  
      <a href="?color=grey">Grey</a>
      <a href="?color=DarkSeaGreen">Green</a>
      <a href="?color=LightCoral">Red</a>
      <a href="?color=pink">Pink</a>
<h1>Form with PHP</h1>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="year">Year of Birth:</label>
    <input type="number" id="year" name="year" required><br><br>
    
    <input type="submit" value="Submit">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['year'])) {
      $name = $_POST["name"];
      $year = $_POST["year"];
      
      $currentYear = date("Y");
      $age = $currentYear - $year;
      echo "Hello $name, you are $age years old";   
    }
  }
  ?>

  <h2>Calculator - Addition</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="num1">Number 1:</label>
    <input type="number" id="num1" name="num1" required><br><br>
    
    <label for="num2">Number 2:</label>
    <input type="number" id="num2" name="num2" required><br><br>
    
    <input type="submit" value="Calculate">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['num1']) && isset($_POST['num2'])) {
      $num1 = $_POST['num1'];
      $num2 = $_POST['num2'];
      
      $result = $num1 + $num2;
      
      echo "<h3>Result:</h3>";
      echo "<p>" . $num1 . " + " . $num2 . " = " . $result . "</p>";
    }
  }
  ?>

<h1>Talk to the user</h1>
  <form method="POST" action="">
    <label for="yourname">Name:</label>
    <input type="text" id="yourname" name="yourname" required><br><br>
    
    <label for="yourage">Year of Birth:</label>
    <input type="number" id="yourage" name="yourage" required><br><br>
    
    <input type="submit" value="Submit">
  </form>

  <?php

  if(isset($_POST['yourname']) && isset($_POST['yourage'])) {
  $yourname = $_POST['yourname'];
  $yourage =  $_POST['yourage'];

  echo "Your name is " . $yourname;
  echo "<br>";
  echo "And your age is " . $yourage;
}
?>


<h1>Easy Password</h1>
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="password">Your passwors is a sequence from 1 to 6, please write down you password:</label></td>
            </tr>
            <tr>
                <td><input type="password" id="password" name="password"></td>
            </tr>     
            <tr>
                <td colspan="2">
                    <input type="submit" value="Verify Password">
                </td>
            </tr>
        </table>
    </form>


    <?php
if(isset($_POST['password'])) {
    $password = $_POST['password'];
    if($password === '123456') {
        echo "Your password is correct!";
    } else {
        echo "Invalid password";
    }
}
?>


    <h1>Voting poll</h1>
    <p> Who did you vote for as Brazil's president?</p>
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="poll">Lula or Bolsonaro?</label></td>
                <td><input type="text" id="vote" name="election"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Check the result">
                </td>
            </tr>
        </table>
    </form>

    <?php

if(isset($_POST['election'])) {
$vote = $_POST['election'];
if($vote === 'Lula'){
  echo "Congratulations, you voted correctly!";}
  elseif($vote === 'Bolsonaro'){
  echo "You've made a mistake! Cast your vote in the next elections with awareness.";}
  else { 
  echo "Invalid option. Please write either 'Lula' or 'Bolsonaro'";}
}
?>

</body>
</html>


    </section>