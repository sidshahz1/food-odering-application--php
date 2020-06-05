function registrationValidation() {
    //  get all the required elemets for front end validation
    var name = document.getElementsByName('name')[0].value;
    var email = document.getElementsByName('email')[0].value;
    var pass1 = document.getElementsByName('pass1')[0].value;
    var pass2 = document.getElementsByName('pass2')[0].value;
    var alertDiv = document.getElementById('alertDiv');

    // regular expressions for black space and email validations
    blackSpaceRegex = /^$|\s+/;
    emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // check is the name field is empty
    if(name.trim()==''){
        alertDiv.innerHTML= "name field cannot be blank";
        alertDiv.style.display="block";
        return false;
    }

    // check if email or password contain space
    if(blackSpaceRegex.test(email) || blackSpaceRegex.test(pass1)){
        alertDiv.innerHTML= "email and password cannot have blank spaces";
        alertDiv.style.display="block";
        return false;
    }

    // check if email is correct
    if(!emailRegex.test(email)){
        alertDiv.innerHTML= "invalid email";
        alertDiv.style.display="block";
        return false;
    }

    // check if passwords match
    if(pass1!=pass2){
        alertDiv.innerHTML= "passwords do not match";
        alertDiv.style.display="block";
        return false;
    }
}
