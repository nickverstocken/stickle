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
use Response;

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

    public function getBook($book_id){
        $book = ReadingBook::where('readingBook_id', $book_id);
        dd($book->title);
        return response::json([
            'success' => true,
            'book' => $book
        ]
        , 200
        );
    }

    public function addNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'shortDescription' => 'string',
            'numberOfPages' => 'required|numeric',
            'bookCover' => 'image'
        ]);

        if ($validator->passes()){
           
            $book = new ReadingBook;
        	$book->title = $request->title;
        	$book->author = $request->author;
        	$book->shortDescription = $request->shortDescription;
        	$book->numberOfPages = $request->numberOfPages;
            $book->coverPath = null;
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
                $filename = 'books/' . $book_id . '.' .$extension;
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
            'shortDescription' => 'string',
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
                $filename = 'books/' . $book->readingBook_id . '.' .$extension;
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
        
        return redirect('/ouders/boeken');
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
    public function searchBooks(Request $request) {
        $searchVal = $request->get('searchVal');
        $user = Auth::user();
        $books = ReadingBook::where('addedBy_id', $user->id)
            ->where(function($query) use ($searchVal)
            {
                $query->orWhere('title', 'like', '%'.$searchVal.'%')
                    ->orWhere('author', 'like', '%' . $searchVal . '%')
                    ->orWhere('shortDescription', 'like', '%' . $searchVal . '%');
            })->get();
        return response::json([
                'success' => true,
                'books' => $books
            ]
            , 200
        );
    }
    public function linkBookToChild(Request $request) {
        $bookId = $request->get('bookId');
        $childId = $request->get('childId');

        $readingBook = ChildrenReadingBook::where('child_id', $childId)->where('book_id', $bookId)->first();
        if(!$readingBook){
            $readingBook = new ChildrenReadingBook();
            $readingBook->book_id = $bookId;
            $readingBook->child_id = $childId;
            $readingBook->save();
        }
        return response::json([
                'success' => true,
                'message' => 'Linked succesfully!'
            ]
            , 200
        );
    }
    public function removeLinkToChild($childrenReadingBook_id){
        $childrenReadingBook = ChildrenReadingBook::find($childrenReadingBook_id);
        $child = $childrenReadingBook->child;
        $parent = Auth::user();
        if($parent->id == $child->parent->id){
            $childrenReadingBook->delete();
            return response::json([
                    'success' => true,
                    'message' => 'Unlinked succesfully!'
                ]
                , 200
            );
        }
        return response::json([
                'success' => false,
                'message' => 'Je bent niet gemachtigd dit te doen'
            ]
            , 200
        );
    }
    public function setBookAsCurrent($childId, $childReadingBookId){
        $readingBook = ChildrenReadingBook::where('childrenReadingBook_Id', $childReadingBookId)->first();
        ChildrenReadingBook::where('child_id', $childId)->where('currentlyReading', 1)->update(['currentlyReading' => 0]);
        if($readingBook){
            if($readingBook->child_id == session('childLoggedIn')){
                $readingBook->currentlyReading = true;
                $readingBook->save();
                return redirect('kind/' . $childId . '/dashboard');
            }
        }
    }
    public function changeLastPageOfReadingBook(Request $request){
        $validator = Validator::make($request->all(), [
            'childReadingBookId' => 'required|numeric',
            'last_page' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $lastpageRead = $request->get('last_page');
            $childReadingBookId = $request->get('childReadingBookId');
            $readingBook = ChildrenReadingBook::where('childrenReadingBook_Id', $childReadingBookId)->first();
            if($readingBook){
                if($readingBook->book->numberOfPages >= $lastpageRead){
                    if($readingBook->book->numberOfPages == $lastpageRead){
                        $readingBook->isFinished = true;
                    }else{
                        $readingBook->isFinished = false;
                    }
                    $readingBook->lastPageRead = $lastpageRead;
                    $readingBook->save();
                    return response::json([
                            'success' => true,
                            'url' => 'ouders/kinderen'
                        ]
                        , 200
                    );
                }else{
                    return response::json([
                            'success' => false,
                            'error' => 'Het boek heeft maar ' . $readingBook->book->numberOfPages . 'bladzijden u gaf een getal in dat groter is dan het aantal bladzijden'
                        ]
                        , 200
                    );
                }

            }else{
                return response::json([
                        'success' => false,
                        'error' => 'Er ging iets mis'
                    ]
                    , 200
                );
            }
        }
        return response::json([
                'success' => false,
                'error' => 'De input die u gaf is niet juist'
            ]
            , 200
        );
    }

}
