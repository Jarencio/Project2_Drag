<?php

require("../Connection/Database.php");

$sql = "SELECT * FROM QueensFranchise";
$franchiseresult = $conn->query($sql); 

$franchiseData = []; // Initialize an array to store the rows
if ($franchiseresult && $franchiseresult->num_rows > 0) {
    // Fetch and store each row in the array
    while ($row = $franchiseresult->fetch_assoc()) {
        $franchiseData[] = $row; // Add row to the array
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Add = $_POST['Add']; //Identifier Justincase I Need it
    $No = $_POST['SeasonNo'];
    $DragName = $_POST['DragName'];
    $Franchise = $_POST['selectedFranchise'];
    echo $No.$DragName.$Franchise; 
}

function AddQueens(){
    
}

