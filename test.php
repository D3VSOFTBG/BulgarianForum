<?php
//include_once("../include/header.php");

// if(empty("")){
//     echo "yes";
// }else{
//     echo "no";
// }

//echo strlen('assaddsadasdasadsasdadsadsadsadsads12312312312313213223132123123112331212331223132131223131212331231223131223132123112312332123131233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333');


// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
echo $_SESSION["favcolor"];
?>

</body>
</html>

