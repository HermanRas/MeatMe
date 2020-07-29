<?php
if(isset($_GET['KEY'])){
  if($_GET['KEY'] !== 'fb2f0991-00da-4e57-bc4e-e7c0fa841613'){
    echo  '{"error": "Auth Failed"}';
    die;
  }
}else{
  echo  '{"error": "Auth Failed"}';
  die;
}

$sql = "SELECT
			orders.active,
			orders.orderID,
			orders.name,
			orders.email,
			orders.phone,
			orders.payment,
			orders.date,
			orders.is_pickup,
			orders.deliveraddress,
			orders.totalPrice,
			products.description,
			products.PricePK,
			products.Qtn,
			products.Weight,
			products.Portion,
			orders.area_id,
			area.name As area_name,
			area.description As area_description,
			status.name As status_name,
			status.description As status_description
		From
			orders Inner Join
			status On status.id = orders.status Inner Join
			products On orders.id = products.orders_id Inner Join
			area On area.id = orders.area_id";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
	$GetOrders =  sqlQuery($sql,$sqlargs);
	
$sql = "SELECT
			admins.name,
			admins.password,
			area.name As area_name,
			area.description As area_description,
			access.name As access_name,
			access.description As access_description
		From
			admins Inner Join
			area On area.id = admins.area_id Inner Join
			access On access.id = admins.user_level";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $GetUsers =  sqlQuery($sql,$sqlargs);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
</head>

<body>

    <h1>All Orders</h1>
    <table style="border">
        <header>
            <tr>
                <th>active</th>
                <th>orderID</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>payment</th>
                <th>date</th>
                <th>status_name</th>
                <th>status_description</th>
                <th>is_pickup</th>
                <th>deliveraddress</th>
                <th>totalPrice</th>
                <th>description</th>
                <th>PricePK</th>
                <th>Qtn</th>
                <th>Weight</th>
                <th>Portion</th>
                <th>area_name</th>
                <th>area_description</th>
            </tr>
        </header>
        <?php
		foreach ($GetOrders[0] as $order) {
		?>
        <tr>
            <td><?=$order['active']?></td>
            <td><?=$order['orderID']?></td>
            <td><?=$order['name']?></td>
            <td><?=$order['email']?></td>
            <td><?=$order['phone']?></td>
            <td><?=$order['payment']?></td>
            <td><?=$order['date']?></td>
            <td><?=$order['status_name']?></td>
            <td><?=$order['status_description']?></td>
            <td><?=$order['is_pickup']?></td>
            <td><?=$order['deliveraddress']?></td>
            <td><?=$order['totalPrice']?></td>
            <td><?=$order['PricePK']?></td>
            <td><?=$order['description']?></td>
            <td><?=$order['Qtn']?></td>
            <td><?=$order['Weight']?></td>
            <td><?=$order['Portion']?></td>
            <td><?=$order['area_name']?></td>
            <td><?=$order['area_description']?></td>
        </tr>
        <?php
			}
		?>
    </table>

    <h1>All Users</h1>
    <table style="border">
        <header>
            <tr>
                <th>name</th>
                <th>password</th>
                <th>access_name</th>
                <th>access_description</th>
                <th>area_name</th>
                <th>area_description</th>
            </tr>
        </header>
        <?php
		foreach ($GetUsers[0] as $order) {
		?>
        <tr>
            <td><?=$order['name']?></td>
            <td><?=$order['password']?></td>
            <td><?=$order['access_name']?></td>
            <td><?=$order['access_description']?></td>
            <td><?=$order['area_name']?></td>
            <td><?=$order['area_description']?></td>
        </tr>
        <?php
			}
		?>
    </table>
</body>

</html>