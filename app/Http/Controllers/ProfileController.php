<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $profile = User::find($user_id);
        return view('profile.index',compact('profile'));
    }

    public function showrepass()
    {
        $user_id = Auth::id();

        $profile = User::find($user_id);
        return view('profile.repass',compact('profile'));
    }

    public function repass(Request $request, $userId)
    {
        $status = 200;
        $msgerror = "";

        $input = $request->all();
        // if($input['pass']){
        //     unset($input['pass']);
        //     unset($input['confirmpass']);
        // }
        // $oldpassword = bcrypt($input['oldpassword']);
        $newpassword = bcrypt($input['newpassword']);

        DB::beginTransaction();
        try{
            // $checkPass = User::where('password', $oldpassword)->get();
            // if (count($checkPass)) {
                unset($input['_token']);
                unset($input['_method']);
                unset($input['confirmpass']);
                User::where('id', $userId)->update(['password' => $newpassword]);
            // }else{
            //     $status = 500;
            //     $msgerror = 'รหัสผ่านไม่ถูกต้อง';
            // }
        } catch (\Exception $ex) {
            DB::rollback();
            $status = 500;
            $msgerror = $ex->getMessage();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'แก้ไขรหัสผ่านเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror, 'url' => "/profile/repass"];
        return Response::json($data);
    }

    public function update(Request $request, $userId)
    {
        $status = 200;
        $msgerror = "";

        $input = $request->all();

        DB::beginTransaction();
        try{
            
                unset($input['_token']);
                unset($input['_method']);
                User::where('id', $userId)->update($input);
            
        } catch (\Exception $ex) {
            DB::rollback();
            $status = 500;
            $msgerror = $ex->getMessage();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror, 'url' => "/profile"];
        return Response::json($data);
    }

    public function updatemail(Request $request, $userId)
    {
        $status = 200;
        $msgerror = "";

        $input = $request->all();

        DB::beginTransaction();
        try{
            $checkEmail = User::where('email', $input['email'])->get();
            if (!count($checkEmail)) {
                unset($input['_token']);
                unset($input['_method']);
                User::where('id', $userId)->update($input);
            }else{
                $status = 500;
                $msgerror = 'อีเมล์นี้มีการใช้งานอยู่แล้ว';
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $status = 500;
            $msgerror = $ex->getMessage();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror, 'url' => "/profile"];
        return Response::json($data);
    }
}
