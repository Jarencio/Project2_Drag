<?php

require("../Connection/Database.php");

$sql = "SELECT * FROM QueensFranchise ORDER BY Name Asc";
$franchiseresult = $conn->query($sql); 

$franchiseData = []; // Initialize an array to store the rows
if ($franchiseresult && $franchiseresult->num_rows > 0) {
    // Fetch and store each row in the array
    while ($row = $franchiseresult->fetch_assoc()) {
        $franchiseData[] = $row; // Add row to the array
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the identifier
    $Add = $_POST['Add'];

    transaction($conn);
}

//Add a Queen And Their Season Competed in
function transaction($conn){
    // Get the drag name
    $DragName = $_POST['DragName'];

    // Get the Recent Promo (Base64 string)
    $RecentPromoBase64 = $_POST['RecentPromo'];
    
    // Decode the Seasons array from JSON format (sent via AJAX)
    $seasons = $_POST['Seasons'];

    // Decode the Base64 image string
    $RecentPromoBinary = base64_decode(
        preg_replace('/^data:image\/\w+;base64,/', '', $RecentPromoBase64)
    );


    try {
        $conn->begin_transaction();
        $QueenID =  AddQueens($conn,$DragName, $RecentPromoBinary);
        AddQueenSeasons($conn,$QueenID,$seasons);
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        exit("Transaction error: " . $e->getMessage());
    }

    echo "<script>alert('ADDING QUEEN IS SUCCESSFUL');

    // Clear the drag name input field
    $('#DName').val('');
    
    // Clear the file input (Recent Promo)
    $('#RecentPromo').val('');
    
    // Reset the season inputs
    $('.Seasons').not(':first').remove(); // Keep the first season input and remove others
    $('.Seasons .SNo').val(''); // Clear the season number field
    $('.Seasons .SName').val(''); // Clear the selected franchise field
    
    </script>";

    QueendDisplay($conn);
}
function AddQueens($conn,$DragName,$RecentPromoBinary){
    $QueenID = "INSERT INTO `dragqueen`(`DragName`, `RecentPromo`) 
    VALUES (?,?)";
    $QueenStmt = $conn->prepare($QueenID);
    $QueenStmt->bind_param("ss",$DragName,$RecentPromoBinary);
    if (!$QueenStmt->execute()) {
        throw new Exception("Error inserting into Queen_Information: " . $QueenStmt->error);
    }
    return $conn->insert_id;
}
function AddQueenSeasons($conn,$QueenID,$seasons){
    foreach ($seasons as $season) {
        $QueenSeasonsID = "INSERT INTO `dragfranchise`(`DragID`, `FranchiseID`, `SeasonNo`) 
        VALUES (?,?,?)";
        $QueenSeasonsStmt = $conn->prepare($QueenSeasonsID);
        $QueenSeasonsStmt->bind_param("iii",$QueenID, $season['selectedFranchise'],$season['seasonNo']);
        if (!$QueenSeasonsStmt->execute()) {
            throw new Exception("Error inserting into FRANCHISE_Information: " . $QueenSeasonsStmt->error);
        }
    }
}
//End of Add Queens

//Display

function QueendDisplay($conn){
    $QueenDisplayconn = "SELECT * FROM QueensInfo";
    $Queenresult = $conn->query($QueenDisplayconn); 

    if ($Queenresult && $Queenresult->num_rows > 0) {
        while ($row = $Queenresult->fetch_assoc()) {
    $egg = base64_encode($row['RecentPromo']);
    echo " <div class='queencontainer'>
    <input type='hidden' value='".$row["DragQueenID"]."'>
    <img src='data:image/png;base64,".$egg."' alt='Drag Queen Image' srcset=''>
    <h1>".$row["DragName"]."</h1>
    <h6> ".nl2br($row["Seasons"])."</h6>
    <button popovertarget='editqueens' type='button'> EDIT </button>
    </div>";
        }
    } else {
        echo "EMPTY FIELDS";
    }
}