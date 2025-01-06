<?php

session_start();

require '../../../vendor/autoload.php';

use App\Controllers\TagController;

$tagInstent = new TagController();

$tags = $tagInstent->getTags();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tag_name = $_POST['tag_name'];
    if (isset($_POST['id'])) {
        $tag_id = $_POST['id'];
    } else {
        $tag_id = null;
    }
    $tagInstent->createTag($tag_name, $tag_id);
    $tags = $tagInstent->getTags();
}
if (isset($_GET['id'])) {
    $tag_id = $_GET['id'];
    $tagInstent->deleteTagById($tag_id);
    $tags = $tagInstent->getTags();
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
                <a href="home.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="category.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Categories
                </a>
                <a href="tag.php" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700">
                    Tags
                </a>
                <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Job Moderation
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen ">
            <!-- Main content -->
            <main class="flex-1 overflow-y-scroll bg-gray-100">
                <div class="min-h-screen flex">
                    <!-- Main Content -->
                    <div class="flex-1 flex flex-col overflow-hidden">
                        <!-- Top header -->
                        <header class="bg-white shadow-sm flex items-center justify-between p-4">
                            <button class="text-gray-500 md:hidden"
                                onclick="document.querySelector('aside').classList.toggle('-translate-x-full')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <div class="flex items-center space-x-4">
                                <button onclick="showModal('addCategoryModal')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Add New Tag
                                </button>
                            </div>
                        </header>

                        <!-- create error message -->
                        <?php if (isset($_SESSION['error']['message'])): ?>
                            <span
                                class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
                                <!-- Optional: Add an error icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p><?php echo $_SESSION['error']['message']; ?></p>
                                <?php unset($_SESSION['error']['message']); ?>
                            </span>
                        <?php endif; ?>

                        <!-- Main content -->
                        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div class="container mx-auto px-4 py-8">
                                <div class="bg-white rounded-lg shadow">
                                    <div class="p-6">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tag Management</h2>

                                        <!-- Category List -->
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            ID</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Tag Name</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Jobs
                                                            Count</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Status</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php if ($tags): ?>
                                                        <?php foreach ($tags as $tag): ?>
                                                            <form action="" method="POST">
                                                                <tr>
                                                                    <?php echo '<td class="px-6 py-4 whitespace-nowrap"><input class=" whitespace-nowrap" name="id" value="' . $tag['id'] . '" readonly></td>' ?>
                                                                    <?php echo '<td class="px-6 py-4 whitespace-nowrap"><input class=" whitespace-nowrap" name="tag_name" value="' . $tag['tag_name'] . '"></td>' ?>
                                                                    <td class="px-6 py-4">145</td>
                                                                    <td class="px-6 py-4">
                                                                        <span
                                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                            Active
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                        <button type="submit"
                                                                            onclick="showModal('editCategoryModal')"
                                                                            class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                                                                        <a href="tag.php?id=<?php echo $tag['id']; ?>"
                                                                            class="text-red-600 hover:text-red-900">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>


                <!-- create secces message -->
                <?php if (isset($_SESSION['success']['message'])): ?>
                    <span
                        class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
                        <!-- Optional: Add an error icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <p><?php echo $_SESSION['success']['message']; ?></p>
                        <?php unset($_SESSION['success']['message']); ?>
                    </span>
                <?php endif; ?>

                <!-- Add Category Modal -->
                <div id="addCategoryModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Tag</h3>
                            <form class="space-y-4" action="" method="POST">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tag Name</label>
                                    <input type="text" name="tag_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Enter category name">
                                </div>
                                <div class="flex justify-end gap-3">
                                    <button type="button" onclick="hideModal('addCategoryModal')"
                                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add
                                        Tag</button>
                                </div>
                            </form>
                        </div>
                    </div>
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