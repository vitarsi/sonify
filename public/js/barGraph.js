function barGraph(placeholder, code) {

var data = new Array();

d3.json("getJSON.php?c="+code,function(error, d) {
    data = d;
    render();
});

function render() {
    var barWidth = 700/data.length;

    var svg = d3.select("#"+placeholder).append("svg")
        .attr("width", 800)
        .attr("height", 500);
    
    var xScale = d3.scale.ordinal()
        .rangeRoundBands([0, 700], .1)
        .domain(data.map(function(d) {return d.tag;}));
    var yScale = d3.scale.linear()
        .range([450,50])
        .domain([0,d3.max(data, function(d) {return +d.count;})]);

    var xAxis = d3.svg.axis()
        .scale(xScale)
        .orient("bottom");
    var yAxis = d3.svg.axis()
        .scale(yScale)
        .orient("left");
    
    svg.selectAll(".bar")
        .data(data)
            .enter().append("rect")
                .attr("class", "bar")
                .attr("transform", function(d,i){return "translate("+(i*barWidth+50)+",450)";})
                .attr("width", barWidth-2)
                .attr("height", function(d) {return 0;});
    // Add transition
    svg.selectAll(".bar")
        .data(data)
            .transition()
                .duration(2000)
                .attr("transform", function(d,i){return "translate("+(i*barWidth+50)+","+yScale(d.count)+")";})
                .attr("height", function(d) {return 450-yScale(d.count);});
    
    svg.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(50," + 450 + ")")
        .call(xAxis);
    svg.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(50,0)")
        .call(yAxis);
}
}