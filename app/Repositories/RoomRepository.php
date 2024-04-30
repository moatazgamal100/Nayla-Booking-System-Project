<?php
namespace App\Repositories;
use App\Models\Room;
class RoomRepository
{
    public function getRoom(String $roomid){
        return Room::with('images')->find($roomid);
    }
}
?>
