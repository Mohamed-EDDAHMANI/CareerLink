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
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Dashboard Recruteur</span>
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
            <div class="grid gap-4">
                <!-- Job Card 1 -->
                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="w-full">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-semibold">Développeur Full Stack</h3>
                                <div class="flex gap-2">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full mt-2">Développement</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#javascript</span>
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#react</span>
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#nodejs</span>
                            </div>
                            <div class="mt-3 text-gray-600">
                                <p><i class="fas fa-map-marker-alt mr-2"></i>Paris, France</p>
                                <p><i class="fas fa-euro-sign mr-2"></i>45k - 55k</p>
                                <p><i class="fas fa-graduation-cap mr-2"></i>Bac+5 - Master en Informatique</p>
                            </div>
                            <p class="mt-3 text-gray-700">
                                Nous recherchons un développeur Full Stack expérimenté pour rejoindre notre équipe technique. 
                                Vous serez responsable du développement et de la maintenance de nos applications web, 
                                en utilisant les dernières technologies.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="w-full">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-semibold">Chef de Projet Marketing Digital</h3>
                                <div class="flex gap-2">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full mt-2">Marketing</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#digital</span>
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#seo</span>
                                <span class="bg-gray-100 text-gray-800 text-sm px-2 py-1 rounded-full">#socialmedia</span>
                            </div>
                            <div class="mt-3 text-gray-600">
                                <p><i class="fas fa-map-marker-alt mr-2"></i>Lyon, France</p>
                                <p><i class="fas fa-euro-sign mr-2"></i>40k - 50k</p>
                                <p><i class="fas fa-graduation-cap mr-2"></i>Bac+5 - Master en Marketing Digital</p>
                            </div>
                            <p class="mt-3 text-gray-700">
                                Nous cherchons un Chef de Projet Marketing Digital pour piloter notre stratégie digitale.
                                Vous serez en charge des campagnes marketing, de l'optimisation SEO et de la gestion des réseaux sociaux.
                            </p>
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
                        <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" placeholder="#javascript #react #nodejs">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Diplôme requis</label>
                        <select class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                            <option>Bac+2 - DUT/BTS</option>
                            <option>Bac+3 - Licence</option>
                            <option>Bac+5 - Master</option>
                            <option>Bac+8 - Doctorat</option>
                        </select>
                        <input type="text" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm" placeholder="Spécialisation (ex: Informatique, Marketing...)">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description du poste</label>
                        <textarea class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" rows="4" placeholder="Décrivez les responsabilités et les attentes du poste..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Salaire</label>
                        <div class="flex gap-2">
                            <input type="number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" placeholder="Min">
                            <input type="number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" placeholder="Max">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lieu</label>
                        <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Annuler</button>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>