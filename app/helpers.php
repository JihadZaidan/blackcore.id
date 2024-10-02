<?php

if (! function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}

if (! function_exists('truncateString')) {
    function truncateString($str, $max) {
        if (strlen($str) > $max) {
            $str = substr($str, 0, $max);
            $str = trim($str);
            $str .= '...';
        }
        return $str;
    }
}