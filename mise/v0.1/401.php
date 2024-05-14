<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>401 Not Auhtorized</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }

    .error-code {
      font-size: 64px;
      font-weight: bold;
      color: #333;
    }

    .error-message {
      font-size: 24px;
      color: #666;
      margin-top: 10px;
    }

    .home-link {
      font-size: 18px;
      color: #007bff;
      text-decoration: none;
      margin-top: 20px;
    }

    .home-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="error-code">401</div>
    <div class="error-message">Oops! You are not authorized. Maybe you were looking for the application</div>
    <a class="home-link" href="../mise/v0.1/dashboard.php">Go to Version 0.1</a>
  </div>
</body>
</html>
