<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
class ApiHotelDescController extends Controller
{
    protected $hotelService;
    public function __construct(HotelService $hotelService){
        $this->hotelService=$hotelService;
    }
    public function show($id)
    {
        $result = $this->hotelService->getHotel($id);
        return $result;

    }
}

