<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: src\View\auth\login.php');
    }

    require_once '../../vendor/autoload.php';

    use App\Controllers\OffreController;

    $offreController = new OffreController();
    $ComplexData = $offreController->getOffres();

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
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-md transition-all duration-300 overflow-hidden group">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    Chef de Projet Marketing Digital
                                </h3>
                                <span
                                    class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    Marketing
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

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#digital</span>
                            <span class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#seo</span>
                            <span
                                class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#socialmedia</span>
                        </div>

                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            Nous cherchons un Chef de Projet Marketing Digital pour piloter notre stratégie digitale.
                            Vous serez en charge des campagnes marketing.
                        </p>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt w-4 text-blue-500"></i>
                                <span class="ml-2">Lyon, France</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-euro-sign w-4 text-green-500"></i>
                                <span class="ml-2">40k - 50k</span>
                            </div>
                            <div class="flex items-center text-gray-600 col-span-2">
                                <i class="fas fa-graduation-cap w-4 text-purple-500"></i>
                                <span class="ml-2">Bac+5 - Marketing Digital</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for New/Edit Job -->
    <div id="jobModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Nouvelle Offre d'Emploi</h3>
                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Intitulé du poste</label>
                        <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                            <option>Développement</option>
                            <option>Marketing</option>
                            <option>Commerce</option>
                            <option>Design</option>
                            <option>Finance</option>
                            <option>Ressources Humaines</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tags (séparés par des espaces)</label>
                        <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                            placeholder="#javascript #react #nodejs">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Diplôme requis</label>
                        <select class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                            <option>Bac+2 - DUT/BTS</option>
                            <option>Bac+3 - Licence</option>
                            <option>Bac+5 - Master</option>
                            <option>Bac+8 - Doctorat</option>
                        </select>
                        <input type="text" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            placeholder="Spécialisation (ex: Informatique, Marketing...)">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description du poste</label>
                        <textarea class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" rows="4"
                            placeholder="Décrivez les responsabilités et les attentes du poste..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Salaire</label>
                        <div class="flex gap-2">
                            <input type="number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                                placeholder="Min">
                            <input type="number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm"
                                placeholder="Max">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lieu</label>
                        <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button"
                            class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Annuler</button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>