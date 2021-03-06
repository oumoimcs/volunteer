<?php

namespace App\Http\Controllers;

use App\StudentModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new StudentModel();
        //$table_student = $model->select();
        $q = $request->input('q');
        $table_student = $model->select_search($q);

        $data = [
        'table_student' => $table_student,
        'q' => $q


        ];
        return view('student/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $id_student = $request->input('id_student');
        $stu_name = $request->input('stu_name');
        $stu_lastname = $request->input('stu_lastname');
        $degree = $request->input('degree');
        $major = $request->input('major');

        $model = new StudentModel();
        $model->insert( $id_student,  $stu_name, $stu_lastname, $degree, $major);
        return redirect('/student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentModel  $studentModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = new StudentModel();
        $table_student = $model->select_id($id);
        $data = [
        'table_student' => $table_student
        ];
        return view('student/show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentModel  $studentModel
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentModel $studentModel)
    {
        $model = new StudentModel();
        $table_student = $model->select_id($id);
        $data = [
        'table_student' => $table_student
        ];
        return view('student/edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentModel  $studentModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_student = $request->input('id_student');
        $stu_name = $request->input('stu_name');
        $stu_lastname = $request->input('stu_lastname');
        $degree = $request->input('degree');
        $major = $request->input('major');
        $model = new StudentModel();
        $model->update($id_student, $stu_name, $stu_lastname, $degree, $major, $id);
        return redirect('/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentModel  $studentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect('/student');

    }

    public function __construct()
    {
        $this->middleware('role:customer');
    }
}
