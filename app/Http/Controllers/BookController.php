<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\ReadingBook;
use App\ChildrenReadingBook;
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
        $book = new ReadingBook;
        $booksOfUser = $book->getBookWithUserId(Auth::id());        
        return view('parent.books.book',
        [
            'booksOfUser' => $booksOfUser,
        ]);
    }

    public function addNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|numeric',
            'bookCover' => 'image'
        ]);

        if ($validator->passes()){
           
            $book = new ReadingBook;
        	$book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
        	$book->numberOfPages = $request->numberOfPages;
            $book->coverPath = "no cover";
        	$book->addedBy_id = Auth::id();
            $book->save();
            $book_id = $book->readingBook_id;

            $file = $request->bookCover;

            if($file){
                $img = Image::make($file);
                $img = $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $extension = pathinfo(storage_path().$file->getClientOriginalName(), PATHINFO_EXTENSION);
                $img = $img->stream();               
                $filename = 'public/books/' . $book_id . '.' .$extension;
                Storage::disk('local')->put($filename, $img);
                $book->coverPath = Storage::url($filename);
                $book->save();
                
            }
            
            return redirect('/ouders/boeken');
        }
        else{
            return Redirect::back()->withErrors($validator);
        }
        
    }
    
    public function editBook($readingBook_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|numeric',
            'bookCover' => 'image'
        ]);

        if ($validator->passes()) {      
            $book = ReadingBook::find($readingBook_id);
            $file = $request->bookCover;
            
            if($file){
                $img = Image::make($file);
                $img = $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            
                $extension = pathinfo(storage_path().$file->getClientOriginalName(), PATHINFO_EXTENSION);
                $img = $img->stream();               
                $filename = 'public/books/' . $book->readingBook_id . '.' .$extension;
                Storage::disk('local')->put($filename, $img);
                $book->coverPath =  Storage::url($filename);
            }

            
            $book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
            $book->numberOfPages = $request->numberOfPages;            
            $book->save();
            
            return redirect('/ouders/boeken');
        }
        
        return redirect('/');
    }

    public function deleteBook($readingBook_id){
        if ($this->isBookFromUser($readingBook_id)){
            $book = ReadingBook::find($readingBook_id);    
            $book->delete();
        }
        return redirect('/ouders/boeken/');
    }    

    public function linkReadingBookToChild(Request $request, $child_id){
        $validator = Validator::make($request->all(), [
            'readingBook_id' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            if ($this->isBookFromUser($readingBook_id)){
                $childrenReadinBook = new ReadingBook;
                $childrenReadinBook->child_id = $child_id;
                $childrenReadinBook->readingBook_id = $request->readingBook_id;
                $childrenReadingBook->lastPageRead = 0;
                $childrenReadinBook->save();

                return Redirect::back();
            }
            return redirect('/');
        }
        else{
            return Redirect::back();
        }
        
    }

    public function removeLinkBetweenReadingBookAndChild(Request $request, $child_id){
        $validator = Validator::make($request->all(), [
            'readingBook_id' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $readingBook_id = $request->readingBook_id;

            if ($this->isBookFromUser($readingBook_id)){
                $ChildrenReadingBookLink = App\ChildrenReadingBook::where('readingBook_id', $readingBook_id)
                    ->where('child_id', $child_id)
                    ->delete();

                return Redirect::back();
            }
            return redirect('/');
        }
        else{
            return Redirect::back();
        }
    }

    public function changeLastPageOfReadingBook(Request $request){
        $validator = Validator::make($request->all(), [
            'readingBook_id' => 'required|numeric',
            'child_id' => 'required|numeric',
            'newLastPageRead' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $readingBook_id = $request->readingBook_id;
            $child_id = $request->child_id;

            if ($this->isBookFromUser($readingBook_id)){
                $ChildrenReadingBookLink = App\ChildrenReadingBook::where('readingBook_id', $readingBook_id)
                    ->where('child_id', $child_id);
                $ChildrenReadingBookLink->lastPageRead = $request->lastPageRead;
                $ChildrenReadinBookLink->save();
                return Redirect::back();
            }
            return redirect('/');
        }
        return Redirect::back()->withErrors($validator);
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
