<?php
require "../partials/navbar.php";

use app\controller\WikisController;
include __DIR__ . '/../../vendor/autoload.php';

$wikiController = new WikisController(); 

if (isset($_GET['id'])) {
    $wikiId = $_GET['id'];

    $wiki = $wikiController->selectWikiById($wikiId);

    if ($wiki) {
?>
        <section class="bg-white dark:bg-gray-900">
            <div class="container px-6 py-10 mx-auto">
                <div class="lg:-mx-6 lg:flex lg:items-center">
                    <img class="object-cover object-center lg:w-1/2 lg:mx-6 w-full h-96 rounded-lg lg:h-[36rem]" src="<?= $wiki['img'] ?>" alt="Article">

                    <div class="mt-8 lg:w-1/2 lg:px-6 lg:mt-0">
                        <p class="text-5xl font-semibold text-blue-500 ">“</p>

                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white lg:text-3xl lg:w-96">
                            <?= $wiki['title'] ?>
                        </h1>

                        <p class="max-w-lg mt-6 text-gray-500 dark:text-gray-400 ">
                            <?= $wiki['description'] ?>
                        </p>

                        <h3 class="mt-6 text-lg font-medium text-blue-500">status</h3>
                        <p class="text-gray-600 dark:text-gray-300"><?= $wiki['status'] ?></p>


                        <h3 class="mt-6 text-lg font-medium text-blue-500">categories</h3>
                        <p class="text-gray-600 dark:text-gray-300"><?= $wiki['categorie_id'] ?></p>



                    </div>
                </div>
            </div>
        </section>
<?php
    } else {
        echo '<p>Wiki not found</p>';
    }
} else {
    echo '<p>Wiki ID not provided</p>';
}

require "../partials/footer.php";
?>
