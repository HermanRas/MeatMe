<?php
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
                area.name As area
            From
                orders Inner Join
                status On status.id = orders.status Inner Join
                area On area.id = orders.area_id
            Where
                orders.active = 0";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $GetOrders =  sqlQuery($sql,$sqlargs);
?>
<div style="min-width: 90vw !important;" class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">Orders</h1>
    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th class="d-none d-lg-table-cell">Email</th>
                            <th class="d-none d-lg-table-cell">Phone</th>
                            <th class="d-none d-lg-table-cell">Payment</th>
                            <th>Date</th>
                            <th class="d-none d-lg-table-cell">Status</th>
                            <th class="d-none d-lg-table-cell">Pickup</th>
                            <th class="d-none d-lg-table-cell">Address</th>
                            <th class="d-none d-lg-table-cell">TotalPrice</th>
                            <th class="d-none d-lg-table-cell">Area</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th class="d-none d-lg-table-cell">Email</th>
                            <th class="d-none d-lg-table-cell">Phone</th>
                            <th class="d-none d-lg-table-cell">Payment</th>
                            <th>Date</th>
                            <th class="d-none d-lg-table-cell">Status</th>
                            <th class="d-none d-lg-table-cell">Pickup</th>
                            <th class="d-none d-lg-table-cell">Address</th>
                            <th class="d-none d-lg-table-cell">TotalPrice</th>
                            <th class="d-none d-lg-table-cell">Area</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            foreach ($GetOrders[0] as $order) {
                        ?>
                        <tr>
                            <td><?php echo $order["orderID"]; ?></td>
                            <td><?php echo $order["name"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["email"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["phone"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo ($order["payment"] == 0 ?  "No" : "Yes"); ?>
                            </td>
                            <td><?php echo $order["date"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["status"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo ($order["is_pickup"] == 0 ?  "No" : "Yes"); ?>
                            </td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["deliveraddress"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["totalPrice"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $order["area"]; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Data Table -->
    <div class="row">
        <div class="col-12 col-md-12">
            <a href="home.php" class="btn btn-lg btn-primary w-100"> Cancel </a>
        </div>
    </div>
</div>