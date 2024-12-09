function updateSeasonRange(selectElement) {
    // Get the selected franchise option
    var selectedOption = selectElement.selectedOptions[0];

    // Get the max and min values from the selected option's data attributes
    var maxSeason = selectedOption.getAttribute('data-max');
    var minSeason = selectedOption.getAttribute('data-min');

    console.log(`Max Season: ${maxSeason}, Min Season: ${minSeason}`);

    // Get the Season No input field within the same container as the select element
    var seasonInput = selectElement.closest('.Seasons').querySelector('.SNo');

    // Update the min and max values for the input
    seasonInput.setAttribute('min', minSeason);
    seasonInput.setAttribute('max', maxSeason);
}


$(document).ready(function () {
    const updateSeasonRange = (selectElement) => {
        const selectedOption = selectElement.selectedOptions[0];
        const maxSeason = selectedOption.getAttribute('data-max');
        const minSeason = selectedOption.getAttribute('data-min');

        const seasonInput = $(selectElement).siblings('.SNo')[0];
        $(seasonInput).attr('min', minSeason).attr('max', maxSeason);
    };

    const addSeasonInput = () => {
        const newSeasonGroup = document.createElement('div');
        newSeasonGroup.className = 'Seasons';
        newSeasonGroup.innerHTML = `
            <input type="number" placeholder="Season No" class="SNo" min="1" max="17">
            <select class="SName" onchange="updateSeasonRange(this)">
                ${franchiseData.map(row => `
                    <option value="${row.FranchiseID}" data-max="${row.SeasonMaxNo}" data-min="${row.SeasonMinNo}">
                        ${row.Name}
                    </option>
                `).join('')}
            </select>
            <button type="button" class="RemoveSeason">-</button>
        `;

        // Append the new season group to the container
        document.querySelector('.SeasonsContainer').appendChild(newSeasonGroup);
    };

    const removeSeasonInput = (button) => {
        button.closest('.Seasons').remove();
    };

    const addData = () => {
        const dragName = $('#DName').val();
        const RecentPromoFile = $('#RecentPromo')[0].files[0];
        const seasons = [];
    
        $('.Seasons').each(function () {
            const seasonNo = $(this).find('.SNo').val();
            const selectedFranchise = $(this).find('.SName').val();
            if (seasonNo && selectedFranchise) {
                seasons.push({ seasonNo, selectedFranchise });
            }
        });
    
        const add = "Add";
    
        if (RecentPromoFile) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const RecentPromoBase64 = e.target.result;
    
                // Make the AJAX call once the image is converted
                $.ajax({
                    url: "../SFR/Function Files/queensfunction.php",
                    method: "POST",
                    data: {
                        DragName: dragName,
                        Seasons: seasons,
                        Add: add,
                        RecentPromo: RecentPromoBase64 // Send the Base64 image data
                    },
                    success: function (data) {
                        $("#results").html(data);
                    },
                    error: function (error) {
                        console.error("Error adding data:", error);
                    }
                });
            };
            reader.readAsDataURL(RecentPromoFile); // Convert image to Base64
        } else {
            console.error("No file selected for Recent Promo.");
        }
    };

    // Reset button functionality
$('#resetButton').click(function () {
    // Clear the drag name input field
    $('#DName').val('');
    
    // Clear the file input (Recent Promo)
    $('#RecentPromo').val('');
    
    // Reset the season inputs
    $('.Seasons').not(':first').remove(); // Keep the first season input and remove others
    $('.Seasons .SNo').val(''); // Clear the season number field
    $('.Seasons .SName').val(''); // Clear the selected franchise field
    
});
    
    // Event listeners
    $('.SeasonsContainer').on('click', '.AddSeason', addSeasonInput);
    $('.SeasonsContainer').on('click', '.RemoveSeason', function () {
        removeSeasonInput(this);
    });
    $('#addbuttons').click(addData);
});

