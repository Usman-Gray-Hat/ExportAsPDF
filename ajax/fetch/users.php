<?php
include("../../dbConnect.php");

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];


$query = "SELECT * FROM users 
WHERE name LIKE '%$searchValue%' 
OR age LIKE '%$searchValue%'
ORDER BY id DESC 
LIMIT $start, $length"; 

$result = mysqli_query($conn, $query);
$data = [];

// For serial number
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM users";
$totalResult = mysqli_query($conn, $totalRecordsQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$page = ($start / $length) + 1;

// Serial Numbers in Ascending
// $i = ($page - 1) * $length + 1;

// Serial Numbers in Descending
$i = $totalRecords - $start;

while ($row = mysqli_fetch_assoc($result)) 
{ 
    $data[] = [
        'sr_no' => $i--,
        'name' => $row['name'],
        'age' => $row['age'],
        'created_at' => date('M-d-Y',strtotime($row['created_at'])),
    ];
}

$query2 = "SELECT * FROM users 
WHERE name LIKE '%$searchValue%' 
OR age LIKE '%$searchValue%'";

$result2 = mysqli_query($conn,$query2);
$totalRecords = mysqli_num_rows($result2);
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>