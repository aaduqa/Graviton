<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];

    // Function to search for a full name within specific containers in an HTML file
    function search_in_file($file_path, $search_query) {
        $results = [];
        $dom = new DOMDocument();

        // Load HTML file
        @$dom->loadHTMLFile($file_path);
        
        // Use XPath to search for the specific containers
        $xpath = new DOMXPath($dom);
        $containers = $xpath->query("//div[@class='container']"); // Adjust the XPath query to match your specific container
        
        foreach ($containers as $container) {
            $content = $container->textContent;
            // Use regular expression to match the full name
            if (preg_match('/\b' . preg_quote($search_query, '/') . '\b/', $content)) {
                $results[] = trim($content);
            }
        }
        
        return $results;
    }

    // Define file paths
    $index_file_path = 'workshopindex.php'; // Adjust path if necessary
    $projectindex_file_path = 'projectindex.php'; // Adjust path if necessary

    // Search in index.php
    $index_results = search_in_file($index_file_path, $search_query);

    // Search in projectindex.php
    $projectindex_results = search_in_file($projectindex_file_path, $search_query);

    // Prepare HTML output
    $output = "<h2>Search Results for '$search_query'</h2>";
    if (!empty($index_results)) {
        $output .= "<h3>Results in index.php:</h3>";
        $output .= "<ul>";
        foreach ($index_results as $result) {
            $output .= "<li>" . htmlspecialchars($result) . "</li>";
        }
        $output .= "</ul>";
    } else {
        $output .= "<p>No results found in index.php</p>";
    }

    if (!empty($projectindex_results)) {
        $output .= "<h3>Results in projectindex.php:</h3>";
        $output .= "<ul>";
        foreach ($projectindex_results as $result) {
            $output .= "<li>" . htmlspecialchars($result) . "</li>";
        }
        $output .= "</ul>";
    } else {
        $output .= "<p>No results found in projectindex.php</p>";
    }

    echo $output;
}
?>
