//Validate the form before submission
function validateForm(){
    if(validateNhi() == false){
        console.warn("validation failed for nhi number");
        return false;
    }
    console.info("validated nhi number successfully");
    //validate last name
    if(validateName("last_name") == false){
        console.warn("validation failed for last name");
        return false;
    }
    console.info("validated last name successfully");
    //validate first name
    if(validateName("first_name") == false){
        console.warn("validation failed for first name");
        return false;
    }
    console.info("validated first name successfully");
    console.info("validated patient details successfully");
}


//validate the nhi number
function validateNhi(){
    var nhi_input = document.getElementById("nhi_num").value;
    var num_test = /[^0-9]/;
    var letter_test = /[^A-Z]/;
    //check the length of input is correct
    if(nhi_input.length != 7 || letter_test.test(nhi_input.substring(0,2)) == true ||
    num_test.test(nhi_input.substring(3,6)) == true){
        displayError("nhi_num","invalid nhi number, expected format: XXX0000");
        return false;
    }
    return true;
}


//validate name
function validateName(control){
    var name_input = document.getElementById(control).value;
    var letter_test = /[^a-zA-Z]/;
    if(name_input === '' || letter_test.test(name_input) == true){
        displayError(control,"Please enter you name in letters");
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