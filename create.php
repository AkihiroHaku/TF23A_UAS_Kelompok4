<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];

    // Memperbarui data buku di database
    $stmt = $pdo->prepare("INSERT INTO books (title, author, published_year, genre) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $author, $published_year, $genre]);

    // Mengalihkan ke halaman index setelah penambahan
    header("Location: index.php");
    exit; // Menghentikan eksekusi skrip setelah pengalihan
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-container a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Book</h2>
        <form action="create.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter book title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" placeholder="Enter author name" required>

            <label for="published_year">Published Year:</label>
            <input type="number" id="published_year" name="published_year" placeholder="Enter published year" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" placeholder="Enter genre" required>

            <button type="submit">Submit</button>
        </form>
        <a href="index.php">Back</a>
    </div>
</body>
</html>