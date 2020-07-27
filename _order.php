<?php
if(isset($_POST['pay'])){
    if(isset($_POST['pay'])){
        // set save values
        date_default_timezone_set('Africa/Harare');
        $orderId = "QOD".random_int(300000,499999);
        $Name = '';
        $Email = '';
        $Phone = '';
        $OrderType = '';
        $Location = '';
        $payment = 0;
        $date = date('Y/m/d h:m:s');
        $active = 1;
        $status = 1;
        $area = 0;

        // set save values;
        $Name = $_POST['name'];
        $Email = $_POST['Email'];
        $Phone = $_POST['Phone'];
        $area = $_POST['Area'];
        $OrderType = ($_POST['orderType'] == 'Deliver') ? 0 : 1;
        if(isset($_POST['location'])){
            $Location = $_POST['location'];
        }

        // insert SQL
        $sql = "INSERT INTO [orders]
            ([orderID]
            ,[name]
            ,[email]
            ,[phone]
            ,[payment]
            ,[date]
            ,[active]
            ,[status]
            ,[is_pickup]
            ,[deliveraddress]
            ,[area_id])
        VALUES
            ('$orderId'
            ,'$Name'
            ,'$Email'
            ,'$Phone'
            ,'$payment'
            ,'$date'
            ,'$active'
            ,'$status'
            ,'$OrderType'
            ,'$Location'
            ,'$area');";

        // DEBUG
        // echo $sql;

        // INSERT TO SQL
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $AddOrder =  sqlQuery($sql,$sqlargs);

        $sql = "SELECT id from [orders] ORDER BY [id] DESC limit 1";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $GetOrderID =  sqlQuery($sql,$sqlargs);

        $GetOrderID = ($GetOrderID[0][0]['id']);

        if(isset($_POST["itemName"])){}
        $item = [];
        $itemsCount = count($_POST["itemName"]);
        
        // Include latest store prices
        require_once('_storeData.php');
        $totalPrice = 0;
        for ($i=0; $i < $itemsCount; $i++) { 
            $name = $_POST["itemName"][$i];
            // find item in store data
            $itemIndex = null;
            foreach($dataSet as $index) {
                if ($name == $index['name']) {
                    $itemIndex = $index;
                    break;
                }
            }
            
            // add create item in order
            $item[$i]['itemName'] = $_POST["itemName"][$i];
            $item[$i]['itemDesc'] = $_POST["itemDesc"][$i];
            $item[$i]['itemWeight'] = $_POST["itemWeight"][$i];
            $item[$i]['itemPortion'] = $_POST["itemPortion"][$i];
            $item[$i]['itemQuantity'] = $_POST["itemQuantity"][$i];
            $item[$i]['itemPricePer'] = $itemIndex['Price p/kg'];
            $item[$i]['itemQuantityPer'] = $itemIndex['PortionPack'][0];
            
            // const itemPrice = (cartItem[0].qnt * cartItem[0].portionValue / storeData[index]['PortionPack'][0]) * storeData[index]['Price p\/kg'];
            // Calc Price
            $price = ($item[$i]['itemQuantity'] * $item[$i]['itemWeight'] / $item[$i]['itemQuantityPer']) * $item[$i]['itemPricePer'];
            $item[$i]['Price'] = $price;
            $totalPrice += $price;

            
            // PrepArgs TO SQL
            $itemName = $item[$i]['itemName'];
            $itemDesc = $item[$i]['itemDesc'];
            $itemPricePer = $item[$i]['itemPricePer'];
            $itemQuantity = $item[$i]['itemQuantity'];
            $itemWeight = $item[$i]['itemWeight'];
            $itemPortion = $item[$i]['itemPortion'];

            // add products to order in DB
            $sql = "INSERT INTO [products]
                ([name]
                ,[description]
                ,[PricePK]
                ,[Qtn]
                ,[Weight]
                ,[Portion]
                ,[orders_id])
            VALUES
                ('$itemName'
                ,'$itemDesc'
                ,'$itemPricePer'
                ,'$itemQuantity'
                ,'$itemWeight'
                ,'$itemPortion'
                ,'$GetOrderID');";

            $sqlargs = array();
            require_once 'config/db_query.php'; 
            $AddProduct =  sqlQuery($sql,$sqlargs);
        }
        
        // update order price
        $sql = "UPDATE [orders] SET [totalPrice] = '$totalPrice' WHERE [id] = '$GetOrderID';";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $updatePrice =  sqlQuery($sql,$sqlargs);
        echo "<script> window.localStorage.setItem('cart', JSON.stringify([]));</script>";
        echo '
            <main data-barba="container" data-barba-namespace="home">
                <div class="container mt-3">
                    <h1 class="bg-secondary-dark rounded p-2">LAMB</h1>
                    <div class="text-center">
                        <hr>
                        <p class="text-dark"> Your order has been created your Order ID: '.$orderId.'</p>
                        <a class="btn  btn-primary" href="https://pay.ozow.com/">
                           Pay Via OZOW Online
                        </a>
                    </div>
                </div>
            </main>';
        die;
    }
}
?>

