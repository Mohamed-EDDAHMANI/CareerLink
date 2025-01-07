<?php
session_start();

require '../../../vendor/autoload.php';

use App\Controllers\CategorieController;
use App\Controllers\TagController;
use App\Controllers\OffreController;
use App\Classes\Offre;

//create instens
$catigorieInstens = new CategorieController();
$tagInstens = new TagController();
$offerControllerInstens = new OffreController();

//get data
$tags = $tagInstens->getTags();
$categoris = $catigorieInstens->getCatigories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['tags']) && is_array($_POST['tags'])) {
        $selectedTags = $_POST['tags'];
    }
    
    // Récupérer les données du formulaire
    $post = $_POST['post'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $qualification = $_POST['qualification'];
    $location = $_POST['location'];
    $category_id = $_POST['categorie_id'];
    $recruiter_id = $_SESSION['user']['id'];
    if($recruiter_id){
        $offreInstens = new Offre('', $post, $description, $salary, $qualification, $location, $recruiter_id, $category_id);
        $offerControllerInstens->createOffre($offreInstens, $selectedTags);
    }else{
        $_SESSION['error']['message'] = 'Invalid Offre informations';
        exit();
    }

}



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une nouvelle offre</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="dashboard.php" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <span class="ml-4 text-xl font-semibold">Créer une nouvelle offre</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- create secces message -->
    <?php if (isset($_SESSION['success']['message'])): ?>
        <span
            class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
            <!-- Optional: Add an error icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <p><?php echo $_SESSION['success']['message']; ?></p>
            <?php unset($_SESSION['success']['message']); ?>
        </span>
    <?php endif; ?>

    <!-- create error message -->
    <?php if (isset($_SESSION['error']['message'])): ?>
        <span
            class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
            <!-- Optional: Add an error icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <p><?php echo $_SESSION['error']['message']; ?></p>
            <?php unset($_SESSION['error']['message']); ?>
        </span>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="pt-20 pb-8 px-4 max-w-4xl mx-auto">
        <form class="space-y-6" method="POST" action="">
            <!-- Basic Information Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Informations de base</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Intitulé du poste *
                        </label>
                        <input name="post" type="text" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="ex: Développeur Full Stack">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Catégorie *
                            </label>
                            <select required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="categorie_id">
                                <option value="">Sélectionnez une catégorie</option>
                                <?php if ($categoris): ?>
                                    <?php foreach ($categoris as $categori): ?>
                                        <?php echo '<option value="' . $categori['id'] . '">' . $categori['category_name'] . '</option>'; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Type de contrat *
                            </label>
                            <select required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Sélectionnez un type</option>
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Intérim">Intérim</option>
                                <option value="internship">Stage</option>
                                <option value="apprenticeship">Alternance</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location and Salary Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Localisation et Rémunération</h2>
                <div class="space-y-4">
                    <div class="gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Ville *
                            </label>
                            <input type="text" name="location" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="ex: Paris">
                        </div>

                    </div>
                    <div class="">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Salaire *
                            </label>
                            <div class="relative">
                                <input type="number" name="salary" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pl-8"
                                    placeholder="ex: 35000">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Prérequis</h2>
                <div class="space-y-4">
                    <div class="">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Niveau d'études *
                            </label>
                            <select required name="qualification"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Sélectionnez un niveau</option>
                                <option value="Bac">Bac</option>
                                <option value="Bac+2 - DUT/BTS">Bac+2 - DUT/BTS</option>
                                <option value="Bac+3 - Licence">Bac+3 - Licence</option>
                                <option value="Bac+5 - Master">Bac+5 - Master</option>
                                <option value="Bac+8 - Doctorat">Bac+8 - Doctorat</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tags (#) *
                        </label>
                        <div class="mb-6">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <?php if ($tags): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <label class="flex items-center space-x-2">
                                            <?php echo '<input type="checkbox" name="tags[]" value=' . $tag['id'] . ' 
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> '; ?>
                                            <?php echo '<span class="text-sm text-gray-700"># ' . $tag['tag_name'] . '</span>'; ?>
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Description du poste</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description détaillée *
                        </label>
                        <textarea required rows="6" name="description"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Décrivez les responsabilités, missions et attentes du poste..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4">
                <button type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Annuler
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Publier l'offre
                </button>
            </div>
        </form>
    </div>


    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 3000);
        }

    </script>
</body>

</html>