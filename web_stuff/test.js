console.log(userId);

var xhr = new XMLHttpRequest();
xhr.open('GET', 'https://api.fitbit.com/1/user/' + userId + '/body/log/fat/date/2020-11-08/1w.json');
var data;
xhr.open('GET', 'https://api.fitbit.com/1/user/' + userId + '/body/log/weight/date/2020-11-08/1m.json');
xhr.setRequestHeader("Authorization", 'Bearer ' + access_token);
xhr.onload = function () {
    if (xhr.status === 200) {
        console.log(xhr.responseText);
	document.write(JSON.parse(xhr.responseText)['fat'][0]['fat']);
	//document.write(JSON.parse(xhr.responseText)['weight'][0]['weight']);
        data = JSON.parse(xhr.responseText)['weight'];
	console.log(data);
	var weight = [];
	var dates = []
	var i;
	// TODO scenarios for when data doesnt exist
	for (i=0; i<data.length; i++) {
    	    weight.push(data[i]['weight']);
	    dates.push(data[i]['date']);
	}
	//document.write(weight);
	console.log(weight);
	graph(weight, dates);
    } else {
        console.log('error ' + xhr.status);
    }
};
xhr.send();


function graph(data, dates) {
    /*var canvas = d3.select("body")
                        .append("svg")
                        .attr("width", 500)
                        .attr("height", 500);
        var circle = canvas.append("circle")
                        .attr("cx",250)
                        .attr("cy", 250)
                        .attr("r", 50)
                        .attr("fill", "red");
*/


//////////////

    var margin = 50;
var width = 200;
var height = 200;
var margin = 50;
var width = 200;
var height = 200;

var x = d3.scaleBand()
  .domain([0,1,2,3,4,5])
  .range([0,width]);

var y = d3.scaleLinear()
  .domain([0,250])
  .range([height,0]);

d3.select("svg")
  .append("g")
  .attr("transform", "translate("+margin+","+margin+")")
  .selectAll("rect").data(data)
  .enter().append("rect")
  .attr("x", function(d,i) {return i*(200.0/6.0);})
  .attr("y", function(d) {return y(d)})
  .attr("width", function(d) { return 200.0/6.0;})
  .attr("height", function(d) { return height-y(d);});

d3.select("svg").append("g")
  .attr("transform", "translate("+margin+","+margin+")")
  .call(d3.axisLeft(y));

d3.select("svg").append("g")
  .attr("transform", "translate("+margin+","+(height+margin)+")")
  .call(d3.axisBottom(x));





////////////////

	/*var m = [80, 80, 80, 80]; // margins
    var w = 1000 - m[1] - m[3]; // width
    var h = 400 - m[0] - m[2]; // height
    
    //var parseDate = d3.time.format("%Y-%m-%d").parse;
    
	
	// X scale will fit all values from data[] within pixels 0-w
		var x = d3.scaleLinear().domain([0, data.length]).range([0, w]);
		// Y scale will fit values from 0-10 within pixels h-0 (Note the inverted domain for the y-scale: bigger is up!)
		var y = d3.scaleLinear().domain([0, 10]).range([h, 0]);
			// automatically determining max range can work something like this
			// var y = d3.scale.linear().domain([0, d3.max(data)]).range([h, 0]);
		// create a line function that can convert data[] into x and y points
		var line = d3.line()
			// assign the X function to plot our line as we wish
			.x(function(d,i) { 
				// verbose logging to show what's actually being done
				console.log('Plotting X value for data point: ' + d + ' using index: ' + i + ' to be at: ' + x(i) + ' using our xScale.');
				// return the X coordinate where we want to plot this datapoint
				return x(i); 
			})
			.y(function(d) { 
				// verbose logging to show what's actually being done
				console.log('Plotting Y value for data point: ' + d + ' to be at: ' + y(d) + " using our yScale.");
				// return the Y coordinate where we want to plot this datapoint
				return y(d); 
			})
			// Add an SVG element with the desired dimensions and margin.
			var graph = d3.select("#graph").append("svg:svg")
			      .attr("width", w + m[1] + m[3])
			      .attr("height", h + m[0] + m[2])
			    .append("svg:g")
			      .attr("transform", "translate(" + m[3] + "," + m[0] + ")");
			// create yAxis
			var xAxis = d3.axisBottom().scale(x).tickSize(-h).tickSubdivide(true);
			// Add the x-axis.
			graph.append("svg:g")
			      .attr("class", "x axis")
			      .attr("transform", "translate(0," + h + ")")
			      .call(xAxis);
			// create left yAxis
			var yAxisLeft = d3.axisLeft().scale(y).ticks(4);
			// Add the y-axis to the left
			graph.append("svg:g")
			      .attr("class", "y axis")
			      .attr("transform", "translate(-25,0)")
			      .call(yAxisLeft);
			
  			// Add the line by appending an svg:path element with the data line we created above
			// do this AFTER the axes above so that the line is above the tick-lines
  			graph.append("svg:path").attr("d", line(data));
   */ 
}

function revokeAccess() {
    var params = "token=" + access_token;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://api.fitbit.com/oauth2/revoke');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Authorization", 'Basic MjJCVEhaOjdhNzFkNTFiMjMzYWZiMTIzYWNkMjQ5ZmJhODUwNDgy', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText)
        }
    };
    xhr.send(params);
}
