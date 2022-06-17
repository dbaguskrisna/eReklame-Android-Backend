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
        $insert = DB::insert('insert into user (nama,alamat,no_hp,jabatan,nama_perusahaan,alamat_perusahaan,no_telp_perusahaan,npwpd,email,password,username,token) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('nama'),$request->input('alamat'),$request->input('noHP'),$request->input('jabatan'),$request->input('nama_perusahaan'),$request->input('alamat_perusahaan'),$request->input('no_telp_perusahaan'),$request->input('npwpd'),$request->input('email'),$request->input('password'),$request->input('username'),$request->input('token')]);
        
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
        $data = DB::table('user')->where('username', $request->input('username'))->update(['token' => $request->input('token')]);
        if($userData == null && $data == null){
            return response()->json(['result'=>'failed','data'=>$userData]);
        } else {
            return response()->json(['result'=>'success','data'=>$userData]);
        }
    }

    public function readUser(Request $request){
        $user=DB::select(DB::raw("select * from user where username=?"), [$request->input('username')]);
        if($user == null){
            return response()->json(['result'=>'failed','data'=>$user]);
        } else {
            return response()->json(['result'=>'success','data'=>$user]);
        }
    }

    public function updatePassword(Request $request){
        $data = DB::table('user')
              ->where('username', $request->input('username'))
              ->update(['password' => $request->input('password')]);
        if($data == null){
            return response()->json(['result'=>'failed','data'=> $request->input('username')]);
        } else {
            return response()->json(['result'=>'success','data'=> $request->input('username')]);
        }
    }

    public function updateUser(Request $request){
        $data = DB::table('user')
              ->where('username', $request->input('username'))
              ->update(['nama' => $request->input('nama_lengkap'), 'alamat' => $request->input('alamat'),'no_hp' => $request->input('no_hp'),'jabatan' => $request->input('jabatan'),'nama_perusahaan' => $request->input('nama_perusahaan'),'alamat_perusahaan' => $request->input('alamat_perusahaan'),'no_telp_perusahaan' => $request->input('no_telp_perusahaan'),'npwpd' => $request->input('npwpd')]);
        if($data == null){
            return response()->json(['result'=>'failed','data'=> $request->input('username')]);
        } else {
            return response()->json(['result'=>'success','data'=> $request->input('username')]);
        }
    }
    
    public function loginPetugas(Request $request){
        $userData=DB::select(DB::raw("select * from petugas_wastib where username=? and password=?"), [$request->input('username'),$request->input('password')]);

        if($userData == null){
            return response()->json(['result'=>'failed','data'=>$userData]);
        } else {
            return response()->json(['result'=>'success','data'=>$userData]);
        }
    }

    public function readPetugasWastib(Request $request){
        $userData=DB::select(DB::raw("select * from petugas_wastib where username=?"), [$request->input('username')]);

        if($userData == null){
            return response()->json(['result'=>'failed','data'=>$userData]);
        } else {
            return response()->json(['result'=>'success','data'=>$userData]);
        }
    }

    public function updatePetugasWastib(Request $request){
        $data = DB::table('petugas_wastib')
              ->where('username', $request->input('username'))
              ->update(['nama_petugas' => $request->input('nama_petugas'), 'alamat' => $request->input('alamat'),'nomor_handphone' => $request->input('no_hp')]);

        if($data == null){
            return response()->json(['result'=>'failed','data'=>  $data]);
        } else {
            return response()->json(['result'=>'success','data'=>  $data]);
        }
    }

    
}