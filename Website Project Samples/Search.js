
function title_search(str) {
var search_string = str.replace(" ", "+");
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	if (this.responseText != "") {
            		var obj = jQuery.parseJSON(this.responseText);
                    document.getElementById('image_side').src = obj.Poster;
                    document.getElementById('title_content').innerHTML = obj.Title;
                    document.getElementById('rating').innerHTML = obj.Rated;
                    document.getElementById('release').innerHTML = obj.Released;
                    document.getElementById('runtime').innerHTML = obj.Runtime;
                    document.getElementById('director').innerHTML = obj.Director;
                    document.getElementById('actors').innerHTML = obj.Actors;
                    document.getElementById('plot').innerHTML = obj.Plot;
                    document.getElementById('metascore').innerHTML = obj.Metascore;
                    document.getElementById('imdb').innerHTML = obj.imdbRating;
                    document.getElementById('rotten').innerHTML = obj.tomatoMeter;
                    document.getElementById('imdbid').value = obj.imdbID;
                    return passid();
            	} else {   
            	} 
            }
        };
        xmlhttp.open("GET", "http://www.omdbapi.com/?t=" + search_string + "&y=&plot=short&r=json&tomatoes=true", true);
        xmlhttp.send();
};

function passid() {
var str = document.getElementById('imdbid').value;
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    document.getElementById('tags_list').innerHTML = this.responseText;
                } else {   
                } 
            }
        };
        xmlhttp.open("GET", "idscript.php?c_id=" + str, true);
        xmlhttp.send();
}
function addtag(str) {
var el_id = document.getElementById('imdbid').value;
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "") {
                    window.alert("tag added");
                } else {   
                } 
            }
        };
        xmlhttp.open("GET", "idscript.php?el_id=" + el_id + "&tag=" + str, true);
        xmlhttp.send();
}
