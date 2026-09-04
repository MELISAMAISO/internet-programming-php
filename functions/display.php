<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if
  $name = test($_POST["name"]);
  $email = test($_POST["email"]);
  $website = test($_POST["website"]);
  $comment = test($_POST["comment"]);
  $gender = test($_POST["gender"]);
}

 
function test($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
echo "name: " . $name . "<br>";
echo "email: " . $email . "<br>";
echo "website: " . $website . "<br>";
echo "comment: " . $comment . "<br>";
echo "gender: " . $gender . "<br>";
?>

