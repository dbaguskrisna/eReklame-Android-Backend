<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = DB::insert('insert into user (nama,alamat,no_hp,jabatan,nama_perusahaan,alamat_perusahaan,no_telp_perusahaan,npwpd,email,password,username) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('nama'),$request->input('alamat'),$request->input('noHp'),$request->input('jabatan'),$request->input('nama_perusahaan'),$request->input('alamat_perusahaan'),$request->input('no_telp_perusahaan'),$request->input('npwpd'),$request->input('email'),$request->input('password'),$request->input('username')]);

        return response()->json(['result'=>'success','data'=>$insert]);
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

    public function login(Request $request){
        $userData=DB::select(DB::raw("select * from user where username=? and password=?"), [$request->input('username'),$request->input('password')]);

        return response()->json(['result'=>'success','data'=>$userData]);
    }

    public function readUser(Request $request){
        $user=DB::select(DB::raw("select * from user where username=?"), [$request->input('username')]);
        return response()->json(['result'=>'success','data'=>$user]);
    }

    public function updatePassword(Request $request){
        $data = DB::table('user')
              ->where('username', $request->input('username'))
              ->update(['password' => $request->input('password')]);
        return response()->json(['result'=>'success','data'=> $request->input('username')]);
    }

}
