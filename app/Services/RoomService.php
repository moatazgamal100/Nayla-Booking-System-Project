<?php
namespace App\Services;
use App\Repositories\RoomRepository;
use App\Http\Traits\ApiHandler;

class RoomService
{
    use ApiHandler;

    protected $roomRepository;
    public function __construct(RoomRepository $roomRepository){
        $this->roomRepository=$roomRepository;
    }
    public function getRoom($roomid){
        $room= $this->roomRepository->getRoom($roomid);
        if(!$room){
            return $this->fail('Room not found');
        }
        else{

            return $this->success($room,'Room fetch success');
        }
    }
}
?>
