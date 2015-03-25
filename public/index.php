<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <script src="js/d3.v3.min.js" charset="utf-8"></script>
        <title>Sonify</title>
    </head>
    <body>
        
        <div id="chart2">
            <h3>Number of questions vs. Tag</h3>
        </div>
        
        <div id="chart3">
            <h3>Number of views vs. Tag</h3>
        </div>
        
        <div id="chart4">
            <h3>Average number of views/question vs. Tag</h3>
        </div>
        
        <div id="chart5">
            <h3>Number of answers vs. Tag</h3>
        </div>
        
        <div id="chart6">
            <h3>Average number of answers/question vs. Tag</h3>
        </div>
        
        <div id="chart7">
            <h3>Number of questions with downvotes vs. Tag</h3>
        </div>
        <div id="chart8">
            <h3>Number of questions with no answers vs. Tag</h3>
        </div>
        <script src="js/barGraph.js"></script>
        <script>
                barGraph("chart2", 2);
                barGraph("chart3", 3);
                barGraph("chart4", 4);
                barGraph("chart5", 5);
                barGraph("chart6", 6);
                barGraph("chart7", 7);
                barGraph("chart8", 8);
        </script>
    </body>
</html>
