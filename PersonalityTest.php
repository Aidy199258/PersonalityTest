<!DOCTYPE html>
<html>
<!---------Include CSS stylesheet----------->
<style>
    <?php include'CSS.css'?></style>
<head>
    <title>Personality Test</title>

</head>

<body class="DefaultBackground">
<div class = QuestionPage>
<div class="header">
    <h1>Online Personality Test</h1>
</div>


<?php

//Validate all input and prompt users to make sure all questions are answered

// define variables and pair variables for error messages
// All set to empty values
$nameErr = $birthyearErr = $genderErr = $birthplaceErr = $residenceErr = $generalErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $submitResult = $_POST["submit"];//Get value of first form status - page just got transferred

    //Check if first time starting the test - $submitResults equals value "Start"
    //No need for validation check if page just got transferred
    //No need to reassign $submitResult value as when this form is submitted, value will be "submit"
    if ($submitResult == "Start"){
        //Detailed error messages will not be displayed if first time
        $generalErr = "";
    } else{
        //Validate detailed answers, name/birth year/birth place/residence place
        // and display relevant error info
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = $_POST["name"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["birthyear"])) {
            $birthyearErr = "Birth Year is required";
        } else {
            $birthyear = $_POST["birthyear"];
            $age = date("Y") - $birthyear;
            if($age<2 ||$age>120){
                $birthyearErr = "Please enter a valid Birth Year";
            }
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $genderErr = "";
        }

        if (empty($_POST["birthplace"])) {
            $birthplaceErr = "Birth place is required";
        } else {
            $birthplaceErr = "";
        }

        if (empty($_POST["residence"])) {
            $residenceErr = "Residence place is required";
        } else {
            $residenceErr = "";
        }

        //Display general error info if some options are not chosen when submitting form
        if (empty($_POST['dress']) || empty($_POST['job']) || empty($_POST['force']) ||
            empty($_POST['freetime']) || empty($_POST['pets']) || empty($_POST['visited']))
        {
            $generalErr = "* Not all questions are answered. <br> * Please make sure all questions are answered for a detailed personality test. <br> ";
        }else {$generalErr = "";}//When all compulsory questions answered


        //If all questions are answered/no error messages, data submitted will be analysed
        //Test results will be available to display
        if(empty($nameErr) && empty($birthyearErr) && empty($genderErr) && empty($birthplaceErr) &&
            empty($residenceErr) && empty($generalErr)){
            //Display the Test Results
            include "TestResults.php";
        }
    }

}
?>

<p class="error align"><?php echo $generalErr;?></p>
<p class="error align">* required field</p>
<form class = "questions" method="post" action="PersonalityTest.php">

    <p style="position: relative;left: 13%;">
        <input class = "button" type="submit" name="submit" value="Submit">
        &nbsp  &nbsp  &nbsp
        <input class = "button" type="reset" name="reset" value=" Clear ">
    </p>

    <p><b>What is your name?</b></br>
        <input class = "TextBox" type="text" name="name" size="25">
        <span class="error">*<?php echo $nameErr;?></span>
        <br/>
    </p>

    <p><b>What is your gender?</b></br>
        <input type="radio" name="gender" value="gentleman">Male
        <input type="radio" name="gender" value="lady">Female
        <span class="error">*<?php echo $genderErr;?></span>
        <br/>
    </p>

    <p><b>In what year were you born?</b></br>
        <input class = "TextBox" type="number" name="birthyear" size="25">
        <span class="error">*<?php echo $birthyearErr;?></span>
        <br/>
    </p>

    <p><b>What is the country of your birth?</b></br>
        <input class = "TextBox" type="text" name="birthplace" size="25">
        <span class="error">*<?php echo $birthplaceErr;?></span>
        <br/>
    </p>

    <p><b>What country do you live in now?</b></br>
        <input class = "TextBox" type="text" name="residence" size="25">
        <span class="error">*<?php echo $residenceErr;?></span>
        </br>
