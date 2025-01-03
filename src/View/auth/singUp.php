<?php 

session_start();

require '../../../vendor/autoload.php';

use App\Controllers\auth\Auth;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $auth = new Auth();

    switch ($role) {
        case 'Administrateur':
            $auth->signup($name, $email, $password, $role);
            break;

        case 'Candidat':
            $skills = $_POST['skills'];
            $deplome = $_POST['deplome'];
            $auth->signup($name, $email, $password, $role, $conn, $skills, $deplome);
            break;

        case 'Recruteur':
            $companyName = $_POST['companyName'];
            $auth->signup($name, $email, $password, $role, $conn, $companyName);

            break;

        default:
            # code...
            break;
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - JobConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .radio-checked {
            box-shadow: 0 0 0 2px #2563eb;
            border-color: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <a href="#" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        JobConnect
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-8 mt-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Create Your Account</h1>
                    <p class="text-gray-600">Join thousands of professionals finding their next opportunity</p>
                </div>

                <!-- Sign Up Form -->
                <form class="space-y-6" action="../../Controllers/auth/singUpController.php" method="POST">
                    <!-- Account Type Selection -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <label id="jobSeekerLabel" class="relative border rounded-xl p-4 cursor-pointer radio-checked">
                            <input type="radio" name="role" value="Candidat" class="absolute inset-0 opacity-0" checked
                                onchange="toggleAccountType('jobSeeker')">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Job Seeker</h3>
                                    <p class="text-sm text-gray-500">I want to find a job</p>
                                </div>
                            </div>
                        </label>

                        <label id="recruiterLabel" class="relative border rounded-xl p-4 cursor-pointer">
                            <input type="radio" name="role" value="Recruteur" class="absolute inset-0 opacity-0"
                                onchange="toggleAccountType('recruiter')">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="fas fa-building text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Recruiter</h3>
                                    <p class="text-sm text-gray-500">I want to hire talent</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Enter your full name">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Enter your email address">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Create a password">
                            <button type="button" class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Job Seeker Fields -->
                    <div id="jobSeekerFields">
                        <!-- Skills Input -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                            <div class="relative">
                                <textarea name="skills"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter your skills (e.g., JavaScript, Python, Project Management)"
                                    rows="3"></textarea>
                                <p class="text-sm text-gray-500 mt-1">Separate skills with commas</p>
                            </div>
                        </div>

                        <!-- Diploma/Education -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Diploma/Education</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" name="deplome">
                                <option value="">Select your highest education level</option>
                                <option value="high_school">High School</option>
                                <option value="associate">Associate Degree</option>
                                <option value="bachelor">Bachelor's Degree</option>
                                <option value="master">Master's Degree</option>
                                <option value="phd">Ph.D</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Recruiter Fields -->
                    <div id="recruiterFields" class="hidden">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                            <input type="text" name="companyName" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Enter your company name">
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg shadow-blue-200">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-gray-600 mt-6">
                        Already have an account? 
                        <a href="login.php" class="text-blue-600 hover:underline">Log in</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <p class="text-gray-600">&copy; 2025 JobConnect. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Terms of Service</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleAccountType(type) {
            const jobSeekerFields = document.getElementById('jobSeekerFields');
            const recruiterFields = document.getElementById('recruiterFields');
            const jobSeekerLabel = document.getElementById('jobSeekerLabel');
            const recruiterLabel = document.getElementById('recruiterLabel');

            if (type === 'jobSeeker') {
                jobSeekerFields.classList.remove('hidden');
                recruiterFields.classList.add('hidden');
                jobSeekerLabel.classList.add('radio-checked');
                recruiterLabel.classList.remove('radio-checked');
            } else {
                jobSeekerFields.classList.add('hidden');
                recruiterFields.classList.remove('hidden');
                jobSeekerLabel.classList.remove('radio-checked');
                recruiterLabel.classList.add('radio-checked');
            }
        }
    </script>
</body>
</html>
