<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personality Test Results</title>
</head>
<body>

<?php

//Display basic data info about the user
include 'UserInfo.php';
$results = new UserInfo($_POST["name"], $_POST["birthyear"], $_POST["gender"], $_POST["birthplace"], $_POST["residence"]);
?>

<p class="statements">
<?php
$results->showAnswers();

echo "<br>";
?>
</p>
<?php
//Display analysis for traits
include "TraitsAnalysis.php";

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
//Display analysis for detailed personality
include "PersonalityAnalysis.php";

echo "<br>";

//Check if user has entered comments - comments will be saved for future references
$comments = "";
if(!empty($_POST["Message"])){
    echo "<br><p class='statements'><b>Thank you for your comment. (^ - ^) </b></p><br>";
    $comments = $_POST["Message"];
}

?>
<br>
<?php

?>

<form method="post" action="StartPage.html">
    <p><input class = "buttonRestart " type="submit" name="submit" value="Try Again"></p>

</form>
<br>
</body>
</html>

