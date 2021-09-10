<?php


class UserInfo
{
    private $name;
    private $birthyear;
    private $age;
    private $gender;
    private $birthplace;
    private $residence;

    //Getter Setter for variables
    function getName(){
        return $this->name;
    }
    function getAge(){
        return $this->age;
    }

    function getGender(){
        return $this->gender;
    }

    function __construct($name, $birthyear, $gender, $birthplace,$residence){
        //Constructor for the results class
        $this->name = $name;
        $this->birthyear = $birthyear;
        $this->age = date("Y") - $birthyear;
        $this->gender = $gender;
        $this->birthplace= $birthplace;
        $this->residence = $residence;
    }



    //Validate answers about personal information - name, age and gender
    function answersInvalid(): bool
    {
        //Return true if answers valid
        if(empty($this->name)||empty($this->age)||empty($this->gender)){
            return true;
        }elseif($this->age<2||$this->age>120){
            echo "Invalid age entered<br>";
            return true;
        }else return false;
    }
    function showAnswers(){
        //validating all results then return results
        if($this->answersInvalid()){
            echo "<br>Not all questions are answered. <br>" .
                "Please ensure all the questions are answered. <br>" .
                "Returning to previous page...<br>";
        }else{
            echo "Hi, " . $this->getName() . "<br>";
            echo "You are a " . "lovely " . $this->age . " year-old " . $this->gender . " from " .
            $this->birthplace . " residing in " . $this->residence . "<br>";

        }
    }

}
