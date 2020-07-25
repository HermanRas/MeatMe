<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <div class="container mt-3">
        <hr>
        <h1 class="bg-secondary-dark rounded p-2">Order Status !</h1>
        <div>
            <form>
                <div class="form-group">
                    <label for="orderID">OrderID</label>
                    <input type="text" class="form-control" name="orderID" aria-describedby="orderHelp"
                        placeholder="Enter OrderID: QOD0000000">
                    <small id="orderHelp" class="form-text text-danger">If you lost your oder ID please get in touch via
                        the contact us page.</small>
                </div>
                <button class="form-control btn btn-primary" type="submit">Search</button>
            </form>
        </div>
        <br>
        <hr>
        <?php
            if(isset($_GET["orderID"])){
                $GetOrderID = $_GET["orderID"];
                
                // load order
                $sql = "SELECT
                        orders.orderID,
                        orders.name,
                        orders.email,
                        orders.phone,
                        orders.payment,
                        orders.date,
                        orders.active,
                        orders.status,
                        orders.is_pickup,
                        orders.deliveraddress,
                        orders.totalPrice,
                        status.name As status_name,
                        status.description As status_descr
                        From
                        orders Inner Join
                        status On status.id = orders.status
                        WHERE [orderID] = '$GetOrderID';";
                $sqlargs = array();
                require_once 'config/db_query.php'; 
                $order =  sqlQuery($sql,$sqlargs);

                $orderCount = $order[1];
                $order = $order[0][0];

                if($orderCount == 1){
                    echo "<h2>Your order was received</h2>";
                    echo "<b> Latest News on your order:<br>";
                    echo  $order["status_name"]."</b> - ".$order["status_descr"] . "<br><hr>";
                    echo '<a class="w-100 btn btn-primary" href="index.php">HOME</a>';
                    echo "<br><hr>";
                }else{
                    echo "<h2>Please type your order ID carefully</h2>";
                }
            }
        ?>
    </div>
</main>