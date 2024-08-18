<?php
require 'config/connection.php';


function totalDataTraining(){
    global $con;
    return (int) mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM penerima_kis"))[0];
}


function jumlahDataKelas(){
    global $con;
    $query = "SELECT COUNT(*) FROM penerima_kis WHERE terima_kis=";

    $jumlahPenerimaKIS['ya'] = (int) mysqli_fetch_row(mysqli_query($con, $query . "'ya'"))[0];
    $jumlahPenerimaKIS['tidak'] = (int) mysqli_fetch_row(mysqli_query($con, $query . "'tidak'"))[0];
    return $jumlahPenerimaKIS;
}


function priorProbability(){
    
    $kelas['ya'] = jumlahDataKelas()['ya'] / totalDataTraining();
    $kelas['tidak'] = jumlahDataKelas()['tidak'] / totalDataTraining();
    return $kelas;
}


function conditionalProbability($nama_kolom, $nilai){
    global $con;
    $query = "SELECT COUNT($nama_kolom) FROM penerima_kis WHERE $nama_kolom = '$nilai' AND terima_kis=";
    $conditionalProbability['ya'] = (int) mysqli_fetch_row(mysqli_query($con, $query. "'ya'"))[0] / jumlahDataKelas()['ya'];
    $conditionalProbability['tidak'] = (int) mysqli_fetch_row(mysqli_query($con, $query. "'tidak'"))[0] / jumlahDataKelas()['tidak'];

    return $conditionalProbability;
}


function posteriorProbability($data){
    
    $atribut['usia'] = conditionalProbability('usia', $data['usia']);
    $atribut['pendidikan_terakhir'] = conditionalProbability('pendidikan_terakhir', $data['pendidikan_terakhir']);
    $atribut['pekerjaan'] = conditionalProbability('pekerjaan', $data['pekerjaan']);
    $atribut['pendapatan'] = conditionalProbability('pendapatan', $data['pendapatan']);
    $atribut['tanggungan_anak'] = conditionalProbability('tanggungan_anak', $data['tanggungan_anak']);

    
    $probabilitas['ya'] = $atribut['usia']['ya'] * $atribut['pendidikan_terakhir']['ya'] * $atribut['pekerjaan']['ya'] * $atribut['pendapatan']['ya'] * $atribut['tanggungan_anak']['ya'] * priorProbability()['ya'];
    $probabilitas['tidak'] = $atribut['usia']['tidak'] * $atribut['pendidikan_terakhir']['tidak'] * $atribut['pekerjaan']['tidak'] * $atribut['pendapatan']['tidak'] * $atribut['tanggungan_anak']['tidak'] * priorProbability()['tidak'];

    if ($probabilitas['ya'] > $probabilitas['tidak']){
        return 'Ya, Layak Menerima';
    } else if ($probabilitas['ya'] < $probabilitas['tidak']){
        return 'Tidak Layak Menerima';
    }
}