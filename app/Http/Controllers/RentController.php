<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    function index() {
        $rents = DB::select("select * from rents");

        return view('rent.index', ['rents' => $rents]);
    }

    function show($id) {
        $rent = DB::select("select * from rents where id=$id");
        if(count($rent) == 1) {
            return view('rent.show', ['rent' => $rent[0]]);
        }

        return abort('404');
    }

    function edit($id) {
        $rent = DB::select("select * from rents where id=$id");

        if(count($rent) == 1) {
            return view('rent.index', ['rent' => $rent[0]]);
        }

        return abort('404');
    }
    
    function update($id) {
        $studentId = $_POST['studentId'];
        $bookId = $_POST['bookId'];
        $date_rent = $_POST['date_rent'];
        $date_return = $_POST['date_return'];
        $updated = DB:: update("update rents set studentId=$studentId, bookId=$bookId, date_rent='$date_rent', date_return='$date_return' where id=$id");

        if($updated == 1) {
            return view('rent.index', ['rent' => $rent[0]]);   
        }

        return abort('404');
    }

    function delete($id) {
        $deleted = DB::delete("delete from rents where id=$id");

        if($deleted == 1) {
            return $this->index();
        }

        return abort('404');
    }

    function create() {
        return view('rent.create');
    }

    function store() {
        $studentId = $_POST['studentId'];
        $bookId = $_POST['bookId'];
        $date_rent = $_POST['date_rent'];
        $date_return = $_POST['date_return'];
        $inserted = DB::insert("insert into rents (studentId, bookId, date_rent, date_return) values ($studentId, $bookId, '$date_rent', '$date_return')");

        if($inserted == 1) {
            return $this->index();
        }

        return abort('404');
    }
}
