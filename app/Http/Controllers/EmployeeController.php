<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
               $employees = \DB::table('employees')->get();
        // dd($employees);
        return view('employee/index', ['employees' => $employees]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:55',
            'job_title' => 'required|max:60',
            'email' => 'required|email|unique:employees',
            'salary'=>'required|numeric:10',

        ]);
       // die('ddd');
        $emp = new Employee();
        $emp->name = $request->name;
        $emp->job_title = $request->job_title;
        $emp->email = $request->email;
        $emp->salary = $request->salary;
        $emp->save();

        \Session::put('msg', 'Employee Added'); // a string
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees=Employee::where('id', $id)->get();
        return view('employee/edit',['employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $validate=\Validator::make($request->all(),[
           'name' => 'required|max:55',
           'job_title' => 'required|max:60',
           'email' => 'required|email',
           'salary'=>'required|numeric:10',

       ]);
        if($validate->fails())
        {
            $employees=Employee::where('id', $id)->get();
            return redirect('/employee/'.$id.'?emp'.$id)
                ->withErrors($validate)
                ->withInput();
        }

        Employee::where('id', $id)
            ->update(['name' =>  $request->name , 'job_title'=> $request->job_title,
                'email'=>$request->email , 'salary' =>$request->salary]);
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //dd($id);
        \DB::table('employees')->where('id', $id)->delete();
        return redirect('/');
    }
    public function ajaxcreate()
    {
        if (\Request::ajax()) {
            $data = \Input::all();
            // echo $data['email'].$data['password'];
            // $arr = (json_decode($data, true));
            $name = $data['name'];
            $job_title = $data['job_title'];
            $email = $data['email'];
            $salary = $data['salary'];

        }
        $validate=\Validator::make($data,[
            'name' => 'required|max:55',
            'job_title' => 'required|max:60',
            'email' => 'required|email|unique:employees',
            'salary'=>'required|numeric:10',

        ]);
        if($validate->fails())
        {
            return 'fail';
        }
        else
        {
            $emp = new \App\Employee();
            $emp->name = $name;
            $emp->job_title = $job_title;
            $emp->email = $email;
            $emp->salary = $salary;
            if($emp->save())
                return "success";
        }

    }
    public function ajaxupdate($id)
    {
        if (\Request::ajax()) {
            $data = \Input::all();
            // echo $data['email'].$data['password'];
            // $arr = (json_decode($data, true));
            $name = $data['name'];
            $job_title = $data['job_title'];
            $email = $data['email'];
            $salary = $data['salary'];

        }
        $validate=\Validator::make($data,[
            'name' => 'required|max:55',
            'job_title' => 'required|max:60',
            'email' => 'required|email',
            'salary'=>'required|numeric:10',

        ]);
        if($validate->fails())
        {
            return 'fail';
        }
        else
        {
            \App\Employee::where('id','=', $id)
                ->update(['name' =>  $name , 'job_title'=> $job_title,
                    'email'=>$email , 'salary' =>$salary]);
            return "success";
        }

    }
    public function delete()
    {
        if (\Request::ajax()) {
            $data = \Input::all();
            $id = $data['id'];
            //dd($id);
            Employee::where('id','=', $id)->delete();
            return 'success';
        }
        else
        {
            return 'fail';
        }
    }
}
