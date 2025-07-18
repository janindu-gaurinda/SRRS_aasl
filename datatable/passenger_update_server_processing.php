<?php
require_once('../conn.php'); // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

// Define columns
$columns = array(
    0 => 'Ref_no',
    1 => 'Package',
    2 => 'Number_Of_Passengers',
    3 => 'Currency_Type',
    4 => 'Amount_New',
    5 => 'payment_ref'
);

// Get the total number of records
$totalDataQuery = "SELECT COUNT(*) as count FROM cip";
$totalDataResult = mysqli_query($conn, $totalDataQuery);
if (!$totalDataResult) {
    echo json_encode(array('error' => mysqli_error($conn)));
    exit;
}
$totalData = mysqli_fetch_assoc($totalDataResult)['count'];

// Get the total number of filtered records
$searchValue = $_POST['search']['value'];
$sql = "SELECT COUNT(*) as count FROM cip WHERE 1=1";
if (!empty($searchValue)) {
    $sql .= " AND (cip_id LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Ref_no LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Package LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Number_Of_Passengers LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Currency_Type LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Amount_New LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR payment_ref LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
}
$totalFilteredResult = mysqli_query($conn, $sql);
if (!$totalFilteredResult) {
    echo json_encode(array('error' => mysqli_error($conn)));
    exit;
}
$totalFiltered = mysqli_fetch_assoc($totalFilteredResult)['count'];

// Sorting
$columnIndex = $_POST['order'][0]['column'];
$columnName = $columns[$columnIndex];
$columnSortOrder = $_POST['order'][0]['dir'];

// Pagination
$start = $_POST['start'];
$length = $_POST['length'];

// Main SQL query
$sql = "SELECT cip_id, Ref_no, Package, Number_Of_Passengers, Currency_Type, Amount_New, payment_ref
        FROM cip 
        WHERE 1=1";
if (!empty($searchValue)) {
    $sql .= " AND (cip_id LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Ref_no LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Package LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Number_Of_Passengers LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Currency_Type LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR Amount_New LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                 OR payment_ref LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
}
$sql .= " ORDER BY " . $columnName . " " . $columnSortOrder;
$sql .= " LIMIT " . $start . ", " . $length;

// Execute SQL query
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(array('error' => mysqli_error($conn)));
    exit;
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    // Format the amount with thousand separators and two decimal places
    $formattedAmount = number_format((float)$row['Amount_New'], 2, '.', ',');

    $data[] = array(
        $row["Ref_no"],
        $row["Package"],
        $row["Number_Of_Passengers"],
        $row['Currency_Type'] . ' ' . $formattedAmount,
        '<div style="display: flex; align-items: center;">
            <form action="./payment_ref_update.php" method="post" style="display: flex; align-items: center; margin: 0;">
                <input type="hidden" name="cip_id" value="' . htmlspecialchars($row['cip_id']) . '">
                <input type="text" class="form-control border border-success-subtle" value="' . htmlspecialchars($row['payment_ref']) . '" name="payment_ref" style="width: auto; max-width: 200px;">
                <button class="btn btn-warning" name="Update" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Update Payment Ref" style="margin-left: 5px;"><i class="bi bi-arrow-repeat"></i></button>
            </form>
        </div>',
        '<a href="./passenger_edit.php?cip_id=' . urlencode($row['cip_id']) . '" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="Top" data-bs-title="Update Details"><i class="bi bi-pencil-square"></i></a>
        <form action="./view_pasenger_detailes.php" method="post" style="display:inline;">
            <input type="hidden" name="cip_id" value="' . htmlspecialchars($row['cip_id']) . '">
            <button class="btn btn-success" name="Update" type="submit" data-bs-toggle="tooltip" data-bs-placement="Right" data-bs-title="View All Details"><i class="bi bi-eye-fill"></i></button>
        </form>'
    );
}

$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
);

echo json_encode($response);

mysqli_close($conn);
?>
