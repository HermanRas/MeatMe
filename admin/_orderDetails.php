<?php
    // set area filter 
    $acl_area_id = (isset($_SESSION['area_id'])?$_SESSION['area_id']:'');
    $ID = (isset($_GET["ID"]))?(int)$_GET["ID"]:0;
    // Order
    $sql = "SELECT
                orders.id,
                orders.active,
                orders.orderID,
                orders.name,
                orders.email,
                orders.phone,
                orders.payment,
                orders.date,
                status.name || ' - ' || status.description As status,
                orders.is_pickup,
                orders.deliveraddress,
                orders.totalPrice,
                area.name || ' - ' || area.description As area
            From
                orders Inner Join
                status On status.id = orders.status Inner Join
                area On area.id = orders.area_id
            Where
                orders.active = 1
                and
                orders.id = $ID
                and
                area.id LIKE '$acl_area_id'";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $GetOrder =  sqlQuery($sql,$sqlargs);
    $GetOrder =$GetOrder[0][0];

    // Details
    $sql = "SELECT * FROM
                products
            WHERE
                orders_id = $ID
            limit 0,1000;";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $GetOrderDetails =  sqlQuery($sql,$sqlargs);
?>
<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center"> Order </h1>
    <hr>
    <h2 class="bg-primary rounded p-2 text-center"><?=$GetOrder["orderID"]?></h2>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Date:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["date"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Name:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["name"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Email:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["email"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Phone:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["phone"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Active:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=($GetOrder["active"]==1? "Yes":"No")?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Paid:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=($GetOrder["payment"]==1? "Yes":"No")?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Deliver:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=($GetOrder["is_pickup"]==0? "Yes":"No")?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Area:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["area"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Address:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$GetOrder["deliveraddress"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Total:</b>
        </div>
        <div class="col-12 col-md-6">
            <?='R'.sprintf('%01.2f', $GetOrder["totalPrice"])?>
        </div>
    </div>
    <hr>
    <h4 class="bg-primary-dark rounded text-center">Items:</h4>
    <?php
    $i = 1;
    foreach ($GetOrderDetails[0] as $item) {
    ?>
    <div class="row">
        <div class="col-12 col-md-12">
            <h5 class="border-bottom border-top">ITEM: <?=$i?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>name</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$item["name"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>description</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$item["description"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>PricePK:</b>
        </div>
        <div class="col-12 col-md-6">
            <?='R'.sprintf('%01.2f', $item["PricePK"])?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Qtn:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$item["Qtn"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Weight:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$item["Weight"]?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <b>Portion:</b>
        </div>
        <div class="col-12 col-md-6">
            <?=$item["Portion"]?>
        </div>
    </div>
    <?php
    $i++;
    }
    ?>
    <hr>
    <!-- End of Data Table -->
    <div class="row">
        <div class="col-12 col-md-3">
            <a href="ordersActive.php" class="btn btn-lg btn-secondary w-100"> Back </a>
        </div>
        <div class="col-12 col-md-3">
            <a href="home.php" class="btn btn-lg btn-success w-100" onclick="err();return false;"> Update </a>
        </div>
        <div class="col-12 col-md-3">
            <a href="home.php" class="btn btn-lg btn-info w-100" onclick="window.print();return false;"> Print </a>
        </div>
        <div class="col-12 col-md-3">
            <a href="home.php" class="btn btn-lg btn-primary w-100"> Home </a>
        </div>
    </div>
    <br>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
function err() {
    Swal.fire({
        icon: 'info',
        title: 'well...',
        text: 'Herman is amper klaar hier!'
    })
}
</script>