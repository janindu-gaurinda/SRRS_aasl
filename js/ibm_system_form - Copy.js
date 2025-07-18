$(document).ready(function () {
    var passengerCount = 0;
    var maxPassengers = parseInt($("#Number_Of_Passengers").val()); // Get the initial maximum number of passengers from the select box

    $("#addnewb").click(function (e) {
        e.preventDefault();
        
        // Update maxPassengers in case it has changed
        maxPassengers = parseInt($("#Number_Of_Passengers").val());
        
        if (passengerCount < maxPassengers) {
            passengerCount++;

            var newPassengerRow = `
                <div class="container-fluid" id="passengerContainer${passengerCount}">
                    <div class="passenger-row row my-2">
                        <div class="col-lg-1 col-md-2 form-group">
                            <label for="title">Title</label>
                            <select class="form-select passengerTitle" name="title[]">
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
                            <label for="passenger_name">Name</label>
                            <input type="text" class="form-control passengerName" placeholder="Passenger Name" name="passengerName[]">
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="passport_no">Passport No</label>
                            <input type="text" class="form-control passportNo" placeholder="Passport No" name="Passport_number[]">
                        </div>
                        <div class="col-lg-3 col-md-3 form-group">
                            <label for="refreshment">Refreshment</label>
                            <select class="form-select refreshment" name="Refreshments[]">
                                <option value="" selected>Select Refreshment</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="non_vegetarian">Non-Vegetarian</option>
                            </select>
                        </div>
                        <div class="col-xl-1 col-md-1 form-group">
                            <label for="">Remove</label>
                            <button class="btn btn-danger removeBtn" data-container-id="passengerContainer${passengerCount}">-</button>
                        </div>
                    </div>
                </div>
            `;

            $("#showitem").prepend(newPassengerRow);
        } else {
            alert("Maximum number of passengers reached.");
        }
    });

    // Add event delegation for dynamically added remove buttons
    $("#showitem").on("click", ".removeBtn", function () {
        var containerId = $(this).data("container-id");
        $("#" + containerId).remove();
        passengerCount--;
    });

    // Update the maximum number of passengers if the selection changes
    $("#Number_Of_Passengers").change(function () {
        maxPassengers = parseInt($(this).val());
    });
});

// ----------------------------

$(document).ready(function () {
  var VisitorsCount = 0;
  var maxVisitors = 2; // Maximum number of visitors allowed

  $("#add_more_row").click(function (e) {
    e.preventDefault();
    if (VisitorsCount < maxVisitors) {
      VisitorsCount++;
      var new_row = `
            <div class=" container-fluid row" id="${VisitorsCount}">
                <div class="col-lg-4 col-md-2 form-group">
                    <div class="form-group">
                        <label for="visitor_name_">Name. </label>
                        <input type="text" class="form-control" name="visitor[]" placeholder="Name. ">
                    </div>
                </div>
                <div class="col-lg-4 col-md-2 form-group">
                    <div class="form-group">
                        <label for="visitor_id_">ID No. </label>
                        <input type="text" class="form-control" name="visitor_id[]" placeholder="ID No. ">
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 form-group">
                    <div class="form-group">
                        <label for="vehicle_No">Vehicle No</label>
                        <input type="text" class="form-control" name="vehicle_no[]" placeholder="Vehicle No ">
                    </div>
                </div>
                <div class="col-xl-1 col-md-1 form-group mt-4">
                    <button class="btn btn-danger remove_v" data-container-id="${VisitorsCount}">-</button>
                </div>
            </div>
            `;
      $("#view_item").append(new_row);
    } else {
      alert("Maximum limit of visitors reached.");
    }
  });

  // Remove row when removeBtn is clicked
  $(document).on("click", ".remove_v", function () {
    var containerId = $(this).data("container-id");
    $("#" + containerId).remove();
    VisitorsCount--;
  });
});
s;
