// Header
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
/* userId is the id of the user, postId is the id of the poll, response is the submitted user response, type is the type of poll,
sliderNum is id number of slider, answered is whether or not the user has answered the poll question already (0 for no, 1 for yes)
Types: num (2), yesNo (2), yesIdkNo (3), moreIdkLess (3), agreeIdkDisagree (3), rate (3), react (5), nbaPredict (5), nflPredict (5) */
function showResult(userId, postId, response, type, sliderNum, answered) {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("result" + postId).innerHTML = this.responseText;
		}
	};
	if(response == "numberSlider") {
		var numberSlider = document.getElementById("myRange" + sliderNum).value;
		xhttp.open("GET", "result.php?userId=" + userId + "&postId=" + postId + "&response=" + numberSlider + "&type=" + type + "&answered=" + answered, true);
	} else {
		xhttp.open("GET", "result.php?userId=" + userId + "&postId=" + postId + "&response=" + response + "&type=" + type + "&answered=" + answered, true);
	}
	xhttp.send();
}