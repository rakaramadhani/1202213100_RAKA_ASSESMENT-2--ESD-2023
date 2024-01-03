<?php
function rupiah($harga){
	$hasil_rupiah = "Rp." . number_format($harga,2,',',',');
	return $hasil_rupiah;
}
?>