<!DOCTYPE HTML> 
<html> 
    <body>
<form method="post" action="display.php"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
Name: <input type="text" name="name"><br><br> 
E-mail: <input type="text" name="email"><br><br> 
Website: <input type="text" name="website"><br><br> 
Comment: <textarea name="comment" rows="5" cols="40"></textarea><br><br>
Gender: <input type="radio" name="gender" value="female">Female <input type="radio" name="gender" value="male">Male <input type="radio" name="gender" value="other">Other
<br><br>
<input type="submit"> </form>
 </body>
 </html>
