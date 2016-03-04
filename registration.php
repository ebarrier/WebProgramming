<?php
require_once "config.php";
include "header.php";
//We do not need connection to db on this page
?>

<h1> Registration page</h1>

<form method="post" action="regsubmit.php">
  <div>
  <label for="email">E-mail</label>
  <input type="email" name="email" id="email" required/>
  </div>    

  <div>
  <label for="password">Password</label>
  <input type="password" name="password" id="password" required/>
  </div>   

  <div>
  <label for="firstname">First-name</label>
  <input type="text" name="firstname" id="firstname" required/>
  </div> 

  <div>
  <label for="lastname">Last-name</label>
  <input type="text" name="lastname" id="lastname" required/>
  </div> 

  <div>
  <label for="dob">Date of birth</label>
  <input type="date" name="dob" id="dob" placeholder="dd/mm/yyyy" required/>
  </div>

  <div>
  <label for="phone">Phone</label>
  <input type="tel" name="phone" id="phone" required/>
  </div>

  <div>
  <label for="country">Country</label>
  <select name="country" id="country">
    <option value="ee">Estonia</option>
    <option value="lv">Latvia</option>
    <option value="lt">Lithuania</option>
  </select>
  </div>

  <div>
  <label for="vatin">VAT</label>
  <input type="text" name="vatin" id="vatin" pattern="([A-Z0-9]{4,14})?$"/>
  </div>

  <div>
  <input type="submit" value="Sign-up"/>
  </div>
  
</form>

<?php
include "footer.php";
?>
