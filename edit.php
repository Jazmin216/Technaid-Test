<?php
include 'conection.php';
include 'crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid patient ID.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM datos_simulados WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Patient not found.");
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    updateDatafunction(
        $id, 
        $_POST['first_name'], $_POST['last_name'], $_POST['email'], 
        $_POST['gender'], $_POST['ip_address'], $_POST['NHS_Number'], 
        $_POST['user_name'], $_POST['password'], $_POST['therapist'], 
        $_POST['therapy_number'], $_POST['session_number'], $_POST['user_id'], 
        $_POST['therapist_specialty'], $_POST['therapy_duration'], $_POST['session_date'], $_POST['therapy_notes']
    );
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Person</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">
    <h2>Edit Person</h2>
    <form method="POST">
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= $row['first_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= $row['last_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Agender" <?= $row['gender'] == 'Agender' ? 'selected' : '' ?>>Agender</option>
                <option value="Bigender" <?= $row['gender'] == 'Bigender' ? 'selected' : '' ?>>Bigender</option>
                <option value="Genderfluid" <?= $row['gender'] == 'Genderfluid' ? 'selected' : '' ?>>Genderfluid</option>
                <option value="Genderqueer" <?= $row['gender'] == 'Genderqueer' ? 'selected' : '' ?>>Genderqueer</option>
                <option value="Non-binary" <?= $row['gender'] == 'Non-binary' ? 'selected' : '' ?>>Non-binary</option>
                <option value="Polygender" <?= $row['gender'] == 'Polygender' ? 'selected' : '' ?>>Polygender</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ip Address</label>
            <input type="text" name="ip_address" value="<?= $row['ip_address'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NHS Number</label>
            <input type="text" name="NHS_Number" value="<?= $row['NHS_Number'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>User Name</label>
            <input type="text" name="user_name" value="<?= $row['user_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" value="<?= $row['password'] ?>" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                    👁️‍🗨️
                </button>
            </div>
        </div>
        <div class="mb-3">
            <label>Therapist</label>
            <input type="text" name="therapist" value="<?= $row['therapist'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Therapy Number</label>
            <input type="number" name="therapy_number" value="<?= $row['therapy_number'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Session Number</label>
            <input type="number" name="session_number" value="<?= $row['session_number'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>User Id</label>
            <input type="number" name="user_id" value="<?= $row['user_id'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Therapist Specialty</label>
            <input type="text" name="therapist_specialty" value="<?= $row['therapist_specialty'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Therapist Duration</label>
            <input type="number" name="therapy_duration" value="<?= $row['therapy_duration'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Session Date</label>
            <input type="date" name="session_date" value="<?= $row['session_date'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="therapy_notes">Therapy Notes</label>
            <textarea name="therapy_notes" id="therapy_notes" class="form-control" rows="5" required><?= htmlspecialchars($row['therapy_notes']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>
