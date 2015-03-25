<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="styles/crawler.css">
        <script src="js/jquery-1.11.1.min.js" charset="utf-8"></script>
        <script src="js/crawler.js" charset="utf-8"></script>
        <script>
            $(document).ready(docInitialise);
        </script>
        <title>Sonify Crawler</title>
    </head>
    <body>
        <div id="startButton">Start crawling</div>
        <div id="currentJob"></div>
        <div id="currentUrl"></div>
        <div id="currentState"></div>
        <iframe id="loader"></iframe>
    </body>
</html>
