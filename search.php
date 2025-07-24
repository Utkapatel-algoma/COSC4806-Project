<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReviewBox - Search Movies</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font added/
    </style>
</head>
<body class="bg-gray-900 text-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-2xl bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
        <h1 class="text-4xl font-extrabold text-blue-400 mb-6 text-center">Search for a Movie</h1>

        <form action="search.php" method="GET" class="flex flex-col sm:flex-row gap-4">
            <input
                type="text"
                name="title"
                placeholder="e.g., Inception, The Matrix"
                class="flex-grow p-3 rounded-md bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400"
                required
            />
            <button
                type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Search
            </button>
        </form>

        <?php
        // PHP code to handle search (will be expanded in later commits)
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $movieTitle = htmlspecialchars($_GET['title']);
            echo "<p class='text-gray-400 mt-6 text-center'>Searching for: <span class='font-semibold text-blue-300'>{$movieTitle}</span>...</p>";
            // Movie details will be displayed here in future commits
        }
        ?>

        <div class="mt-8 text-center">
            <a href="index.php" class="text-blue-400 hover:text-blue-300 transition duration-300">← Back to Home</a>
        </div>
    </div>
</body>
</html>