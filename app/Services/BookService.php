<?php
namespace App\Services;
use App\Repositories\BookRepository;
use App\Http\Traits\ApiHandler;
class BookService
{
    use ApiHandler;
    protected $bookRepository;
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function storeBook(array $data)
    {
        return $this->bookRepository->storeBook($data);
    }
    public function getBooks()
    {
        $books= $this->bookRepository->getBooks();
        if(!$books){
            return $this->notFound("No data found");
        }
        else
        {
            foreach ($books as $book) {
                $book->username = $book->user->name;
                $book->hotel_name = $book->hotel->name;
                $book->room_type = $book->room->type;
            }
            return $this->success($books,"Data fetched successfully");
        }
    }
}
?>
