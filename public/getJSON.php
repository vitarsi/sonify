<?php
require_once "../inc/utils.php";

$code = intval($_GET['c']);

switch($code) {
    case 1:    // views vs answers with votes
        $query = "SELECT countAnswers, countVotes, countViews FROM so_questions WHERE tag LIKE 'php'";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }

            echo json_encode($data);
        }        break;
    case 2:    // number of questions vs tag
        $query = "SELECT count(*) AS 'count', tag FROM so_questions GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }
            // Save this information
            $_SESSION['totals'] = $data;

            echo json_encode($data);
        }
        break;
    case 3:    // number of views vs tag
        $query = "SELECT sum(countViews) AS 'count', tag FROM so_questions GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
        break;
    case 4:    // number of views/question vs tag
        $query = "SELECT sum(countViews) AS 'count', tag FROM so_questions GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            $i = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                // Normalise the data
                $row['count'] /= $_SESSION['totals'][$i++]['count'];
                $data[] = $row;
            }
            
            echo json_encode($data);
        }
        break;
    case 5:    // number of answers vs tag
        $query = "SELECT sum(countAnswers) AS 'count', tag FROM so_questions GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
        }
        break;
    case 6:    // number of answers/question vs tag
        $query = "SELECT sum(countAnswers) AS 'count', tag FROM so_questions GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            $i = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                // Normalise the data
                $row['count'] /= $_SESSION['totals'][$i++]['count'];
                $data[] = $row;
            }
            
            echo json_encode($data);
        }
        break;
    case 7:    // questions with downvotes vs tag
        $query = "SELECT count(*) AS 'count', tag FROM so_questions WHERE countVotes<0 GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
        }
        break;
    case 8:    // questions with no answers vs tag
        $query = "SELECT count(*) AS 'count', tag FROM so_questions WHERE countAnswers=0 GROUP BY tag";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) {
            $data = Array();
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
        }
        break;
}

?>