<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <form method="POST">
        <div class="container mt-3">
            <div class="card bg-primary">
                <div class="card-header">
                    <h2 class="text-white">
                        <span class="px-2"><i style="font-size: 2rem;"
                                class="fas fa-shopping-cart cart-icon"></i></span>
                        My Order
                    </h2>
                </div>

                <div class="container pb-2">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" Name="name" aria-describedby="emailHelp"
                            placeholder="Enter Your Name" Required>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="Email" Name="Email" aria-describedby="emailHelp"
                            placeholder="Enter email" Required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                            anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone Number</label>
                        <input type="text" class="form-control" id="Phone" Name="Phone" placeholder="072 000 1234"
                            Required>
                    </div>
                    <?php
                        // get Areas from DB
                        $sql = "Select * from area;";
                        $sqlargs = array();
                        require_once 'config/db_query.php'; 
                        $areas =  sqlQuery($sql,$sqlargs);
                    ?>
                    <div class="form-group">
                        <label for="Area">Location / Area:</label>
                        <select class="form-control" name="Area" id="Area" required>
                            <option value="">Please Select</option>
                            <?php
                            foreach ($areas[0] as $area) {
                                echo '<option value="'.$area['id'].'">'.$area['name'].' - '.$area["description"].'</option>';
                            }
                            
                            
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="orderType">Collect / Deliver:</label>
                        <select class="form-control" name="orderType" id="orderType" onchange="getLocation()" required>
                            <option value="">Please Select</option>
                            <option vlaue="Deliver">Deliver</option>
                            <option value="Collect">Collect</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Terms & Conditions" Required>
                        <label class="form-check-label" for="exampleCheck1">I accept the <a href="terms.php"
                                target="_blank">Terms and Conditions</a>, Check me
                            out</label>
                    </div>
                </div>
                <hr>

                <ul id="cartData" class="list-group list-group-flush">
                    <!-- Per Item -->
                    <!-- 
                        /////////////////////////////////////////////////////////////////////////////////
                        //  Render Cart Page cartManager.js
                        /////////////////////////////////////////////////////////////////////////////////
                    -->
                </ul>
            </div>
            <br>
            <a class="btn btn-primary" href="index.php">&lt; Back to Shopping</a>
            <button type="submit" name="pay" class="btn btn-primary float-right">Let's Pay</button>
            <br>
            <hr>
        </div>
    </form>
</main>

<script>
function getLocation() {

    const e = document.getElementById("orderType");
    const type = e.options[e.selectedIndex].value;
    console.log(type);

    if (type === 'Deliver') {
        console.log('add input');

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "location");
        input.setAttribute("id", "location");
        input.setAttribute("class", "form-control");
        input.setAttribute("placeholder", "your address");
        input.setAttribute("required", "required");
        e.after(input);
    } else {
        const e = document.getElementById("location");
        e.parentNode.removeChild(e);
    }
}
</script>