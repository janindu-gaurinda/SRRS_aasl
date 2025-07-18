<?php
require_once('../conn.php');

// Columns
$columns = array(
    0 => 'cip_id',
    1 => 'Ref_no',
    2 => 'Package',
    3 => 'Departure_date',
    4 => 'proffession',
    5 => 'E_mail',
    6 => 'Number_Of_Passengers',
    7 => 'Currency_Type',
    8 => 'Amount_New',
    9 => 'payment_ref'
);

// Base SQL query
$sql = "SELECT * FROM cip WHERE payment_ref = '' ";

// Search functionality
$searchValue = $_POST['search']['value'];
if (!empty($searchValue)) {
    $sql .= " AND (";
    foreach ($columns as $column) {
        $sql .= " $column LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' OR";
    }
    $sql = rtrim($sql, "OR");
    $sql .= ")";
}

// Get total records
$totalData = mysqli_num_rows(mysqli_query($conn, $sql));

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
        $data[] = array(
            $row['cip_id'],
            $row['Ref_no'],
            $row['Package'],
            $row['Departure_date'],
            $row['proffession'],
            $row['E_mail'] . "<br>" . $row['Telephone'],
            $row['Number_Of_Passengers'],
            $row['Currency_Type'] . $row['Amount_New'],
            '<input type="hidden" name="cip_id[]" value="' . $row['cip_id'] . '">
            <input type="text" class="form-control border border-success-subtle" name="payment_ref[]" id="payment_ref' . $row['cip_id'] . '" style="width: 150px;">',
            '<button class="btn btn-success" id="add_btn" name="Update" type="Update" data-bs-toggle="tooltip" data-bs-placement="Right" data-bs-title="veiw all details">UPDATE</button>'
        );        
    }
}

$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalData,
    "data" => $data
);

echo json_encode($response);
?>
