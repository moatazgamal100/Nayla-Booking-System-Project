<?php



namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReviewService;
use App\Http\Requests\ReviewRequest;

class ApiReviewController extends Controller
{

    protected $reviewService;

    public function __construct(ReviewService $reviewService){
        $this->reviewService = $reviewService;
    }


    public function index()
    {
        $result = $this->reviewService->getReviews();
        return $result;

    }


    public function store(ReviewRequest $request)
    {
        $data=$request->validated();

        // Get the authenticated user's ID


        $result = $this->reviewService->createReview($data);
        return $result;

    }


    public function getReviewsByHotelId($hotelId)
    {
        $result = $this->reviewService->getReviewById($hotelId);
        return $result;



    }


}

