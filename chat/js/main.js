//alert("Hello Javascript");
var j = 5;
console.log("Log used to debug JS");
console.info("Information");
console.debug("Debug j:", j);
console.debug("Page:", window.location.href);
console.error("ERROR");

//EventSource is a class
var source = new EventSource("http://push.koodur.com/ev/chatroom");

//Associate a function witht the event of message coming in
source.onmessage = function(event) { //equivalent to source.onmessage = function somename(event)
  console.log("Received server-sent event:", event.data);
  document.querySelector("div").innerHTML += "<br>" + event.data; //this will select <div> tag from website and replace the inner HTML value
}

function sendMsg() {
  var request = new XMLHttpRequest();
  request.open('POST', 'http://push.koodur.com/pub?id=chatroom', true);
  request.send(document.querySelector("#msg").value);
  document.inputbox.value="";
}

