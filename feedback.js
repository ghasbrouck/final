function respond(){
    var atSign = document.getElementById("email").value.indexOf("@");
    if(atSign=='-1') {
        alert("Email not valid");
    }
    else {
        alert("Thank you for submitting the form! Enjoy your day!!")
        window.location.href = 'index.html';
    }
}