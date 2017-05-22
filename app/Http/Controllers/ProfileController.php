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
        return view('profile.index',compact('profile','orders'));
    }

    public function update(Request $request, $userId)
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
