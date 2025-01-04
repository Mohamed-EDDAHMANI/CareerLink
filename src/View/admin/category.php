<div class="min-h-screen flex">
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top header -->
        <header class="bg-white shadow-sm flex items-center justify-between p-4">
            <button class="text-gray-500 md:hidden"
                onclick="document.querySelector('aside').classList.toggle('-translate-x-full')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center space-x-4">
                <button onclick="showModal('addCategoryModal')"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Add New Category
                </button>
            </div>
        </header>

        <!-- create error message -->
        <?php if (isset($_SESSION['error']['message'])): ?>
            <span
                class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
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

        <!-- Main content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Category Management</h2>

                        <!-- Category List -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Category Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jobs
                                            Count</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if ($catigories): ?>
                                        <?php foreach ($catigories as $category): ?>
                                            <tr>
                                                <?php echo '<td class="px-6 py-4 whitespace-nowrap">' . $category['category_name'] . '</td>' ?>
                                                <td class="px-6 py-4">Tech and IT related jobs</td>
                                                <td class="px-6 py-4">145</td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="dashboard.php?id=<?php echo $category['id']; ?>" onclick="showModal('editCategoryModal')"
                                                        class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                                                    <button onclick="showModal('deleteCategoryModal')"
                                                        class="text-red-600 hover:text-red-900">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">Marketing</td>
                                        <td class="px-6 py-4">Digital marketing positions</td>
                                        <td class="px-6 py-4">89</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="showModal('editCategoryModal')"
                                                class="text-blue-600 hover:text-blue-900 mr-4">Edit</button>
                                            <button onclick="showModal('deleteCategoryModal')"
                                                class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
        </svg>
        <p><?php echo $_SESSION['success']['message']; ?></p>
        <?php unset($_SESSION['success']['message']); ?>
    </span>
<?php endif; ?>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Category</h3>
            <form class="space-y-4" action="" method="POST">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="category_name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter category name">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideModal('addCategoryModal')"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add
                        Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Category</h3>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category Name</label>
                    <?php echo '<input type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        value="' . $categorie['category_name'] .'">' ?>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideModal('editCategoryModal')"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div id="deleteCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Category</h3>
            <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete this category? This action cannot be
                undone.</p>
            <div class="flex justify-center gap-3">
                <button onclick="hideModal('deleteCategoryModal')"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
</div>