<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\ZkLibrary\ZKLibrary;
use App\FpLibrary\Parse;
use App\Models\Device;
use App\Models\Sift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $karyawan = Karyawan::all();
        $karyawan = Karyawan::with('sifts')->get();
        return view('pages.karyawan.index')->withKaryawans($karyawan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $device = Device::find(1);

        try {
            $karyawan = new Karyawan();
            $karyawan->uid = $request->get('user_id');
            $karyawan->user_id = $request->get('user_id');
            $karyawan->role = $request->get('role');
            $karyawan->nik = $request->get('nik');
            $karyawan->telepon = $request->get('telepon');
            $karyawan->email = $request->get('email');
            $karyawan->nama = $request->get('nama');
            $karyawan->alamat = $request->get('alamat');
            $karyawan->save();
            if ($karyawan == true) {
                $Connect = fsockopen($device->ip, $device->port, $errno, $errstr, 1);
                if($Connect){
                    $id=$request->get('user_id');
                    $nama=$request->get('nama');
                    $role = $request->get('role');
                    $password = $request->get('password');
                    $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">". '0' ."</ArgComKey><Arg><PIN>".$id."</PIN><Name>".$nama."</Name>" . "<Privilege>" . $role . "</Privilege>" . "<Password>" . $password . "</Password>" . "</Arg></SetUserInfo>";
                    $newLine="\r\n";
                    fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                    fputs($Connect, "Content-Type: text/xml".$newLine);
                    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                    fputs($Connect, $soap_request.$newLine);
                    $buffer="";
                    while($Response=fgets($Connect, 1024)){
                        $buffer=$buffer.$Response;
                    }
                }else echo "Koneksi Gagal";
                $buffer=Parse_Data($buffer,"<Information>","</Information>");
                Session::flash('status', 'Data berhasil diupdate');
                return redirect()->route('karyawan.index');
            }

        } catch (\Throwable $th) {
            throw $th;
            Session::flash('status', 'Terjadi kesalahan saat menambahkan data');
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        return view('pages.karyawan.edit')->withKaryawan($karyawan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $karyawan = Karyawan::find($id);
            $karyawan->kode = $request->get('kode');
            $karyawan->nik = $request->get('nik');
            $karyawan->nama = $request->get('nama');
            $karyawan->alamat = $request->get('alamat');
            $karyawan->save();
            Session::flash('status', 'Data karyawan berhasil diupdate');
            return redirect()->route('karyawan.index');
        } catch (\Throwable $th) {
            Session::flash('status', 'Terjadi kesalahan saat mengupdate data');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find(1);
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        if ($karyawan == true) {
            $Connect = fsockopen($device->ip, $device->port, $errno, $errstr, 1);
            if($Connect){
                $soap_request="<DeleteUser><ArgComKey xsi:type=\"xsd:integer\">".'0'."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$karyawan->user_id."</PIN></Arg></DeleteUser>";
                $newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
                $buffer="";
                while($Response=fgets($Connect, $device->port)){
                    $buffer=$buffer.$Response;
                }
            }else echo "Koneksi Gagal";
            $buffer=Parse_Data($buffer,"<ClearDataResponse>","</ClearDataResponse>");
            Session::flash('status', 'Data berhasil dihapus');
            return redirect()->route('karyawan.index');
        }

    }

    public function siftKaryawan(Request $request)
    {
        $karyawans = Karyawan::all();
        return view('pages.karyawan.add_sift')->withKaryawans($karyawans)->with('sift_id', $request->sift_id);
    }

    public function siftKaryawanStore(Request $request)
    {
        $karyawanSift = Sift::find($request->get('sift_id'));
        $karyawan = Karyawan::where('id', $request->get('karyawan'))->first();
        $karyawan_id = $karyawan->id;
        $karyawanSift->karyawans()->attach($karyawan_id);
        Session::flash('status', 'Data berhasil disimpan');
        return redirect()->route('sift.index');
    }
}
