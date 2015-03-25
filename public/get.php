<?php
$url = trim(urldecode($_GET['url']));

$html = file_get_contents($url);

// Extract only the div containing the questions
if (preg_match("/<div id=\"questions\"[^>]*?>([\s\S]*)<\/div>/mi", $html, $questions))
    $html = $questions[0];
$output = preg_replace("/(<script[^>]*?>[\s\S]*?<\/script>)/mi", "", $html);
echo $output;
?>
