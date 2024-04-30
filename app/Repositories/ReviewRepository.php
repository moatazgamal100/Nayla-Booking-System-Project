<?php
namespace App\Repositories;
use App\Models\Review;
class ReviewRepository
{
    public function getReviews(){
        return Review::with('user')->get();
    }
    public function createReview(array $data){
        return Review::create($data);
    }
    public function getReviewById($hotelId){
        return Review::where('hotel_id', $hotelId)->with('user')->get();
    }
}
?>
