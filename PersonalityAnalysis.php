<?php
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

//Set bonus image results to default "false"
$AnimalsFriend = $CEO = $Weatherman = $GreatTraveller = false;

$dress = array(
    "Don't pay much attention about details. <br>",
    "Easy going and pay attention to some details. <br>",
    "Care a lot about what others think and always try to be the role model<br>",
    "Always have thoughts different from others and try to be yourself. <br> ");

$job = array(
    "Enjoy having a laid-back life style. <br>",
    "Enjoy helping others to fulfill meaning of life. <br>",
    "Like trendy things and always stay fashionable. <br>",
    "Enjoy being the centre of focus. <br>",
    "Are adventurous and would like to try something unusual in life. <br>");

$force = array(
    "Can be emotional and care about every details in life. <br>",
    "Often try to stay positive and focus on best things in life. <br>",
    "Have you own way of doing things and quite different from others. <br>",
    "Are an influencer and making a big impact everywhere you go. <br>",
    "Are an influencer and continue to make a difference to other people's life. <br>",
    "Are an egoistic person and will not change your mind because of other people's suggestions easily. <br> ");

$freetime = array(
    "Home is your comfort zone.<br>",
    "You enjoy spending quality entertaining time in life <br>",
    "You are an active outdoor person. <br>",
    "You enjoy living in the moment and have fun whenever possible. <br>",
    "Work is your life. <br>");

$pets = array (
    "You like pets. <br>",
    "You love pets. <br>",
    "You love all animals. <br>");

$visited = array(
    "You haven't travelled much yet. <br>",
    "You love exploring different places. <br>",
    "Travel is your middle name. <br>");

//Create an array for analysis statement for all single/multiple choice questions
$statements = array();

switch ($_POST["dress"]){
    case "dontcare":
        $statements[0] = $dress[0];
        break;
    case "classy":
        $statements[0] = $dress[1];
        break;
    case "formal":
        $statements[0] = $dress[2];
        break;
    case "wild":
        $statements[0] = $dress[3];
        break;
}

switch ($_POST["job"]){
    case "goatherder":
        $statements[1] = $job[0];
        break;
    case "doctor":
        $statements[1] = $job[1];
        break;
    case "ceo":{
        $statements[1] = $job[2];
        $CEO = true;
        break;}
    case "model":
        $statements[1] = $job[3];
        break;
    case "rockstar":
        $statements[1] = $job[4];
        break;
    case "astronaut":
        $statements[1] = $job[5];
        break;
}

switch ($_POST["force"]){
    case "rain":
        $statements[2] = $force[0];
        break;
    case "summersky":
        $statements[2] = $force[1];
        break;
    case "glacier":
        $statements[2] = $force[2];
        break;
    case "forestfire":
        $statements[2] = $force[3];
        break;
    case "storm":
        $statements[2] = $force[4];
        break;
    case "eyestorm":{
        $statements[2] = $force[5];
        $Weatherman = true;
        break;}
}

//For multiple choice questions[freetime], all relevant statements will be included.
$statements[3] = "";
for($i = 0; $i<count($_POST["freetime"]); $i++){
    $statements[3] .= $freetime[$i];
}

//For multiple choice questions[pets], relevant statement will be selected based on number of options chosen.
if(count($_POST["pets"])<2){
    $statements[4] = $pets[0];
}else if(count($_POST["pets"])==8){
    $statements[4] =  $pets[2];
    $AnimalsFriend = true;
}else $statements[4] = $pets[1];

//For multiple choice questions[visited], relevant statement will be selected based on number of options chosen.
//$statements[5] = $_POST["visited"];
if(count($_POST["visited"])<2){
    $statements[5] = $visited[0];
}else if(count($_POST["visited"])==6){
    $GreatTraveller = true;
    $statements[5] =  $visited[2];
}else $statements[5] = $visited[1];



//Customed image will display if certain criteria met -
//1. Animals' Friend - if friends with all pets/animals
//2. Greatest Traveller - if selected all places
//3. CEO - if selected CEO for job
//4. Weatherman - if selected eye storm
//5. Default - if no condition met
$image=0;
if($AnimalsFriend){
    $image = 1;
}else if ($GreatTraveller){
    $image=2;
}else if ($CEO){
    $image = 3;
}else if ($Weatherman){
    $image = 4;
}else $image = "default";


?>

<div class="resultImage">
    <?php switch ($image){
        case "1": {?> <img src="Images/animalsfriend.png" style="width: 50%" alt="animalsfriend.png"/> <?php
            break;}
        case "2": { ?><img src="Images/greatesttraveller.png" style="width: 50%" alt="greatesttraveller.png"/><?php
            break;}
        case "3":{ ?> <img src="Images/CEO.png" style="width: 50%" alt="CEO.png"/><?php
            break;}
        case "4":{ ?><img src="Images/weatherman.png" style="width: 50%" alt="weatherman.png"/><?php
            break;}
        default: {?> <img src="Images/default.png" style="width: 50%" alt="default.png"/><?php
        }
    }
    ?>

</div>
<?php
echo "<br>";
echo "<br><p class='statements'>Based on the answers you've chosen, it seems that you are such a person who... </p>";
//echo "------Display the results based on analysis <br>";
?>

<div class='statements'>
<?php
for($i = 0; $i<6; $i++){

    echo "<p>$statements[$i]</p>";
}

?>
</div>
