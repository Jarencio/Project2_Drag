<?php

require("../Connection/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Add = $_POST['Add']; //Identifier Justincase I Need it
    
    if($Add=="Add"){
        $Name = $_POST['SeasonName'];
        $No = $_POST['SeasonNo'];
       AddFranchise($conn,$Name,$No);
    } else if ($Add=="Edit"){
        $ID = $_POST['franchiseID'];
        $Name = $_POST['SeasonName'];
        $No = $_POST['SeasonNo'];
        EditFranchise($conn,$Name,$No,$ID );    
    } else if ($Add=="Search"){
        $Res = $_POST['Res'];
        $condition = "WHERE Name LIKE '%$Res%'";
        table_franchise($conn,$condition);
    }


}

function AddFranchise($conn,$Sname,$SNo){
    $addfranchisesql = "INSERT INTO `franchise`(`Name`, `SeasonMaxNo`) VALUES (?,?)";
    $franchisestmt = $conn->prepare($addfranchisesql);
    $franchisestmt->bind_param("si",$Sname,$SNo);
    if (!$franchisestmt->execute()) {
        throw new Exception("Error inserting into delivery_information: " . $franchisestmt->error);
    }
    $condition = "";
    table_franchise($conn,$condition);
}

function  EditFranchise($conn,$Name,$No,$ID){
    $editfranchisesql = "UPDATE `franchise` 
    SET `Name`=?,`SeasonMaxNo`= ? 
    WHERE  `FranchiseID` = ?";
    $franchisestmt = $conn->prepare($editfranchisesql);
    $franchisestmt->bind_param("sii",$Name,$No,$ID);
    if (!$franchisestmt->execute()) {
        throw new Exception("Error inserting into delivery_information: " . $franchisestmt->error);
    }
    $condition = "";
    table_franchise($conn,$condition);
    
}


function table_franchise($conn,$condition){
        $sql = "SELECT FranchiseID, Name, SeasonMaxNo FROM franchise f $condition";
        $franchiseresult = $conn->query($sql); 


        echo "<table>
    <tr>
    <th>ID</th>
    <th>Season Name</th>
    <th>Season Max No.</th>
    </tr>";
    
        if ($franchiseresult && $franchiseresult->num_rows > 0) {
            // Fetch and display each row from the result set
            while ($row = $franchiseresult->fetch_assoc()) {
                echo "
                <tr>  
                <input type="."hidden"." value='".$row['FranchiseID']."'>
                 <td>".$row['FranchiseID']."</td>
                 <td>".$row['Name']."</td>
                 <td>".$row['SeasonMaxNo']."</td>
                 </tr>";
            };
        } else{
            echo "<tr>  
             <td colspan='3'> NO DATA IS FOUND </td>
            </tr>";
        }

    echo "    <div>
 
    </div>

    </table>";
};



