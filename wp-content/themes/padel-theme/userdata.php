<?php
// Enqueue jQuery for AJAX
add_action('wp_enqueue_scripts', 'enqueue_jquery_for_ajax');
function enqueue_jquery_for_ajax() {
    wp_enqueue_script('jquery');
}

// Include custom AJAX functions
require_once('ajax-functions/user-data-function.php');
?>

<form id="search-user-form" class="flex items-center justify-center mt-4">
    <label for="user-id" class="mr-2">Enter User ID:</label>
    <input type="text" id="user-id" name="user_id" required class="border border-gray-300 rounded-md px-2 py-1">
    <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded-md">Search</button>
</form>

<div id="search-results" class="mt-4 font-bold text-center"></div>

<form id="update-user-form" class="flex items-center justify-center mt-4">
    <label for="user-id-update" class="mr-2">User ID:</label>
    <input type="text" id="user-id-update" name="user_id" required class="border border-gray-300 rounded-md px-2 py-1">
    <label for="wins" class="ml-2 mr-2">Wins:</label>
    <input type="number" id="wins" name="wins" class="border border-gray-300 rounded-md px-2 py-1">
    <label for="racket" class="ml-2 mr-2">Racket:</label>
    <input type="text" id="racket" name="racket" class="border border-gray-300 rounded-md px-2 py-1">
    <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded-md">Update</button>
</form>

<div id="update-results" class="mt-4 font-bold text-center"></div>
