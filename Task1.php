<?php

// Swap two numbers without using temporary varialble


$number1=10;
$number2=20;
echo "First number is: ".$number1." Before swaping"."<br>"."Second number is: ".$number2." Before swaping"."<br>";

$number1=$number1+$number2;
$number2=$number1-$number2;
$number1=$number1-$number2;

echo "First number is: ".$number1." After swaping"."<br>"."Second number is: ".$number2." After swaping"."<br><hr>";

// Print two php variables using single echo statement

$First	="I like php ";
$Second ="programming language";
echo $First.$Second;