<?php

include __DIR__ . '/../../vendor/autoload.php';
session_start();


require_once '../partials/navbar.php';



use app\controller\TagsController;
use app\controller\CategoriesController;
use app\controller\WikisController;


 $c = new TagsController();
$tags = $c->selectTags();

$d = new CategoriesController();
$categories = $d->selectCategories();

$wiki = new WikisController();
$wikis = $wiki->selectWikis();

?>



<form class="flex  inline mx-auto" method="post">   
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full mx-auto">
        <input type="text" id="live_search" class=" mx-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-100 ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required>
    </div>

</form>

<h1 class="mt-2 text-5xl font-semibold   md:mt-0 text-center  ">Wikis</h1>
<div class="wiki  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center">
<?php foreach($wikis as $wik): ?>
<div class="max-w-2xl overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
<img class="object-cover w-full h-64" src="../../public/imgs/<?=$wik['img'] ?>" alt="Article">

    <div class="p-6">
        <div> 
            <a href="./DetailWiki.php?id=<?= $wik['id']?>" class="block mt-2 text-xl font-semibold text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 hover:underline" tabindex="0" role="link"><?= $wik['title'] ?></a>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"><?= $wik['description']?></p>
                
            <?php if(isset($_SESSION["userid"]) && $_SESSION["userid"] == $wik['user_id']) :?>
                
  <div class="mt-2"><a href="delete.php?id=<?php echo $wik['id']; ?>">

   <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="hover" style="width:25px;height:25px"></lord-icon>Delete</a>
     <a href="update.php?id=<?php echo $wik['id']; ?>" class="bg-yellow-500 rounded-full px-4 py-2 text-white">Update</a>
                </div>
                <?php endif; ?>
        </div>  
        </div>
    </div>
    <?php endforeach;?>

</div>



<script>
var wikii = document.getElementsByClassName("wiki")[0];
var liveSearchInput = document.getElementById("live_search");
var searchResult = document.getElementById("searchresult");

liveSearchInput.addEventListener('keyup', async function () {
    try {
        const response = await fetch('../../app/controller/WikisController.php?search=' + liveSearchInput.value);
        wikii.innerHTML = "";
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        data.forEach(function (wik) {
           console.log(wik);
           const newHtml = `    
                <div class="max-w-2xl overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <img class="object-cover w-full h-64" src="../../public/imgs/${wik.img}" alt="Article">
                    <div class="p-6">
                        <div>
                            <a href="./DetailWiki.php?id=${wik.id}" class="block mt-2 text-xl font-semibold text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 hover:underline" tabindex="0" role="link">${wik.title}</a>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">${wik.description}</p>
                        </div>
                    </div>
                </div>`;

            wikii.innerHTML += newHtml;

        });

    } catch (error) {
        console.error('Fetch error:', error);
    }
});











</script>

<script src="https://cdn.lordicon.com/lordicon.js"></script>


<?php
require_once '../partials/footer.php';
?>

