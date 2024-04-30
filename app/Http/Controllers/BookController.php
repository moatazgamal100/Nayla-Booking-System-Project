<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Room;
use App\Models\Hotel;
use App\Http\Requests\BookRequest;
use Illuminate\support\facades\DB;
use App\Http\traits\ApiHandler;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    use ApiHandler;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //load the related data from the User, Hotel, and Room models
        $result=$this->bookService->getBooks();

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BookRequest $request)
    {
        $data = $request->validated();
        $result=$this->bookService->storeBook($data);
        return $result;
    }

}
