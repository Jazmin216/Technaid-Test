<?php
include 'conection.php';


$allowed_fields = ['gender', 'therapist', 'therapist_specialty', 'therapy_duration'];
$field = $_GET['field'] ?? '';

$data = [];

if ($field && in_array($field, $allowed_fields)) {
    $query = "SELECT `$field`, COUNT(*) as count FROM datos_simulados GROUP BY `$field`";
    $result = $conn->query($query);
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
$jsonData = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-4">

    <h2>Generate Statistics</h2>

    <form action="stats.php" method="GET" class="mb-4">
        <label for="field" class="form-label">Select a variable to visualize:</label>
        <select name="field" id="field" class="form-select" required>
            <option value="">-- Select --</option>
            <?php foreach ($allowed_fields as $option): ?>
                <option value="<?= $option ?>" <?= $field === $option ? 'selected' : '' ?>>
                    <?= ucfirst(str_replace('_', ' ', $option)) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Generate Chart</button>
        <a href="index.php" class="btn btn-danger mt-2">Cancel</a>
    </form>

    <?php if ($field && !empty($data)): ?>
        <canvas id="chart"></canvas>

        <script>
            const data = <?= $jsonData ?>;
            const labels = data.map(item => item['<?= $field ?>']);
            const counts = data.map(item => item['count']);

            const ctx = document.getElementById('chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of <?= ucfirst($field) ?>',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
    <?php elseif ($field): ?>
        <p>No data available for the selected field.</p>
    <?php endif; ?>

</body>
</html>
