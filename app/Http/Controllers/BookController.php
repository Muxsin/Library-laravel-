<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    function index() {
        $books = DB::select("select * from books");
        return view('book.index', ['books' => $books]);
    }

    function show($id) {
        $book = DB::select("select * from books where id=$id");
        if(count($book) == 1) {
            return view('book.show', ['book' => $book[0]]);
        }
        return abort('404');
    }

    function edit($id) {
        $book = DB::select("select * from books where id=$id");
        if(count($book) == 1) {
            return view('book.update', ['book' => $book[0]]);
        }
        return abort('404');
    }

    function update($id) {
        $title = $_POST['title'];
        $cell = $_POST['cell'];
        $updated = DB::update("update books set title='$title', cell='$cell' where id=$id");
        
        if($updated == 1) {
            return $this->index();
        }
        return abort('404');
    }

    function delete($id) {
        $deleted = DB::delete("delete from books where id=$id");
        if($deleted == 1) {
            return $this->index();
        }
        return abort('404');
    }

    function create() {
        return view('book.create');
    }

    function store() {
        $title = $_POST['title'];
        $cell = $_POST['cell'];
        $inserted = DB::insert("insert into books (title, cell) values ('$title', '$cell')");
        if($inserted == 1) {
            return $this->index();
        }
        return abort('404');
    }
}
