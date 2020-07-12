<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            echo "Koneksi Gagal";
        }

        // include("parse.php");
        // $buffer=Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        // $buffer=explode("\r\n", $buffer);

        // for ($a=0;$a<count($buffer);$a++) {
        //     $data=Parse_Data($buffer[$a], "<Row>", "</Row>");
        //     $PIN=Parse_Data($data, "<PIN>", "</PIN>");
        //     $DateTime=Parse_Data($data, "<DateTime>", "</DateTime>");
        //     $Verified=Parse_Data($data, "<Verified>", "</Verified>");
        //     $Status=Parse_Data($data, "<Status>", "</Status>");

        //     if ($PIN <> '') {
        //         $data = "select count(*) as NUMBER_OF_ROWS from PDV_ABS_ABSENSI_LOG where userid = '$PIN' and tanggal = to_date('$DateTime', 'YYYY-MM-DD HH24:MI:SS') and status = '$Status'";
        //         $resultrecord = oci_parse($c1, $data);
        //         oci_define_by_name($resultrecord, 'NUMBER_OF_ROWS', $number_of_rows);
        //         oci_execute($resultrecord);
        //         oci_fetch($resultrecord);
        //         echo $number_of_rows;
        //         echo $PIN;
        //         echo $DateTime;

        //         if ($number_of_rows == '0') {
        //             $db1 = "insert into PDV_ABS_ABSENSI_LOG values ('$PIN',to_date('$DateTime', 'YYYY-MM-DD HH24:MI:SS'),to_date('$DateTime', 'YYYY-MM-DD HH24:MI:SS'),'$Status')";
        //             $result=oci_parse($c1, $db1);
        //             oci_execute($result);
        //         } else {
        //             echo "tidak";
        //         }
        //     }
        // }

        $data = [];

        return view('absensi_karyawan.index', compact('ip', 'key', 'data'));
    }
}
