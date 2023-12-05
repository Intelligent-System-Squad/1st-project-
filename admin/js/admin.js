

  //function to validate login form
function loginValidate(loginForm){

var validationVerified=true;
var errorMessage="";
var okayMessage="click OK to continue";

if (loginForm.myusername.value=="")
{
errorMessage+="Email not filled!\n";
validationVerified=false;
}
if(loginForm.mypassword.value=="")
{
errorMessage+="Password not filled!\n";
validationVerified=false;
}
if (!isValidEmail(loginForm.myusername.value)) {
errorMessage+="Invalid email address provided!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
if(validationVerified)
{
alert(okayMessage);
}
return validationVerified;
}

//function to handle register-form validation
function registerValidate(registerForm){

    var validationVerified=true;
    var errorMessage="";
    var okayMessage="click OK to process registration";
    
    if (registerForm.firstname.value=="")
    {
    errorMessage+="Firstname not filled!\n";
    validationVerified=false;
    }
    if(registerForm.lastname.value=="")
    {
    errorMessage+="Lastname not filled!\n";
    validationVerified=false;
    }
    if (registerForm.email.value=="")
    {
    errorMessage+="Email not filled!\n";
    validationVerified=false;
    }
    if(registerForm.password.value=="")
    {
    errorMessage+="Password not provided!\n";
    validationVerified=false;
    }
    if(registerForm.ConfirmPassword.value=="")
    {
    errorMessage+="Confirm password not filled!\n";
    validationVerified=false;
    }
    if(registerForm.ConfirmPassword.value!=registerForm.password.value)
    {
    errorMessage+="Confirm password and password do not match!\n";
    validationVerified=false;
    }
    if (!isValidEmail(registerForm.email.value)) {
    errorMessage+="Invalid email address provided!\n";
    validationVerified=false;
    }
    if(!validationVerified)
    {
    alert(errorMessage);
    }
    if(validationVerified)
    {
    alert(okayMessage);
    }
    return validationVerified;
    }
    
    //function to handle update-form validation
    function updateProfile(registerForm){
    
    var validationVerified=true;
    var errorMessage="";
    var okayMessage="click OK to update your account";
    
    if (registerForm.firstname.value=="")
    {
    errorMessage+="Firstname not filled!\n";
    validationVerified=false;
    }
    if(registerForm.lastname.value=="")
    {
    errorMessage+="Lastname not filled!\n";
    validationVerified=false;
    }
    if (registerForm.email.value=="")
    {
    errorMessage+="Email not filled!\n";
    validationVerified=false;
    }
    if(registerForm.password.value=="")
    {
    errorMessage+="New password not provided!\n";
    validationVerified=false;
    }
    if(registerForm.ConfirmPassword.value=="")
    {
    errorMessage+="Confirm password not filled!\n";
    validationVerified=false;
    }
    if(registerForm.ConfirmPassword.value!=registerForm.password.value)
    {
    errorMessage+="Confirm password and new password do not match!\n";
    validationVerified=false;
    }
    if (!isValidEmail(registerForm.email.value)) {
    errorMessage+="Invalid email address provided!\n";
    validationVerified=false;
    }
    if(!validationVerified)
    {
    alert(errorMessage);
    }
    if(validationVerified)
    {
    alert(okayMessage);
    }
    return validationVerified;
    }
    
    //validate email function
    function isValidEmail(val) {
        var re = /^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/;
        if (!re.test(val)) {
            return false;
        }
        return true;
    }


//validate position form
function positionValidate(positionForm){

var validationVerified=true;
var errorMessage="";
var okayMessage="click OK to add new position";

if (positionForm.position.value == "")
{
errorMessage+="Please enter the position name!\n";
validationVerified=false;
}
if (!isValidPosition(positionForm.position.value)) {
errorMessage+="Invalid position provided! Don't leave spaces between words i.e. Try to replace spaces with a dash (-)\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
if(validationVerified)
{
alert(okayMessage);
}
return validationVerified;
}

//validate voter form
function voterValidate(voterForm){

    var validationVerified=true;
    var errorMessage="";
    var okayMessage="click OK to add new voter";
    
    if (voterForm.fname.value == "")
    {
    errorMessage+="Please enter the voter first name!\n";
    validationVerified=false;
    }
    if (voterForm.lname.value == "")
    {
    errorMessage+="Please enter the voter last name!\n";
    validationVerified=false;
    }
    if (voterForm.email.value == "")
    {
    errorMessage+="Please enter the voter email!\n";
    validationVerified=false;
    }
    if (voterForm.password.value == "")
    {
    errorMessage+="Please enter the voter password!\n";
    validationVerified=false;
    }
    if(!validationVerified)
    {
    alert(errorMessage);
    }
    if(validationVerified)
    {
    alert(okayMessage);
    }
    return validationVerified;
    } 

//validate candidate form
function candidateValidate(candidateForm){

var validationVerified=true;
var errorMessage="";
var okayMessage="click OK to add new candidate";

if (candidateForm.name.value == "")
{
errorMessage+="Please enter the candidate name!\n";
validationVerified=false;
}
if (candidateForm.position.selectedIndex == 0)
{
errorMessage+="Candidate position not set!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
if(validationVerified)
{
alert(okayMessage);
}
return validationVerified;
}

//validate position form
function positionValidate(positionForm){

var validationVerified=true;
var errorMessage="";
var okayMessage="click OK to see the poll results under the chosen position.";

if (positionForm.position.selectedIndex == 0)
{
errorMessage+="Position not set! Choose a position to retrieve the respective poll results.\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
if(validationVerified)
{
alert(okayMessage);
}
return validationVerified;
}