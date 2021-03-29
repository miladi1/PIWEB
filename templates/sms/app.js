
function envoyer(){
const url="https://api.twilio.com/2010-04-01/Accounts/ACc833a6a29e863acbba4a339fb74f5b5c/Messages.json";
const auth=":ACc833a6a29e863acbba4a339fb74f5b5c:ACc833a6a29e863acbba4a339fb74f5b5c";

const message=document.getElementById("mobile");
const numTel=document.getElementById("message");

const msg=encodeURI(message);
const numTel=encodeURI(numTel);

const myHeader=new Headers({
'Content-Type':'application/x-www-form-urlencoded',
'Authorization':'Basic'+btoa(auth)

});
const unit={
method:'POST',
headers : myHeader ,
mode:'cors',
body:"To=21653695025&From=+14159442437&Body=Wink"


}

fetch(url)
.then(Response=>console.log(Response))
.catch(error=>console.log(console.error));
}