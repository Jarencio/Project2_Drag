<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS FILES/franchise.css?v=1.1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body>
<?php
require("../Function Files/frachisefunction.php");
?>
<form method="POST" action="../SFR/Function Files/frachisefunction.php">
<div class="function">
    <div>
    <button popovertarget="myPopover" type="button"> ADD FRANCHISE</button>
    <button id="editButton" type="button"> EDIT FRANCHISE</button>
    </div>
    <input type="text" id="Search" placeholder="Search">
    </div>


<div  id="results">
<?php
    $condition = "";

    table_franchise($conn,$condition);
?>


</div>

<div class="AddFranchises" popover id="myPopover">
  <h1> Add A Franchise</h1>   
  <input type="text" placeholder="Season Name" id="SName">
  <input type="number" placeholder="Season Max No." id="SNo">
  <div class="buttons">
  <button id="addbuttons" type="button">ADD</button>
  <button id="resetButton" type="button">RESET</button>
  </div>
</div>

<script src="../SFR/JS FILES/franchise.js?v=1.2"></script>
</form>

</body>
</html>