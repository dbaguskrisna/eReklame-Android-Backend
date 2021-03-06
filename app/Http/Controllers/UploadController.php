<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.upload_file');
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

	public function proses_upload(Request $request){
        $this->validate($request, [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,xls,xlsx,txt,ppt,pptx,dwg',
            'username' => 'required',
            'id_reklame' => 'required',
            'id_berkas' => 'required'
        ]);
     
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
     
        $nama_file = time()."_".$file->getClientOriginalName();
     
        $data = DB::select(DB::raw("select iduser from user where username=?"), [$request->username]);
        $str = json_encode($data[0]);
        $id_user = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);
     
        $insert = DB::insert('insert into berkas_upload_berkas_digital (id_user,id_reklame,id_berkas,nama_berkas,status) values (?,?,?,?,?)',[$id_user,$request->id_reklame,$request->id_berkas,$nama_file,0]);

        // Gambar::create([
        //     'file' => $nama_file,
        //     'keterangan' => $request->keterangan,
        // ]);
        
        if ($insert == null) {
            return response()->json(['result' => 'failed', 'data' => $request->input('id_reklame')]);
        } else {
            return response()->json(['result' => 'success', 'data' => $request->input('id_reklame')]);
        }
    }
    
    public function readUploadData(Request $request){
        $user=DB::select(DB::raw("select berkas_upload_berkas_digital.id_upload,berkas_upload_berkas_digital.id_user,berkas_upload_berkas_digital.id_reklame, berkas_upload_berkas_digital.id_berkas,berkas_upload_berkas_digital.nama_berkas,berkas_upload_berkas_digital.status, master_berkas.nama_berkas as jenis_berkas from berkas_upload_berkas_digital INNER JOIN master_berkas ON berkas_upload_berkas_digital.id_berkas=master_berkas.id_berkas where id_reklame=?"), [$request->input('id_reklame')]);

        if($user == null){
            return response()->json(['result'=>'failed','data'=>$user]);
        } else {
            return response()->json(['result'=>'success','data'=>$user]);
        }
    }

    public function deleteBerkas (Request $request){
        $delete = DB::table('berkas_upload_berkas_digital')->where('id_upload', $request->input('id_upload'))->delete();

        if($delete == null){
            return response()->json(['result'=>'failed','data'=>$delete]);
        } else {
            return response()->json(['result'=>'success','data'=>$delete]);
        }
    }

    public function downloadBerkas(Request $request){
        $image = DB::table('berkas_upload_berkas_digital')->select('nama_berkas')->where('id_upload', $request->input('id_upload'))->first();

        //return response()->download(public_path('data_file/'.$image->{'nama_berkas'}));

        return response()->json(['result'=>'success','data'=>$image->{'nama_berkas'}]);
    }
}
