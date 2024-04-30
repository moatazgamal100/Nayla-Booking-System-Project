<?php
namespace App\Services;

use App\Repositories\HotelRepository;
use App\Http\Resources\HotelResource;
use Illuminate\Support\Facades\DB;

use App\Http\Traits\ApiHandler;


class HotelService
{

    use ApiHandler;

    protected $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function getAllHotels()
    {
        $hotels = $this->hotelRepository->getAllHotels();
        if(count($hotels) == 0){
            return $this->fail('No hotels found');
        }
        else{
            return HotelResource::collection($hotels);
        }
    }
    public function getHotel(string $id)
    {
        $hotel = $this->hotelRepository->findById($id);
        if(!$hotel){
            return $this->fail('Hotel not found');
        }
        else{
            return new HotelResource($hotel);
        }
    }
    public function createHotel(array $data, array $images)
    {
        DB::beginTransaction();
        try {
            $hotel = $this->hotelRepository->create($data);

        foreach ($images as $image) {
            $filename = $image->getClientOriginalName();
            $image->move('images', $filename);
            $this->hotelRepository->createImage([
                'image' => $filename,
                'hotel_id' => $hotel->id,
            ]);
        }
        DB::commit();
        return $this->success($hotel,'Hotel created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->fail($th->getMessage());
        }
    }


    public function updateHotel(array $data, string $id)
    {
        $hotel = $this->hotelRepository->update($data,$id);
        if($hotel){
            return $this->Success($hotel,'Hotel updated successfully');
        }
        else{
            return $this->fail('Failed to update hotel');}

    }
}
?>
