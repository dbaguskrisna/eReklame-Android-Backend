<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReklameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $insert = DB::insert('insert into reklame (id_jenis_reklame,id_user,id_jenis_produk,id_lokasi_penempatan,id_status_tanah,id_letak_reklame,tahun_pendirian,kecamatan,kelurahan,tahun_pajak,tgl_permohonan,sudut_pandang,nama_jalan,nomor_jalan,detail_lokasi,panjang_reklame,lebar_reklame,luas_reklame,tinggi_reklame,teks,no_formulir,status_pengajuan,status) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->input('id_jenis_reklame'), $request->input('id_user'), $request->input('id_jenis_produk'), $request->input('id_lokasi_penempatan'), $request->input('id_status_tanah'), $request->input('id_letak_reklame'), $request->input('tahun_pendirian'), $request->input('kecamatan'), $request->input('kelurahan'), $request->input('tahun_pajak'), $request->input('tgl_permohonan'), $request->input('sudut_pandang'), $request->input('nama_jalan'), $request->input('nomor_jalan'), $request->input('detail_lokasi'), $request->input('panjang_reklame'), $request->input('lebar_reklame'), $request->input('luas_reklame'), $request->input('tinggi_reklame'), $request->input('teks'), $request->input('no_formulir'), $request->input('status_pengajuan'), $request->input('status')]);

        $data = DB::select(DB::raw("select id_reklame from reklame where no_formulir=?"), [$request->input('no_formulir')]);
        $str = json_encode($data[0]);
        $id_reklame = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

        $insertCoordinate = DB::insert('insert into history_xy (id_reklame,latitude,longtitude,status) values (?, ?, ?, ?)', [$id_reklame, $request->input('latitude'), $request->input('longtitude'), 0]);

        if ($insertCoordinate == null) {
            return response()->json(['result' => 'failed', 'data_insert_reklame' => $insert, 'data_insert_coordinate' => $insertCoordinate]);
        } else {
            return response()->json(['result' => 'success', 'data_insert_reklame' => $insert, 'data_insert_coordinate' => $insertCoordinate]);
        }
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

    public function readReklame(Request $request)
    {
        $data = DB::select(DB::raw("select 
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status from reklame inner join user on reklame.id_user = user.iduser WHERE user.username = ?"), [$request->input('user')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function readDetailReklame(Request $request)
    {
        $data = DB::select(DB::raw("select 
        user.nama,
        user.alamat,
        user.no_hp,
        user.jabatan,
        user.nama_perusahaan,
        user.alamat_perusahaan,
        user.no_telp_perusahaan,
        user.npwpd,
        user.email,
        user.token,
        jenis_produk.nama_jenis_produk,
        jenis_reklame.nama_jenis_reklame,
        letak_reklame.letak,
        lokasi_penempatan.lokasi_penempatan,
        status_tanah.nama_status_tanah,
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status from reklame inner join user on reklame.id_user = user.iduser INNER JOIN jenis_reklame ON reklame.id_jenis_reklame = jenis_reklame.id_jenis_reklame INNER JOIN letak_reklame ON reklame.id_letak_reklame = letak_reklame.id_letak_reklame INNER JOIN lokasi_penempatan ON reklame.id_lokasi_penempatan = lokasi_penempatan.id_lokasi INNER JOIN status_tanah ON reklame.id_status_tanah = status_tanah.id_status INNER JOIN jenis_produk ON reklame.id_jenis_produk = jenis_produk.id_jenis_produk WHERE reklame.id_reklame = ?"), [$request->input('id_reklame')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function showMaps(Request $request)
    {
        $data = DB::select(DB::raw("select history_xy.id_history_xy,history_xy.id_reklame,history_xy.latitude,history_xy.longtitude,history_xy.status,reklame.no_formulir,user.nama from history_xy INNER JOIN reklame ON history_xy.id_reklame = reklame.id_reklame INNER JOIN user ON reklame.id_user = user.iduser WHERE user.username = ?"), [$request->input('user')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function showReklamePetugas(Request $request)
    {
        $data = DB::select(DB::raw("select history_xy.id_history_xy,history_xy.id_reklame,history_xy.status,history_xy.latitude,history_xy.longtitude,reklame.no_formulir,user.nama from history_xy INNER JOIN reklame ON history_xy.id_reklame = reklame.id_reklame INNER JOIN user ON reklame.id_user = user.iduser"), [$request->input('user')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function insertDataSurvey(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:jpg,jpeg,png',
        ]);
     
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
     
        $nama_file = "reklame_".time()."_".$file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);

        $data = DB::select(DB::raw("select id_reklame from reklame where no_formulir=?"), [$request->input('no_formulir')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'request' => $request->input('no_formulir')]);
        } else {
            $str = json_encode($data[0]);
            $id_reklame = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

            $insert = DB::insert('insert into data_survey (id_reklame,id_petugas,tanggal_survey,berita_acara,gambar) values (?,?,?,?,?)', [$id_reklame, $request->input('id_petugas'), $request->input('tanggal_survey'), $request->input('berita_acara'), $nama_file]);

            if ($insert == null) {
                return response()->json(['result' => 'failed', 'data' => $insert]);
            } else {
                return response()->json(['result' => 'success', 'data' => $insert]);
            }
        }
    }

    public function readReklameBelumDiVerifikasi(Request $request)
    {
        $data = DB::select(DB::raw("select 
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status from reklame INNER JOIN user ON reklame.id_user = user.iduser WHERE reklame.status_pengajuan = 1"));
        
        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function readBerkasSudahDiverifikasi(Request $request)
    {
        $data = DB::select(DB::raw("select 
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status from reklame WHERE reklame.status_pengajuan = 2"));

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function readBerkasKurang(Request $request)
    {
        $data = DB::select(DB::raw("select 
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status from reklame WHERE reklame.status_pengajuan = 3"));

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function changeStatus(Request $request)
    {
        $data = DB::table('reklame')->where('id_reklame', $request->input('id_reklame'))->update(['status_pengajuan' => '1']);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $request->input('id_reklame')]);
        } else {
            return response()->json(['result' => 'success', 'data' => $request->input('id_reklame')]);
        }
    }

    public function changeStatusBerkasSudahDiVerifikasi(Request $request)
    {
        $data = DB::table('reklame')->where('id_reklame', $request->input('id_reklame'))->update(['status_pengajuan' => '2']);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $request->input('id_reklame')]);
        } else {
            return response()->json(['result' => 'success', 'data' => $request->input('id_reklame')]);
        }
    }

    public function changeStatusBerkasKurang(Request $request)
    {
        $data = DB::table('reklame')->where('id_reklame', $request->input('id_reklame'))->update(['status_pengajuan' => '3']);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $request->input('id_reklame')]);
        } else {
            return response()->json(['result' => 'success', 'data' => $request->input('id_reklame')]);
        }
    }

    public function deleteReklame(Request $request)
    {
        $dataHistory = DB::table('history_xy')->where('id_reklame', $request->input('id_reklame'))->delete();
        $dataReklame  = DB::table('reklame')->where('id_reklame', $request->input('id_reklame'))->delete();

        if ($dataHistory == null && $dataReklame == null) {
            return response()->json(['result' => 'failed', 'data' => $request->input('id_reklame')]);
        } else {
            return response()->json(['result' => 'success', 'data' => $request->input('id_reklame')]);
        }
    }

    public function detailDataSurvey (Request $request){
        $data = DB::select(DB::raw("select 
        user.nama,
        user.alamat,
        user.no_hp,
        user.jabatan,
        user.nama_perusahaan,
        user.alamat_perusahaan,
        user.no_telp_perusahaan,
        user.npwpd,
        user.email,
        user.token,
        jenis_produk.nama_jenis_produk,
        jenis_reklame.nama_jenis_reklame,
        letak_reklame.letak,
        lokasi_penempatan.lokasi_penempatan,
        status_tanah.nama_status_tanah,
        reklame.id_reklame,
        reklame.id_jenis_reklame,
        reklame.id_user,
        reklame.id_jenis_produk,
        reklame.id_lokasi_penempatan,
        reklame.id_status_tanah,
        reklame.id_letak_reklame,
        reklame.tahun_pendirian,
        reklame.kecamatan,
        reklame.kelurahan,
        reklame.tahun_pajak,
        reklame.tgl_permohonan,
        reklame.sudut_pandang,
        reklame.nama_jalan,
        reklame.nomor_jalan,
        reklame.detail_lokasi,
        reklame.panjang_reklame,
        reklame.lebar_reklame,
        reklame.luas_reklame,
        reklame.tinggi_reklame,
        reklame.teks,
        reklame.no_formulir,
        reklame.status_pengajuan,
        reklame.status,
        data_survey.tanggal_survey,
        data_survey.berita_acara,
        data_survey.gambar,
        data_survey.id_survey
        from reklame inner join user on reklame.id_user = user.iduser INNER JOIN jenis_reklame ON reklame.id_jenis_reklame = jenis_reklame.id_jenis_reklame INNER JOIN letak_reklame ON reklame.id_letak_reklame = letak_reklame.id_letak_reklame INNER JOIN lokasi_penempatan ON reklame.id_lokasi_penempatan = lokasi_penempatan.id_lokasi INNER JOIN status_tanah ON reklame.id_status_tanah = status_tanah.id_status INNER JOIN jenis_produk ON reklame.id_jenis_produk = jenis_produk.id_jenis_produk INNER JOIN data_survey ON reklame.id_reklame = data_survey.id_reklame WHERE data_survey.id_survey = ?"), [$request->input('id_survey')]);

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function dataSurvey(){
        $data = DB::select(DB::raw('SELECT data_survey.id_survey,reklame.no_formulir, reklame.tahun_pendirian, reklame.status, data_survey.id_petugas, data_survey.tanggal_survey, data_survey.berita_acara, data_survey.gambar FROM data_survey INNER JOIN reklame ON data_survey.id_reklame = reklame.id_reklame'));

        if ($data == null) {
            return response()->json(['result' => 'failed', 'data' => $data]);
        } else {
            return response()->json(['result' => 'success', 'data' => $data]);
        }
    }

    public function showImageReklame(Request $request){
        $image = DB::table('data_survey')->select('gambar')->where('id_survey', $request->input('id_survey'))->first();

        //return response()->download(public_path('data_file/'.$image->{'nama_berkas'}));
        
        return response()->json(['result'=>'success','data'=>'http://localhost/eReklame//eReklame//public//data_file/'.$image->{'gambar'}]);
    }
}
