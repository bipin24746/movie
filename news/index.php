<?php include('header.php'); ?>

<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header("");
}
?>

<div class="dashboard-container max-w-5xl mx-auto">
    <div class="horizontal-menu flex justify-between items-center mb-8">
        <a href="dash.php" id="now-showing-link" class="text-gray-700 font-bold">Now Showing</a>
        <div class="search flex">
            <input type="text" id="search-input" name="search" placeholder="Search Movies" class="px-2 py-1 border border-gray-300 rounded">
            <button type="button" id="search-button" class="px-2 py-1 bg-green-500 text-white rounded cursor-pointer ml-2">Search</button>
        </div>
    </div>
    <h2 class="text-center font-semibold">Now Showing</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $dbname = "moviebooking";
    $conn = new mysqli($servername, $username, "", $dbname);
    if ($conn->connect_error) {
        die("Connection failed " . $conn->connect_error);
    }

    $sql = "SELECT * FROM movie";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $mid = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $time = $row['time'];
            $image = $row['image'];

            echo "
            <div class='movies-container w-1/4 flex'>
                <div class='movie-card border-2 border-gray-300 p-4 w-full m-6'>
                    <img src='../../images/$image' alt='Movie Poster' class='h-48 w-full object-cover'>
                    <div class='movie-details mt-4'>
                        <h5 class='movie-name font-bold mb-2'>$name</h5>
                        <p class='movie-description mb-4'>$description</p>
                        <p class='movie-price mb-4'>Price: $price</p>
                        <p class='movie-price mb-4'>Show Time: $time</p>
                        <form action='test.php' method='post'>
                            <input type='hidden' name='time' value='$time'>
                            <input type='hidden' name='mid' value='$mid'>
                            <input type='hidden' name='mname' value='$name'>
                            <input type='submit' name='book_now' value='Book Now' class='book bg-green-500'>
                        </form>
                    </div>
                </div>
            </div>";
        }
    }
    ?>
</div>
