<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Address;
use Illuminate\Http\Request;
use Response;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $status = 200;
        $msgerror = "";

        $user_id = Auth::id();
        $fullname = $request->input('fullname');
        $detail = $request->input('detail');
        $postcode = $request->input('postcode');
        $tel = $request->input('tel');

        DB::beginTransaction();
        try{
            Address::create([
                'user_id' => $user_id,
                'fullname' => $fullname,
                'detail' => $detail,
                'postcode' => $postcode,
                'tel' => $tel
                ]);
            
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


    public function update(Request $request, $addressId)
    {
        $status = 200;
        $msgerror = "";

        $address = $request->all();

        DB::beginTransaction();
        try{
            unset($address['_token']);
            unset($address['_method']);
            Address::where('id', $addressId)->update($address);;
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

    public function getAddress(Request $request)
    {
        $status = 200;

        $addressId = $request->input('addressId');

        $ad = Address::find($addressId);

        
        $data = ['status' => $status,'address' => $ad];
        return Response::json($data);
    }

    public function destroy(address $addressId)
    {
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $ad = $addressId->delete();
        } catch (\Exception $ex) {
            $status = 500;
            $msgerror = $ex->getMessage();
            DB::rollback();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror];
        return Response::json($data);
    }
}
