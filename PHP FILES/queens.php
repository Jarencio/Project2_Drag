<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS FILES/queens.css?v=1.3">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php
require("../Function Files/queensfunction.php");
?>

<form method="POST" action="../SFR/Function Files/frachisefunction.php">
<div class="function">
    <div>
    <button popovertarget="addqueens" type="button"> ADD A QUEEN</button>
    </div>
    <input type="text" id="Search" placeholder="Search">
</div>

<div  id="results">
    <div class="queencontainer">
    <img src="PHP FILES/4.png" alt="afsdgbxfsawS" srcset="">
    <h1> Black Peppa </h1>
    <h6> RuPaul's Drag Race UK Season 3 </h6>
    <button type="button"> EDIT </button>
    </div>
</div>

<div class="queens" popover id="addqueens">
<input type="text" placeholder="Drag Name" id="DName">
<div class="Seasons">
    <input type='number' placeholder='Season No' id='SNo' min='1' max='17'>
    <?php
    echo "
        <select name='' id='SName' onchange='updateSeasonRange1(0)'>";
    foreach ($franchiseData as $row) {
        echo "<option value='".$row["FranchiseID"]."' data-max='".$row["SeasonMaxNo"]."' data-min='".$row["SeasonMinNo"]."'>".$row["Name"]."</option>";
    }
    ?>
    </select>
    <button type="button" id="AddSeason[0]">+</button>
</div>

<div class="Seasons" id="Number2" style="display: none;">
    <input type='number' placeholder='Season No' id='SNo2' min='1' max='17'>
    <?php
    echo "
        <select name='' id='SName2' onchange='updateSeasonRange2(0)'>";
    foreach ($franchiseData as $row) {
        echo "<option value='".$row["FranchiseID"]."' data-max='".$row["SeasonMaxNo"]."' data-min='".$row["SeasonMinNo"]."'>".$row["Name"]."</option>";
    }
    ?>
    </select>
    <button type="button"> - </button>
</div>

<div class="Seasons" id="Number3" style="display: none;">
    <input type='number' placeholder='Season No' id='SNo3' min='1' max='17'>
    <?php
    echo "
        <select name='' id='SName3' onchange='updateSeasonRange3(0)'>";
    foreach ($franchiseData as $row) {
        echo "<option value='".$row["FranchiseID"]."' data-max='".$row["SeasonMaxNo"]."' data-min='".$row["SeasonMinNo"]."'>".$row["Name"]."</option>";
    }
    ?>
    </select>
    <button type="button"> - </button>
</div>

<h2> ENTER HER RECENT PROMO: </h2>
<input type="file" id="RecentPromo" accept="image/*">
<div class="buttons">
  <button id="addbuttons" type="button">ADD</button>
  <button id="resetButton" type="button">RESET</button>
  </div>
</div>

<script src="../SFR/JS FILES/queens.js?v=1.7"></script>
</form>

</body>
</html>