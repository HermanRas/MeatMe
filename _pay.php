<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Payment screen from vendor.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>

        <?php
        /////////////////////////////////////////////////////////////////////////////////////
        // GET Payment Confirmation from bank
        /////////////////////////////////////////////////////////////////////////////////////
        if(isset($_GET['ACTY'])||isset($_GET['ACTN'])){
            if(isset($_GET['ACTY'])){
                // Thanks for your Payment
                echo "<h3>Thank you for your Payment !<h3>";
                echo "<p>You can track your onder with the REF:QOD". $_GET['orderID'] ." on the orders page;</p>";
                echo "<br><hr>";
                echo '<a class="btn btn-primary" href="index.php">HOME</a>';
                echo "<br><hr>";
                $orderToFile = "Name,PricePK,Qtn,Weight,Portion\n";
                foreach ($_GET["productLog"] as $orderItem) {
                    $orderToFile = $orderToFile . $orderItem;
                }

                $orderToFile = $orderToFile . "\n\n" ."Name:".$_GET['name']."\n";
                $orderToFile = $orderToFile . "Email:".$_GET['Email']."\n";
                $orderToFile = $orderToFile . "Phone:".$_GET['Phone']."\n";
                $orderToFile = $orderToFile . "orderType:".$_GET['orderType']."\n";
                if(isset($_GET['location'])){
                    $orderToFile = $orderToFile ."location:".$_GET['location']."\n";
                }
                
                file_put_contents("Orders/QOD". $_GET['orderID'].".csv",$orderToFile);
                echo "<script>window.localStorage.setItem('cart', JSON.stringify([]));</script>";
            }
            if(isset($_GET['ACTN'])){
                // Oops, there was something wrong with your Payment
                echo "<h3> Oops, there was something wrong with your Payment <h3>";
                echo "<p>You can click below to try again.</p>";
                echo "<br><hr>";
                echo '<a class="btn btn-primary mx-2" href="order.php">Retry</a>';
                echo '<a class="btn btn-primary" href="index.php">HOME</a>';
                echo "<br><hr>";
            }

            die;
        }



        /////////////////////////////////////////////////////////////////////////////////////
        // POST from Order to bank
        /////////////////////////////////////////////////////////////////////////////////////
        
        // if Cart was ready
        if(isset($_POST["Email"]) && isset($_POST["Phone"]) && isset($_POST["name"])){
            echo "<form>";
            // Load Server Safe Prices and data
            include_once("_storeData.php");
            echo '<input type="hidden" value="'.$_POST['name'].'" name="name">';
            echo '<input type="hidden" value="'.$_POST['Email'].'" name="Email">';
            echo '<input type="hidden" value="'.$_POST['Phone'].'" name="Phone">';
            echo '<input type="hidden" value="'.$_POST['orderType'].'" name="orderType">';
            if(isset($_post['location'])){}
            echo '<input type="hidden" value="'.$_POST['location'].'" name="location">';
            $i = 0;
            $totalPrice = 0;
            foreach ($_POST["itemName"] as $name) {
                // Lookup Item in DB
                foreach($dataSet as $item) {
                    if ($item["name"] == $name) {
                        $totalPrice = $totalPrice + $item["Price p/kg"] * ($_POST["itemWeight"][$i] * $_POST["itemQuantity"][$i] / $item['PortionPack'][0]);
                        $productLog = $item["name"].",".$item["Price p/kg"] .",". $_POST["itemQuantity"][$i]. "," .$_POST["itemWeight"][$i].",".$_POST["itemPortion"][$i]."\n";
                        echo '<input type="hidden" value="'.$productLog.'" name="productLog[]">';
                        break;
                    }
                }
                $i++;
            }
            echo "BANK: FNB<br>";
            echo "BRANCH: 123-341<br>";
            echo "TYPE: SAVINGS<br>";
            echo "ACC: 6776542341<br>";
            $orderId = random_int(300000,499999);
            echo "OUR REF: QOD" .$orderId ."<br>";
            echo '<input type="hidden" value="'.$orderId.'" name="orderID">';
            echo "<b>R ".number_format( $totalPrice ,2) ."</b>";
            echo "<hr>";
            echo '<button name="ACTY" class="btn btn-outline-info">Fake Success transaction</button>';
            echo '<button name="ACTN" class="btn btn-outline-danger">Fake Failed transaction</button>';
            echo "</form>";
            echo "<br><hr>";
        }
        
        ?>

    </div>
</div>