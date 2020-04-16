<?php

/**
 * membuat set active di tiap class yang diisi route
 * @param [type] $uri    [description]
 * @param string $output [description]
 */
function set_active($uri, $output = 'kt-menu__item--open kt-menu__item--here')
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
            $pph21r = 0;
        }
        $pph21ok =  $pph21r;
        $sisapokok = $sisapokok1 - $range;
        return   $pajakbulan = ($pph21ok/12);
    }
}
