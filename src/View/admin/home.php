
<?php

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
                <a href="/" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700 ">
                    Dashboard
                </a>
                <a href="category.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Categories
                </a>
                <a href="tag.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
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
                <div class="container mx-auto px-4 py-6">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Categories</h3>
                            <p class="text-3xl font-bold">12</p>
                            <div class="mt-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Categories →</button>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Active Tags</h3>
                            <p class="text-3xl font-bold">45</p>
                            <div class="mt-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Tags →</button>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Pending Moderation</h3>
                            <p class="text-3xl font-bold">7</p>
                            <div class="mt-2">
                                <button class="text-red-600 hover:text-red-800 text-sm">Review Jobs →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Management -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Category Management</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Category
                                                Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Job Count
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4">Technology</td>
                                            <td class="px-6 py-4">145</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4">Marketing</td>
                                            <td class="px-6 py-4">89</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tag Management -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Tag Management</h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                                    <span>PHP</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                                    <span>Marketing Digital</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                                    <span>Gestion de Projet</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Moderation -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Jobs Pending Moderation</h2>
                            <div class="space-y-4">
                                <div class="border rounded p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium">Senior Developer</h3>
                                            <p class="text-sm text-gray-500">Posted by: Tech Corp</p>
                                            <div class="mt-2 flex gap-2">
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">PHP</span>
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">JavaScript</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <button
                                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Approve</button>
                                            <button
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Archive</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Charts -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Jobs per Category</h2>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Most Active Recruiters</h2>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>


      

    </script>
</body>

</html>