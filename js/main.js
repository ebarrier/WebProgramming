// In HTML we only have <button id="update_cart">Update cart</button> to trigger update
// and <div id="shopping_cart">Initially empty</div> for placing the shopping cart in the webpage
 
// Wait page to be loaded and then associate click event
document.addEventListener("DOMContentLoaded", function() {
  document.querySelector("#update_cart").addEventListener(
   "click", updateCart
  );
});
 
// This only defines updateCart function, but it does not run it!
function updateCart() {
  var request = new XMLHttpRequest();
  request.open('GET', 'cart.php', true);
 
  // This is an example of callback
  request.onload = function() {
    // This function runs once response has been received
    if (request.status >= 200 && request.status < 400) {
      document.querySelector("#shopping_cart").innerHTML =
        request.responseText;
    }
  };
 
  // This will only start the request
  request.send();
}
