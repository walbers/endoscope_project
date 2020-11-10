console.log("hello");
/*
$(document).ready(function(){
$("button").click(function(){
	$.post("http://localhost:5000/test",
	{
		name: "Donald",
		city: "Duckburg"
	},
	function(data, status){
		alert("Data: " + data + "\nStatus: " + status);
	});
});
});
*/

function turnOn() {
var xhr = new XMLHttpRequest();
var url = "http://localhost:5000/test";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.response);
	console.log(xhr.responseText);
    } else {
	console.log('idk');
    }
};
var data = JSON.stringify({"value": "1"});
xhr.send(data);
}

function turnOff() {
var xhr = new XMLHttpRequest();
var url = "http://localhost:5000/test";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.response);
	console.log(xhr.responseText);
    } else {
	console.log('idk');
    }
};
var data = JSON.stringify({"value": "2"});
xhr.send(data);

}
