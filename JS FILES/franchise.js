// JavaScript script
console.log("Script has been loaded and executed successfully!");



$(document).ready(function() {
    
    $('#resetButton').on('click', function(event) {
        const name =document.querySelector('#SName');
        const no =document.querySelector('#SNo'); 

        // Prevent the form from submitting
        event.preventDefault();
        
        // Trigger the alert
        
        // Clear the input fields
        $('#SName').val('');
        $('#SNo').val('');
        
    });


    $('#editButton').on('click', function(event) {
        // Log to confirm the button click
        console.log("Edit button pressed");
    
        // Select all rows and enable contenteditable for specific cells
        $('tr').each(function() {
            // Make the Name and SeasonMaxNo columns editable
            $(this).find('td:nth-child(3), td:nth-child(4)').attr('contenteditable', 'true');
        });
    
        // Optionally, provide visual feedback that cells are editable
        $('td[contenteditable="true"]').css('background-color', '#f9f9f9'); // Light background for editable cells
    });
    

    const AddData = () => {
        const SeasonName = $("#SName").val();
        const SeasonNo = $("#SNo").val();
        const Add = "Add";
        console.log("Work");

        if(SeasonName == "" || SeasonNo == ""){
            alert("PLEASE FILL UP ALL OF THE INFORMATION");
        } else {
            $.ajax({
                url: "../SFR/Function Files/frachisefunction.php",
                method: "POST",
                data: {SeasonName: SeasonName, SeasonNo: SeasonNo,Add:Add},
                success: function (data) {
                    console.log(SeasonName);
                    $("#results").html(data);
                },
                error: function (error) {
                    console.error("Error fetching accounts:", error);
                }
            });
        }
    

    };

    const Search = () => {
        const Res = $("#Search").val();
        console.log(Res);
        const Add = "Search";

        $.ajax({
            url: "../SFR/Function Files/frachisefunction.php",
            method: "POST",
            data: {Res:Res,Add:Add},
            success: function (data) {
                console.log(Res);
                $("#results").html(data);
            },
            error: function (error) {
                console.error("Error fetching accounts:", error);
            }
        });

    }

 // Delegate event listener to the table for dynamically added cells
document.querySelector('table').addEventListener('blur', function (event) {
    const cell = event.target;
    
    // Check if the blurred element is a contenteditable cell
    if (cell.hasAttribute('contenteditable')) {
        // Find the parent row
        const row = cell.closest('tr');

        // Extract values from the row
        const franchiseID = row.querySelector('input[type="hidden"]').value;
        const SeasonName = row.querySelector('td:nth-child(3)').textContent.trim();
        const SeasonNo = row.querySelector('td:nth-child(4)').textContent.trim();
        const Add = "Edit";

        // Send AJAX request
        $.ajax({
            url: "../SFR/Function Files/frachisefunction.php",
            method: "POST",
            data: { SeasonName: SeasonName, SeasonNo: SeasonNo, Add: Add, franchiseID: franchiseID },
            success: function (data) {
                console.log(SeasonName);
                $("#results").html(data);
            },
            error: function (error) {
                console.error("Error fetching accounts:", error);
            }
        });
    }
}, true);






    
$("#Search").keyup(Search);
    $('#addbuttons').click(AddData);
});