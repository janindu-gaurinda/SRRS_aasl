$(document).ready(function() {
    let passengerCount = 1;

    $('#addnewb').click(function() {
        passengerCount++;
        $('#passengerContainer').append(`
            <div class="passenger-row row my-2" id="showitem_${passengerCount}">
                <div class="col-lg-1 col-md-2 form-group">
                    <label for="title_${passengerCount}">Title</label>
                    <select class="form-select passengerTitle" id="title_${passengerCount}" name="title[]" required>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Ms">Ms</option>
                        <option value="Dr">Dr</option>
                        <option value="Prof">Prof</option>
                        <option value="Rev">Rev</option>
                        <option value="Sir">Sir</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-2 form-group">
                    <label for="passenger_name_${passengerCount}">Name</label>
                    <input type="text" class="form-control passengerName" placeholder="Passenger Name" id="passenger_name_${passengerCount}" name="passengerName[]" required>
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                    <label for="passport_no_${passengerCount}">Passport No</label>
                    <input type="text" class="form-control passportNo" placeholder="Passport No" id="passport_no_${passengerCount}" name="Passport_number[]" required>
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                    <label for="refreshment_${passengerCount}">Refreshment</label>
                    <select class="form-select refreshment" id="refreshment_${passengerCount}" name="Refreshments[]" required>
                        <option value="" selected>Select Refreshment</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="non_vegetarian">Non-Vegetarian</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-row" data-id="${passengerCount}">Remove</button>
            </div>
        `);
    });

    $(document).on('click', '.remove-row', function() {
        const id = $(this).data('id');
        $(`#showitem_${id}`).remove();
    });
});
//===============

$(document).ready(function () {
    var visitorsCount = 0;
    var maxVisitors = 2; // Maximum number of visitors allowed

    $("#add_more_row").click(function (e) {
        e.preventDefault();

        if (visitorsCount < maxVisitors) {
            visitorsCount++;
            var newRow = `
                <div class="container-fluid row" id="visitorContainer${visitorsCount}">
                    <div class="col-lg-4 col-md-2 form-group">
                        <div class="form-group">
                            <label for="visitor_name_">Name</label>
                            <input type="text" class="form-control" name="visitor[]" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-2 form-group">
                        <div class="form-group">
                            <label for="visitor_id_">ID No.</label>
                            <input type="text" class="form-control" name="visitor_id[]" placeholder="ID No.">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 form-group">
                        <div class="form-group">
                            <label for="vehicle_No">Vehicle No</label>
                            <input type="text" class="form-control" name="vehicle_no[]" placeholder="Vehicle No">
                        </div>
                    </div>
                    <div class="col-xl-1 col-md-1 form-group mt-4">
                        <button class="btn btn-danger remove_v" data-container-id="visitorContainer${visitorsCount}">-</button>
                    </div>
                </div>
            `;

            $("#view_item").append(newRow);
        } else {
            alert("Maximum limit of visitors reached.");
        }
    });

    // Event delegation for dynamically added remove buttons
    $("#view_item").on("click", ".remove_v", function () {
        var containerId = $(this).data("container-id");
        $("#" + containerId).remove();
        visitorsCount--;
    });
});
