<?php
/*
* Calculates average review
* $reviews - an array of numbers
*/
function calculateAverageReview($reviews) {
    $overallRating = 0;
    foreach($reviews as $review) { $overallRating += $review->Rating; }
    if($overallRating > 0) { $overallRating = $overallRating / count($reviews); }
    
    return ceil($overallRating);
}

?>