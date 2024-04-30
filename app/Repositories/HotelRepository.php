<?php
namespace App\Repositories;

use App\Models\Hotel;
use App\Models\HotelImage;

class HotelRepository
{
    public function getAllHotels()
    {
        return Hotel::with('images','rooms' ,'rooms.images')->get();
    }
    public function create(array $data)
    {
        return Hotel::create($data);
    }
    public function findById(string $id)
    {
        return Hotel::with('images', 'rooms.images')->find($id);
    }

    public function createImage(array $data)
    {
        return HotelImage::create($data);
    }
    public function update(array $data , string $id)
    {
        $hotel=$this->findById($id);
        $hotel->update($data);
        return $hotel;
    }
}
?>
