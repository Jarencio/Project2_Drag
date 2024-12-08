function updateSeasonRange(id) {
    console.log("Sfdgcbc");
    // Get the selected franchise option
    var selectedOption = document.getElementById('SName').selectedOptions[0];

    // Get the max and min values from the selected option's data attributes
    var maxSeason = selectedOption.getAttribute('data-max');
    var minSeason = selectedOption.getAttribute('data-min');

    console.log(maxSeason);

    // Get the Season No input field
    var seasonInput = document.getElementById('SNo');

    // Update the min and max values for the input
    seasonInput.setAttribute('min', minSeason);
    seasonInput.setAttribute('max', maxSeason);
}

$(document).ready(function() {

    const AddData = () => {
        const DragName = $("#DName").val();
        const SeasonNo = $("#SNo").val();
        const selectedOption = $("#SName option:selected"); // Replace 'YourSelectID' with the actual ID of your <select> element
        const selectedFranchise = selectedOption.val(); // Get the value of the selected option
        const Add = "Add";


        $.ajax({
            url: "../SFR/Function Files/queensfunction.php",
            method: "POST",
            data: {DragName: DragName, SeasonNo: SeasonNo,Add:Add,selectedFranchise:selectedFranchise},
            success: function (data) {
                console.log(selectedFranchise);
                $("#results").html(data);
            },
            error: function (error) {
                console.error("Error fetching accounts:", error);
            }
        });

        console.log("WORKING");

    };

    const AddSeason = () => {
        console.log("WORKING");
        document.getElementById("Number2").removeAttribute("style");
    }
$('#addbuttons').click(AddData);
$('#AddSeason\\[0\\]').click(AddSeason);
});

