<?php
$searchTerm = $_GET['term'];
require_once 'inc/tourlib.php';
$tourObj = new tourLibrary();
$autoSuggest = $tourObj->getAutoCompleteList(rawurlencode($searchTerm));
				
				//echo "<pre>";print_r($autoSuggest->object);exit();

//return json data
echo json_encode($autoSuggest->object);
?>