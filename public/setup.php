<?php
require_once "../inc/utils.php";

if (isset($_POST['intent'])) {
    if ($_POST['intent']==="Create table") {
        $query = "CREATE TABLE IF NOT EXISTS so_questions (
                    id int(11) NOT NULL,
                    question varchar(255) NOT NULL,
                    link varchar(1024) NOT NULL,
                    countAnswers int(11) NOT NULL,
                    countVotes int(11) NOT NULL,
                    countViews int(11) NOT NULL,
                    excerpt varchar(255) NOT NULL,
                    tag varchar(16) NOT NULL,
                    PRIMARY KEY  (id)
                    )";
        if(mysql_query($query))
            $success = true;
        else 
            echo mysql_error();
    }
    if ($_POST['intent']==="Empty table") {
        $query = "DELETE FROM so_questions";
        if(mysql_query($query))
            $success = true;
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            body {
                font-family: Verdana;
            }
        </style>
        <title>Sonify Setup</title>
    </head>
    <body>
        <div>
            <?php if (isset($success) && $success) echo "Successfully done!";?>
            <form method="POST">
                Click here to setup the table required for Sonify:
                <input type="submit" name="intent" value="Create table"><br>
                Click here to purge the table:
                <input type="submit" name="intent" value="Empty table"><br>
            </form>
        </div>
    </body>
</html>
