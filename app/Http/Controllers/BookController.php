<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    //temporary function
    public function openNewBook()
    {
        return view('newBook');
    }

    public function addNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|numeric',
            //'cover' => 'image'
        ]);

        if ($validator->passes()){
            /* $image = $request->cover;
            $extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);

            $imageName = 'user-'.Auth::id().'-'.str_random(5).'.'.$extension;
            $image->move("img/BookCovers/", $imageName);
            $coverPath = 'img/BookCovers/'.$imageName; */

            $book = new ReadingBook;
        	$book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
        	$book->numberOfPages = $request->numberOfPages;
            //$book->coverPath = $coverPath;
            $book->coverPath = "temporaryPath";
        	$book->addedBy_id = Auth::id();
            $book->save();
            
            return redirect('/ouders/boeken');
        }
        else{
            return Redirect::back()->withErrors($validator);
        }
        
    }

    //temporary function
    public function openEditBook($readingBook_id)    
    {
        if ($this->isBookFromUser($readingBook_id)){
            $book = ReadingBook::find($readingBook_id);
            return view('editBook',[
                'book' => $book
                ]);
        }
        return redirect('/');
    }

    //Function to give Book information in jsonfile
    public function getBookData($readingBook_id)    
    {
        //if ($this->isBookFromUser($readingBook_id)){
            $book = ReadingBook::find($readingBook_id);
            return response()->json($book);
        /* }
        else{
            return "Book does not belong to user";
        }   */      
    }

    public function editBook($readingBook_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string|max:255',
            'numberOfPages' => 'required|numeric'
        ]);

        if ($validator->passes()) {      

            $book = ReadingBook::find($readingBook_id);
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
