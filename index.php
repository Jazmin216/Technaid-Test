<?php
include 'conection.php';
include 'crud.php';

$where = [];
if (!empty($_GET['first_name'])) {
    $where[] = "first_name LIKE '%" . $conn->real_escape_string($_GET['first_name']) . "%'";
}
if (!empty($_GET['last_name'])) {
    $where[] = "last_name LIKE '%" . $conn->real_escape_string($_GET['last_name']) . "%'";
}
if (!empty($_GET['id'])) {
    $where[] = "id = " . intval($_GET['id']);
}
if (!empty($_GET['gender'])) {
    $where[] = "gender = '" . $conn->real_escape_string($_GET['gender']) . "'";
}

$sql = "SELECT * FROM datos_simulados";
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="mb-4">Patient Management</h2>

    <form action="index.php" method="GET" class="row g-2 mb-4 d-flex align-items-center">
        <div class="col-md-2">
            <input type="text" name="first_name" placeholder="First Name" class="form-control" value="<?= $_GET['first_name'] ?? '' ?>">
        </div>
        <div class="col-md-2">
            <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="<?= $_GET['last_name'] ?? '' ?>">
        </div>
        <div class="col-md-2">
            <input type="number" name="id" placeholder="ID" class="form-control" value="<?= $_GET['id'] ?? '' ?>">
        </div>
        <div class="col-md-2">
        <select name="gender" id="gender" class="form-control">
            <option value="">Gender</option>
            <option value="Male" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Agender" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Agender') ? 'selected' : '' ?>>Agender</option>
            <option value="Bigender" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Bigender') ? 'selected' : '' ?>>Bigender</option>
            <option value="Genderfluid" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Genderfluid') ? 'selected' : '' ?>>Genderfluid</option>
            <option value="Genderqueer" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Genderqueer') ? 'selected' : '' ?>>Genderqueer</option>
            <option value="Non-binary" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Non-binary') ? 'selected' : '' ?>>Non-binary</option>
            <option value="Polygender" <?= (isset($_GET['gender']) && $_GET['gender'] == 'Polygender') ? 'selected' : '' ?>>Polygender</option>
        </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="add_patient.php" class="btn btn-success">Add Patient</a>
            <a href="stats.php" class="btn btn-warning">Stats</a>
            <button type="submit" formaction="export.php" class="btn btn-info">Export</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Ip Address</th>
                <th>NHS Number</th>
                <th>User Name</th>
                <th>Password</th>
                <th>Therapist</th>
                <th>Therapy Number</th>
                <th>Session Number</th>
                <th>User id</th>
                <th>Therapist Specialty</th>
                <th>Therapist Duration</th>
                <th>Session Date</th>
                <th>Therapy Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="process.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>    
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['ip_address'] ?></td>
                    <td><?= $row['NHS_Number'] ?></td>
                    <td><?= $row['user_name'] ?></td>
                    <td class='password-cell'>{$row["password"]}</td>
                    <td><?= $row['therapist'] ?></td>
                    <td><?= $row['therapy_number'] ?></td>
                    <td><?= $row['session_number'] ?></td>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['therapist_specialty'] ?></td>
                    <td><?= $row['therapy_duration'] ?></td>
                    <td><?= $row['session_date'] ?></td>
                    <td class="notes-column">
                        <?= nl2br(htmlspecialchars($row['therapy_notes'])) ?>
                    </td>             
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
<style>
    .notes-column {
        min-width: 300px; 
        max-width: 500px; 
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    .password-cell {
        font-family: "password";
        -webkit-text-security: disc;
    }
</style>

</html>
