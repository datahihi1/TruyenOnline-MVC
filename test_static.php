<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyenonline";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("
        SELECT DATE(time_bought) AS purchase_date, 
        SUM(price) AS total_spent
        FROM comic_bought
        GROUP BY DATE(time_bought)
        ORDER BY purchase_date;
    ");
    $sql->execute();

    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Chuyển dữ liệu thành JSON để sử dụng với thư viện biểu đồ
    $data = json_encode($results);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        // Lấy dữ liệu từ PHP
        const data = <?php echo $data; ?>;

        // Xử lý dữ liệu cho Chart.js
        const labels = data.map(item => item.purchase_date);
        const values = data.map(item => item.total_spent);

        // Vẽ biểu đồ
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Kiểu biểu đồ: bar (cột), line (đường), etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Spent',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Spent'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
