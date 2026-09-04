<?php
$fruits=["Apple","Banana","Orange"];
for($i=0; $i<count($fruits);$i++){
    echo $fruits[$i]."<br>";
}

//TYPES OF ARRAYS
//indexed arrays is a type of arrays where each element is automatically assigned a numeric index starting from 0 

$fruits=array("Apple","Banana","Mango");

echo $fruits[0]."<br>";
echo $fruits[1]."<br>";
echo $fruits[2]."<br>";

//associative arrays is a type of array that use namedkeys insteadof numeric indexes to store values

$age=array("Alice"=>25, "Bob"=>30, "Charlie"=>22);

echo "Alice is " .$age["Alice"] ." years old.<br>";
echo "Bob is " .$age["Bob"] ." years old.<br>";
echo "Charlie is " .$age["Charlie"] ." years old.<br>";

//multidimensional arrays are arrays that contain other arrays enabling structured data storage

$students=[
    ["Name"=>"john", "Score"=>85, "Grade"=>"A"],
    ["Name"=>"sara", "Score"=>90, "Grade"=>"A+"],
    ["Name"=>"mike", "Score"=>78, "Grade"=>"B"]

];
foreach($students as $student){
    echo $student["Name"]. " scored ". $student["Score"]." and got grade ". $student["Grade"]. "<br>";
}



?>
