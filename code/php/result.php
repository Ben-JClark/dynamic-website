<!DOCTYPE html>
<html>

<head>
    <link href="../styles/style.css" rel="stylesheet">
    <title>Getting data</title>
</head>

<body>
    <h1>SOFA Result</h1>
    <h2>Patient Details</h2>
    <?php
    //retreive the NHI, surname, and firstname from cookies
    $nhi = $_COOKIE["patient-nhi"];
    $lname = $_COOKIE["patient-surname"];
    $fname = $_COOKIE["patient-firstname"];

    //display the patient details from the cookies at the top of the page
    echo "<p>NHI number: $nhi </p>";
    echo "<p>Last Name: $lname </p>";
    echo "<p>First Name: $fname </p>";

    echo "<h2>SOFA form inputs</h2>";

    $score = 0;

    //retreive the inputs from the post request
    $respiratory_num = $_POST["respiratory_num"];
    $respiratory_bin = $_POST["respiratory_bin"];
    if($respiratory_num < 100 && $respiratory_bin == "yes"){
        $score += 4;
    }
    else if($respiratory_num < 200 && $respiratory_bin == "yes"){
        $score += 3;
    }
    else if($respiratory_num < 300){
        $score += 2;
    }
    else if($respiratory_num < 400){
        $score += 1;
    }
    else if(!($respiratory_num >= 400)){
        error_log("ERROR, Score not counting respiratory",0);
    }


    $liver = $_POST["liver"];
    if($liver < 1.2){
        $score += 0;
    }
    else if($liver <= 1.9){
        $score += 1;
    }
    else if($liver <= 5.9){
        $score += 2;
    }
    else if($liver <= 11.9){
        $score += 3;
    }
    else if($liver > 11.9){
        $score += 4;
    }
    else{
        error_log("ERROR, Score not counting liver",0);
    }

    $coagulation = $_POST["coagulation"];
    if($coagulation < 20){
        $score += 4;
    }
    else if($coagulation < 50){
        $score += 3;
    }
    else if($coagulation < 100){
        $score += 2;
    }
    else if($coagulation < 150){
        $score += 3;
    }
    else if(!($coagulation >= 150 )){
        error_log("ERROR, Score not counting coagulation",0);
    }

    $kidneys = $_POST["kidneys"];
    if($kidneys < 1.2){
        $score += 0;
    }
    else if($kidneys <= 1.9){
        $score += 1;
    }
    else if($kidneys <= 3.4){
        $score += 2;
    }
    else if($kidneys <= 4.9){
        $score += 3;
    }
    else if($kidneys > 4.9 ){
        $score += 4;
    }
    else{
        error_log("ERROR, Score not counting Renal function/kidneys",0);
    }

    $nervous = $_POST["nervous"];
    if($nervous < 6){
        $score += 4;
    }
    else if($nervous <= 9){
        $score += 3;
    }
    else if($nervous <= 12){
        $score += 2;
    }
    else if($nervous <= 14){
        $score += 1;
    }
    else if($nervous != 15){
        error_log("ERROR, Score not counting nervous system",0);
    }

    echo "<p>PaO2/FiO2 is $respiratory_num mmHg (kPa)</p>";
    echo "<p>Central nervous system is $nervous</p>";
    echo "<p>Are they mechanically ventilated including CPAP? $respiratory_bin</p>";
    echo "<p>liver, bilirubin $liver mg/dl</p>";
    echo "<p>coagulation, platelets $coagulation ×10^3/μl</p>";
    echo "<p>kidneys, creatinine is $kidneys mg/dl</p>";

	
	$administration = $_POST["administration"];
    echo "<p>administration of of vasopressors required, $administration</p>";
	if($administration == "none"){
        $map = $_POST["map"];
        echo "<p>mean arterial pressure is $map mmHg</p>";
        //if map is <70, then +1
        if($map == "<70"){
            $score += 1;
        }
        else if($map != ">=70"){
            error_log("ERROR, Score not counting MAP",0);
        }
	}
	else if($administration == "dopamine"){
		$dop = $_POST["dopamine"];
        echo "<p>dopamine amount is $dop μg/kg/min</p>";
        //if dopamine <=5, then +2
        if($dop == "<=5"){
            $score +=2;
        }
        //if dopamine >5, then +3
        else if($dop == "5-15"){
            $score += 3;
        }
        //if dopamine >15, then +4
        if($dop == ">15"){
            $score += 4;
        }
        else{
            error_log("ERROR, Score not counting dopamine",0);
        }
	}
	else if($administration == "dobutamine"){
		$dob = "present";
        echo "<p>dobutamine is present</p>";
        $score += 2;

	}
	else if($administration == "epinephrine" || $administration == "norepinephrine"){
		$epi = $_POST["norepinephrine"];
        echo "<p>$administration amount is $epi μg/kg/min</p>";
        if($epi == "<=0.1"){
            $score +=3;
        }
        //if dopamine >5, then +3
        else if($dop == ">0.1"){
            $score += 4;
        }
        else{
            error_log("ERROR, Score not counting epinephrine/norepinephrine",0);
        }
	}
    
	echo "<p id='result'>SOFA score is $score points</p>";
    ?>

</body>

</html>