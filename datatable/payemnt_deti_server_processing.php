<?php
require_once('../conn.php');

// Columns
$columns = array(
    // 0 => 'cip_id',
    0 => 'Ref_no',
    1 => 'Package',
    2 => 'Departure_date',
    3 => 'proffession',
    4 => 'E_mail',
    5 => 'Number_Of_Passengers',
    6 => 'Currency_Type',
    7 => 'Amount_New',
    8 => 'payment_ref'
);

// Get the total number of records
$totalData = mysqli_num_rows(mysqli_query($conn, "SELECT cip_id FROM cip WHERE payment_ref != ''"));

// Get the total number of filtered records
$searchValue = $_POST['search']['value'];
$sql = "SELECT * FROM cip WHERE payment_ref != ''";
if (!empty($searchValue)) {
    $sql .= " AND (cip_id LIKE '%" . $searchValue . "%' OR Ref_no LIKE '%" . $searchValue . "%' OR Package LIKE '%" . $searchValue . "%' OR Departure_date LIKE '%" . $searchValue . "%' OR proffession LIKE '%" . $searchValue . "%' OR E_mail LIKE '%" . $searchValue . "%' OR Number_Of_Passengers LIKE '%" . $searchValue . "%' OR Currency_Type LIKE '%" . $searchValue . "%' OR Amount_New LIKE '%" . $searchValue . "%' OR payment_ref LIKE '%" . $searchValue . "%')";
}
$totalFiltered = mysqli_num_rows(mysqli_query($conn, $sql));

// Sorting
$columnIndex = $_POST['order'][0]['column'];
$columnName = $columns[$columnIndex];
$columnSortOrder = $_POST['order'][0]['dir'];
$sql .= " ORDER BY " . $columnName . " " . $columnSortOrder;

// Pagination
$start = $_POST['start'];
$length = $_POST['length'];
$sql .= " LIMIT " . $start . ", " . $length;

// Execute SQL query
$result = mysqli_query($conn, $sql);


$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Format the amount with thousand separators and two decimal places
    $formattedAmount = number_format((float)$row['Amount_New'], 2, '.', ',');
        $data[] = array(
            // $row['cip_id'],
            $row['Ref_no'],
            $row['Package'],
            $row['Departure_date'] . "<br>" . $row['Arrival_date'],
            $row['proffession'],
            $row['E_mail'] . "<br>" . $row['Telephone'],
            $row['Number_Of_Passengers'],
            $row['Currency_Type'] . ' ' . $formattedAmount,
            $row['payment_ref'],
            '<a href="./Receipt.php?cip_id=' . $row['cip_id'] . '" target="_blank" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="View Receipt"><i class="bi bi-eye-fill"></i></a>'
        );
    }
}

$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
);

header('Content-Type: application/json');
echo json_encode($response);
?>
