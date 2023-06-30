//Display the corresponding control depending on the index of the administration given
function selectAdministration(index){
    if(index == -1 || index == 0){
        document.getElementById("map_div").hidden = false;
        document.getElementById("epi_div").hidden = true;
        document.getElementById("dop_div").hidden = true;
    }
    else if(index == 1){
        document.getElementById("map_div").hidden = true;
        document.getElementById("epi_div").hidden = true;
        document.getElementById("dop_div").hidden = false;
    }
    else if(index == 2){
        document.getElementById("map_div").hidden = true;
        document.getElementById("epi_div").hidden = true;
        document.getElementById("dop_div").hidden = true;
    }
    else{
        document.getElementById("map_div").hidden = true;
        document.getElementById("epi_div").hidden = false;
        document.getElementById("dop_div").hidden = true;
    }
}

//validate the form before submission
function validateForm(){
    console.info("validating form");
    if(validateRespitory() == false){
        console.warn("validation failed for respitory controls");
        return false;
    }
    console.info("validated resportory controls successfully");

    if(validateNervous() == false){
        console.warn("validation failed for nervous controls");
        return false;
    }
    console.info("validated resportory nervous successfully");

    if(validateCardiovascular() == false){
        console.warn("validation failed for cardiovascular controls");
        return false;
    }
    console.info("validated cardiovascular controls successfully");

    if(validateLiver() == false){
        console.warn("validation failed for liver controls");
        return false;
    }
    console.info("validated liver controls successfully");

    if(validateCoagulation() == false){
        console.warn("validation failed for coagulation controls");
        return false;
    }
    console.info("validated coagulation controls successfully");

    if(validateKidneys() == false){
        console.warn("validation failed for kidney controls");
        return false;
    }
    console.info("validated kidney controls successfully");

    console.info("validation successful")
    return true;
}

//validate the controls in the Respitory System
function validateRespitory(){
    //check that the user has entered a number in the respiratory_num control
    var num_input = document.getElementById("resp_num").value;
    var num_val = /[^0-9]/; //if characters don't all 0-9, return false
    if(num_input === '' || num_val.test(num_input) == true){
        displayError("resp_num","Please enter a number");
        return false;
    }
    //if neither radio button is selected return false
    if(document.getElementById("resp_yes").checked == false &&
    document.getElementById("resp_no").checked == false){
        displayError("resp_div","Please select one of the options");
        return false;
    }
}

function validateNervous(){
    //check that the user has entered a number in the nervous control
    var num_input = document.getElementById("nervous").value;
    var num_val = /[^0-9]/; //if characters don't all 0-9, return false
    if(num_input === '' || num_val.test(num_input) == true){
        displayError("nervous","Please enter a number");
        return false;
    }
    return true;
}

function validateCardiovascular(){
    var index = document.getElementById("administration").selectedIndex;
    if(index == "-1"){
        displayError("administration","Please select an administration option");
        return false;
    }
    if(index == "0"){
        if(document.getElementById("map_greater").checked == false &&
        document.getElementById("map_less").checked == false){
            displayError("map_div","Please select an amount");
            return false;
        }
    }
    else if(index == "1"){
        if(document.getElementById("dop_less").checked == false &&
        document.getElementById("dop_greater_than").checked == false &&
        document.getElementById("dop_less_than").checked == false){
            displayError("dop_div","Please select an amount");
            return false;
        }
    }
    else if(index == "3" || index == "4"){
        if(document.getElementById("epi_greater_than").checked == false &&
        document.getElementById("epi_less_than").checked == false){
            displayError("epi_div","Please select an amount");
            return false;
        }
    }
}

function validateLiver(){
    //check that the user has entered a number in the liver control
    var num_input = document.getElementById("liver").value;
    var num_val = /[^0-9.]/; //if characters don't all 0-9, return false
    if(num_input === '' || num_val.test(num_input) == true){
        displayError("liver","Please enter a number");
        return false;
    }
    return true;
}

function validateCoagulation(){
    //check that the user has entered a number in the liver control
    var num_input = document.getElementById("coagulation").value;
    var num_val = /[^0-9]/; //if characters don't all 0-9, return false
    if(num_input === '' || num_val.test(num_input) == true){
        displayError("coagulation","Please enter a number");
        return false;
    }
    return true;
}

function validateKidneys(){
    //check that the user has entered a number in the liver control
    var num_input = document.getElementById("kidneys").value;
    var num_val = /[^0-9.]/; //if characters don't all 0-9, return false
    if(num_input === '' || num_val.test(num_input) == true){
        displayError("kidneys","Please enter a number");
        return false;
    }
    return true;
}

function displayError(elementID, msg){
    var element = document.getElementById(elementID);
    if(element == null){
        console.error("couldn't find element to display error to");
        return;
    }

    var msgElement = document.createElement("span");
    msgElement.textContent = msg;
    msgElement.style.color = "red";
    element.parentNode.insertBefore(msgElement,element.nextSibling);
    element.style.border="solid 1px red";
    
}
