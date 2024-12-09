<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS FILES/queens.css?v=1.5">
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
<?php
QueendDisplay($conn);
?>
</div>

<div class="queens" popover id="addqueens">
<input type="text" placeholder="Drag Name" id="DName">
<div class="SeasonsContainer">
    <div class="Seasons">
        <input type="number" placeholder="Season No" class="SNo" min="1" max="6" required>
        <select class="SName" onchange="updateSeasonRange(this)">
            <?php
            foreach ($franchiseData as $row) {
                echo "<option value='".$row["FranchiseID"]."' data-max='".$row["SeasonMaxNo"]."' data-min='".$row["SeasonMinNo"]."'>".$row["Name"]."</option>";
            }
            ?>
        </select>
        <button type="button" class="AddSeason">+</button>
    </div>
</div>

<h2> ENTER HER RECENT PROMO: </h2>
<input type="file" id="RecentPromo" accept="image/*">
<div class="buttons">
  <button id="addbuttons" type="button">ADD</button>
  <button id="resetButton" type="button">RESET</button>
  </div>
</div>

<div class="queens" popover id="editqueens">
<input type="text" placeholder="Drag Name" id="DName">
<div class="SeasonsContainer">
    <div class="Seasons">
        <input type="number" placeholder="Season No" class="SNo" min="1" max="6" required>
        <select class="SName" onchange="updateSeasonRange(this)">
            <?php
            foreach ($franchiseData as $row) {
                echo "<option value='".$row["FranchiseID"]."' data-max='".$row["SeasonMaxNo"]."' data-min='".$row["SeasonMinNo"]."'>".$row["Name"]."</option>";
            }
            ?>
        </select>
        <button type="button" class="AddSeason">+</button>
    </div>
</div>

<h2> ENTER HER RECENT PROMO: </h2>
<input type="file" id="RecentPromo" accept="image/*">
<div class="buttons">
  <button id="addbuttons" type="button">ADD</button>
  <button id="resetButton" type="button">RESET</button>
  </div>
</div>

<script src="../SFR/JS FILES/queens.js?v=1.8"></script>
</form>
<script>
    const franchiseData = <?php echo json_encode($franchiseData); ?>;
</script>

</body>
</html>