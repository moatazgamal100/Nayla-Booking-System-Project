<?php
namespace App\Services;
use App\Repositories\ReviewRepository;
use App\Http\Traits\ApiHandler;
use Tymon\JWTAuth\Facades\JWTAuth;


class ReviewService
{
    use ApiHandler;

    protected $reviewRepository;
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }
    public function getReviews(){
        $reviews= $this->reviewRepository->getReviews();
        if(!$reviews) {
            return $this->fail('No reviews found');
        }
        else{

            return $this->Success($reviews, 'Reviews fetched successfully');
        }
    }

    public function createReview(array $data){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $review= $this->reviewRepository->createReview($data);
            if(!$review) {
                return $this->fail('Failed to submit review');
            }
            else{
                return $this->Success($review, 'Review submitted successfully');
            }
        } catch (\Exception $e) {
            return $this->fail('Unauthorized');
        }

    }

    public function getReviewById($id){
        $reviews= $this->reviewRepository->getReviewById($id);
        $reviews->transform(function ($review) {
            $review->user->name = $review->user->fname . ' ' . $review->user->lname;
            return $review;
        });

            return $this->Success($reviews, 'Reviews fetched successfully');
    }
}
?>
