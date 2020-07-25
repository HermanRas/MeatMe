<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozow, new payment</title>
</head>

<body>
    <form action="https://pay.ozow.com" method="post">
        <label for="SiteCode">Site Code: </label>
        <input type="text" name="SiteCode" value="TSTSTE0001"><br>
        <label for="CountryCode">Country Code: </label>
        <input type="text" name="CountryCode" value="ZA"><br>
        <label for="CurrencyCode">Currency Code: </label>
        <input type="text" name="CurrencyCode" value="ZAR"><br>
        <hr>
        <label for="Amount">Amount: </label>
        <input type="text" name="CountryCode" value="3200"><br>
        <label for="TransactionReference">TransactionRef: </label>
        <input type="text" name="TransactionReference" value="QOD012345"><br>
        <label for="BankReference">BankReference: </label>
        <input type="text" name="BankReference" value="QueensOD-QOD012345"><br>
        <hr>
        <label for="Optional1">Optional1: </label>
        <input type="text" name="Optional1" value="Optional1"><br>
        <label for="Optional2">Optional2: </label>
        <input type="text" name="Optional2" value="Optional2"><br>
        <label for="Optional3">Optional3: </label>
        <input type="text" name="Optional3" value="Optional3"><br>
        <label for="Optional4">Optional4: </label>
        <input type="text" name="Optional4" value="Optional4"><br>
        <label for="Optional5">Optional5: </label>
        <input type="text" name="Optional5" value="Optional5"><br>
        <hr>
        <label for="Customer">Customer: </label>
        <input type="text" name="Customer" value="Herman Ras"><br>
        <label for="CancelURL">CancelURL: </label>
        <input type="text" name="CancelURL"
            value="https://phq-7hxllh2.petragroup.local/web_dev/projects/MeatMe/orderStatus.php?cancel"><br>
        <label for="ErrorURL">ErrorURL: </label>
        <input type="text" name="ErrorURL"
            value="https://phq-7hxllh2.petragroup.local/web_dev/projects/MeatMe/orderStatus.php?error"><br>
        <label for="SuccessUrl">SuccessUrl: </label>
        <input type="text" name="SuccessUrl"
            value="https://phq-7hxllh2.petragroup.local/web_dev/projects/MeatMe/orderStatus.php?orderID=441879"><br>
        <label for="NoticeUrl">NoticeUrl: </label>
        <input type="text" name="NoticeUrl"
            value="https://phq-7hxllh2.petragroup.local/web_dev/projects/MeatMe/orderStatus.php?note"><br>
        <hr>
        <label for="IsTest">IsTest: </label>
        <input type="text" name="IsTest" value="TRUE"><br>
        <label for="HashCheck">HashCheck: </label>
        <input type="text" name="HashCheck" id="HashCheck" value=""><br>
        <button type="submit">Start Order</button>
    </form>
    <div id="string">

    </div>
    <br>
    <div id="sha512">
    </div>
    <script type="text/javascript" src="../vendor/brix/crypto/crypto-js.js"></script>
    <script src="js/hashCheck.js"></script>
</body>

</html>