</p>



    <p><hr>

    <p><h3>I see myself as someone who ...</h3>

    <ol >
        <!-- This piece of Javascript generates a series of questions each with radio button responses.
        All responses at the server side will be collected into an array called "question", ie access
        this using $_POST['question'] -->
        <script language="JavaScript1.2">

            function writequestion(txt, qno)
            {
                document.write("<li><b> ... " + txt + "</b><br>")
                document.write("Disagree")
                document.write("&nbsp <input type=radio name=question[" + qno + "] value=1 checked>1")
                for (i=2; i<=5; i++) {
                    document.write("&nbsp <input  type=radio name=question[" + qno + "] value=" + i + ">" + i)
                }
                document.write("&nbsp Agree")
            }

            writequestion("is talkative", 1)
            writequestion("does a thorough job", 2)
            writequestion("is original, comes up with new ideas", 3)
            writequestion("is helpful, unselfish with others", 4)
            writequestion("can be somewhat careless", 5)
            writequestion("is relaxed, handles stress well", 6)
            writequestion("is curious about many things", 7)
            writequestion("is full of energy", 8)
            writequestion("starts quarrels with others", 9)
            writequestion("is a reliable worker", 10)
            writequestion("is a deep thinker", 11)
            writequestion("tends to be disorganized", 12)
            writequestion("worries a lot", 13)
            writequestion("tends to be quiet", 14)
            writequestion("tends to be lazy", 15)
            writequestion("sometimes shy", 16)
            writequestion("is sometimes rude to others", 17)
            writequestion("tends to find fault with others", 18)
            writequestion("gets nervous easily", 19)
            writequestion("likes to work in a team", 20)

        </script>

    </ol>

    <p><hr>

    <!-----------------------------------
    The options for following questions are reordered for calculating points
    to check for different personality type => normal to unusual options
    ------------------------------------->
    <p><b>What best describes your attitude to your style of dress?</b><br/>
        <select class="options" name=dress>
            <option value="dontcare">I don't care how I look</option>
            <option value="classy">I like to dress classy yet casual</option>
            <option value="formal">I always dress formally</option>
            <option value="wild">I always wear wild and crazy stuff</option>
        </select>

    <p><b>Which of these jobs would be most appealing to you?</b><br/>
        <select class="options" name=job>
            <option class="option" value="goatherder">Goat herder <br/>
            <option class="option" value="doctor">Medical doctor <br/>
            <option class="option" value="ceo">CEO of large mega-corporation <br/>
            <option class="option" value="model">Fashion model <br/>
            <option class="option" value="rockstar">Rock star <br/>
            <option class="option" value="astronaut">Astronaut <br/>
        </select>

    <p><b>What force of nature do you identify yourself with?</b><br/>
        <select class="options" name=force>
            <option class = "option" value="rain">A misting rain <br/>
            <option value="summersky">The summer sky <br/>
            <option value="glacier">An icy glacier <br/>
            <option value="forestfire">A raging forest fire <br/>
            <option value="storm">The storm itself <br/>
            <option value="eyestorm">The eye of a storm <br/>
        </select>

    <p><hr>

    <p><b>How do you spend your free time?</b>
        <span class="error">*</span><br/>
        <input type=checkbox name=freetime[] value="home">Stay at home <br/>
        <input type=checkbox name=freetime[] value="hobby">Indulge in a hobby <br/>
        <input type=checkbox name=freetime[] value="sports">Play sports <br/>
        <input type=checkbox name=freetime[] value="party">Partying! <br/>
        <input type=checkbox name=freetime[] value="work">Carry on working <br/>


    <p><b>What pets do you own?</b>
        <span class="error">*</span><br/>
        <input type=checkbox name=pets[] value="dog">Dog <br/>
        <input type=checkbox name=pets[] value="cat">Cat <br/>
        <input type=checkbox name=pets[] value="bird">Bird <br/>
        <input type=checkbox name=pets[] value="fish">Fish <br/>
        <input type=checkbox name=pets[] value="goat">Goat <br/>
        <input type=checkbox name=pets[] value="pig">Pig <br/>
        <input type=checkbox name=pets[] value="horse">Horse <br/>
        <input type=checkbox name=pets[] value="sheep">Sheep <br/>

    <p><b>Which of these regions in the World have you lived in?</b>
        <span class="error">*</span><br/>
        <input type=checkbox name=visited[] value="europe">Europe <br/>
        <input type=checkbox name=visited[] value="namerica">North America <br/>
        <input type=checkbox name=visited[] value="samerica">South America <br/>
        <input type=checkbox name=visited[] value="asia">Asia <br/>
        <input type=checkbox name=visited[] value="oceania">Oceania (Australia, NZ, South Pacific)<br/>
        <input type=checkbox name=visited[] value="antarctica">Antarctica <br/>

    <p><b>Enter a message or comment if you have one.</b><br/>
        <textarea style="border-radius: 5px" name="Message" cols="60" rows="6"></textarea>
        <br/><br/>
    </p>

</form>

</div>
</body>
</html>
