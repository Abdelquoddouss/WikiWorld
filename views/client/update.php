<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Wiki</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-8 p-8 bg-white shadow-md max-w-md">

    <h2 class="text-2xl font-bold mb-4">Update Wiki</h2>

    <?php
    include __DIR__ . '/../../vendor/autoload.php';
    use app\controller\WikisController;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $wikiController = new WikisController();
        $wiki = $wikiController->selectWikiById($id);

    }
    ?>

<form action="../../app/controller/WikisController.php?id=<?=$wiki['wiki_id'] ?>" method="post">


        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-600">Description:</label>
            <textarea name="description" class="mt-1 p-2 border rounded-md w-full"><?= $wiki['description'] ?></textarea>
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
            <input type="text" name="title" value="<?= $wiki['title'] ?>" class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="img" class="block text-sm font-medium text-gray-600">Image URL:</label>
            <input type="text" name="img" value="<?= $wiki['img'] ?>" class="mt-1 p-2 border rounded-md w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md" name="update">Update</button>
    </form>
</div>

</body>
</html>
