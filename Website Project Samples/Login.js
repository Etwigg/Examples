function validate(str) {

var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	if (this.responseText != "") {
            		document.getElementById("register").className = "form-control input-lg btn-warning";
            		document.getElementById("register").disabled = true;
            	} else {
            		document.getElementById("register").className = "form-control input-lg";
            		document.getElementById("register").disabled = false;
            	}
                
            }
        };
        xmlhttp.open("GET", "validate.php?u=" + str, true);
        xmlhttp.send();
}

function validate1 ()
{
    var formElt = document.getElementById("mainform");
    if (formElt.username.value == "")
    {
        document.getElementById("").innerHTML
        window.alert('No Username Given');
        return false;
    }
    if (formElt.password.value == "")
    {
        window.alert('No Password Given');
        return false;
    }
    return true;
}
function fail ()
{
    window.alert("Login Failed");
}