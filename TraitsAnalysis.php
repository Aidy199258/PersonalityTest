<?php

/********************************************
 Get the answer array - no need for validating
    as there will be default answers "1" for all options
    if no answer has been chosen
 ********************************************/
$answers = array();
//$answers[0]=null;
$answers = $_POST['question'];

//Answers with a rating of 4/5 will be seen as strong traits
$StrongTraits = array("Bubbly", "Responsible", "Creative", "Generous", "Careless", "Chill", "Curious", "Energetic","argumentative", "Unreliable", "Logical", "Organised", "Worried", "Quiet", "Lazy", "Shy", "Rude","Criticising","Anxious", "Team-spirited");

//Answers with a rating of 1/2 will be seen as strong traits
$WeakTraits = array("Reserved", "Neglecting","Inartistic", "Selfish", "Caring", "Stressful", "Bored", "Vegetating", "Peaceful","Reliable", "Impulsive", "Disorganised", "Carefree", "Loud", "Active", "Adventurous", "Polite", "Easy-going","Laid-back", "Solo worker");

$Traits = array();//Traits array for the user
//var_dump($answers);
for($i = 1; $i<count($answers);$i++) {
    if ($answers[$i] > 3) {
        $Traits[$i] = $StrongTraits[$i];
    } else if ($answers[$i] < 3) {
        $Traits[$i] = $WeakTraits[$i];
    } else $Traits[$i] = null; //If a user chooses a neutral number 3, the trait for the question will be set to null

}
?>
<p class="statements">
<?php
//Analyse the answers for questions "I see myself as someone who ..."
echo "Following are some inner truth about you: <br>";
echo "You are ... <br> ";
?>
</p>

<br>

<?php


for($i = 1; $i<count($Traits);$i++){
    if(!empty($Traits[$i])){
        //echo "$Traits[$i]: ".$Traits[$i]."<br>";
        echo "<p class='traits'>$Traits[$i]<br></p>";
    }

}

?>

