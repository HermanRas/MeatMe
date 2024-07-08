<?PHP
///////////////////////////////////////////////////////////////////////////////////
//   Do POST Actions
///////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['action'])){

    //do actions update
    if ($_POST['action']== 'update'){
        $uid = $_POST['uid'];
        $name = $_POST['areaName'];
        $description = $_POST['areaDescription'];

        $sql = "update area set name='$name',description='$description' where id = '$uid'";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);

        echo '<script>  window.location.replace("area.php?notice=update"); </script>';
    }
    
    //do actions add
    if ($_POST['action']== 'add'){
        $name = $_POST['areaName'];
        $description = $_POST['areaDescription'];

        $sql = "insert into area (name,description) values('$name','$description');";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);
        echo '<script>  window.location.replace("area.php?notice=add"); </script>';
    }
}

//do actions delete
if (isset($_GET['delete'])){
    //delete farm with uid
    $uid = $_GET['delete'];
    
    $sql = "delete from area where id = '$uid'";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $result =  sqlQuery($sql,$sqlargs);

    echo '<script>  window.location.replace("area.php?notice=delete"); </script>';
}

if (isset($_GET['notice'])){
    
    //if delete
    if ($_GET['notice']=='delete'){
    echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            Area Removed !
         </div>';
    }

    //if update
    if ($_GET['notice']=='update'){
    echo '<div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            Area Updated !
         </div>';
    }

    //if add
    if ($_GET['notice']=='add'){
    echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            Area Added !
         </div>';
    }
}

?>

<script src="js/areaAction.js">
///////////////////////////////////////////////////////////////////////////////////
//   Do onchange Actions
///////////////////////////////////////////////////////////////////////////////////
</script>


<div class="container">
    <?php
    //if no add or update show form
    if ((!isset($_GET['add']))&&(!isset($_GET['name']))){
        $sql = "select * from area limit 0,1000";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);
    ?>
    <div class="form-group">
        <h1 class="bg-secondary-dark rounded p-2 mt-1 text-center">Areas:</h1>
        <hr>
        <label for="farm">Areas:</label>
        <select class="form-control" id="farm" onchange="updateAction()">
            <option value="">Select Area</option>
            <?php
                foreach ($result[0] as $row) {
                    echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>';
                }
            ?>
            <option value="addFarm">+Add Area</option>
        </select>
    </div>
    <?php
    }
    ?>

    <?php
    //if add new
    if (isset($_GET['add'])){
    ?>
    <form method="POST" id="frmAdd">
        <h1 class="bg-secondary-dark rounded p-2 mt-1 text-center">New Area:</h1>
        <hr>
        <div class="form-group">
            <label for="areaName">Name:</label>
            <input type="text" class="form-control" value="" name="areaName" id="areaName" placeholder="Name">
            <label for="areaDescription">Description:</label>
            <input type="text" class="form-control" value="" name="areaDescription" id="areaDescription"
                placeholder="Description">
            <input type="hidden" name="action" value="add">
        </div>
        <button type="button" class="btn btn-success" onclick="frmAdd.submit()">Add Area</button>
        <button type="button" class="btn btn-warning" onclick="window.location.href='area.php'">Cancel</button>
    </form>
    <?php
    }
    ?>

    <?php
    //update current
    if (isset($_GET['name'])){

        $uid = $_GET['name'];
        $sql = "select * from area where id = '$uid' limit 1;";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);

        foreach ($result[0] as $row) {
            $name = $row['name'];
            $description = $row['description'];
        }
    ?>
    <form method="POST" id="frmUpdate">
        <h1 class="bg-secondary-dark rounded p-2 mt-1 text-center">Update Area:</h1>
        <hr>
        <div class="form-group">
            <label for="areaName">Name:</label>
            <input type="text" class="form-control" value="<?php echo $name; ?>" name="areaName" id="areaName">
            <input type="hidden" value="<?php echo $uid; ?>" name="uid" id="uid">

            <label for="areaDescription">Description:</label>
            <input type="text" class="form-control" value="<?php echo $description; ?>" name="areaDescription"
                id="areaDescription">
            <input type="hidden" name="action" value="update">
        </div>
        <button type="button" class="btn btn-success" onclick="frmUpdate.submit()">Update</button>
        <button type="button" class="btn btn-danger" onclick="deleteAction()">Remove</button>
        <button type="button" class="btn btn-warning" onclick="window.location.href='area.php'">Cancel</button>
    </form>
    <?php
    }
    ?>


</div>