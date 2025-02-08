<?php
include 'conection.php'; 

$first_name = $_GET['first_name'] ?? '';
$last_name = $_GET['last_name'] ?? '';
$id = $_GET['id'] ?? '';
$gender = $_GET['gender'] ?? '';

$query = "SELECT * FROM datos_simulados";
$conditions = [];

if (!empty($first_name)) $conditions[] = "first_name LIKE '%$first_name%'";
if (!empty($last_name)) $conditions[] = "last_name LIKE '%$last_name%'";
if (!empty($id)) $conditions[] = "id = $id";
if (!empty($gender)) $conditions[] = "gender = '$gender'";

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = $conn->query($query);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=filtered_data.xls");
header("Pragma: no-cache");
header("Expires: 0");

$separator = "\t"; 

$fields = array(
    "ID", "First Name", "Last Name", "Email", "Gender", "IP Address", 
    "NHS Number", "User Name", "Password", "Therapist", "Therapy Number", 
    "Session Number", "User ID", "Therapist Specialty", "Therapy Duration", 
    "Session Date", "Therapy Notes"
);
echo implode("\t", $fields) . "\n";

while ($row = $result->fetch_assoc()) {

    $data = array_map(function ($value) {

        $value = str_replace('"', '""', $value);

        $value = str_replace(array("\r\n", "\r", "\n"), "\n", $value);
        return "\"$value\""; 
    }, array(
        $row["id"], 
        $row["first_name"], 
        $row["last_name"], 
        $row["email"], 
        $row["gender"], 
        $row["ip_address"], 
        $row["NHS_Number"], 
        $row["user_name"], 
        $row["password"], 
        $row["therapist"], 
        $row["therapy_number"], 
        $row["session_number"], 
        $row["user_id"], 
        $row["therapist_specialty"], 
        $row["therapy_duration"], 
        $row["session_date"], 
        $row["therapy_notes"]
    ));

    echo implode("\t", $data) . "\n";
}

exit;

?>
