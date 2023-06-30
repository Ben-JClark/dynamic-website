<!DOCTYPE html>
<html>

<head>
    <link href="../styles/style.css" rel="stylesheet">
    <title>Getting data</title>
    <script src="../scripts/sofa.js"></script>
</head>

<body>
    <h1>SOFA Inputs</h1>
    <?php
    //PHP
    //receive the three values from the post request
    $nhi = $_POST["nhi"];
    $lname = $_POST["lname"];
    $fname = $_POST["fname"];

    //set the cookies "patient-nhi", "patient-surname", and "patient-firstname" on the client PC.
    setcookie("patient-nhi", $nhi, time() + 360);
    setcookie("patient-surname", $lname, time() + 360);
    setcookie("patient-firstname", $fname, time() + 360);

    //display the name and nhi of the patient at the top of the page
    echo "<h2>Patient Details</h2>";
    echo "<p>NHI number: $nhi </p>";
    echo "<p>Last Name: $lname </p>";
    echo "<p>First Name: $fname </p>";
    ?>


    <!--Create a form for the user to enter...-->
    <form id="sofa_input_form" method="POST" action="result.php" onsubmit="return validateForm();">
        <!--Respiratory System [numeric and binary input]-->
        <h2>Respiratory System</h2>
            <label for="respiratory_num">PaO2/FiO2</label>
            <input type="text" name="respiratory_num" id="resp_num" placeholder="mmHg (kPa)">
            <br>

            <!--Respiratory System [binary input]-->
        <div id="resp_div">
            <label for="resp_yes">Mechanically ventilated including CPAP: Yes</label>
            <input type="radio" id="resp_yes" name="respiratory_bin" value="yes">
            <label for="resp_no">No</label>
            <input type="radio" id="resp_no" name="respiratory_bin" value="no">
        </div>


        <!--Nervous System [numeric input]-->
        <h2>Nervous System</h2>
            <label for="nervous">Glasgow coma scale</label>
            <input type="text" name="nervous" id="nervous">
        <br>

        <!--Cardiovascular System [five possible numberic inputs]-->
        <h2>Cardiovascular System</h2>
        <label for ="administration">administration of vasopressors required</label>
        <select name="administration" id="administration" onclick="selectAdministration(this.selectedIndex)">
            <option value="none">None</option>
            <option value="dopamine">Dopamine</option>
            <option value="dobutamine">Dobutamine</option>
            <option value="epinephrine">Epinephrine</option>
            <option value="norepinephrine">Norepinephrine</option>
        </select>

        <!--IF selected none-->
        <!--Mean arterial pressure (MAP)-->
        <div id="map_div">
            <label for="map_greater">Mean arterial pressure: ≥ 70</label>
            <input type="radio" id="map_greater" name="map" value=">=70">
            <label for="map_less">&lt 70 mmHg</label>
            <input type="radio" id="map_less" name="map" value="<70">
        </div>
        <!--IF selected dopamine-->
        <div id="dop_div" hidden>
            <label for="dop_greater_than">Dopamine: ≤ 5</label>
            <input type="radio" id="dop_less" name="dopamine" value="<=5">
            <label for="dop_greater_than">5 to 15</label>
            <input type="radio" id="dop_greater_than" name="dopamine" value="5-15">
            <label for="dop_less_than">&gt 15 μg/kg/min</label>
            <input type="radio" id="dop_less_than" name="dopamine" value=">15">
        </div>
        <!--IF selected epinephrine, or norepinephrine-->
        <div id="epi_div" hidden>
            <label for="epi_greater_than">Amount: &gt 0.1</label>
            <input type="radio" id="epi_greater_than" name="norepinephrine" value=">0.1">
            <label for="epi_less_than">≤ 0.1 μg/kg/min</label>
            <input type="radio" id="epi_less_than" name="norepinephrine" value="<=0.1">
        </div>
        <!--Else selected dobutamine (display nothing)-->


        <!--Liver [numeric]-->
        <h2>Liver</h2>
            <label for="liver">Bilirubin</label>
            <input type="text" name="liver" id="liver" placeholder="mg/dl">
        <br>

        <!--Coagulation [numeric]-->
        <h2>Coagulation</h2>
            <label for="coagulation">Coagulation</label>
            <input type="text" name="coagulation" id="coagulation" placeholder="Platelets×10^3/μl">
        <br>

        <!--Kidneys [numeric]-->
        <h2>Renal function</h2>
            <label for="kidneys">Creatinine</label>
            <input type="text" name="kidneys" id="kidneys" placeholder="mg/dl">
        <br><br>
        <!--Use Java to validate the input-->
        <button type="submit">Calculate Score</button>
    </form>

</body>

</html>