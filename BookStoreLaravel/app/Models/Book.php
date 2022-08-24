<?php

namespace App\Models;

use App\Exceptions\BookStoreException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class Book extends Model
{
    protected $fillable = [
        'name',
        'description',
        'author',
        'image',
        'Price',
        'quantity',

    ];

    public function adminOrUserVerification($currentUserId)
    {
        $adminId = User::select('id')->where([['role', '=', 'admin'], ['id', '=', $currentUserId]])->get();
        return $adminId;
    }
    public function saveBookDetails($request, $currentUser)
    {
        $book = new Book();
        //$path = Storage::disk('s3')->put('images', $request->image);
        //$url = env('AWS_URL') . $path;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/books', $fileName);
            $book->image = $fileName;
        }
        $book->name = $request->input('name');
        $book->description = $request->input('description');
        $book->author = $request->input('author');
        $book->image = $request->input('image');
        //$book->image = $url;
        $book->Price = $request->input('Price');
        $book->quantity = $request->input('quantity');
        $book->user_id = $currentUser->id;
        $book->save();

        return $book;
    }

    public function findingBook($bookId)
    {
        $book = Book::where('id', $bookId)->first();
        return $book;
    }


    public static function updateBook($request, $book)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/books', $fileName);
            $book->image = $fileName;
        }
        $book->name = $request->input('name');
        $book->description = $request->input('description');
        $book->author = $request->input('author');
        // $book->image = $request->input('image');
        $book->Price = $request->input('Price');
        $book->save();

        return $book;
    }
}


