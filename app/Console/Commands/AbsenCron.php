<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Device;
use App\Models\Karyawan;
use App\Models\Sift;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

class AbsenCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $device = Device::find(1);
        $Connect = fsockopen($device->ip, $device->port, $errno, $errstr, 1);
        if($Connect){
            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">". '0' ."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
        }else echo "Koneksi Gagal";
        $buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
        $buffer=explode("\r\n",$buffer);
        $shift = Sift::where('name', 'Pagi')->first();
        foreach ($buffer as $key => $item) {
            $absensi = Absensi::firstOrCreate([
                'user_id' =>  Parse_Data($item,"<PIN>","</PIN>"),
                'tanggal_absen' => Parse_Data($item,"<DateTime>","</DateTime>"),
                'verifikasi' => Parse_Data($item,"<Verified>","</Verified>"),
                'status' => Parse_Data($item,"<Status>","</Status>"),
            ]);

            $karyawan = Karyawan::where('user_id', $absensi->user_id)->first();

            if ($absensi->wasRecentlyCreated == true) {
                $status = null;
                if (strtotime(Str::substr($absensi->tanggal_absen, 11, 5)) < strtotime($shift->masuk) ) {
                    $status = 'tepat waktu';
                }else{
                    $status = 'terlambat';
                }
                $this->sendWhatsappNotification($karyawan->nama, $status, Str::substr($absensi->tanggal_absen, 0, 10), Str::substr($absensi->tanggal_absen, 11, 5), '+6281944999994');
            }

        }
    }

    private function sendWhatsappNotification(string $nama, string $status, string $tanggal, string $jam, string $recipient)
    {
        $twilio_whatsapp_number = "+14155238886";
        $account_sid = "ACa06c46c9adb1f92794b40a69e0e36aa2";
        $auth_token = "aa4471a99344e53aa0f38d8b1003a86e";

        $client = new Client($account_sid, $auth_token);
        $message = "Assalamualaikum.wr.wb\nKepada yth Bapak/Ibu *$nama* memberitahukan bahwa pada hari ini tgl $tanggal jam $jam anda $status dalam melakukan absensi sidik jari, Akan lebih baik bila besok tidak diulangi lagi.\nTerima kasih.\nAsrama As-Tsalasunah";
        return $client->messages->create("whatsapp:$recipient", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }

}
