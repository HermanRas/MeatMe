<?php 
function sqlQuery($sql,$args){
        require("config/db.php");
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($args);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $results = NULL;
        $count = 0;
        
        try {
                    $results = $stmt->fetchAll();
                    $count = count($results);
        } catch (\Throwable $th) {
                    //echo $th;
        }

        return [$results, $count];
    }
?>