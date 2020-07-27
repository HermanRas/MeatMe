<?PHP
///////////////////////////////////////////////////////////////////////////////////
//   Do POST Actions
///////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['action'])){

    //do actions update
    if ($_POST['action']== 'update'){
        $uid = $_POST['uid'];
        $naam = $_POST['userName'];
        $pwd = $_POST['userPin'];
        $acl = $_POST['acl'];
        $farm_id = $_POST['farm_id'];

        $sql = "update admins set name='$naam',password='$pwd',user_level='$acl',area_id='$farm_id' where id = '$uid'";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);

        echo '<script>  window.location.replace("agent.php?notice=update"); </script>';
    }
    
    //do actions add
    if ($_POST['action']== 'add'){
        $naam = $_POST['userName'];
        $pwd = $_POST['userPin'];
        $acl = $_POST['acl'];
        $farm_id = $_POST['farm_id'];

        $sql = "insert into admins (name,password,user_level,area_id) values('$naam','$pwd','$acl','$farm_id');";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);
        echo '<script>  window.location.replace("agent.php?notice=add"); </script>';
    }
}

//do actions delete
if (isset($_GET['delete'])){
    //delete user with uid
    $uid = $_GET['delete'];
    
    $sql = "delete from admins where id = '$uid'";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $result =  sqlQuery($sql,$sqlargs);
    
    echo '<script>  window.location.replace("agent.php?notice=delete"); </script>';
}

if (isset($_GET['notice'])){
    
    //if delete
    if ($_GET['notice']=='delete'){
    echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            User Removed !
         </div>';
    }

    //if update
    if ($_GET['notice']=='update'){
    echo '<div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            User Updated !
         </div>';
    }

    //if add
    if ($_GET['notice']=='add'){
    echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            User Added !
         </div>';
    }
}

?>

<script src="JS/userAction.js">
///////////////////////////////////////////////////////////////////////////////////
//   Do onchange Actions
///////////////////////////////////////////////////////////////////////////////////
</script>


<div class="container">
    <?php
    //if no add or update show form
    if ((!isset($_GET['add']))&&(!isset($_GET['name']))){
        $sql = "select * from admins limit 0,1000";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);
    ?>
    <div class="form-group">
        <h1 class="bg-secondary-dark rounded p-2 mt-1 text-center">Users:</h1>
        <hr>
        <label for="User">Users:</label>
        <select class="form-control" id="User" onchange="updateAction()">
            <option value="">Select Uesr</option>
            <?php
                foreach ($result[0] as $row) {
                    echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>';
                }
            ?>
            <option value="addUser">+New User</option>
        </select>
    </div>
    <?php
    }
    ?>

    <?php
    //if add new
    if (isset($_GET['add'])){
 

        $sql = "select * from access where description not like '%N/A%';";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $resultAcl =  sqlQuery($sql,$sqlargs);

        $sql = "select * from area;";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $resultFarm =  sqlQuery($sql,$sqlargs);
    ?>
    <form method="POST" id="frmAdd">
        <div class="form-group">
            <label for="userName">User Name:</label>
            <input type="text" class="form-control" value="" name="userName" id="userName" placeholder="Name">
            <label for="userPin">User Password:</label>
            <input type="text" class="form-control" value="" name="userPin" id="userPin" placeholder="Password">

            <label for="farm_id">Areas:</label>
            <select class="form-control" name="farm_id" id="farm_id">
                <option value="">Select Area</option>
                <?php
                    foreach ($resultFarm[0] as $row) {
                        echo '<option value="'. $row['id'].'" '. $selected .'>('. $row['id']. ') ' . $row['name'] .'</option>';
                     }
                ?>
            </select>

            <label for="acl">Access Level:</label>
            <select class="form-control" name="acl" id="acl" required>
                <option value="">Select Access</option>
                <?php
                    foreach ($resultAcl[0] as $row) {
                        if($row['id']==$acl){
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        echo '<option value="'. $row['id'].'" '. $selected .'>('. $row['id']. ') ' . $row['name'] .'</option>';
                     }
                ?>
            </select>
            <input type="hidden" name="action" value="add">
        </div>
        <button type="button" class="btn btn-success" onclick="frmAdd.submit()">Add</button>
        <button type="button" class="btn btn-warning" onclick="window.location.href='agent.php'">Cancel</button>
    </form>
    <?php
    }
    ?>

    <?php
    //update current
    if (isset($_GET['name'])){
        $uid = $_GET['name'];
        $sql = "select * from admins where id = '$uid' limit 1;";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $result =  sqlQuery($sql,$sqlargs);

        foreach ($result[0] as $row) {
            $name = $row['name'];
            $pass = $row['password'];
            $farm_id = $row['area_id'];
            $acl = $row['user_level'];
        }

        $sql = "select * from access where description not like '%N/A%';";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $resultAcl =  sqlQuery($sql,$sqlargs);

        $sql = "select * from area;";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $resultFarm =  sqlQuery($sql,$sqlargs);

    ?>
    <form method="POST" id="frmUpdate">
        <h1 class="bg-secondary-dark rounded p-2 mt-1 text-center">Update User:</h1>
        <hr>
        <div class="form-group">
            <label for="userName">User Name:</label>
            <input type="text" class="form-control" value="<?php echo $name; ?>" name="userName" id="userName">
            <input type="hidden" value="<?php echo $uid; ?>" name="uid" id="uid">

            <label for="userPin">User Password:</label>
            <input type="text" class="form-control" value="<?php echo $pass; ?>" name="userPin" id="userPin">

            <label for="farm_id">Areas:</label>
            <select class="form-control" name="farm_id" id="farm_id">
                <option value="">Select Area</option>
                <?php
                    foreach ($resultFarm[0] as $row) {
                        if($row['id']==$farm_id){
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        echo '<option value="'. $row['id'].'" '. $selected .'>('. $row['id']. ') ' . $row['name'] .'</option>';
                     }
                ?>
            </select>

            <label for="acl">Access Level:</label>
            <select class="form-control" name="acl" id="acl">
                <option value="">Select Access</option>
                <?php
                    foreach ($resultAcl[0] as $row) {
                        if($row['id']==$acl){
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        echo '<option value="'. $row['id'].'" '. $selected .'>('. $row['id']. ') ' . $row['name'] .'</option>';
                     }
                ?>
            </select>
            <input type="hidden" name="action" value="update">
        </div>
        <button type="button" class="btn btn-success" onclick="frmUpdate.submit()">Update</button>
        <button type="button" class="btn btn-danger" onclick="deleteAction()">Delete</button>
        <button type="button" class="btn btn-warning" onclick="window.location.href='agent.php'">Cancel</button>
    </form>
    <?php
    }
    ?>


</div>