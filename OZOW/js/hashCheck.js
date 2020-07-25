let PriKey = "215114531AFF7134A94C88CEEA48E";
let ApiKey = "EB5758F2C3B4DF3FF4F2669D5FF5B";

let inputs = document.querySelectorAll('input');
let hashText = '';
inputs.forEach(inVal => {
    hashText += inVal.value;
});
hashText += PriKey;
document.getElementById('string').innerHTML = "2)<br>" + hashText;
hashText = hashText.toLowerCase();

//https://github.com/brix/crypto-js
let encrypted = CryptoJS.SHA512(hashText);
document.getElementById('sha512').innerHTML = "3)<br>" + hashText + "<br> 4)<br>" + encrypted;
document.getElementById('HashCheck').value = encrypted;
console.log(encrypted);
