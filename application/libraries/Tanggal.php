<?php


class tanggal2
{
	function ind2($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.$pecah[1].$di.$pecah[0];
	}
	function indTempo($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.($pecah[1]+1).$di.$pecah[0];
	}
	function eng($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.$pecah[1].$di.$pecah[0];
	}
}

class tanggal
{
	function ind($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2];
	}
	function ind2($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.$pecah[1].$di.$pecah[0];
	}
	function indTempo($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.($pecah[1]+1).$di.$pecah[0];
	}
	function eng($id,$di)
	{
	$pecah=explode("-",$id);
	return $pecah[2].$di.$pecah[1].$di.$pecah[0];
	}

	 function selisih($awal,$akhir){ //Y-m-d
       $tglAwal = strtotime($awal);
       $tglAkhir = strtotime($akhir);
       $jeda = $tglAkhir - $tglAwal;
       return ($jeda/(60*60*24));
     }
	function namaHari($tanggal) //ymd
	{
	 	$day = date('D', strtotime($tanggal));
		$dayList = array(
    	'Sun' => 'M',
    	'Mon' => 'S',
    	'Tue' => 'SL',
    	'Wed' => 'R',
    	'Thu' => 'K',
    	'Fri' => 'J',
    	'Sat' => 'SB'
		);
		return $dayList[$day];
	}function hariLengkap($tanggal,$seperator)
	{
	$tgl=isset($tanggal)?($tanggal):"";
	if($tgl){ $tanggal;	}else { return 0; };
	 	$day = date('D', strtotime($tanggal));
		$dayList = array(
    	'Sun' => 'Minggu',
    	'Mon' => 'Senin',
    	'Tue' => 'Selasa',
    	'Wed' => 'Rabu',
    	'Thu' => 'Kamis',
    	'Fri' => 'Jumat',
    	'Sat' => 'Sabtu'
		);
		return $dayList[$day].", ".$this->ind2($tanggal,$seperator);
	}
	function jatuhTempo($tanggal,$seperator)
	{
	 	$day = date('D', strtotime($tanggal));
		$dayList = array(
    	'Sun' => 'Minggu',
    	'Mon' => 'Senin',
    	'Tue' => 'Selasa',
    	'Wed' => 'Rabu',
    	'Thu' => 'Kamis',
    	'Fri' => 'Jumat',
    	'Sat' => 'Sabtu'
		);
		return $dayList[$day].", ".$this->indTempo($tanggal,$seperator);
	}
	function bulan($bln)
	{
		if($bln==1){
		return "Januari";}
		elseif($bln==2){
		return "Februari";}
		elseif($bln==3){
		return "Maret";}
		elseif($bln==4){
		return "April";}
		elseif($bln==5){
		return "Mei";}
		elseif($bln==6){
		return "Juni";}
		elseif($bln==7){
		return "Juli";}
		elseif($bln==8){
		return "Agustus";}
		elseif($bln==9){
		return "September";}
		elseif($bln==10){
		return "Oktober";}
		elseif($bln==11){
		return "November";}
		elseif($bln==12){
		return "Desember";}

	}
	function bulanThn($id)
	{
	$data=explode("-",$id);
	$bln=$data[1];
	$thn=$data[0];
		if($bln==1){
		$dataBulan= "Januari";}
		elseif($bln==2){
		$dataBulan=  "Februari";}
		elseif($bln==3){
		$dataBulan=  "Maret";}
		elseif($bln==4){
		$dataBulan=  "April";}
		elseif($bln==5){
		$dataBulan=  "Mei";}
		elseif($bln==6){
		$dataBulan=  "Juni";}
		elseif($bln==7){
		$dataBulan=  "Juli";}
		elseif($bln==8){
		$dataBulan=  "Agustus";}
		elseif($bln==9){
		$dataBulan=  "September";}
		elseif($bln==10){
		$dataBulan=  "Oktober";}
		elseif($bln==11){
		$dataBulan=  "November";}
		elseif($bln==12){
		$dataBulan=  "Desember";}
		return $dataBulan."-".$thn;

	}
	function range($tgl,$seperator)
	{
	//03/30/2016 - 03/31/2016
		$tglORI=explode(" - ",$tgl);
		$tglAwal=explode("/",$tglORI[0]);
		$tgl1=$tglAwal[1]."-".$tglAwal[0]."-".$tglAwal[2];

		$tglAkhir=explode("/",$tglORI[1]);
		$tgl2=$tglAkhir[1]."-".$tglAkhir[0]."-".$tglAkhir[2];
	return $tgl1." ".$seperator." ".$tgl2;
	}

	function minBulan($tgl,$min)
	{
	return date('Y-m-d', strtotime('$min month', strtotime($tgl)));
	}

	function range1($tgl)
	{
	//03/30/2016 - 03/31/2016
		$tglORI=explode(" - ",$tgl);
		$tglAwal=explode("/",$tglORI[0]);
		$tgl1=$tglAwal[2]."-".$tglAwal[0]."-".$tglAwal[1];
		return $tgl1;
	}

	function range2($tgl)
	{
	//03/30/2016 - 03/31/2016
		$tglORI=explode(" - ",$tgl);
		$tglAwal=explode("/",$tglORI[1]);
		$tgl2=$tglAwal[2]."-".$tglAwal[0]."-".$tglAwal[1];
		return $tgl2;
	}

	function tomorrow($tgl)
	{
	$tglORI=explode("/",$tgl);
	$tanggal=$tglORI[0];
	return	$tgl-1;//=$tglORI[0]."/".$tglORI[1]."/".$tglORI[2];
	}

}
?>
