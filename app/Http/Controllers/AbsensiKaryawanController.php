<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Absensi;

class AbsensiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ip = "192.168.16.201";
        $key = "0";
        return view('absensi_karyawan.index', compact('ip', 'key'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
        $absensi_list = Absensi::orderBy('tanggal', 'desc');

        return datatables()->of($absensi_list)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $ip = $request->ip_address;
        $key = $request->comm_key;

        $Connect = fsockopen($ip, "80", $errno, $errstr, 1);
        if ($Connect) {
            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while ($Response=fgets($Connect, 1024)) {
                $buffer=$buffer.$Response;
            }
        } else {
            return "Koneksi Gagal";
        }

        $buffer=$this->parseData($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer=explode("\r\n", $buffer);

        for ($a=0; $a < count($buffer); $a++) {
            $data = $this->parseData($buffer[$a], "<Row>", "</Row>");
            $PIN = $this->parseData($data, "<PIN>", "</PIN>");
            $DateTime = $this->parseData($data, "<DateTime>", "</DateTime>");
            $Verified = $this->parseData($data, "<Verified>", "</Verified>");
            $Status = $this->parseData($data, "<Status>", "</Status>");

            if ($PIN <> '') {
                $absensi = Absensi::where('userid', $PIN)
                ->where('tanggal', $DateTime)
                ->get();

                if ($absensi->count() == '0') {
                    // LAKUKAN INSERT
                    $absensi = new Absensi;
                    $absensi->userid = $PIN;
                    $absensi->tanggal  = $DateTime;
                    $absensi->verifikasi = $Verified;
                    $absensi->status = $Status;

                    $absensi->save();
                } else {
                    echo "tidak";
                }
            }
        }

        return view('absensi_karyawan.index', compact('ip', 'key'));
    }

    public function parseData($data, $p1, $p2)
    {
        $data=" ".$data;
        $hasil="";
        $awal=strpos($data, $p1);
        if ($awal!="") {
            $akhir=strpos(strstr($data, $p1), $p2);
            if ($akhir!="") {
                $hasil=substr($data, $awal+strlen($p1), $akhir-strlen($p1));
            }
        }
        return $hasil;
    }
}
