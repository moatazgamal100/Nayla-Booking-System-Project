<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Http\Requests\StoreApiHotelRequest;
use App\Http\Requests\UpdateApiHotelRequest;
use App\Services\HotelService;

use Illuminate\Http\Request;

class ApiHotelController extends Controller
{

    protected $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }


    public function index()
    {
        $result = $this->hotelService->getAllHotels();
        return $result;

    }


    public function store(StoreApiHotelRequest $request)
    {
        $data = $request->validated();

        $images = $request->file('image');
        $result = $this->hotelService->createHotel($data, $images);
        return $result;

    }


    public function show(string $id)
    {
        $result=$this->hotelService->getHotel($id);
        return $result;


    }

    public function update(UpdateApiHotelRequest $request, string $id)
    {
        $data=$request->validated();

        $result=$this->hotelService->updateHotel($data,$id);
        return $result;

    }

}
