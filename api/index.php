<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
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
  <title>Famous Quotes API</title>
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
    code {
      background-color: #eaeaea;
      padding: 2px 5px;
      border-radius: 4px;
      font-family: monospace;
    }
    a {
      color: #007acc;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<h1>📚 Famous Quotes REST API</h1>

<p>Welcome to your INF653 Midterm Project: a fully functional REST API built using PHP, PostgreSQL, and deployed via Docker on Render.</p>

<h2>✅ Core API Endpoints</h2>
<ul>
  <li><code>GET /api/quotes/</code> – Get all quotes</li>
  <li><code>GET /api/quotes/?id=10</code> – Get a specific quote</li>
  <li><code>GET /api/quotes/?author_id=5</code> – Get quotes by author</li>
  <li><code>GET /api/quotes/?category_id=4</code> – Get quotes by category</li>
  <li><code>GET /api/quotes/?author_id=5&category_id=4</code> – Filter by both</li>
  <li><code>POST /api/quotes/</code> – Add a new quote</li>
  <li><code>PUT /api/quotes/</code> – Update a quote</li>
  <li><code>DELETE /api/quotes/</code> – Delete a quote</li>
</ul>

<h3>Authors</h3>
<ul>
  <li><code>GET /api/authors/</code> – Get all authors</li>
  <li><code>GET /api/authors/?id=5</code> – Get a specific author</li>
  <li><code>POST /api/authors/</code> – Add new author</li>
  <li><code>PUT /api/authors/</code> – Update author</li>
  <li><code>DELETE /api/authors/</code> – Delete author</li>
</ul>

<h3>Categories</h3>
<ul>
  <li><code>GET /api/categories/</code> – Get all categories</li>
  <li><code>GET /api/categories/?id=4</code> – Get a specific category</li>
  <li><code>POST /api/categories/</code> – Add new category</li>
  <li><code>PUT /api/categories/</code> – Update category</li>
  <li><code>DELETE /api/categories/</code> – Delete category</li>
</ul>

<h2>🧪 Test It</h2>
<p>You can test all endpoints using <a href="https://www.postman.com/" target="_blank">Postman</a>.</p>

<h2>📝 About</h2>
<p>This API was developed for the <strong>Spring 2024 INF653 Back End Web Development Midterm</strong> project. You can find full documentation in your <code>README.md</code> or GitHub repo.</p>

<p><strong>GitHub:</strong> <a href="https://github.com/gsarpong09/FAMOUS-QUOTES" target="_blank">gsarpong09/FAMOUS-QUOTES</a></p>

</body>
</html>
