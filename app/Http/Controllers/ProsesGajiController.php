<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SdmMasterPegawai;
use App\Models\TblPajak;
use App\Models\PayMasterUpah;
use DB;
use PDF;
use Excel;
use Alert;

class ProsesGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proses_gaji.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // return view('proses_gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->radioupah == 'proses'){
            $data_tahun = substr($request->tanggalupah,-4);
            $data_bulan = ltrim(substr($request->tanggalupah,0,-5), '0');
            $data=PayMasterUpah::where('tahun', $data_tahun)
            ->where('bulan',$data_bulan)
            ->where('nopek', 'LIKE','KOM%')->count();
            if($data >= 1 ){
                return redirect()->route('proses_gaji.index')->with(['proses' => 'proses']);
            }else{
                if($request->prosesupah == 'A'){
                        // PekerjaTetap()
                        $data_pegawai = SdmMasterPegawai::where('status','C')->orderBy('nopeg', 'asc')->get();
                        foreach($data_pegawai as $data)
                        {
                            // TblPajak::insert([
                            //     'tahun' => $data_tahun,
                            //     'bulan' => $data_bulan,
                            //     'nopeg' => $data->nopeg,
                            //     'status' => $data->kodekeluarga,        
                            //     ]); 

                            $data_sdmut = DB::select("select a.ut from sdm_ut a where a.nopeg='$data->nopeg' and a.mulai=(select max(mulai) from sdm_ut where nopeg='$data->nopeg')");
                            if(!empty($data_sdmut)){
                                    foreach($data_sdmut as $data_sdm)
                                    {
                                        $upahtetap = $data_sdm->ut;
                                    }
                            }else{
                                $upahtetap = '0';
                            }
                            $data_paymaster = PayMasterUpah::insert([
                                    'tahun' => $data_tahun,
                                    'bulan' => $data_bulan,
                                    'nopek' => $data->nopeg,
                                    'aard' => '01',        
                                    'jmlcc' => '0',        
                                    'ccl' => '0',        
                                    'nilai' => $upahtetap,        
                                    'userid' => $request->userid,        
                                    ]); 
                        }
                        // PekerjaKontrak()
                        // PekerjaBantu()
                        // Pengurus()
                        // Komite()
                        // PekerjaBaru()
                        // Alert::success('Data Berhasil Ditambah', 'Berhasil')->persistent(true)->autoClose(2000);
                        // return redirect()->route('proses_gaji.index');
                }elseif($request->prosesupah == 'C'){
                    // PekerjaTetap()
                }elseif($request->prosesupah == 'K'){
                    // PekerjaKontrak()
                }elseif($request->prosesupah == 'N'){
                    // PekerjaBaru()
                }elseif($request->prosesupah == 'B'){
                    // PekerjaBantu()
                }elseif($request->prosesupah == 'U'){
                    // Pengurus()
                }else{
                    // Komite()
                }
            }
        }else{
            return redirect()->route('proses_gaji.index')->with(['proses' => 'proses']);
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
}
