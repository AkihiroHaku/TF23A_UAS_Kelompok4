<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];

    // Memperbarui data buku di database
    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, published_year = ?, genre = ? WHERE id = ?");
    $stmt->execute([$title, $author, $published_year, $genre, $id]);

    // Mengalihkan ke halaman index setelah pembaruan
    header("Location: index.php");
    exit; // Menghentikan eksekusi skrip setelah pengalihan
}

// Mengambil ID buku dari URL
$id = $_GET['id'];

// Mengambil data buku berdasarkan ID
$book = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$book->execute([$id]);
$book = $book->fetch();

if (!$book) {
    // Jika buku tidak ditemukan, bisa mengalihkan atau menampilkan pesan error
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
        <h2>Edit Buku</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>

            <label for="published_year">Published Year:</label>
            <input type="number" id="published_year" name="published_year" value="<?php echo htmlspecialchars($book['published_year']); ?>" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required>

            <button type="submit">Update</button>
        </form>
        <a href="index.php">Back</a>
    </div>
</body>
</html>