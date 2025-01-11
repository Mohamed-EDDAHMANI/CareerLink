<?php
session_start();


require_once '../../../vendor/autoload.php';

use App\Controllers\OffreController;
use App\Controllers\CandidatController;
use App\Controllers\auth\Auth;

$offreController = new OffreController();
$candidatController = new CandidatController();
$auth = new Auth();

$ComplexData = $offreController->getOffres();
if ($_SESSION) {
    echo 'helllooo';
    $id = $_SESSION['user']['id'];
    $counter = $numOfOffres = $candidatController->getNumOfOffres($id);
    // $offresPostuler = $candidatController->getOffresPostuler($id);
} else {
    $counter = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user'])) {
        header('Location: src\View\auth\login.php');
        exit();
    }
    $id = $_POST['id'];
    $candidatController->applyToOffre($id, $_SESSION['user']['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Find Your Next Opportunity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <a href="#"
                        class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        JobConnect
                    </a>

                </div>

                <!-- Search Bar - Show on larger screens -->
                <div class="hidden md:flex flex-1 mx-8">
                    <div class="relative w-full max-w-2xl">
                        <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="text" placeholder="Search jobs, companies, or keywords..."
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                    </div>
                </div>

                <!-- Auth Buttons -->

                <?php if (isset($_SESSION['user'])) {
                    echo '<div class="flex flex-col items-center space-x-4">';
                    echo '<h2 class="text-lg font-semibold ">Hello, ' . $_SESSION['user']['name'] . '</h2> ';
                    echo '<a href="../../Controllers/auth/logout.php"
                            class="px-6  text-blue-600 hover:text-blue-800 font-medium" >Logout</a>';
                    echo '</div>';
                } else {
                    echo '<div class="flex items-center space-x-4">';
                    echo '<a href="./src/View/auth/login.php"
                        class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium">Login</a>
                        <a href="#"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg shadow-blue-200">Sign
                        Up</a>';
                    echo '</div>';
                } ?>

            </div>
        </nav>
    </header>

    <!-- Main Content with Sidebar -->
    <div class="container mx-auto px-4 mt-24 mb-8 flex flex-col md:flex-row gap-6">
        <!-- Sidebar -->
        <aside class="md:w-80 bg-white rounded-xl shadow-sm p-6 h-fit sticky top-28">
            <div class="flex  justify-between ">
                <h2 class="text-lg font-semibold mb-6">Filters</h2>
                <span
                    class="flex justity-centre items-center px-4 bg-blue-500 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200">
                    <?php if ($counter): ?>
                        <?php echo '<span class="text-red-500 mr-2 text-bold px-3 text-lg rounded-full bg-blue-600">' . $counter . ' </span>'; ?>
                    <?php else: ?>
                        0
                    <?php endif; ?>
                    Postuls</span>
            </div>

            <!-- Job Type -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Job Type</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Full-time</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Part-time</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Contract</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Internship</span>
                    </label>
                </div>
            </div>

            <!-- Experience Level -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Experience Level</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Entry Level</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Mid Level</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Senior Level</span>
                    </label>
                </div>
            </div>

            <!-- Salary Range -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Salary Range</h3>
                <input type="range" min="0" max="200000"
                    class="w-full h-2 bg-blue-100 rounded-lg appearance-none cursor-pointer">
                <div class="flex justify-between mt-2">
                    <span class="text-sm text-gray-500">$0</span>
                    <span class="text-sm text-gray-500">$200k</span>
                </div>
            </div>

            <!-- Location Type -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Location Type</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Remote</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">On-site</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                        <span class="ml-2 text-gray-600">Hybrid</span>
                    </label>
                </div>
            </div>

            <button
                class="w-full py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg shadow-blue-200">
                Apply Filters
            </button>
        </aside>

        <!-- create secces message -->
        <?php if (isset($_SESSION['success']['message'])): ?>
            <span
                class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
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

        <!-- Main Content - Job Listings -->
        <main class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Latest Job Opportunities</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">Sort by:</span>
                    <select
                        class="px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500">
                        <option>Most Recent</option>
                        <option>Highest Paid</option>
                        <option>Most Relevant</option>
                    </select>
                </div>
            </div>

            <!-- Job Cards Container -->
            <div class="space-y-4 overflow-y-auto max-h-[calc(100vh-180px)]">
                <!-- Job Card Template (Improved) -->
                <?php if ($ComplexData): ?>
                    <?php foreach ($ComplexData as $offre): ?>
                        <article
                            class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow border border-gray-100">
                            <div class="flex items-start gap-4">
                                <!-- Company Logo -->
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-building text-2xl text-gray-400"></i>
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                                                <?php echo $offre['post'] ?>
                                            </h3>
                                            <p class="text-gray-600">TechCorp Inc.</p>
                                        </div>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-sm px-4 py-1 rounded-full font-medium"><?php echo $offre['category_name'] ?></span>
                                    </div>

                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        <?php echo $offre['description'] ?>
                                    </p>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <?php $tags = explode(',', $offre['tags']); ?>
                                        <?php foreach ($tags as $tag): ?>
                                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                                                #<?php echo $tag ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span><?php echo $offre['location'] ?>, Maroc</span>
                                            </div>
                                            <div class="flex items-center text-gray-500">
                                                <i class="fas fa-dollar-sign mr-2"></i>
                                                <span><?php echo $offre['salary'] ?>DH</span>
                                            </div>
                                        </div>
                                        <a class="apply px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200"
                                            <?php if (isset($_SESSION['user'])): ?>
                                                 onclick="apply(<?php echo $offre['id'] ?>)"
                                            <?php else: ?>
                                                href="../auth/login.php"
                                            <?php endif; ?>
                                            >Apply Now</a>

                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>


                <!-- Additional Job Cards (Duplicated for demonstration) -->
                <!-- Copy the article element above multiple times here -->

            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-blue-600 text-white p-2 rounded-lg">
                            <i class="fas fa-briefcase text-xl"></i>
                        </div>
                        <span class="text-xl font-bold">JobConnect</span>
                    </div>
                    <p class="text-gray-600 mb-4">Finding the right job opportunity has never been easier. Connect with
                        top companies and find your dream job today.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i
                                class="fab fa-linkedin text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i
                                class="fab fa-facebook text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Find Jobs</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Post a Job</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-envelope mr-2"></i>
                            contact@jobconnect.com
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-phone mr-2"></i>
                            (555) 123-4567
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            123 Business Ave, Suite 100
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 5000);
        }

        function apply(id) {
            // Create an AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Display the server response
                    // document.getElementById('response').textContent = xhr.responseText;
                } else {
                    console.error('An error occurred: ' + xhr.statusText);
                }
            };

            xhr.send('id=' + id);

        }

    </script>
</body>

</html>