<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReadingBook;
use Auth;
use Redirect;
use Validator;


class BookController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function showAllBooks(){
        return view('parent.books.book');
    }

    public function addNewBook()
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|number',
            'cover' => 'image'
        ]);

        if ($validator->passes()){
            $image = $request->cover;
            $extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);

            $imageName = 'user-'.Auth::id().'-'.str_random(5).'.'.$extension;
            $image->move("img/BookCovers/", $imageName);
            $coverPath = 'img/BookCovers/'.$imageName;

            $book = new ReadingBook;
        	$book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
        	$book->numberOfPages = $request->numberOfPages;
        	$book->coverPath = $coverPath;
        	$book->addedBy_id = Auth::id();
            $book->save();
            
            return redirect('/ouders/boeken');
        }
        
    }

    public function editBook($readingBook_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|number'
        ]);

        if ($validator->passes()) {      

            $book = ReadingBook::find($readingBook_id);
            $book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
        	$book->numberOfPages = $request->numberOfPages;
            $book->save();
            
            return redirect('/');
        }
        
        return redirect('/');
    }

    public function deleteBook($readingBook_id){
        if ($this->isBookFromUser($readingBook_id)){
            $book = ReadingBook::find($readingBook_id);    
            $book->delete();
        }
        return redirect('/');
    }

    //function to check if Book is from logged in parent
    public function isBookFromUser($readingBook_id){
        $book = new ReadingBook;
        $booksOfUser = $book->getBookWithUserId(Auth::id());

        foreach ($booksOfUser as $key => $book) {
            if($book->readingBook_id == $readingBook_id){
                return True;
            }
        }
        return False;
    }

}
