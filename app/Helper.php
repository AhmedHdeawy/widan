<?php 

use App\Review;


/**
 * Get static Setting by it's key
 */
function getReviewByKey($key, $evaluation)
{
    $reviewEval =  Review::where('client_id', $key)->where('evaluation', $evaluation)->count();
    $allReviews =  Review::where('client_id', $key)->count();

    if ($allReviews != 0) {
        $percentage = ($reviewEval / $allReviews);
        # code...
    } else {
        $percentage = 0;
    }
    


    return $percentage * 100;
}


?>
