<?php
    // Orders This Year
    $sql = "SELECT
            Count(main.orders.id) As orders
            From
            orders Inner Join
            status On status.id = orders.status
            Where
            orders.payment = 1 And
            orders.date Like (StrfTime('%Y', 'now') || '%');";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $CountOrdersY =  sqlQuery($sql,$sqlargs);
    $CountOrdersY = $CountOrdersY[0][0]["orders"];

    // Orders This Month
    $sql = "SELECT
            Count(main.orders.id) As orders
            From
            orders Inner Join
            status On status.id = orders.status
            Where
            orders.payment = 1 And
            orders.date Like (StrfTime('%Y', 'now') || '/' || StrfTime('%m', 'now') || '%');";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $CountOrdersM =  sqlQuery($sql,$sqlargs);
    $CountOrdersM = $CountOrdersM[0][0]["orders"];
    
    // Orders Pending
    $sql = "SELECT
            Count(main.orders.id) As orders
            From
            orders Inner Join
            status On status.id = orders.status
            Where
            orders.payment = 0;";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $CountPending =  sqlQuery($sql,$sqlargs);
    $CountPending = $CountPending[0][0]["orders"];

    // Orders Complete 
    $sql = "SELECT
            sum(totalPrice) as total
            From orders
            WHERE payment = 1";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $CountPayment =  sqlQuery($sql,$sqlargs);
    $CountPayment = $CountPayment[0][0]["total"];

    // Sales by Product Items 
    $sql = "SELECT
                products.description,
                Count(main.products.description) As count
            From
                orders Inner Join
                status On status.id = orders.status Inner Join
                products On orders.id = products.orders_id
            Group By
                products.description
            Order By count DESC
                limit 0,5;";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $ProductsCount =  sqlQuery($sql,$sqlargs);
    $Products = [];
    $Products["description"] = [];
    $Products["count"] = [];

    foreach ($ProductsCount[0] as $rec) {
        array_push($Products["description"],$rec["description"]);
        array_push($Products["count"],(int)$rec["count"]);
    }
    $Products =  json_encode($Products);
    echo '<script> let productsCount = '.$Products.'; </script>' ;

    // Top Clients Complete 
    $sql = "SELECT 
                name,
                email,
                count(totalPrice) as count
            FROM orders
                WHERE
                payment = 1
                GROUP BY
                name, email
            ORDER BY count DESC
                limit 0,10";
                
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $Clients =  sqlQuery($sql,$sqlargs);
?>
<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">QWEENS ONLINE DELI<br><small>Admin Dashboard</small></h1>
    <!-- Content Row -->
    <div class="row">

        <!-- Employees (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Sales (Year)</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?=$CountOrdersY;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employees (Online) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sales (Month)</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?=$CountOrdersM;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Today Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Sales
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">R <?=$CountPayment;?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Assistance Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Orders Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$CountPending?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-12">
            <!-- Modules Completed Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">TOP 10 Clients</h6>
                </div>
                <div class="card-body">
                    <?php
                    $total = 0;
                    foreach ($Clients[0] as $rec) {
                        $total += (int)$rec["count"];
                    }
                    foreach ($Clients[0] as $rec) {
                        $percent = ((int)$rec["count"] / $total)*100
                ?>
                    <h4 class="small font-weight-bold">
                        <?php echo '<a class="text-dark" href="mailto:'.$rec['email'].'">'. $rec["name"]." (".$rec["count"].")</a>";?><span
                            class="float-right"><?=$percent?>%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?=$percent?>%"
                            aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-lg-6 mb-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Sales by Item</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">

                        <!-- '#4e73df', '#28a745', '#36b9cc', '#ffc107', '#dc3545' -->
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:#4e73df;"></i>
                            <?=$ProductsCount[0][0]["description"] ?>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:#28a745;"></i>
                            <?=$ProductsCount[0][1]["description"] ?>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:#36b9cc;"></i>
                            <?=$ProductsCount[0][2]["description"] ?>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:#ffc107;"></i>
                            <?=$ProductsCount[0][3]["description"] ?>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:#dc3545;"></i>
                            <?=$ProductsCount[0][4]["description"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/Chart.min.js"></script>
<script src="js/adminPie.js"></script>