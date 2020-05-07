<?php


/**
 * membuat set active di tiap class yang diisi route
 * @param [type] $uri    [description]
 * @param string $output [description]
 * kt-menu__item--here remove for collapse menu
 */
function set_active($uri, $output = 'kt-menu__item--open')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

function set_active_submenu($uri, $output = '--active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

/**
 * membuat format mata uang rupiah
 * @param  [type] $angka [description]
 * @return [type]        [description]
 */
function currency_idr($angka)
{
    return "Rp. ".number_format($angka, 2, ',', '.');
}

/**
 * membuat format mata uang rupiah
 * @param  [type] $angka [description]
 * @return [type]        [description]
 */
function float_two($angka)
{
    return str_replace(',', '', number_format($angka, 2));
}


function pajak($nilai)
{
    $nilai2 = 0;
    $nilai1 = 0;
    $tunjangan = 0;
    $pajakbulan=1;
    $nilaikenapajak = $nilai;
    $sisapokok = $nilaikenapajak;
    $data_sdmprogresif = DB::select("select * from sdm_tbl_progressif order by awal asc");
    // SdmTblProgressif::orderBy('awal','asc');
    // $pph21ok = 0;
    foreach ($data_sdmprogresif as $data_prog) {
        $awal = $data_prog->awal;
        $akhir = $data_prog->akhir;
        $persen = $data_prog->prosen;
        $prosen = $persen/100;
        $range = $akhir - $awal;
        if ($sisapokok > 0) {
            $sisapokok1 = $sisapokok;
            if ($sisapokok1 > 0 and $sisapokok1 < $range) {
                $pph21r = $sisapokok1 * $prosen;
            } elseif ($sisapokok1 > 0 and $sisapokok1 >= $range) {
                $pph21r = $range * $prosen;
            } else {
                $pph21r = 0;
            }
        } else {
            $sisapokok1 = $sisapokok;
            $pph21r = 0;
        }
        $pph21ok =  $pph21r;
        $sisapokok = $sisapokok1 - $range;
        return   $pajakbulan = ($pph21ok/12);
    }
}

function hitunghari($awal,$akhir)
{
    $tglsekarang = strtotime($awal); 
    $jatuhtempo = strtotime($akhir);
    // hitung perbedaan  jatuh tempo dengan sekarang 
    $beda = $jatuhtempo - $tglsekarang; // unix time
    // konversi $beda kedalam hari
    return $bedahari = ($beda/24/60/60);
}

function stbbuku($sthnbln, $ssup)
{
    $data_rsbulan = DB::select("select * from timetrans where thnbln='$sthnbln' and suplesi='$ssup'");
    if(!empty($data_rsbulan)){
       return $stbbuku = 0;
    }else{
        foreach($data_rsbulan as $data_rs)
        {
            if($data_rs->status == 1){
               return $stbbuku = 1;
            }elseif($data_rs->status == 2){
               return $stbbuku = 2;
            }elseif($data_rs->status == 3){
               return $stbbuku = 3;
            }else{
               return $stbbuku = 0;
            }
        }
    }
}

function vbildb($vvals)
{
    if(is_null($vvals) or $vvals == 0){
        return $vbildb = 0;
    }else{
        $src = $vvals;
        return $vbildb = $src;
    }
}
    