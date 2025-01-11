<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: src\View\auth\login.php');
}

require_once '../../../vendor/autoload.php';

use App\Controllers\OffreController;

$offreController = new OffreController();
if (isset($_SESSION['user'])) {
    $recruteurId = $_SESSION['user']['id'];
}
$ComplexData = $offreController->getOffresById($recruteurId);

if (isset($_GET['id'])) {
    $offreController->deleteOffre($_GET['id']);
    // $ComplexData = $offreController->getOffresById($recruteurId);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Recruteur</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Dashboard
                        Recruteur</span>
                </div>
                <div class="flex items-center">
                    <a href="createOffre.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Nouvelle Offre
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16 px-4">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 mt-4">
            <div class="bg-white rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-briefcase text-2xl text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-900 text-lg font-medium">Offres Actives</h2>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-900 text-lg font-medium">Candidatures</h2>
                        <p class="text-3xl font-bold text-gray-900">48</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-2xl text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-900 text-lg font-medium">En Cours</h2>
                        <p class="text-3xl font-bold text-gray-900">8</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-handshake text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-900 text-lg font-medium">Recrutements</h2>
                        <p class="text-3xl font-bold text-gray-900">5</p>
                    </div>
                </div>
            </div>
        </div>

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


        <!-- Job Listings -->
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Offres d'emploi</h2>
                <div class="flex gap-2">
                    <input type="text" placeholder="Rechercher..." class="border rounded-lg px-3 py-2">
                    <select class="border rounded-lg px-3 py-2">
                        <option>Toutes les catégories</option>
                        <option>Développement</option>
                        <option>Marketing</option>
                        <option>Commerce</option>
                        <option>Design</option>
                        <option>Finance</option>
                        <option>Ressources Humaines</option>
                    </select>
                </div>
            </div>

            <!-- Job Cards -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Job Card 1 -->
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-md transition-all duration-300 overflow-hidden group">
                    <div class="p-5">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Développeur Full Stack
                                </h3>
                                <span
                                    class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                    Développement
                                </span>
                            </div>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-1 text-gray-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#javascript</span>
                            <span
                                class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#react</span>
                            <span
                                class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#nodejs</span>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            Nous recherchons un développeur Full Stack expérimenté pour rejoindre notre équipe
                            technique.
                            Vous serez responsable du développement et de la maintenance de nos applications web.
                        </p>

                        <!-- Details -->
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt w-4 text-blue-500"></i>
                                <span class="ml-2">Paris, France</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-euro-sign w-4 text-green-500"></i>
                                <span class="ml-2">45k - 55k</span>
                            </div>
                            <div class="flex items-center text-gray-600 col-span-2">
                                <i class="fas fa-graduation-cap w-4 text-purple-500"></i>
                                <span class="ml-2">Bac+5 - Master en Informatique</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <?php foreach ($ComplexData as $offre): ?>
                    <div
                        class="bg-white rounded-xl shadow-lg hover:shadow-md transition-all duration-300 overflow-hidden group">
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        <?php echo $offre['post']; ?>
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                        <?php echo $offre['category_name']; ?>
                                    </span>
                                </div>

                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-1 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50">
                                        <a href="updateOffre.php?id=<?php echo $offre['id']; ?>"><i
                                                class="fas fa-edit"></i></a>
                                    </button>
                                    <button class="p-1 text-gray-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                        <a href="dashboard.php?id=<?php echo $offre['id']; ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </button>
                                </div>
                            </div>
                            <?php $tags = explode(',', $offre['tags']); ?>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($tags as $tag): ?>
                                    <span
                                        class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#<?php echo $tag; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                <?php echo $offre['description']; ?>
                            </p>


                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-map-marker-alt w-4 text-blue-500"></i>
                                    <span class="ml-2"><?php echo $offre['location']; ?>, Maroc</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <!-- <i class="fas fa-euro-sign w-4 text-green-500"></i> -->
                                    <span class="ml-2"><?php echo $offre['salary']; ?>DH</span>
                                </div>
                                <div class="flex items-center text-gray-600 col-span-2">
                                    <i class="fas fa-graduation-cap w-4 text-purple-500"></i>
                                    <span class="ml-2"><?php echo $offre['qualification']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
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