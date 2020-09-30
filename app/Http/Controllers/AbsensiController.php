<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Device;
use App\Models\Karyawan;
use App\Models\Sift;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $karyawanAbsen = Karyawan::join('absensis', 'absensis.user_id', 'karyawans.user_id')
                                    ->join('karyawan_sift', 'karyawan_sift.karyawan_id', 'karyawans.id')
                                    ->join('sifts', 'karyawan_sift.sift_id', 'sifts.id')
                                    ->get();
                                    // dd($karyawanAbsen);

        return view('pages.absensi.index')->withBuffers($karyawanAbsen);

    }

    private function sendWhatsappNotification(string $status, string $tanggal, string $jam, string $recipient)
    {
        $twilio_whatsapp_number = "+14155238886";
        $account_sid = "ACa06c46c9adb1f92794b40a69e0e36aa2";
        $auth_token = "aa4471a99344e53aa0f38d8b1003a86e";

        $client = new Client($account_sid, $auth_token);
        $message = "Assalamualaikum.wr.wb\nKepada yth Bapak/Ibu $status memberitahukan bahwa pada hari ini tgl $tanggal jam $jam anda terlambat dalam melakukan absensi sidik jari, Akan lebih baik bila besok tidak diulangi lagi.\nTerima kasih.\nAsrama As-Tsalasunah";
        return $client->messages->create("whatsapp:$recipient", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
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
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *4
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    public function export()
    {
        return Excel::download(new AbsensiExport, date('d-m-Y') . '-data-absen.xlsx');
    }
}
