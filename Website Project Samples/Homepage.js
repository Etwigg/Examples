$(document).ready(function(){
      $('.myclass').slick({
        autoplay: true
      });
});

function api_call() {

var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	if (this.responseText != "") {
            		var obj = jQuery.parseJSON(this.responseText);

            		document.getElementById('slide1').src = obj.Poster;
            	} else {

            	}
                
            }
        };
        xmlhttp.open("GET", "http://www.omdbapi.com/?t=Doctor+Strange&y=&plot=short&r=json", true);
        xmlhttp.send();
}