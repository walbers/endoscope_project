var url = window.location.href;
var accessToken = url.split("#")[1].split("=")[1].split("&")[0]; 
var userId = url.split("#")[1].split("=")[2].split("&")[0]; 

function getThisWeek() {
    var today = new Date();
    var thisWeek = new Date(today.getFullYear() - 1, today.getMonth() + 1, today.getDate());
    return thisWeek;
}

function getLastWeek() {
    var today = new Date();
    var lastWeek = new Date(today.getFullYear() - 1, today.getMonth() + 1, today.getDate() - 7);
    return lastWeek;
  }

  function formatDate(date) {
    var d = new Date(date);
    var year = d.getFullYear();
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var day = ("0" + d.getDate()).slice(-2);
    return year + "-" + month + "-" + day;
  }

var startDate = formatDate(getLastWeek());
var endDate = formatDate(getThisWeek());

function formatHHmmTime(date) {
    var d = new Date(date);
    return ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);
}


function fetchJSON(accessToken, url) {
    var data;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.setRequestHeader("Authorization", 'Bearer ' + accessToken);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
	};
    }
    xhr.send();
}

function fetch_sleep_data(userId, accessToken, startDate, endDate) {
    var sDate = formatDate(startDate);
    var eDate = formatDate(endDate);
    var sleepDataUrl = "https://api.fitbit.com/1.2/user/" + userId + "/sleep/date/" + sDate + "/" + eDate + ".json";
    fetchJSON(accessToken, sleepDataUrl);
}

function fetch_heart_rate_data(userId, accessToken, startDate, endDate) {
    var startDate = formatDate(startDate);
    var endDate = formatDate(endDate);
    var heartRateDataUrl = "https://api.fitbit.com/1/user/" + userId + "/activities/heart/date/" + startDate + "/" + endDate + "/1min.json";
    fetchJSON(accessToken, heartRateDataUrl);
}

function fetch_weight_data(userId, accessToken, startDate, endDate) {
    var sDate = formatDate(startDate);
    var eDate = formatDate(endDate);
    var weightDataUrl = "https://api.fitbit.com/1/user/" + userId + "/body/bmi/date" + sDate + "/" + eDate + ".json";
    fetchJSON(accessToken, weightDataUrl);
}

function fetch_activity_data(userId, accessToken, startDate, endDate){
    var sDate = formatDate(startDate);
    var eDate = formatDate(endDate);
    var activityDataUrl = "https://api.fitbit.com/1/user/" + userId + "activities/steps/date/" + sDate + "/" + eDate + "/15min.json";
    fetchJSON(accessToken, activityDataUrl);
}

var sleep_json = fetch_sleep_data(userId, accessToken, startDate, endDate);
var weight_json = fetch_weight_data(userId, accessToken, startDate, endDate);
var heart_json = fetch_heart_rate_data(userId, accessToken, startDate, endDate);
var activity_json = fetch_activity_data(userId, accessToken, startDate, endDate);


console.log(sleep_json);
console.log(weight_json);
console.log(heart_json);
console.log(activity_json);

// var xhr = new XMLHttpRequest();
// var data;
// xhr.open('GET', 'https://api.fitbit.com/1/user/' + userId + '/body/log/weight/date/' + date + '/1m.json');
// xhr.setRequestHeader("Authorization", 'Bearer ' + access_token);
// xhr.onload = function () {
//     if (xhr.status === 200) {
//         console.log(xhr.responseText);
// 	//document.write(JSON.parse(xhr.responseText)['weight'][0]['weight']);
//         data = JSON.parse(xhr.responseText)['weight'];
// 	console.log(data);
// 	var weight = [];
// 	var dates = []
// 	var i;
// 	// TODO scenarios for when data doesnt exist
// 	for (i=0; i<data.length; i++) {
//     	    weight.push(data[i]['weight']);
// 	    dates.push(data[i]['date']);
// 	}
// 	//document.write(weight);
// 	console.log(weight);
// 	graph(weight, dates);
//     } else {
//         console.log('error ' + xhr.status);
//     }
// };
// xhr.send();


// function graph(data, dates) {
    
//     var margin = 50;
// var width = 200;
// var height = 200;
// var margin = 50;
// var width = 200;
// var height = 200;

// var x = d3.scaleBand()
//   .domain([0,1,2,3,4,5])
//   .range([0,width]);

// var y = d3.scaleLinear()
//   .domain([0,250])
//   .range([height,0]);

// d3.select("svg")
//   .append("g")
//   .attr("transform", "translate("+margin+","+margin+")")
//   .selectAll("rect").data(data)
//   .enter().append("rect")
//   .attr("x", function(d,i) {return i*(200.0/6.0);})
//   .attr("y", function(d) {return y(d)})
//   .attr("width", function(d) { return 200.0/6.0;})
//   .attr("height", function(d) { return height-y(d);});

// d3.select("svg").append("g")
//   .attr("transform", "translate("+margin+","+margin+")")
//   .call(d3.axisLeft(y));

// d3.select("svg").append("g")
//   .attr("transform", "translate("+margin+","+(height+margin)+")")
//   .call(d3.axisBottom(x));

// }

// function revokeAccess() {
//     var params = "token=" + access_token;
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'https://api.fitbit.com/oauth2/revoke');
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xhr.setRequestHeader("Authorization", 'Basic MjJCVEhaOjdhNzFkNTFiMjMzYWZiMTIzYWNkMjQ5ZmJhODUwNDgy', true);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             console.log(xhr.responseText)
//         }
//     };
//     xhr.send(params);
// }
