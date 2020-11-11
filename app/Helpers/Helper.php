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

/**
 * membuat format mata uang rupiah
 * @param  [type] $angka [description]
 * @return [type]        [description]
 */
function nominal_abs($angka)
{
    return number_format(abs($angka), 2);
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
    $pph21ok = 0;
    if ($sisapokok > 0) {
        $sisapokok1 = $sisapokok;
        if (($sisapokok1 > 0) and ($sisapokok1 < 50000000)) {
            $pph21r = $sisapokok1 * (5/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 < 250000000)) {
            $pph21r = $sisapokok1 * (15/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 < 500000000)) {
            $pph21r = $sisapokok1 * (25/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 >= 500000000)) {
            $pph21r = $sisapokok1 * (30/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif($sisapokok1 < 0) {
            $pph21r = 0;
            return $pajakbulanpt = ($pph21r);
        }
    } else {
        $sisapokok1 = $sisapokok;
        $pph21r = 0;
        return $pajakbulanpt = 0;
    }
}
function pph21ok($pokok)
{
    $pphrss=DB::select("select * from sdm_tbl_progressif order by awal asc");
    $pph21ok = 0;
    $sisapokok = $pokok; 
    if ($sisapokok > 0) {
        $sisapokok1 = $sisapokok;
        if (($sisapokok1 > 0) and ($sisapokok1 < 50000000)) {
            $pph21r = $sisapokok1 * (5/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 < 250000000)) {
            $pph21r = $sisapokok1 * (15/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 < 500000000)) {
            $pph21r = $sisapokok1 * (25/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif (($sisapokok1 > 0) and ($sisapokok1 >= 500000000)) {
            $pph21r = $sisapokok1 * (30/100);
            return $pajakbulanpt = ($pph21r/12);
        } elseif($sisapokok1 < 0) {
            $pph21r = 0;
            return $pajakbulanpt = ($pph21r);
        }
    } else {
        $sisapokok1 = $sisapokok;
        $pph21r = 0;
        return $pajakbulanpt = 0;
    }
}

function hitunghari($awal, $akhir)
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
    if (!empty($data_rsbulan)) {
        foreach ($data_rsbulan as $data_rs) {
            if ($data_rs->status == 1) {
                return $stbbuku = 1;
            } elseif ($data_rs->status == 2) {
                return $stbbuku = 2;
            } elseif ($data_rs->status == 3) {
                return $stbbuku = 3;
            } else {
                return $stbbuku = 0;
            }
        }
    } else {
        return $stbbuku = 0;
    }
}

function vbildb($vvals)
{
    if (is_null($vvals) or $vvals == 0) {
        return $vbildb = 0;
    } else {
        $src = $vvals;
        return $vbildb = $src;
    }
}

function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function pekerja_status($status)
{
    switch ($status) {
        case "P":
            return "Pensiun";
            break;
        case "C":
            return "Aktif";
            break;
        case "K":
            return "Kontrak";
            break;
        case "B":
            return "Perbantuan";
            break;
        case "D":
            return "Direksi";
            break;
        case "N":
            return "Pekerja Baru";
            break;
        case "U":
            return "Komisaris";
            break;
    }
}

function vf($tf)
{
    if (is_null($tf)) {
        return   $vf = "0";
    } else {
        return $vf = trim($tf);
    }
}

function stbbuku2($sthnbln, $ssup)
{
    $data_rsbulan = DB::select("select * from bulankontroller where thnbln='$sthnbln' and suplesi='$ssup'");
    if (!empty($data_rsbulan)) {
        foreach ($data_rsbulan as $data) {
            if ($data->status == 1) {
                return 'gtopening';
            } elseif ($data->status == 2) {
                return 'gtstopping';
            } elseif ($data->status == 3) {
                return 'gtclosing';
            } else {
                return 'gtnone';
            }
        }
    } else {
        return 'gtnone';
    }
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } elseif ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } elseif ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } elseif ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } elseif ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } elseif ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } elseif ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } elseif ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } elseif ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } elseif ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

// function konversi($x)
// {
//     $x = abs($x);
//     $angka = array("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
//     $temp = "";
    
//     if ($x < 12) {
//         $temp = " ".$angka[$x];
//     } elseif ($x<20) {
//         $temp = konversi($x - 10)." belas";
//     } elseif ($x<100) {
//         $temp = konversi($x/10)." puluh". konversi($x%10);
//     } elseif ($x<200) {
//         $temp = " seratus".konversi($x-100);
//     } elseif ($x<1000) {
//         $temp = konversi($x/100)." ratus".konversi($x%100);
//     } elseif ($x<2000) {
//         $temp = " seribu".konversi($x-1000);
//     } elseif ($x<1000000) {
//         $temp = konversi($x/1000)." ribu".konversi($x%1000);
//     } elseif ($x<1000000000) {
//         $temp = konversi($x/1000000)." juta".konversi($x%1000000);
//     } elseif ($x<1000000000000) {
//         $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
//     }
    
//     return $temp;
// }
    
// function tkoma($x)
// {
//     $str = stristr($x, ".");
//     $ex = explode('.', $x);

//     if (($ex[1]/10) >= 1) {
//         $a = abs($ex[1]);
//     }
//     $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
//     $temp = "";

//     $a2 = $ex[1]/10;
//     $pjg = strlen($str);
//     $i =1;
    

//     if ($a>=1 && $a< 12) {
//         $temp .= " ".$string[$a];
//     } elseif ($a>12 && $a < 20) {
//         $temp .= konversi($a - 10)." belas";
//     } elseif ($a>20 && $a<100) {
//         $temp .= konversi($a / 10)." puluh". konversi($a % 10);
//     } else {
//         if ($a2<1) {
//             while ($i<$pjg) {
//                 $char = substr($str, $i, 1);
//                 $i++;
//                 $temp .= " ".$string[$char];
//             }
//         }
//     }
//     return $temp;
// }
   
// function terbilang($x)
// {
//     if ($x<0) {
//         $hasil = "minus ".trim(konversi(x));
//     } else {
//         $poin = trim(tkoma($x));
//         $hasil = trim(konversi($x));
//     }

//     if ($poin) {
//         $hasil = $hasil." koma ".$poin;
//     } else {
//         $hasil = $hasil;
//     }
//     return $hasil;
// }
