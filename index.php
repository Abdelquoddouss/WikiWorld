<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'views/partials/navbar.php';

use app\controller\CategoriesController;
use app\controller\WikisController;

include __DIR__ . '/vendor/autoload.php';


$a= new CategoriesController();
$category = $a->selectCategories2(); 


$b= new WikisController();
$Wikis= $b->selectWikis2();




?>




<!-- heros -->
<div class="lg:flex">
        <div class="flex items-center justify-center w-full px-6 py-8 lg:h-[32rem] lg:w-1/2">
            <div class="max-w-xl">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl">wiki<span class="text-blue-600 dark:text-blue-400">world</span></h2>

                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 lg:text-base">WikiWorld est une plateforme de gestion de wikis conçue pour simplifier la création, la collaboration et la diffusion des connaissances. Que vous soyez un étudiant, un professionnel ou un passionné cherchant à partager votre expertise, WikiWorld est l'outil idéal pour organiser vos informations de manière structurée et accessible</p>

                <div class="flex flex-col mt-6 space-y-3 lg:space-y-0 lg:flex-row">
                    <?php


                        if(isset($_SESSION['role']) == "auteur"){
                            echo '<a href="/WikiWorld/views/client/InserWiki.php" class="block px-5 py-2 text-sm font-medium tracking-wider text-center text-white transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">Add Wiki</a>';
                        }
                        else{
                            echo '<a href="/WikiWorld/views/auth/login.php" class="block px-5 py-2 text-sm font-medium tracking-wider text-center text-white transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">Get Started</a>';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="w-full h-64 lg:w-1/2 lg:h-auto ps-10	my-10">
            <div class="w-full h-full bg-cover" style="background-image: url(https://images.unsplash.com/photo-1508394522741-82ac9c15ba69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=748&q=80)">
                <div class="w-full h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>



<!-- Categories -->
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">explore our <br> awesome <span class="text-blue-500">Categories</span></h1>

        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
        <?php foreach($category as $a) : ?>

            <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </span>

                <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white"><?=$a["name"]?></h1>

            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<!-- WIKIS -->

<h1 class="mt-2 text-5xl font-semibold   md:mt-0 text-center  ">Wikis</h1>
<div class="flex  gap-10 ps-10	my-10">
    <?php foreach($Wikis as $wik): ?>
<div class="max-w-2xl overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
<img class="object-cover w-full h-64" src="./public/imgs/<?=$wik['img'] ?>" alt="Article">


    <div class="p-6">
        <div>
            
            <a href="./views/client/DetailWiki.php?id=<?= $wik['id']?>" class="block mt-2 text-xl font-semibold text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 hover:underline" tabindex="0" role="link"><?= $wik['title'] ?></a>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"><?= $wik['description']?></p>
        </div>
        </div>
    </div>
    <?php endforeach;?>
</div>

<div class="  md:mt-0 text-center   ps-10	my-10 ">
<a  href="/WikiWorld/views/client/Wiki.php"  type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
All Wikis </a>
<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
</svg>
</div>

<hr>


<!-- REVIEWS -->
<h1 class="mt-2 text-5xl font-semibold   md:mt-0 text-center  ps-10	my-10 	">Reviews</h1>
<div class="flex  gap-10 ps-10	my-10">
<div class="w-full max-w-md px-8 py-4 mt-16 bg-white rounded-lg shadow-lg dark:bg-gray-800">
    <div class="flex justify-center -mt-16 md:justify-end">
        <img class="object-cover w-20 h-20 border-2 border-blue-500 rounded-full dark:border-blue-400" alt="Testimonial avatar" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=76&q=80">
    </div>

    <h2 class="mt-2 text-xl font-semibold text-gray-800 dark:text-white md:mt-0">Directeur Anas</h2>

    <p class="mt-2 text-sm text-gray-600 dark:text-gray-200">En tant qu'enseignant, WikiWorld est un outil précieux pour créer des wikis éducatifs interactifs. Mes étudiants peuvent collaborer sur des projets de groupe, partager des ressources et créer un contenu pédagogique de qualité. </p>

</div>
<div class="w-full max-w-md px-8 py-4 mt-16 bg-white rounded-lg shadow-lg dark:bg-gray-800">
    <div class="flex justify-center -mt-16 md:justify-end">
        <img class="object-cover w-20 h-20 border-2 border-blue-500 rounded-full dark:border-blue-400" alt="Testimonial avatar" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=76&q=80">
    </div>

    <h2 class="mt-2 text-xl font-semibold text-gray-800 dark:text-white md:mt-0">Hamza</h2>

    <p class="mt-2 text-sm text-gray-600 dark:text-gray-200">je suis impressionné par la richesse des fonctionnalités offertes par WikiWorld. L'éditeur de texte riche permet de créer des wikis visuellement attrayants, avec la possibilité d'insérer des médias et de lier différentes pages entre elles.</p>
</div>
<div class="w-full max-w-md px-8 py-4 mt-16 bg-white rounded-lg shadow-lg dark:bg-gray-800">
    <div class="flex justify-center -mt-16 md:justify-end">
        <img class="object-cover w-20 h-20 border-2 border-blue-500 rounded-full dark:border-blue-400" alt="Testimonial avatar" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=76&q=80">
    </div>

    <h2 class="mt-2 text-xl font-semibold text-gray-800 dark:text-white md:mt-0">Tools</h2>

    <p class="mt-2 text-sm text-gray-600 dark:text-gray-200">WikiWorld a révolutionné la façon dont je gère mes projets de recherche. La plateforme conviviale et intuitive facilite la création et la collaboration sur des wikis personnalisés.</p>
</div>
</div>

<!-- FAQ -->
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">Frequently asked questions.</h1>

        <div class="grid grid-cols-1 gap-8 mt-8 lg:mt-16 md:grid-cols-2 xl:grid-cols-3">
            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Qu'est-ce qu'un wiki ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    Un wiki est une plateforme en ligne qui permet à plusieurs utilisateurs de collaborer et de créer du contenu de manière collective. C'est un système de gestion de connaissances où les utilisateurs peuvent créer, modifier et organiser des pages web contenant des informations sur un sujet spécifique.                    </p>
                </div>
            </div>

            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Comment puis-je créer un nouveau wiki sur WikiWorld ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    Pour créer un nouveau wiki sur WikiWorld, il vous suffit de vous inscrire sur notre plateforme et de vous connecter à votre compte. Une fois connecté, vous pouvez accéder à votre tableau de bord et utiliser l'option "Créer un nouveau wiki". Vous pouvez alors donner un titre à votre wiki, ajouter une description et commencer à ajouter du contenu.                    </p>
                </div>
            </div>

            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Puis-je inviter d'autres personnes à contribuer à mon wiki ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    Oui, absolument ! WikiWorld favorise la collaboration et vous permet d'inviter d'autres utilisateurs à contribuer à votre wiki. Vous pouvez gérer les autorisations des utilisateurs et définir qui peut simplement visualiser le contenu ou qui peut également le modifier. Cela permet une construction collective du savoir et une collaboration efficace.                    </p>
                </div>
            </div>

            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white"> Comment puis-je formater le contenu de mon wiki ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    WikiWorld propose un éditeur de texte riche qui vous permet de formater le contenu de votre wiki de manière conviviale. Vous pouvez mettre en évidence des mots ou des phrases, créer des listes à puces ou numérotées, ajouter des titres et sous-titres, insérer des images et des vidéos, créer des liens hypertexte, et bien plus encore.                    </p>
                </div>
            </div>

            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Comment puis-je rechercher des informations spécifiques sur WikiWorld ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    WikiWorld propose un système de recherche puissant qui vous permet de trouver rapidement des informations spécifiques. Vous pouvez utiliser la barre de recherche située en haut du site pour entrer des mots-clés ou des phrases liés à ce que vous recherchez. Les résultats de recherche afficheront les wikis pertinents contenant les informations que vous recherchez.                        </p>
                </div>
            </div>

            <div>
                <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-700 dark:text-white"> Est-ce que WikiWorld sauvegarde les versions précédentes des wikis ?</h1>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                    Oui, WikiWorld conserve un historique des versions précédentes de vos wikis. Cela vous permet de voir toutes les modifications apportées au fil du temps et de revenir à une version antérieure si nécessaire. L'historique des versions est un outil précieux pour suivre les changements et garantir l'intégrité de votre contenu.                    </p>
                </div>
            </div>
        </div>
    </div>
</section>



    

<?php
require_once 'views/partials/footer.php';
?>