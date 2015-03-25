<?php
require_once "../inc/utils.php";

$questionID = intval($_POST['questionID']);
$question = substr(cleanUp($_POST['question']),0,250);
$link = cleanUp($_POST['link']);
$countAnswers = intval($_POST['countAnswers']);
$countVotes = intval($_POST['countVotes']);
$countViews = intval($_POST['countViews']);
$excerpt = substr(cleanUp($_POST['excerpt']),0,250);
$tag = cleanUp($_POST['tag']);

// Check whether question already exists
$query = "SELECT id FROM so_questions WHERE id=$questionID";
$result = mysql_query($query);
if (mysql_num_rows($result)) {
    // Update existing data
    $query = "UPDATE so_questions SET 
                question=\"$question\",link=\"$link\",countAnswers=$countAnswers,
                countVotes=$countVotes,countViews=$countViews,excerpt=\"$excerpt\",
                tag=\"$tag\" WHERE id=$questionID";
    if (mysql_query($query)) {
        echo '{"success":"true"}';
    } else {
        echo '{"success":"false","error":"'.mysql_error().'"}';
    }
} else {
    // Insert a new row
    $query = "INSERT INTO so_questions(id,question,link,countAnswers,countVotes,countViews,excerpt,tag) VALUES
                ($questionID,\"$question\",\"$link\",$countAnswers,$countVotes,$countViews,\"$excerpt\",\"$tag\")";
    if (mysql_query($query)) {
        echo '{"success":"true"}';
    } else {
        echo '{"success":"false","error":"'.mysql_error().'"}';
    }
}

?>
