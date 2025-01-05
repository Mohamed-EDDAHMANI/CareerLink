<?php

session_start();

require '../../../vendor/autoload.php';

use App\Controllers\CategorieController;

$catigorieInstent = new CategorieController();

$catigories = $catigorieInstent->getCatigories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    if (isset($_POST['id'])) {
        $category_id = $_POST['id'];
    } else {
        $category_id = null;
    }
    $catigorieInstent->createCategorie($category_name, $category_id);
    $catigories = $catigorieInstent->getCatigories();
}
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $categorie = $catigorieInstent->deleteCategoryById($category_id);
    $catigories = $catigorieInstent->getCatigories();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CareerLink Admin Management</title>
</head>

<body class="bg-gray-100 h-vh overflow-hidden">
    <div class="min-h-screen flex h-vh">
        <!-- Sidebar -->
        <aside
            class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            <div class="flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold">CareerLink</span>
            </div>

            <nav class="space-y-2" id="category">
                <a href="" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700">
                    Dashboard
                </a>
                <a href="" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Categories
                </a>
                <a href="" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Tags
                </a>
                <a href="" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Job Moderation
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen ">
            <!-- Main content -->
            <main class="flex-1 overflow-y-scroll bg-gray-100">
                <div class="home hidden">
                    <?php include 'home.php'; ?>
                </div>
                <div class="category">
                    <?php include 'category.php'; ?>
                </div>
                <div class="tags hidden">
                    <?php include 'category.php'; ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 3000);
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
             
    </script>
</body>

</html>