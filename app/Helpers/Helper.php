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
