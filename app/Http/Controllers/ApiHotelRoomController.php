<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use App\Services\RoomService;

class ApiHotelRoomController extends Controller
{
    protected $roomService;
    public function __construct(RoomService $roomService){
        $this->roomService=$roomService;
    }

    public function show($roomId)
    {
        $result = $this->roomService->getRoom($roomId);
        return $result;

    }
        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'price' => 'required|numeric',
                'view' => 'required|string',
                'type' => 'required|string',
                'description' => 'required|string',
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'hotel_id' => 'required',
            ]);

            $room=Room::create($data);

            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();
                $image->move('storage/room_images', $filename);
                RoomImage::create([
                    'image' => $filename,
                    'room_id' => $room->id,
                ]);
            }

            return response()->json(['message' => 'Room added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Exception occurred: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

