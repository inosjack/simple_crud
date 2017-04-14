<?php

namespace App\Http\Controllers;

use App\Reguser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('userlogin');
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
            'name' => 'required|max:255',
            'mobile_no' => 'required|numeric:10',
            'email' => 'required|email|unique:regusers',
            'password'=> 'required',
            'cpassword' => 'required|same:password'
        ]);
        $newuser = new Reguser();
        $newuser->name = $request->name;
        $newuser->mobile_no = $request->mobile_no;
        $newuser->email = $request->email;
        $newuser->password = $request->password;
        $newuser->save();

        \Session::put('msg', 'register complele login plz'); // a string
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
        //
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
        //
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
    }

    public function showRegisform()
    {
        return view('regisuser');
    }
    public function login()
    {
        if(\Request::ajax()) {
                $data = \Input::all();
                // echo $data['email'].$data['password'];
                // $arr = (json_decode($data, true));
                $email=$data['email'];
                $pass=$data['password'];
                // echo $email.$pass;
                if($user = \DB::table('users')->where('email',$email)->first()) {
                    if (($user->password) == ($pass)) {
                        // \Session::put('uid',$request->uid );
                        echo "success";
                    } else {
                        echo 'failed';
                    }
                }else {
                    echo 'failed';
                }
        }

       /* $arr = (json_decode($request, true));
        $this->validate($arr, [
            'email' => 'required|max:255',
            'password'=> 'required',
        ]);
        $user = \DB::table('users')->where('email', $arr->email)->first();
        if(($user->password)==($request->password))
        {
           // \Session::put('uid',$request->uid );
            return redirect('/welcome');
        }
        else
        {
            return redirect('/');
        }*/
        /*$userdata=array(
            'name'=>'$request->uid',
            'password'=>'$request->upass'
        );
        if(\Auth::attempt($userdata))
        {
            \Session::put('uid',$request->uid );
            return redirect('/welcome');
        }
        else{
            return view('userlogin');
        }*/

    }

}
