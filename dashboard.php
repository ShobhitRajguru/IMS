<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Basic CSS styles for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-template-rows: repeat(8, auto);
            gap: 10px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            grid-column: 1 / -1;
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 200px;
        }
        .user-info {
            grid-column: 1 / -1;
            text-align: right;
            margin-bottom: 20px;
        }
        .buttons {
            grid-column: 1 / -1;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50; /* Green */
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        }
        .btn2 {
        display: inline-block;
        padding: 10px 20px;
        background-color: #2196F3; /* Blue */
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        }
        .chart-container {
            grid-column: 1 / span 3;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .bar-chart-container {
            grid-column: 4 / -1;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
        #output {
            grid-column: 1 / -1;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            text-align: center;
        }

        /* CSS styles for individual category messages */
        .category-message {
            margin-bottom: 10px;
        }

        /* CSS styles for the "All categories are adequately filled." message */
        #adequate-message {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Company Name and Logo -->
    <div class="header">
        <img src="logo.jpg" alt="Company Logo">
        <h1>LAB INVENTORY MANAGEMENT SYSTEM</h1>
    </div>

    <!-- User Information -->
    <div class="user-info">
        <?php
        // Start session
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['username'], $_SESSION['lab_no'])) {
            echo "<p>Welcome, " . $_SESSION['username'] . "</p>";
            echo "<p>Lab No.: " . $_SESSION['lab_no'] . "</p>";
            //echo "<p>LAB NO.: " . $_SESSION['lab_no'] . "</p>";
            echo "<form method='post' action='login_process.php'>";
            echo "<button type='submit' name='signout' class='btn'>Sign Out</button>";
            echo "</form><br>";
            echo "<form action='send_data_issue.php' method='post'>";
            //echo "<label for='data'>Data:</label>";
            echo "    <input type='hidden' id='data' name='data' value='" . $_SESSION['lab_no'] . "'>";
            echo "<button type='submit' onclick='location.href='http://127.0.0.1:5000/' class='btn2'>Issue</button>";
            echo "</form>";
            echo "<form action='send_data.php' method='post'>";
            //echo "<label for='data'>Data:</label>";
            echo "    <input type='hidden' id='data' name='data' value='" . $_SESSION['lab_no'] . "'>";
            echo "<button type='submit' onclick='location.href='http://127.0.0.1:5000/' class='btn2'>Receive</button>";
            echo "</form>";
        } else {
            // Redirect to login page if not logged in
            header("Location: login.php");
            exit;
        }
        ?>
    </div>

    <!-- Buttons to View or Edit Components -->
    <div class="buttons">
        <button onclick="location.href='view_components.php?lab_no=<?php echo $_SESSION['lab_no']; ?>';" class="btn">View Components</button>
        <button onclick="location.href='edit_components.php?lab_no=<?php echo $_SESSION['lab_no']; ?>';" class="btn">Edit Components</button>
        
    
    </div>
    <div id="output"></div> <!-- This is where the output will be displayed -->
    <!-- Category Counts Chart -->
    <div class="chart-container">
        <h2>Category Counts</h2>
        <canvas id="categoryChart" width="100" height="100"></canvas>
    </div>

    <!-- Bar Graph -->
    <div class="bar-chart-container">
        <h2>Bar Graph</h2>
        <canvas id="barChart" width="100" height="100"></canvas>
    </div>
</div>



<script>
    // Retrieve data from PHP and prepare for chart
    var categoryCounts = <?php
        include_once 'db_connect.php';
        $lab = $_SESSION['lab_no'];
        $sql = "SELECT category, COUNT(*) AS total_entries FROM components WHERE lab_no = $lab GROUP BY category";
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[$row["category"]] = $row["total_entries"];
            }
        }
        echo json_encode($data);
        $conn->close();
    ?>;

    // Create pie chart
    var ctx = document.getElementById('categoryChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(categoryCounts),
            datasets: [{
                data: Object.values(categoryCounts),
                backgroundColor: [
                    'rgba(255, 159, 64, 0.6)',  // Orange
                    'rgba(75, 192, 192, 0.6)',   // Teal
                    'rgba(153, 102, 255, 0.6)',  // Purple
                    'rgba(255, 205, 86, 0.6)',   // Yellow
                    'rgba(54, 162, 235, 0.6)',   // Blue
                    'rgba(255, 99, 132, 0.6)',   // Red
                    // Add more colors if needed
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    // Add more colors if needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            // Add chart options here
        }
    });

    // Capacity limits for each category
    const capacityLimits = {
        PC: 10,
        CRO: 5,
        FANS: 20,
        TUBE: 20,
        DMM: 20,
        FPGA_BOARD: 4 // Note: corrected "BORADS" to "BOARDS"
    };

    // Calculate filled and vacant percentages for each category
    const filledPercentages = {};
    const requiredquantity = {};
    for (const category in categoryCounts) {
        const count = categoryCounts[category];
        const capacity = capacityLimits[category];
        const required = Math.ceil((capacity * 0.3) - count);
        const filledPercentage = (count / capacity) * 100;
        const vacantPercentage = 100 - filledPercentage;
        filledPercentages[category] = { filled: filledPercentage, vacant: vacantPercentage };
        requiredquantity[category] = { quantity: required };
    }

     // Check if any category has less than 30% vacancy
     const lackingCategories = [];
        for (const category in filledPercentages) {
            if (filledPercentages[category].filled < 30) {
                lackingCategories.push(category);
            }
        }

        // Display a message for lacking categories
        if (lackingCategories.length > 0) {
            const outputDiv = document.getElementById('output');
            outputDiv.innerHTML = "<p>The following categories are lacking:</p>";
            lackingCategories.forEach(category => {
                outputDiv.innerHTML += `<p>${category}: ${filledPercentages[category].filled}% filled :: ${requiredquantity[category].quantity} required</p>`;
                //outputDiv.innerHTML += `<p>${category}: ${requiredquantity[category].quantity} required</p>`;
                
            });
        } else {
            document.getElementById('output').textContent = "All categories are adequately filled.";
        }
     // Create bar chart
var ctx = document.getElementById('barChart').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: Object.keys(categoryCounts),
        datasets: [{
            label: 'Filled',
            data: Object.values(filledPercentages).map(obj => obj.filled),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Vacant',
            data: Object.values(filledPercentages).map(obj => obj.vacant),
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                stacked: true,
                ticks: {
                    beginAtZero: true,
                    callback: function (value) {
                        return value + "%";
                    }
                }
            },
            x: {
                stacked: true
            }
        }
    }
});
</script>



</body>
</html>
