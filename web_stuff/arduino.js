function do_request(val) {
  var xhr = new XMLHttpRequest();
  var url = "http://localhost:5000/";
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
  var data = JSON.stringify({"value": String(val)});
  xhr.send(data);
}

var slider = document.getElementById('myRange');
slider.addEventListener('change', function() {
  console.log(slider.value);
  do_request(slider.value);
});
