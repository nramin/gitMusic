$(document).ready(function(){

	var overallData;
	var donutSliceColor;
	var completeData;
	var circleIndex = 1;
	var numCircles = [];
	var colors = ["#1f77b4", "#aec7e8", "#ff7f0e", "#ffbb78", "#2ca02c", "#98df8a", "#d62728", "#ff9896", "#9467bd", "#c5b0d5", "#8c564b", "#c49c94", "#e377c2", "#f7b6d2", "#7f7f7f", "#c7c7c7", "#bcbd22", "#dbdb8d", "#17becf", "#9edae5"];
	var pastCircleCenter;
	var circleHeight = 600;
	var circleWidth = 200;

	var margin = {top: 20, right: 30, bottom: 30, left: 40},
		width = 6000 - margin.left - margin.right,
	    height = 500 - margin.top - margin.bottom;

	$.ajax({
			url      : 'http://api.nytimes.com/svc/real-estate/v2/sales/count.jsonp',
			type     : 'GET',
			dataType : 'jsonp',
			data     : {"thousand-best" : "Y", 
						"geo-extent-level":"borough",
						"geo-extent-value": "Brooklyn",
						"geo-summary-level":"neighborhood",
						"date-range": "2008-Q4",
						"api-key" : "10daecc7fe0aaaa2f0dd05e8e15ec024:17:68174035"
			},
			success  : function(data){
				var d = data.results;
				var counts = getCountArray(d);
				overallData = d.slice(0);
				completeData = overallData;

				//tufteAss(d, true, '.chart', width/d.length, false, true, true);
				donut();
				path();
				//tufteAss(d.slice(0), false, '#chart2', 5, true, false, false); // copy of array
			}
		});



function xDomain(data){
	var xData = [];
	for(var i = 0; i < data.length; i++)
		xData.push(data[i].neighborhood);
	return xData;
}

function getCountArray(data){
	var counts = [];
	for(var i = 0; i < data.length; i++)
		counts.push(data[i].count);
	return counts;
}


//sort the data backwards
function tufteAss(data, descending, chart, barWidth, resizeCanvas, axis, ticks){

	if(resizeCanvas){
		width = 600;
		height = 680;
	}
	data = overallData;


    //var barWidth = width/ data.length + 1;

    /*
    if(descending)
    	data.sort(function(a, b) { return b.count - a.count; });
    else
    	data.sort(function(a, b) { return a.count - b.count; });
	*/

	
	var y = d3.scale.linear()
	    .range([height, 0]);

	
	//set a scale
	var x = d3.scale.ordinal()
		.domain(xDomain(data))
    	.rangeRoundBands([0, width + data.length * 2]);

    var xAxis = d3.svg.axis()
		.scale(x)
		.orient("bottom")
		.ticks(data.length);

	// change number of ticks
	var yAxis = d3.svg.axis()
		.scale(y)
		.orient('left')
		.ticks(5);

	//x.domain(data.map(function(d) { d.neighborhood; }))
	y.domain([0, d3.max(data, function(d) { return d.count; })]);

	//specify chart
	var chart = d3.select(chart)
	    	.attr("width", width + margin.left + margin.right)
	    	.attr("height", height + margin.top + margin.bottom)
	    .append("g")
	    	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


	// fix translate
	var bar = chart.selectAll(".bar")
		.data(data)
		.enter().append("g")
		.attr("class", "bar")
		.attr("transform", function(d, i) { return "translate(" + ((i * barWidth + 40) + i * 4) + ", 0)"; })
		
	// fix width
	bar.append('rect')
		.attr('y', function(d) { return y(d.count); })
		.attr("height", function(d) { return height - y(d.count); })
		.attr('width', barWidth);


	// only have on bigger one
	bar.append('text')
		.attr('dy', '1.75em')
		.attr('y', function(d) { return this.parentNode.childNodes[0].attributes[0].value })
		.attr('x', barWidth / 2)
		.attr('class', 'numbers')
		//.text(function(d) { return d.count })
		.on('click', function() {
			console.log(this.parentNode.childNodes[0].attributes[0].value);
	});

	if(axis) {
		chart.append("g")
			.data(data)
			.attr("class", "x axis")
			.attr('transform', 'translate(0,' + height + ')')
			.text(function(d){ return d.neighborhood; })
			.call(xAxis);

		chart.append("g")
			.attr("class", "y axis")
			.attr('id', 'yAxis')
			.call(yAxis)
			.append("text")
		    .attr("transform", "rotate(-90)")
		    .attr("y", 18)
		    .attr("dy", ".71em")
		    .style("text-anchor", "end")
		    .text("Apartments sold");
	} else { // click handler for chart 2
		bar.on('mouseover',function(d){
			$('#text2').text(d.neighborhood).attr('fill',"rgb(204,66,47)");
			//$('#' + d.neighborhood + '2').show();

		})
		.on('mouseout', function(d) {
			$('#text2').attr('fill',"white");
			//$('#' + (d.neighborhood.split(' ').join('')) + '2').hide();
		});

		$('.side').hide();

	}
	
		 

	var sortBars = function() {
		chart.selectAll("rect")
           .sort(function(a, b) {
                 return a.count - b.count;
           })
           .transition()
           .duration(1000)
           .attr("x", function(d, i) {
                 return x(i);
           });
	}

	//change color, and data
	if(ticks){
		chart.selectAll('.line')
			.data([50,100,150,200])
			.enter()
			.append('line')
			.attr('class','line')
			.attr('y1', function(d) { return y(d) })
			.attr('y2', function(d) { return y(d) })
			.attr('x1', 0)
			.attr('x2', 10000);
	} else {
		chart.selectAll('.line')
			.data(data)
			.enter()
			.append('line')
			.attr('class','line')
			.attr('y1', function(d) { return y(d.count) })
			.attr('y2', function(d) { return y(d.count) })
			.attr('x1', 0)
			.attr('x2', function(d, i) { return ((i * barWidth + 40) + i * 4) });

		chart.selectAll('.side')
			.data(data)
			.enter()
			.append('text')
			.attr('class','side')
			.attr('y', function(d) { return y(d.count) })
			.attr('x',function(d){
				if(String(d.count).match('^[0-9]{3}$'))
					return -10;
				else
					return -8;
			})
			.text(function(d) { return d.count })
			.attr('id', function(d){ 
				return d.neighborhood.split(' ').join('') + "2"
			});


		chart.append('text')
			.attr('x', 450)
			.attr('y', 300)
			.attr('id', 'text2')
			.text('');

	}


}

function donut() {

	d3.select(".donut").empty();

	var data = overallData;
	
	data.sort(function(a, b) { return b.count - a.count; });

	var width = 650,
    height = 600,
    radius = Math.min(width, height) / 2;

	var color = d3.scale.category20();

	/*
	var colors = [];
	for(var i =0; i< 20; i++)
		colors.push(color(i));
	*/
	

	console.log(colors);

	var pie = d3.layout.pie()
		.value(function (d) {return d.count });

	var arc = d3.svg.arc()
	    .innerRadius(radius - 100)
	    .outerRadius(radius - 60);


	var svg = d3.select(".donut")
		.data([data])
	    .attr("width", width)
	    .attr("height", height)
	    .append("g")
	    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

	var path = svg.selectAll("path")
	    .data(pie.value(function(d) { return d.count; }))
	  	.enter().append("path")
	    .attr("fill", function(d, i) { return color(i) ; })
	    .attr("d", arc)
	    //.classed('slice', true)
	    .on('mouseover', function(d){ 
	    	donutSliceColor = d3.select(this).style('fill');
	    	$('#donutData').empty();
	    	$span = $('<span>').text(d.data.count + ' apartments');
	    	$('#donutData').text(d.data.neighborhood + "'s version");
	    	d3.select(this).transition().style("fill", " #fcfcfa");
	    })
	    .on('mouseout', function(d){
	    	d3.select(this).transition().style("fill", donutSliceColor);
	    }).on('click', function(d){
	    	$('h1').text(d.data.neighborhood + "'s version");
	    	makeNewData();
	    });

}

function makeNewData(){
	var length = parseInt(getRandomArbitary(2, completeData.length));
	var dubaTemp = [];
	for(var i = 0; i < length; i++){
		dubaTemp.push(completeData[i]);
	}
	overallData = dubaTemp;
	donut();
	addCircle();
	addLine();
}

function getRandomArbitary (min, max) {
    return Math.random() * (max - min) + min;
}

function path() {
	

	var svg = d3.select(".path")
	    .attr("width", circleWidth)
	    .attr("height", circleHeight)
	    .append("g")
	    .classed('circles', true)
	    //.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

}

function addCircle() {
	pastCircleCenter = circleHeight - (100 * (circleIndex / 1.63));


	var circle = d3.select(".circles")
		.append('g')
		.classed('circleGroup', true)
		.attr('id', 'circleGroup' + circleIndex)
		.insert("circle")
		.classed('node', true)
		.attr('id', 'circle' + circleIndex)
        .attr("cx", 40)
        .attr('fill', 'white')
        .attr("cy", pastCircleCenter)
        .attr('stroke-width', 4)
        .attr('stroke', 'black')
        .attr('fill-opacity', 0.0);


    circle
    	.transition()
    	.attr("r", 0)
    	.duration(1000);
    	

  	circle.transition().duration(750).delay(50)
        .attr("r", 30);

    for (var i = 0; i < circleIndex; i++)
    	numCircles.push('duba');


    d3.selectAll(".node")
    	.data(numCircles)
    	.transition()
    	.duration(750)
    	.delay(50)
    	.attr('r', function(d,i) { 
    		if(i == 0)
    			return 30;
    		else
    			return calculateCircleRadius(i);
    	});



    rearrangeNodes();
}

function rearrangeNodes() {
	/*
	d3.selectAll('.circleGroup')
		.sort(function(){
			var num = this.attr('id');
			num = num.charAt(num.length - 1);
			return num - 1;
		});
*/
}

function addLine(){
	if(circleIndex != 1){

		console.log("center: " + getCircleCenter(circleIndex));
		getCircleRadius(circleIndex);
		

		var line = d3.select("#circleGroup" + circleIndex)
			.insert('line', "#circleGroup" + (circleIndex - 1))
			.attr("x1", 40)
            //.attr("y1", 560 - (100 * (circleIndex / 1.63)))
            //.attr("y1", (height - (100 * (circleIndex / 1.63))) + (30 / circleIndex * 1.63)) //bottom
            .attr('y1', getCircleCenter(circleIndex) + getCircleRadius(circleIndex))
            .attr("x2", 40)
            .attr("y2", getCircleCenter(circleIndex) + getCircleRadius(circleIndex)) //bottom
            .attr("stroke-width", 3)
            .attr("stroke", 'black');

        line.transition().duration(750).delay(50)
        	//.attr("y2", 555 - (100 * (circleIndex / 1.63)) + (30 / (circleIndex - 1) * 1.63))
        	.attr('y2', getCircleCenter(circleIndex - 1) - getCircleRadius(circleIndex - 1));
	}

	var text = line = d3.select("#circleGroup" + circleIndex)
		.append('text')
		.attr('x', 80)
		.attr('y', getCircleCenter(circleIndex))
		.attr('font-family', 'futura')
		.text('duba');

	circleIndex++;
}

function getCircleCenter(index){
	return parseInt(d3.select('#circle' + index).attr('cy'));
}

function calculateCircleRadius(index){
	if(index == 0)
		return 30;
	else
		return 30 / (index * 1.63);
}

function getCircleRadius(index){
	if(index == 0)
		return 30
	else
		return calculateCircleRadius(index - 1);
}

});

