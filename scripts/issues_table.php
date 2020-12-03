<?php

require_once 'dbconfig.php';

try{
    $button=$_POST['button'];
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password1);
    $stmt = $conn->query("SELECT c.title,c.descrip,c.typeof,c.stat,c.assigned_to,c.created, c1.firstname, c1.lastname, c1.id  FROM issues c, users c1 WHERE c.assigned_to=c1.id");
    $results = $stmt ->fetchALL(PDO ::FETCH_ASSOC);
    if($button=='all'){
        echo '<table>';
        echo '<tr>';
        echo'<th>Title</th>';
        echo '<th></th>';
        echo '<th>Type</th>';
        echo '<th>Status</th>';
        echo '<th>Assigned To</th>';
        echo '<th>Created</th>';
        echo '</tr>';
        foreach($results as $row){
            $datetime = new DateTime($row['created']);
            $date1 = $datetime->format('Y-m-d');
            echo '<tr>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['descrip'].'</td>';
            echo '<td class="typeof">'.$row['typeof'].'</td>';
            echo '<td   class="status">'.$row['stat'].'</td>';
            echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
            echo '<td>'.$date1.'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    elseif($button=='open'){
        echo '<table>';
        echo '<tr>';
        echo'<th>Title</th>';
        echo '<th></th>';
        echo '<th>Type</th>';
        echo '<th>Status</th>';
        echo '<th>Assigned To</th>';
        echo '<th>Created</th>';
        echo '</tr>';
        foreach($results as $row){
            if($row['stat']=="open"){
                $datetime = new DateTime($row['created']);
                $date1 = $datetime->format('Y-m-d');
                echo '<tr>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['descrip'].'</td>';
                echo '<td class="typeof">'.$row['typeof'].'</td>';
                echo '<td   class="status">'.$row['stat'].'</td>';
                echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
                echo '<td>'.$date1.'</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    }
    elseif($button=='mytickets'){
        echo '<table>';
        echo '<tr>';
        echo'<th>Title</th>';
        echo '<th></th>';
        echo '<th>Type</th>';
        echo '<th>Status</th>';
        echo '<th>Assigned To</th>';
        echo '<th>Created</th>';
        echo '</tr>';
        foreach($results as $row){
            $datetime = new DateTime($row['created']);
            $date1 = $datetime->format('Y-m-d');
            if($row['id']=="1"){
                echo '<tr>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['descrip'].'</td>';
                echo '<td class="typeof">'.$row['typeof'].'</td>';
                echo '<td  class="status">'.$row['stat'].'</td>';
                echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
                echo '<td>'.$date1.'</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    }
}
catch (PDOException $pe){
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>