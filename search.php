<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReviewBox - Search Movies</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font */
        body {
            font-family: 'Inter', sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
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
        // Checked: If movie title provided
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $movieTitle = htmlspecialchars($_GET['title']);
            // Added: OMDB API Key
            $omdbApiKey = '484f806d'; // Your OMDB API Key

            // Updated: API URL construction
            $url = "http://www.omdbapi.com/?t=" . urlencode($movieTitle) . "&apikey=" . $omdbApiKey;

            // Fetched: Data from OMDB
            $response = @file_get_contents($url); // Suppress warnings
            $movieData = json_decode($response, true); // Decoded: JSON response

            // Checked: If movie found
            if ($movieData && $movieData['Response'] == 'True') {
                // Added: Movie details display
                echo "<div class='mt-8 p-6 bg-gray-700 rounded-lg shadow-inner'>";
                echo "<h2 class='text-3xl font-bold text-blue-300 mb-4'>" . htmlspecialchars($movieData['Title']) . " (" . htmlspecialchars($movieData['Year']) . ")</h2>";
                echo "<div class='flex flex-col md:flex-row gap-6'>";
                echo "<div class='md:w-1/3 flex-shrink-0'>";
                // Added: Poster with fallback
                $poster = ($movieData['Poster'] !== 'N/A') ? htmlspecialchars($movieData['Poster']) : "https://placehold.co/300x450/333/fff?text=No+Poster";
                echo "<img src='{$poster}' alt='" . htmlspecialchars($movieData['Title']) . " Poster' class='w-full h-auto rounded-lg shadow-md object-cover'>";
                echo "</div>";
                echo "<div class='md:w-2/3'>";
                echo "<p class='text-gray-300 mb-2'><strong class='text-blue-200'>Genre:</strong> " . htmlspecialchars($movieData['Genre']) . "</p>";
                echo "<p class='text-gray-300 mb-2'><strong class='text-blue-200'>Director:</strong> " . htmlspecialchars($movieData['Director']) . "</p>";
                echo "<p class='text-gray-300 mb-2'><strong class='text-blue-200'>Actors:</strong> " . htmlspecialchars($movieData['Actors']) . "</p>";
                echo "<p class='text-gray-300 mb-2'><strong class='text-blue-200'>Plot:</strong> " . htmlspecialchars($movieData['Plot']) . "</p>";
                echo "<p class='text-gray-300 mb-2'><strong class='text-blue-200'>IMDB Rating:</strong> " . htmlspecialchars($movieData['imdbRating']) . " (" . htmlspecialchars($movieData['imdbVotes']) . " votes)</p>";

                // Added: YouTube Trailer Section
                $trailerSearchQuery = urlencode($movieData['Title'] . " " . $movieData['Year'] . " official trailer");
                $youtubeEmbedUrl = "https://www.youtube.com/embed?listType=search&list=" . $trailerSearchQuery;

                echo "<div class='mt-6 p-4 bg-gray-800 rounded-md'>";
                echo "<h3 class='text-xl font-semibold text-gray-200 mb-3'>Movie Trailer</h3>";
                echo "<div class='relative' style='padding-bottom: 56.25%; height: 0; overflow: hidden;'>"; // Aspect ratio container
                echo "<iframe
                        src='{$youtubeEmbedUrl}'
                        frameborder='0'
                        allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                        allowfullscreen
                        class='absolute top-0 left-0 w-full h-full rounded-md'
                    ></iframe>";
                echo "</div>"; // Closed: relative
                echo "<p class='text-gray-400 text-sm mt-2 text-center'>Note: Trailer search is automatic and may not always show the exact official trailer.</p>";
                echo "</div>"; // Closed: trailer section

                echo "</div>"; // Closed: md:w-2/3
                echo "</div>"; // Closed: flex
                echo "</div>"; // Closed: movie details container
            } else {
                // Updated: Error message
                echo "<p class='text-red-400 mt-6 text-center'>" . htmlspecialchars($movieData['Error'] ?? 'Movie not found or an error occurred.') . "</p>";
            }
        }
        ?>

        <div class="mt-8 text-center">
            <a href="index.php" class="text-blue-400 hover:text-blue-300 transition duration-300">← Back to Home</a>
        </div>
    </div>
</body>
</html>