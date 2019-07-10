window.onscroll = function() {
	myFunction()
};
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunction() {
	if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		} else {
			header.classList.remove("sticky");
		}
}
/* id is the id of the poll, response is the submitted user response, type is the type of poll, sliderNum is id number of slider
Types: num (2), yesNo (2), yesIdkNo (3), moreIdkLess (3), agreeIdkDisagree (3), rate (3), react (5), nbaPredict (5), nflPredict (5) */
function showResult(id, response, type, sliderNum) {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("result" + id).innerHTML = this.responseText;
		}
	};
	if(response == "numberSlider") {
		var numberSlider = document.getElementById("myRange" + sliderNum).value;
		xhttp.open("GET", "result.php?id=" + id + "&response=" + numberSlider + "&type=" + type, true);
	} else {
		xhttp.open("GET", "result.php?id=" + id + "&response=" + response + "&type=" + type, true);
	}
	xhttp.send();
}