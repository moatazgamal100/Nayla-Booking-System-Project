<?php
namespace App\Repositories;
use App\Models\Book;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ApiHandler;
class BookRepository
{
    use ApiHandler;
    public function storeBook(array $data){
        DB::beginTransaction();
        try{
            $book=Book::create($data);
            Room::find($data['room_id'])->update(['status' => 'booked']);
            DB::commit();
            return $this->Success('Booked successfully', $book);
        }
        catch (\Exception $e){
            DB::rollBack();
            return $this->serverError($e->getMessage());
        }
    }
    public function getBooks()
    {
        return Book::with(['user', 'hotel', 'room'])->get();
    }
}
?>
