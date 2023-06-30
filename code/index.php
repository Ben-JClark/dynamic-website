<!DOCTYPE html>
<html>

<head>
    <link href="./styles/style.css" rel="stylesheet">
    <title>Getting data</title>
    <script src="./scripts/index.js"></script>
</head>

<body>
    <h1>SOFA Score</h1>
    <p>
        SOFA score is a sequential organ failure assessment score. This is score is used to track a person's status during<br>
        the stay in an intensive care unit (ICU) to determine the extent of a person's organ function or rate of failure.
    </p>

    <?php
    //Read cookies if they have been stored
    $nhi = $_COOKIE["patient-nhi"];
    $lname = $_COOKIE["patient-surname"];
    $fname = $_COOKIE["patient-firstname"];
    ?>

    <!--a form that prompts the user to enter their patient details-->
    <form method="POST" action="php/sofa.php" onsubmit="return validateForm();">
        <label for="nhi">NHI Number</label>
        <input type="text" id="nhi_num" name="nhi" value=<?php echo $nhi ?>>
        <br><br>
        <label for="lname">Last Name</label>
        <input type="text" id="last_name" name="lname" value=<?php echo $lname ?>>
        <br><br>
        <label for="fname">First Name</label>
        <input type="text" id="first_name" name="fname" value=<?php echo $fname ?>>
        <br><br>
        <!--Use Java to validate the input-->
        <button type="submit">Login</button>
    </form>


</body>

</html>