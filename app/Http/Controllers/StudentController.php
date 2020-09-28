<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    function index() {
        $students = DB::select("select * from students");
        return view('student.index', ['students' => $students]);
    }
    
    function show($id) {
        $student = DB::select("select * from students where id=$id");
        if(count($student) == 1) {
            return view('student.show', ['student' => $student[0]]);
        }
        return abort('404');
    }

    function edit($id) {
        $student = DB::select("select * from students where id=$id");
        if(count($student) == 1) {
            return view('student.update', ['student' => $student[0]]);
        }
        return abort('404');
    }

    function update($id) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $class = $_POST['class'];
        $updated = DB::update("update students set name='$name', surname='$surname', class=$class where id=$id");
        
        if($updated == 1) {
            return $this->index();
        }
        return abort('404');
    }

    function delete($id) {
        $deleted = DB::delete("delete from students where id=$id");
        if($deleted == 1) {
            return $this->index();
        }
        return abort('404');
    }

    function create() {
        return view('student.create');
    }

    function store() {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $class = $_POST['class'];
        $inserted = DB::insert("insert into students (name, surname, class) values ('$name', '$surname', $class)");
        if($inserted == 1) {
            return $this->index();
        }
        return abort('404');
    }
}
