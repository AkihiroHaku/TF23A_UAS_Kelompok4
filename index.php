<?php
include 'db.php';

$books = $pdo->query("SELECT * FROM books")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Perpustakaan Buku</h1>
    <a href="create.php" class="btn btn-primary mb-3">Add New Book</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published Year</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['published_year'] ?></td>
                    <td><?= $book['genre'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $book['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>