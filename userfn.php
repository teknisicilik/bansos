<?php
namespace PHPMaker2020\bansos;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$val = date("Y|m", $lastmonth);
	$wrk = $FldExpression . " BETWEEN " .
		QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
		" AND " .
		QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
	return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0) {
	return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions
// Database Connecting event
function Database_Connecting(&$info) {

	// Example:
	//var_dump($info);
	//if ($info["id"] == "DB" && CurrentUserIP() == "127.0.0.1") { // Testing on local PC
	//	$info["host"] = "locahost";
	//	$info["user"] = "root";
	//	$info["pass"] = "";
	//}

}

// Database Connected event
function Database_Connected(&$conn) {

	// Example:
	//if ($conn->info["id"] == "DB")
	//	$conn->Execute("Your SQL");

}

function MenuItem_Adding($item) {

	//var_dump($item);
	// Return FALSE if menu item not allowed

	return TRUE;
}

function Menu_Rendering($menu) {

	// Change menu items here
}

function Menu_Rendered($menu) {

	// Clean up here
}

// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew) {

	//var_dump($rsnew);
	return TRUE;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row) {

	//echo "PersonalData Downloading";
}

// Personal Data Deleted event
function PersonalData_Deleted($row) {

	//echo "PersonalData Deleted";
}
if(!function_exists("get1row")){

	function get1row($sql){
		return ExecuteRow($sql);
	}
}
if(!function_exists("_query")){

	function _query($sqls){
		$c = [];
		$opts = ["mode" => DB_FETCH_ASSOC];
		return ExecuteRows($sqls, $c, $opts);
	}    
}

function provinsiId(){
	return '33'; // jawa tengah
}

function kabupatenId(){
	return '3374'; //kota semarang
}

