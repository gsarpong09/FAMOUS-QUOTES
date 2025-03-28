<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Famous Quotes API Test</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: #f5f5f5;
      color: #333;
    }
    h1 {
      color: #007acc;
    }
    input, button {
      padding: 0.5rem;
      margin: 0.5rem 0;
      width: 100%;
      max-width: 400px;
    }
    pre {
      background: #eee;
      padding: 1rem;
      overflow: auto;
    }
  </style>
</head>
<body>
<h1>Famous Quotes API Test Console</h1>
<p>Enter an API endpoint to test it directly:</p>

<input type="text" id="endpoint" value="/api/quotes/" placeholder="e.g. /api/quotes/?id=1">
<button onclick="runTest()">Send GET Request</button>
<pre id="result">Results will appear here...</pre>

<script>
function runTest() {
  const endpoint = document.getElementById('endpoint').value;
  const url = window.location.origin + endpoint;
  fetch(url)
    .then(res => res.json())
    .then(data => {
      document.getElementById('result').textContent = JSON.stringify(data, null, 2);
    })
    .catch(err => {
      document.getElementById('result').textContent = 'Error: ' + err;
    });
}
</script>

<p><strong>Examples to try:</strong></p>
<ul>
  <li><code>/api/quotes/</code></li>
  <li><code>/api/quotes/?id=10</code></li>
  <li><code>/api/authors/</code></li>
  <li><code>/api/categories/</code></li>
</ul>

</body>
</html>
