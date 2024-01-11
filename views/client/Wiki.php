<?php
require_once '../partials/navbar.php';

use app\controller\TagsController;
use app\controller\CategoriesController;
use app\controller\WikisController;
include __DIR__ . '/../../vendor/autoload.php';


 $c = new TagsController();
$tags = $c->selectTags();

$d = new CategoriesController();
$categories = $d->selectCategories();

$wiki = new WikisController();
$wikis = $wiki->selectWikis();

?>



<div class="w-1/3 mx-auto mt-10">
<label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>

<select id="small" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected>Choose a country</option>
  <?php foreach($categories as $category) : ?>
  <option value="US"><?=$category["name"]?></option>
  <?php endforeach; ?>
</select>
<label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>


<select id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Choose a country</option>
    <?php foreach($tags as $tag) : ?>
  <option value="US"><?=$tag["name"] ?></option>
  <?php endforeach; ?>
</select>

</div>



<h1 class="mt-2 text-5xl font-semibold   md:mt-0 text-center  ">Wikis</h1>
<div class="flex  gap-10 ps-10	my-10">
    <?php foreach($wikis as $wiki): ?>
<div class="max-w-2xl overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
    <img class="object-cover w-full h-64" src="<?= $wiki['img'] ?>" alt="Article">

    <div class="p-6">
        <div>
            
        <a href="./DetailWiki.php?id=<?= $wiki['id'] ?>" class="block mt-2 text-xl font-semibold text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 hover:underline" tabindex="0" role="link"><?= $wiki['title'] ?></a>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"><?= $wiki['description']?></p>
        </div>

       
    </div>
</div>
<?php endforeach;?>
</div>



<?php
require_once '../partials/footer.php';
?>