function filterKelurahan(){
	return ' BETWEEN 3374010 AND 3374160';
}
$API_ACTIONS["getBantuanById"] = function (Request $request, Response $response) {
	$data = [];
	$nik = Param("nik");

	// Cek Nik
	if(!empty($nik)){

		// Ambil data warga 
		$sql = "SELECT 
					master_warga.*, 
					master_alamat.nama AS alamat, 
					master_alamat.rw AS rw, 
					master_alamat.rt AS rt, 
					master_warga.nik
				FROM 
					master_warga 
				INNER JOIN master_alamat ON master_warga.alamat_id = master_alamat.id
				WHERE master_warga.nik = $nik";
		$query = _query($sql);
		if(!empty($query)){
			$data['warga'] = $query[0];
			$kk = $query[0]['kk'];

			// $tahun = 'YEAR(CURDATE())';
			$tahun = '2021';

			// Ambil data bantuan 
			$sql_bantuan = "SELECT 	master_jenis_bantuan.nama AS jenis_bantuan, 
									master_bantuan.nama AS nama_bantuan, 
									master_bantuan.keterangan AS keterangan_bantuan,
									rekap_bantuan.kk_warga
							FROM rekap_bantuan 
							INNER JOIN master_jenis_bantuan ON rekap_bantuan.jenis_bantuan_id = master_jenis_bantuan.id 
							INNER JOIN master_bantuan ON rekap_bantuan.bansos_id = master_bantuan.id
							WHERE rekap_bantuan.kk_warga = $kk AND rekap_bantuan.tahun_bantuan = $tahun";
			$query_bantuan = _query($sql_bantuan);
			$data['bantuan'] = $query_bantuan;

			// print_r($query_bantuan);
			// die();

		}else{
			$data['warga'] = false;	
		}
	}else{
		$data = [];
	}

	// print_r($data);
	// die();

	return WriteJson($data);
};
$API_ACTIONS["getDataKecamatan"] = function (Request $request, Response $response) {
	$tahun = Param("tahun");
	$data = [];
	$get_kecamatan = _query("SELECT * FROM `kecamatan` WHERE idkabupaten = 3374 ");
	if (!empty($get_kecamatan)) {
		foreach ($get_kecamatan as $key => $kecamatan) {
			$nama_kecamatan = $kecamatan['nama'];
			$kecamatan_id = $kecamatan['id'];
			$data['nama_kecamatan'][] = $nama_kecamatan;
			$data['kecamatan_id'][] = $kecamatan_id;
			if (empty($tahun)) {
				$tahun = date("Y");
			}
			$get_total = get1row("SELECT count(*) AS total_bantuan FROM rekap_bantuan2 WHERE rekap_bantuan2.kecamatan_id = $kecamatan_id AND rekap_bantuan2.tahun = $tahun");
			$total = $get_total['total_bantuan'];
			$data['total_bantuan'][] = $total;
		}
	}
	return WriteJson($data);
};
$API_ACTIONS["getDataKelurahan"] = function (Request $request, Response $response) {
	$tahun = Param("tahun");
	$kecamatan_id = Param("kecamatan_id");
	$data = [];
	$get_kelurahan = _query("SELECT * FROM `desa` WHERE kecamatan_id = $kecamatan_id ");
	if (!empty($get_kelurahan)) {
		foreach ($get_kelurahan as $key => $kelurahan) {
			$nama_kelurahan = $kelurahan['nama'];
			$kelurahan_id = $kelurahan['id'];
			$data['nama_kelurahan'][] = $nama_kelurahan;
			$data['kelurahan_id'][] = $kelurahan_id;
			if (empty($tahun)) {
				$tahun = date("Y");
			}
			$get_total = get1row("SELECT count(*) AS total_bantuan FROM rekap_bantuan2 WHERE rekap_bantuan2.kelurahan_id = $kelurahan_id AND rekap_bantuan2.tahun = $tahun");
			$total = $get_total['total_bantuan'];
			$data['total_bantuan'][] = $total;
		}
	}
	return WriteJson($data);
};
$API_ACTIONS["getDataRw"] = function (Request $request, Response $response) {
	$tahun = Param("tahun");
	$kelurahan_id = Param("kelurahan_id");
	$data = [];
	$get_rw = _query("SELECT * FROM `rw` WHERE desa_id = $kelurahan_id ");
	if (!empty($get_rw)) {
		foreach ($get_rw as $key => $rw) {
			$nama_rw = $rw['nama'];
			$rw_id = $rw['id'];
			$data['nama_rw'][] = "Rw ".$nama_rw;
			$data['rw_id'][] = $rw_id;
			if(empty($tahun)){
				$tahun = date("Y");
			}
			$get_total = get1row("SELECT count(*) AS total_bantuan FROM rekap_bantuan2 WHERE rekap_bantuan2.rw_id = $rw_id AND rekap_bantuan2.tahun = $tahun");
			$total = $get_total['total_bantuan'];
			$data['total_bantuan'][] = $total;
		}
	}
	return WriteJson($data);
};
$API_ACTIONS["getDataRt"] = function (Request $request, Response $response) {
	$tahun = Param("tahun");
	$rw_id = Param("rw_id");
	$data = [];
	$get_rt = _query("SELECT * FROM `rt` WHERE rw_id = $rw_id");
	if (!empty($get_rt)) {
		foreach ($get_rt as $key => $rt) {
			$nama_rt = $rt['nama'];
			$rt_id = $rt['id'];
			$data['nama_rt'][] = "Rt " . $nama_rt;
			$data['rt_id'][] = $rt_id;
			if (empty($tahun)) {
				$tahun = date("Y");
			}
			$get_total = get1row("SELECT count(*) AS total_bantuan FROM rekap_bantuan2 WHERE rekap_bantuan2.rw_id = $rw_id AND rekap_bantuan2.rt_id = $rt_id AND rekap_bantuan2.tahun = $tahun");
			$total = $get_total['total_bantuan'];
			$data['total_bantuan'][] = $total;
		}
	}
	return WriteJson($data);
};
?>