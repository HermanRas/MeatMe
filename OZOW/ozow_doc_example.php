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
        <label for="Amount">Amount: </label>
        <input type="text" name="CountryCode" value="25.00"><br>
        <label for="TransactionReference">TransactionRef: </label>
        <input type="text" name="TransactionReference" value="123"><br>
        <label for="BankReference">BankReference: </label>
        <input type="text" name="BankReference" value="ABC123"><br>
        <label for="CancelURL">CancelURL: </label>
        <input type="text" name="CancelURL" value="http://demo.ozow.com/cancel.aspx"><br>
        <label for="ErrorURL">ErrorURL: </label>
        <input type="text" name="ErrorURL" value="http://demo.ozow.com/cancel.aspx"><br>
        <label for="SuccessUrl">SuccessUrl: </label>
        <input type="text" name="SuccessUrl" value="http://demo.ozow.com/success.aspx"><br>
        <label for="NoticeUrl">NoticeUrl: </label>
        <input type="text" name="NoticeUrl" value="http://demo.ozow.com/notify.aspx"><br>
        <label for="IsTest">IsTest: </label>
        <input type="text" name="IsTest" value="false"><br>
        <label for="HashCheck">HashCheck: </label>
        <input type="text" name="HashCheck" id="HashCheck" value=""><br>
        <button type="submit">Start Order</button>
    </form>
    <div id="string">

    </div>
    <div>
        tstste0001zazar25.00123abc123http://demo.ozow.com/cancel.aspxhttp://demo.ozow.com/cancel.aspxhttp://demo.ozow.com/success.aspxhttp://demo.ozow.com/notify.aspxfalse215114531aff7134a94c88ceea48e
    </div>
    <br>
    <div id="sha512">
    </div>
    <script type="text/javascript" src="../vendor/brix/crypto/crypto-js.js"></script>
    <script src="js/hashCheck.js"></script>
</body>

</html>