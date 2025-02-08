<?php
include 'conection.php';
include 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    insertData(
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
    <title>Add Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Add New Patient</h2>
    
    <form method="POST" class="mb-4">
        <input type="text" name="first_name" placeholder="Name" required class="form-control mb-2">
        <input type="text" name="last_name" placeholder="Last Name" required class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
        <select name="gender" required class="form-control mb-2">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Agender">Agender</option>
            <option value="Bigender">Bigender</option>
            <option value="Genderfluid">Genderfluid</option>
            <option value="Genderqueer">Genderqueer</option>
            <option value="Non-binary">Non-binary</option>
            <option value="Polygender">Polygender</option>
        </select>
        <input type="text" name="ip_address" placeholder="Ip Address" required class="form-control mb-2">
        <input type="text" name="NHS_Number" placeholder="NHS Number" required class="form-control mb-2">
        <input type="text" name="user_name" placeholder="User Name" required class="form-control mb-2">
        <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
        <input type="text" name="therapist" placeholder="Therapist" required class="form-control mb-2">
        <input type="number" name="therapy_number" placeholder="Therapy Number" required class="form-control mb-2">
        <input type="number" name="session_number" placeholder="Session Number" required class="form-control mb-2">
        <input type="number" name="user_id" placeholder="User id" required class="form-control mb-2">
        <input type="text" name="therapist_specialty" placeholder="Therapist Specialty" required class="form-control mb-2">
        <input type="number" name="therapy_duration" placeholder="Therapist Duration" required class="form-control mb-2">
        <textarea name="therapy_notes" placeholder="Therapy Notes" required class="form-control mb-2" rows="5"></textarea>
        <label for="session_date">Session Date</label>
        <input type="date" id="session_date" name="session_date" required class="form-control mb-2">
        <button type="submit" name="insert" class="btn btn-success">Add</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
