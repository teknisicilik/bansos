<?php namespace PHPMaker2020\bansos; ?>
<?php

/**
 * Table class for rekap_bantuan2
 */
class rekap_bantuan2 extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $bansos_id;
	public $warga_id;
	public $jenis_bantuan_id;
	public $type;
	public $jumlah;
	public $sumber_bantuan_id;
	public $pengambilan_bantuuan_id;
	public $frekuensi;
	public $bulan;
	public $tahun;
	public $keterangan_bantuan;
	public $status;
	public $kk;
	public $nik;
	public $nama;
	public $provinsi_id;
	public $kabupaten_id;
	public $kecamatan_id;
	public $kelurahan_id;
	public $rw_id;
	public $rt_id;
	public $alamat_id;
	public $nomor_rumah;
	public $status_warga_id;
	public $keterangan_warga;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'rekap_bantuan2';
		$this->TableName = 'rekap_bantuan2';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`rekap_bantuan2`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// bansos_id
		$this->bansos_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_bansos_id', 'bansos_id', '`bansos_id`', '`bansos_id`', 3, 11, -1, FALSE, '`bansos_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bansos_id->Nullable = FALSE; // NOT NULL field
		$this->bansos_id->Required = TRUE; // Required field
		$this->bansos_id->Sortable = TRUE; // Allow sort
		$this->bansos_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bansos_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->bansos_id->Lookup = new Lookup('bansos_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->bansos_id->Lookup = new Lookup('bansos_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->bansos_id->Lookup = new Lookup('bansos_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->bansos_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bansos_id'] = &$this->bansos_id;

		// warga_id
		$this->warga_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_warga_id', 'warga_id', '`warga_id`', '`warga_id`', 3, 11, -1, FALSE, '`EV__warga_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->warga_id->Nullable = FALSE; // NOT NULL field
		$this->warga_id->Required = TRUE; // Required field
		$this->warga_id->Sortable = TRUE; // Allow sort
		$this->warga_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->warga_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->warga_id->Lookup = new Lookup('warga_id', 'master_warga', FALSE, 'id', ["nik","nama","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->warga_id->Lookup = new Lookup('warga_id', 'master_warga', FALSE, 'id', ["nik","nama","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->warga_id->Lookup = new Lookup('warga_id', 'master_warga', FALSE, 'id', ["nik","nama","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->warga_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['warga_id'] = &$this->warga_id;

		// jenis_bantuan_id
		$this->jenis_bantuan_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_jenis_bantuan_id', 'jenis_bantuan_id', '`jenis_bantuan_id`', '`jenis_bantuan_id`', 3, 11, -1, FALSE, '`jenis_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenis_bantuan_id->Nullable = FALSE; // NOT NULL field
		$this->jenis_bantuan_id->Required = TRUE; // Required field
		$this->jenis_bantuan_id->Sortable = TRUE; // Allow sort
		$this->jenis_bantuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenis_bantuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->jenis_bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis_bantuan_id'] = &$this->jenis_bantuan_id;

		// type
		$this->type = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_type', 'type', '`type`', '`type`', 202, 1, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->type->Nullable = FALSE; // NOT NULL field
		$this->type->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->type->OptionCount = 2;
		$this->fields['type'] = &$this->type;

		// jumlah
		$this->jumlah = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 200, 100, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Nullable = FALSE; // NOT NULL field
		$this->jumlah->Required = TRUE; // Required field
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->fields['jumlah'] = &$this->jumlah;

		// sumber_bantuan_id
		$this->sumber_bantuan_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_sumber_bantuan_id', 'sumber_bantuan_id', '`sumber_bantuan_id`', '`sumber_bantuan_id`', 3, 11, -1, FALSE, '`sumber_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sumber_bantuan_id->Nullable = FALSE; // NOT NULL field
		$this->sumber_bantuan_id->Required = TRUE; // Required field
		$this->sumber_bantuan_id->Sortable = TRUE; // Allow sort
		$this->sumber_bantuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sumber_bantuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->sumber_bantuan_id->Lookup = new Lookup('sumber_bantuan_id', 'master_sumber_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->sumber_bantuan_id->Lookup = new Lookup('sumber_bantuan_id', 'master_sumber_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->sumber_bantuan_id->Lookup = new Lookup('sumber_bantuan_id', 'master_sumber_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->sumber_bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sumber_bantuan_id'] = &$this->sumber_bantuan_id;

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_pengambilan_bantuuan_id', 'pengambilan_bantuuan_id', '`pengambilan_bantuuan_id`', '`pengambilan_bantuuan_id`', 3, 11, -1, FALSE, '`pengambilan_bantuuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pengambilan_bantuuan_id->Nullable = FALSE; // NOT NULL field
		$this->pengambilan_bantuuan_id->Required = TRUE; // Required field
		$this->pengambilan_bantuuan_id->Sortable = TRUE; // Allow sort
		$this->pengambilan_bantuuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pengambilan_bantuuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->pengambilan_bantuuan_id->Lookup = new Lookup('pengambilan_bantuuan_id', 'master_pengambilan_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->pengambilan_bantuuan_id->Lookup = new Lookup('pengambilan_bantuuan_id', 'master_pengambilan_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->pengambilan_bantuuan_id->Lookup = new Lookup('pengambilan_bantuuan_id', 'master_pengambilan_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->pengambilan_bantuuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pengambilan_bantuuan_id'] = &$this->pengambilan_bantuuan_id;

		// frekuensi
		$this->frekuensi = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_frekuensi', 'frekuensi', '`frekuensi`', '`frekuensi`', 200, 100, -1, FALSE, '`frekuensi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->frekuensi->Nullable = FALSE; // NOT NULL field
		$this->frekuensi->Required = TRUE; // Required field
		$this->frekuensi->Sortable = TRUE; // Allow sort
		$this->fields['frekuensi'] = &$this->frekuensi;

		// bulan
		$this->bulan = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_bulan', 'bulan', '`bulan`', '`bulan`', 200, 10, -1, FALSE, '`bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bulan->Nullable = FALSE; // NOT NULL field
		$this->bulan->Required = TRUE; // Required field
		$this->bulan->Sortable = TRUE; // Allow sort
		$this->bulan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bulan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->bulan->Lookup = new Lookup('bulan', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->bulan->Lookup = new Lookup('bulan', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->bulan->Lookup = new Lookup('bulan', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->bulan->OptionCount = 12;
		$this->fields['bulan'] = &$this->bulan;

		// tahun
		$this->tahun = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_tahun', 'tahun', '`tahun`', '`tahun`', 3, 11, -1, FALSE, '`tahun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun->Nullable = FALSE; // NOT NULL field
		$this->tahun->Required = TRUE; // Required field
		$this->tahun->Sortable = TRUE; // Allow sort
		$this->tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun'] = &$this->tahun;

		// keterangan_bantuan
		$this->keterangan_bantuan = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_keterangan_bantuan', 'keterangan_bantuan', '`keterangan_bantuan`', '`keterangan_bantuan`', 201, 65535, -1, FALSE, '`keterangan_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_bantuan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan_bantuan'] = &$this->keterangan_bantuan;

		// status
		$this->status = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->status->Lookup = new Lookup('status', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'rekap_bantuan2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status->OptionCount = 3;
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// kk
		$this->kk = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_kk', 'kk', '`kk`', '`kk`', 200, 100, -1, FALSE, '`kk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kk->Nullable = FALSE; // NOT NULL field
		$this->kk->Required = TRUE; // Required field
		$this->kk->Sortable = TRUE; // Allow sort
		$this->kk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kk'] = &$this->kk;

		// nik
		$this->nik = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_nik', 'nik', '`nik`', '`nik`', 20, 16, -1, FALSE, '`nik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik->Nullable = FALSE; // NOT NULL field
		$this->nik->Required = TRUE; // Required field
		$this->nik->Sortable = TRUE; // Allow sort
		$this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nik'] = &$this->nik;

		// nama
		$this->nama = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_nama', 'nama', '`nama`', '`nama`', 200, 100, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Nullable = FALSE; // NOT NULL field
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// provinsi_id
		$this->provinsi_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_provinsi_id', 'provinsi_id', '`provinsi_id`', '`provinsi_id`', 20, 20, -1, FALSE, '`provinsi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->provinsi_id->Nullable = FALSE; // NOT NULL field
		$this->provinsi_id->Required = TRUE; // Required field
		$this->provinsi_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->provinsi_id->Lookup = new Lookup('provinsi_id', 'provinsi', FALSE, 'id', ["nama","","",""], [], ["x_kabupaten_id"], [], [], [], [], '', '');
				break;
			case "id":
				$this->provinsi_id->Lookup = new Lookup('provinsi_id', 'provinsi', FALSE, 'id', ["nama","","",""], [], ["x_kabupaten_id"], [], [], [], [], '', '');
				break;
			default:
				$this->provinsi_id->Lookup = new Lookup('provinsi_id', 'provinsi', FALSE, 'id', ["nama","","",""], [], ["x_kabupaten_id"], [], [], [], [], '', '');
				break;
		}
		$this->provinsi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['provinsi_id'] = &$this->provinsi_id;

		// kabupaten_id
		$this->kabupaten_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_kabupaten_id', 'kabupaten_id', '`kabupaten_id`', '`kabupaten_id`', 20, 20, -1, FALSE, '`kabupaten_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kabupaten_id->Nullable = FALSE; // NOT NULL field
		$this->kabupaten_id->Required = TRUE; // Required field
		$this->kabupaten_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->kabupaten_id->Lookup = new Lookup('kabupaten_id', 'kabupaten', FALSE, 'id', ["nama","","",""], ["x_provinsi_id"], [], ["provinsi_id"], ["x_provinsi_id"], [], [], '', '');
				break;
			case "id":
				$this->kabupaten_id->Lookup = new Lookup('kabupaten_id', 'kabupaten', FALSE, 'id', ["nama","","",""], ["x_provinsi_id"], [], ["provinsi_id"], ["x_provinsi_id"], [], [], '', '');
				break;
			default:
				$this->kabupaten_id->Lookup = new Lookup('kabupaten_id', 'kabupaten', FALSE, 'id', ["nama","","",""], ["x_provinsi_id"], [], ["provinsi_id"], ["x_provinsi_id"], [], [], '', '');
				break;
		}
		$this->kabupaten_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kabupaten_id'] = &$this->kabupaten_id;

		// kecamatan_id
		$this->kecamatan_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_kecamatan_id', 'kecamatan_id', '`kecamatan_id`', '`kecamatan_id`', 20, 20, -1, FALSE, '`kecamatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kecamatan_id->Nullable = FALSE; // NOT NULL field
		$this->kecamatan_id->Required = TRUE; // Required field
		$this->kecamatan_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->kecamatan_id->Lookup = new Lookup('kecamatan_id', 'kecamatan', FALSE, 'id', ["nama","","",""], [], ["x_kelurahan_id"], [], [], [], [], '', '');
				break;
			case "id":
				$this->kecamatan_id->Lookup = new Lookup('kecamatan_id', 'kecamatan', FALSE, 'id', ["nama","","",""], [], ["x_kelurahan_id"], [], [], [], [], '', '');
				break;
			default:
				$this->kecamatan_id->Lookup = new Lookup('kecamatan_id', 'kecamatan', FALSE, 'id', ["nama","","",""], [], ["x_kelurahan_id"], [], [], [], [], '', '');
				break;
		}
		$this->kecamatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kecamatan_id'] = &$this->kecamatan_id;

		// kelurahan_id
		$this->kelurahan_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_kelurahan_id', 'kelurahan_id', '`kelurahan_id`', '`kelurahan_id`', 20, 20, -1, FALSE, '`kelurahan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kelurahan_id->Nullable = FALSE; // NOT NULL field
		$this->kelurahan_id->Required = TRUE; // Required field
		$this->kelurahan_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->kelurahan_id->Lookup = new Lookup('kelurahan_id', 'desa', FALSE, 'id', ["nama","","",""], ["x_kecamatan_id"], ["x_rw_id"], ["kecamatan_id"], ["x_kecamatan_id"], [], [], '', '');
				break;
			case "id":
				$this->kelurahan_id->Lookup = new Lookup('kelurahan_id', 'desa', FALSE, 'id', ["nama","","",""], ["x_kecamatan_id"], ["x_rw_id"], ["kecamatan_id"], ["x_kecamatan_id"], [], [], '', '');
				break;
			default:
				$this->kelurahan_id->Lookup = new Lookup('kelurahan_id', 'desa', FALSE, 'id', ["nama","","",""], ["x_kecamatan_id"], ["x_rw_id"], ["kecamatan_id"], ["x_kecamatan_id"], [], [], '', '');
				break;
		}
		$this->kelurahan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kelurahan_id'] = &$this->kelurahan_id;

		// rw_id
		$this->rw_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_rw_id', 'rw_id', '`rw_id`', '`rw_id`', 20, 20, -1, FALSE, '`rw_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rw_id->Nullable = FALSE; // NOT NULL field
		$this->rw_id->Required = TRUE; // Required field
		$this->rw_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->rw_id->Lookup = new Lookup('rw_id', 'rw', FALSE, 'id', ["nama","","",""], ["x_kelurahan_id"], ["x_rt_id"], ["desa_id"], ["x_desa_id"], [], [], '', '');
				break;
			case "id":
				$this->rw_id->Lookup = new Lookup('rw_id', 'rw', FALSE, 'id', ["nama","","",""], ["x_kelurahan_id"], ["x_rt_id"], ["desa_id"], ["x_desa_id"], [], [], '', '');
				break;
			default:
				$this->rw_id->Lookup = new Lookup('rw_id', 'rw', FALSE, 'id', ["nama","","",""], ["x_kelurahan_id"], ["x_rt_id"], ["desa_id"], ["x_desa_id"], [], [], '', '');
				break;
		}
		$this->rw_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rw_id'] = &$this->rw_id;

		// rt_id
		$this->rt_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_rt_id', 'rt_id', '`rt_id`', '`rt_id`', 20, 20, -1, FALSE, '`rt_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rt_id->Nullable = FALSE; // NOT NULL field
		$this->rt_id->Required = TRUE; // Required field
		$this->rt_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->rt_id->Lookup = new Lookup('rt_id', 'rt', FALSE, 'id', ["nama","","",""], ["x_rw_id"], ["x_alamat_id"], ["rw_id"], ["x_rw_id"], [], [], '', '');
				break;
			case "id":
				$this->rt_id->Lookup = new Lookup('rt_id', 'rt', FALSE, 'id', ["nama","","",""], ["x_rw_id"], ["x_alamat_id"], ["rw_id"], ["x_rw_id"], [], [], '', '');
				break;
			default:
				$this->rt_id->Lookup = new Lookup('rt_id', 'rt', FALSE, 'id', ["nama","","",""], ["x_rw_id"], ["x_alamat_id"], ["rw_id"], ["x_rw_id"], [], [], '', '');
				break;
		}
		$this->rt_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rt_id'] = &$this->rt_id;

		// alamat_id
		$this->alamat_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_alamat_id', 'alamat_id', '`alamat_id`', '`alamat_id`', 3, 11, -1, FALSE, '`alamat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat_id->Nullable = FALSE; // NOT NULL field
		$this->alamat_id->Required = TRUE; // Required field
		$this->alamat_id->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->alamat_id->Lookup = new Lookup('alamat_id', 'master_alamat', FALSE, 'id', ["nama","","",""], ["x_rt_id"], [], ["rt_id"], ["x_rt_id"], [], [], '', '');
				break;
			case "id":
				$this->alamat_id->Lookup = new Lookup('alamat_id', 'master_alamat', FALSE, 'id', ["nama","","",""], ["x_rt_id"], [], ["rt_id"], ["x_rt_id"], [], [], '', '');
				break;
			default:
				$this->alamat_id->Lookup = new Lookup('alamat_id', 'master_alamat', FALSE, 'id', ["nama","","",""], ["x_rt_id"], [], ["rt_id"], ["x_rt_id"], [], [], '', '');
				break;
		}
		$this->alamat_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['alamat_id'] = &$this->alamat_id;

		// nomor_rumah
		$this->nomor_rumah = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_nomor_rumah', 'nomor_rumah', '`nomor_rumah`', '`nomor_rumah`', 200, 10, -1, FALSE, '`nomor_rumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_rumah->Nullable = FALSE; // NOT NULL field
		$this->nomor_rumah->Required = TRUE; // Required field
		$this->nomor_rumah->Sortable = TRUE; // Allow sort
		$this->fields['nomor_rumah'] = &$this->nomor_rumah;

		// status_warga_id
		$this->status_warga_id = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_status_warga_id', 'status_warga_id', '`status_warga_id`', '`status_warga_id`', 3, 11, -1, FALSE, '`status_warga_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_warga_id->Sortable = TRUE; // Allow sort
		$this->status_warga_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_warga_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_warga_id->Lookup = new Lookup('status_warga_id', 'master_status_warga', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->status_warga_id->Lookup = new Lookup('status_warga_id', 'master_status_warga', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status_warga_id->Lookup = new Lookup('status_warga_id', 'master_status_warga', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status_warga_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->status_warga_id->AdvancedSearch->SearchValueDefault = 1;
		$this->status_warga_id->AdvancedSearch->SearchOperatorDefault = "=";
		$this->status_warga_id->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->status_warga_id->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['status_warga_id'] = &$this->status_warga_id;

		// keterangan_warga
		$this->keterangan_warga = new DbField('rekap_bantuan2', 'rekap_bantuan2', 'x_keterangan_warga', 'keterangan_warga', '`keterangan_warga`', '`keterangan_warga`', 201, 65535, -1, FALSE, '`keterangan_warga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_warga->Sortable = TRUE; // Allow sort
		$this->fields['keterangan_warga'] = &$this->keterangan_warga;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`rekap_bantuan2`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		global $CurrentLanguage;
		switch ($CurrentLanguage) {
			case "en":
				$select = "SELECT * FROM (" .
					"SELECT *,  FROM `rekap_bantuan2`" .
					") `TMP_TABLE`";
				break;
			case "id":
				$select = "SELECT * FROM (" .
					"SELECT *,  FROM `rekap_bantuan2`" .
					") `TMP_TABLE`";
				break;
			default:
				$select = "SELECT * FROM (" .
					"SELECT *,  FROM `rekap_bantuan2`" .
					") `TMP_TABLE`";
				break;
		}
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->warga_id->AdvancedSearch->SearchValue != "" ||
			$this->warga_id->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->warga_id->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->warga_id->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->bansos_id->DbValue = $row['bansos_id'];
		$this->warga_id->DbValue = $row['warga_id'];
		$this->jenis_bantuan_id->DbValue = $row['jenis_bantuan_id'];
		$this->type->DbValue = $row['type'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->sumber_bantuan_id->DbValue = $row['sumber_bantuan_id'];
		$this->pengambilan_bantuuan_id->DbValue = $row['pengambilan_bantuuan_id'];
		$this->frekuensi->DbValue = $row['frekuensi'];
		$this->bulan->DbValue = $row['bulan'];
		$this->tahun->DbValue = $row['tahun'];
		$this->keterangan_bantuan->DbValue = $row['keterangan_bantuan'];
		$this->status->DbValue = $row['status'];
		$this->kk->DbValue = $row['kk'];
		$this->nik->DbValue = $row['nik'];
		$this->nama->DbValue = $row['nama'];
		$this->provinsi_id->DbValue = $row['provinsi_id'];
		$this->kabupaten_id->DbValue = $row['kabupaten_id'];
		$this->kecamatan_id->DbValue = $row['kecamatan_id'];
		$this->kelurahan_id->DbValue = $row['kelurahan_id'];
		$this->rw_id->DbValue = $row['rw_id'];
		$this->rt_id->DbValue = $row['rt_id'];
		$this->alamat_id->DbValue = $row['alamat_id'];
		$this->nomor_rumah->DbValue = $row['nomor_rumah'];
		$this->status_warga_id->DbValue = $row['status_warga_id'];
		$this->keterangan_warga->DbValue = $row['keterangan_warga'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "rekap_bantuan2list.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "rekap_bantuan2view.php")
			return $Language->phrase("View");
		elseif ($pageName == "rekap_bantuan2edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "rekap_bantuan2add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "rekap_bantuan2list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("rekap_bantuan2view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("rekap_bantuan2view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "rekap_bantuan2add.php?" . $this->getUrlParm($parm);
		else
			$url = "rekap_bantuan2add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("rekap_bantuan2edit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("rekap_bantuan2add.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("rekap_bantuan2delete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->bansos_id->setDbValue($rs->fields('bansos_id'));
		$this->warga_id->setDbValue($rs->fields('warga_id'));
		$this->jenis_bantuan_id->setDbValue($rs->fields('jenis_bantuan_id'));
		$this->type->setDbValue($rs->fields('type'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->sumber_bantuan_id->setDbValue($rs->fields('sumber_bantuan_id'));
		$this->pengambilan_bantuuan_id->setDbValue($rs->fields('pengambilan_bantuuan_id'));
		$this->frekuensi->setDbValue($rs->fields('frekuensi'));
		$this->bulan->setDbValue($rs->fields('bulan'));
		$this->tahun->setDbValue($rs->fields('tahun'));
		$this->keterangan_bantuan->setDbValue($rs->fields('keterangan_bantuan'));
		$this->status->setDbValue($rs->fields('status'));
		$this->kk->setDbValue($rs->fields('kk'));
		$this->nik->setDbValue($rs->fields('nik'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->provinsi_id->setDbValue($rs->fields('provinsi_id'));
		$this->kabupaten_id->setDbValue($rs->fields('kabupaten_id'));
		$this->kecamatan_id->setDbValue($rs->fields('kecamatan_id'));
		$this->kelurahan_id->setDbValue($rs->fields('kelurahan_id'));
		$this->rw_id->setDbValue($rs->fields('rw_id'));
		$this->rt_id->setDbValue($rs->fields('rt_id'));
		$this->alamat_id->setDbValue($rs->fields('alamat_id'));
		$this->nomor_rumah->setDbValue($rs->fields('nomor_rumah'));
		$this->status_warga_id->setDbValue($rs->fields('status_warga_id'));
		$this->keterangan_warga->setDbValue($rs->fields('keterangan_warga'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// bansos_id
		// warga_id
		// jenis_bantuan_id
		// type
		// jumlah
		// sumber_bantuan_id
		// pengambilan_bantuuan_id
		// frekuensi
		// bulan
		// tahun
		// keterangan_bantuan
		// status
		// kk
		// nik
		// nama
		// provinsi_id
		// kabupaten_id
		// kecamatan_id
		// kelurahan_id
		// rw_id
		// rt_id
		// alamat_id
		// nomor_rumah
		// status_warga_id
		// keterangan_warga
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// bansos_id
		$curVal = strval($this->bansos_id->CurrentValue);
		if ($curVal != "") {
			$this->bansos_id->ViewValue = $this->bansos_id->lookupCacheOption($curVal);
			if ($this->bansos_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`na` = 'n'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->bansos_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->bansos_id->ViewValue = $this->bansos_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bansos_id->ViewValue = $this->bansos_id->CurrentValue;
				}
			}
		} else {
			$this->bansos_id->ViewValue = NULL;
		}
		$this->bansos_id->ViewCustomAttributes = "";

		// warga_id
		if ($this->warga_id->VirtualValue != "") {
			$this->warga_id->ViewValue = $this->warga_id->VirtualValue;
		} else {
			$curVal = strval($this->warga_id->CurrentValue);
			if ($curVal != "") {
				$this->warga_id->ViewValue = $this->warga_id->lookupCacheOption($curVal);
				if ($this->warga_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->warga_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->warga_id->ViewValue = $this->warga_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->warga_id->ViewValue = $this->warga_id->CurrentValue;
					}
				}
			} else {
				$this->warga_id->ViewValue = NULL;
			}
		}
		$this->warga_id->ViewCustomAttributes = "";

		// jenis_bantuan_id
		$curVal = strval($this->jenis_bantuan_id->CurrentValue);
		if ($curVal != "") {
			$this->jenis_bantuan_id->ViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
			if ($this->jenis_bantuan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`na` = 'n'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->jenis_bantuan_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jenis_bantuan_id->ViewValue = $this->jenis_bantuan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jenis_bantuan_id->ViewValue = $this->jenis_bantuan_id->CurrentValue;
				}
			}
		} else {
			$this->jenis_bantuan_id->ViewValue = NULL;
		}
		$this->jenis_bantuan_id->ViewCustomAttributes = "";

		// type
		if (strval($this->type->CurrentValue) != "") {
			$this->type->ViewValue = $this->type->optionCaption($this->type->CurrentValue);
		} else {
			$this->type->ViewValue = NULL;
		}
		$this->type->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewCustomAttributes = "";

		// sumber_bantuan_id
		$curVal = strval($this->sumber_bantuan_id->CurrentValue);
		if ($curVal != "") {
			$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->lookupCacheOption($curVal);
			if ($this->sumber_bantuan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->sumber_bantuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->CurrentValue;
				}
			}
		} else {
			$this->sumber_bantuan_id->ViewValue = NULL;
		}
		$this->sumber_bantuan_id->ViewCustomAttributes = "";

		// pengambilan_bantuuan_id
		$curVal = strval($this->pengambilan_bantuuan_id->CurrentValue);
		if ($curVal != "") {
			$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->lookupCacheOption($curVal);
			if ($this->pengambilan_bantuuan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pengambilan_bantuuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->CurrentValue;
				}
			}
		} else {
			$this->pengambilan_bantuuan_id->ViewValue = NULL;
		}
		$this->pengambilan_bantuuan_id->ViewCustomAttributes = "";

		// frekuensi
		$this->frekuensi->ViewValue = $this->frekuensi->CurrentValue;
		$this->frekuensi->ViewCustomAttributes = "";

		// bulan
		if (strval($this->bulan->CurrentValue) != "") {
			$this->bulan->ViewValue = $this->bulan->optionCaption($this->bulan->CurrentValue);
		} else {
			$this->bulan->ViewValue = NULL;
		}
		$this->bulan->ViewCustomAttributes = "";

		// tahun
		$this->tahun->ViewValue = $this->tahun->CurrentValue;
		$this->tahun->ViewCustomAttributes = "";

		// keterangan_bantuan
		$this->keterangan_bantuan->ViewValue = $this->keterangan_bantuan->CurrentValue;
		$this->keterangan_bantuan->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// kk
		$this->kk->ViewValue = $this->kk->CurrentValue;
		$this->kk->ViewCustomAttributes = "";

		// nik
		$this->nik->ViewValue = $this->nik->CurrentValue;
		$this->nik->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// provinsi_id
		$this->provinsi_id->ViewValue = $this->provinsi_id->CurrentValue;
		$curVal = strval($this->provinsi_id->CurrentValue);
		if ($curVal != "") {
			$this->provinsi_id->ViewValue = $this->provinsi_id->lookupCacheOption($curVal);
			if ($this->provinsi_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`id` = ".provinsiId()."";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->provinsi_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->provinsi_id->ViewValue = $this->provinsi_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->provinsi_id->ViewValue = $this->provinsi_id->CurrentValue;
				}
			}
		} else {
			$this->provinsi_id->ViewValue = NULL;
		}
		$this->provinsi_id->ViewCustomAttributes = "";

		// kabupaten_id
		$this->kabupaten_id->ViewValue = $this->kabupaten_id->CurrentValue;
		$curVal = strval($this->kabupaten_id->CurrentValue);
		if ($curVal != "") {
			$this->kabupaten_id->ViewValue = $this->kabupaten_id->lookupCacheOption($curVal);
			if ($this->kabupaten_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`id` = ".kabupatenId()."";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->kabupaten_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kabupaten_id->ViewValue = $this->kabupaten_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kabupaten_id->ViewValue = $this->kabupaten_id->CurrentValue;
				}
			}
		} else {
			$this->kabupaten_id->ViewValue = NULL;
		}
		$this->kabupaten_id->ViewCustomAttributes = "";

		// kecamatan_id
		$this->kecamatan_id->ViewValue = $this->kecamatan_id->CurrentValue;
		$curVal = strval($this->kecamatan_id->CurrentValue);
		if ($curVal != "") {
			$this->kecamatan_id->ViewValue = $this->kecamatan_id->lookupCacheOption($curVal);
			if ($this->kecamatan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`idkabupaten` = ".kabupatenId()."";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->kecamatan_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kecamatan_id->ViewValue = $this->kecamatan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kecamatan_id->ViewValue = $this->kecamatan_id->CurrentValue;
				}
			}
		} else {
			$this->kecamatan_id->ViewValue = NULL;
		}
		$this->kecamatan_id->ViewCustomAttributes = "";

		// kelurahan_id
		$this->kelurahan_id->ViewValue = $this->kelurahan_id->CurrentValue;
		$curVal = strval($this->kelurahan_id->CurrentValue);
		if ($curVal != "") {
			$this->kelurahan_id->ViewValue = $this->kelurahan_id->lookupCacheOption($curVal);
			if ($this->kelurahan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`kecamatan_id` ".filterKelurahan()."";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->kelurahan_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kelurahan_id->ViewValue = $this->kelurahan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kelurahan_id->ViewValue = $this->kelurahan_id->CurrentValue;
				}
			}
		} else {
			$this->kelurahan_id->ViewValue = NULL;
		}
		$this->kelurahan_id->ViewCustomAttributes = "";

		// rw_id
		$this->rw_id->ViewValue = $this->rw_id->CurrentValue;
		$curVal = strval($this->rw_id->CurrentValue);
		if ($curVal != "") {
			$this->rw_id->ViewValue = $this->rw_id->lookupCacheOption($curVal);
			if ($this->rw_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->rw_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->rw_id->ViewValue = $this->rw_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->rw_id->ViewValue = $this->rw_id->CurrentValue;
				}
			}
		} else {
			$this->rw_id->ViewValue = NULL;
		}
		$this->rw_id->ViewCustomAttributes = "";

		// rt_id
		$this->rt_id->ViewValue = $this->rt_id->CurrentValue;
		$curVal = strval($this->rt_id->CurrentValue);
		if ($curVal != "") {
			$this->rt_id->ViewValue = $this->rt_id->lookupCacheOption($curVal);
			if ($this->rt_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->rt_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->rt_id->ViewValue = $this->rt_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->rt_id->ViewValue = $this->rt_id->CurrentValue;
				}
			}
		} else {
			$this->rt_id->ViewValue = NULL;
		}
		$this->rt_id->ViewCustomAttributes = "";

		// alamat_id
		$this->alamat_id->ViewValue = $this->alamat_id->CurrentValue;
		$curVal = strval($this->alamat_id->CurrentValue);
		if ($curVal != "") {
			$this->alamat_id->ViewValue = $this->alamat_id->lookupCacheOption($curVal);
			if ($this->alamat_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`na` = 'n'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->alamat_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->alamat_id->ViewValue = $this->alamat_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->alamat_id->ViewValue = $this->alamat_id->CurrentValue;
				}
			}
		} else {
			$this->alamat_id->ViewValue = NULL;
		}
		$this->alamat_id->ViewCustomAttributes = "";

		// nomor_rumah
		$this->nomor_rumah->ViewValue = $this->nomor_rumah->CurrentValue;
		$this->nomor_rumah->ViewCustomAttributes = "";

		// status_warga_id
		$curVal = strval($this->status_warga_id->CurrentValue);
		if ($curVal != "") {
			$this->status_warga_id->ViewValue = $this->status_warga_id->lookupCacheOption($curVal);
			if ($this->status_warga_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status_warga_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->status_warga_id->ViewValue = $this->status_warga_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status_warga_id->ViewValue = $this->status_warga_id->CurrentValue;
				}
			}
		} else {
			$this->status_warga_id->ViewValue = NULL;
		}
		$this->status_warga_id->ViewCustomAttributes = "";

		// keterangan_warga
		$this->keterangan_warga->ViewValue = $this->keterangan_warga->CurrentValue;
		$this->keterangan_warga->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// bansos_id
		$this->bansos_id->LinkCustomAttributes = "";
		$this->bansos_id->HrefValue = "";
		$this->bansos_id->TooltipValue = "";

		// warga_id
		$this->warga_id->LinkCustomAttributes = "";
		$this->warga_id->HrefValue = "";
		$this->warga_id->TooltipValue = "";

		// jenis_bantuan_id
		$this->jenis_bantuan_id->LinkCustomAttributes = "";
		$this->jenis_bantuan_id->HrefValue = "";
		$this->jenis_bantuan_id->TooltipValue = "";

		// type
		$this->type->LinkCustomAttributes = "";
		$this->type->HrefValue = "";
		$this->type->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

		// sumber_bantuan_id
		$this->sumber_bantuan_id->LinkCustomAttributes = "";
		$this->sumber_bantuan_id->HrefValue = "";
		$this->sumber_bantuan_id->TooltipValue = "";

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id->LinkCustomAttributes = "";
		$this->pengambilan_bantuuan_id->HrefValue = "";
		$this->pengambilan_bantuuan_id->TooltipValue = "";

		// frekuensi
		$this->frekuensi->LinkCustomAttributes = "";
		$this->frekuensi->HrefValue = "";
		$this->frekuensi->TooltipValue = "";

		// bulan
		$this->bulan->LinkCustomAttributes = "";
		$this->bulan->HrefValue = "";
		$this->bulan->TooltipValue = "";

		// tahun
		$this->tahun->LinkCustomAttributes = "";
		$this->tahun->HrefValue = "";
		$this->tahun->TooltipValue = "";

		// keterangan_bantuan
		$this->keterangan_bantuan->LinkCustomAttributes = "";
		$this->keterangan_bantuan->HrefValue = "";
		$this->keterangan_bantuan->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// kk
		$this->kk->LinkCustomAttributes = "";
		$this->kk->HrefValue = "";
		$this->kk->TooltipValue = "";

		// nik
		$this->nik->LinkCustomAttributes = "";
		$this->nik->HrefValue = "";
		$this->nik->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// provinsi_id
		$this->provinsi_id->LinkCustomAttributes = "";
		$this->provinsi_id->HrefValue = "";
		$this->provinsi_id->TooltipValue = "";

		// kabupaten_id
		$this->kabupaten_id->LinkCustomAttributes = "";
		$this->kabupaten_id->HrefValue = "";
		$this->kabupaten_id->TooltipValue = "";

		// kecamatan_id
		$this->kecamatan_id->LinkCustomAttributes = "";
		$this->kecamatan_id->HrefValue = "";
		$this->kecamatan_id->TooltipValue = "";

		// kelurahan_id
		$this->kelurahan_id->LinkCustomAttributes = "";
		$this->kelurahan_id->HrefValue = "";
		$this->kelurahan_id->TooltipValue = "";

		// rw_id
		$this->rw_id->LinkCustomAttributes = "";
		$this->rw_id->HrefValue = "";
		$this->rw_id->TooltipValue = "";

		// rt_id
		$this->rt_id->LinkCustomAttributes = "";
		$this->rt_id->HrefValue = "";
		$this->rt_id->TooltipValue = "";

		// alamat_id
		$this->alamat_id->LinkCustomAttributes = "";
		$this->alamat_id->HrefValue = "";
		$this->alamat_id->TooltipValue = "";

		// nomor_rumah
		$this->nomor_rumah->LinkCustomAttributes = "";
		$this->nomor_rumah->HrefValue = "";
		$this->nomor_rumah->TooltipValue = "";

		// status_warga_id
		$this->status_warga_id->LinkCustomAttributes = "";
		$this->status_warga_id->HrefValue = "";
		$this->status_warga_id->TooltipValue = "";

		// keterangan_warga
		$this->keterangan_warga->LinkCustomAttributes = "";
		$this->keterangan_warga->HrefValue = "";
		$this->keterangan_warga->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// bansos_id
		$this->bansos_id->EditAttrs["class"] = "form-control";
		$this->bansos_id->EditCustomAttributes = "";

		// warga_id
		$this->warga_id->EditAttrs["class"] = "form-control";
		$this->warga_id->EditCustomAttributes = "";

		// jenis_bantuan_id
		$this->jenis_bantuan_id->EditAttrs["class"] = "form-control";
		$this->jenis_bantuan_id->EditCustomAttributes = "";

		// type
		$this->type->EditCustomAttributes = "";
		$this->type->EditValue = $this->type->options(FALSE);

		// jumlah
		$this->jumlah->EditAttrs["class"] = "form-control";
		$this->jumlah->EditCustomAttributes = "";
		if (!$this->jumlah->Raw)
			$this->jumlah->CurrentValue = HtmlDecode($this->jumlah->CurrentValue);
		$this->jumlah->EditValue = $this->jumlah->CurrentValue;
		$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

		// sumber_bantuan_id
		$this->sumber_bantuan_id->EditAttrs["class"] = "form-control";
		$this->sumber_bantuan_id->EditCustomAttributes = "";

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id->EditAttrs["class"] = "form-control";
		$this->pengambilan_bantuuan_id->EditCustomAttributes = "";

		// frekuensi
		$this->frekuensi->EditAttrs["class"] = "form-control";
		$this->frekuensi->EditCustomAttributes = "";
		if (!$this->frekuensi->Raw)
			$this->frekuensi->CurrentValue = HtmlDecode($this->frekuensi->CurrentValue);
		$this->frekuensi->EditValue = $this->frekuensi->CurrentValue;
		$this->frekuensi->PlaceHolder = RemoveHtml($this->frekuensi->caption());

		// bulan
		$this->bulan->EditAttrs["class"] = "form-control";
		$this->bulan->EditCustomAttributes = "";
		$this->bulan->EditValue = $this->bulan->options(TRUE);

		// tahun
		$this->tahun->EditAttrs["class"] = "form-control";
		$this->tahun->EditCustomAttributes = "";
		$this->tahun->EditValue = $this->tahun->CurrentValue;
		$this->tahun->PlaceHolder = RemoveHtml($this->tahun->caption());

		// keterangan_bantuan
		$this->keterangan_bantuan->EditAttrs["class"] = "form-control";
		$this->keterangan_bantuan->EditCustomAttributes = "";
		$this->keterangan_bantuan->EditValue = $this->keterangan_bantuan->CurrentValue;
		$this->keterangan_bantuan->PlaceHolder = RemoveHtml($this->keterangan_bantuan->caption());

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(TRUE);

		// kk
		$this->kk->EditAttrs["class"] = "form-control";
		$this->kk->EditCustomAttributes = "";
		if (!$this->kk->Raw)
			$this->kk->CurrentValue = HtmlDecode($this->kk->CurrentValue);
		$this->kk->EditValue = $this->kk->CurrentValue;
		$this->kk->PlaceHolder = RemoveHtml($this->kk->caption());

		// nik
		$this->nik->EditAttrs["class"] = "form-control";
		$this->nik->EditCustomAttributes = "";
		$this->nik->EditValue = $this->nik->CurrentValue;
		$this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// provinsi_id
		$this->provinsi_id->EditAttrs["class"] = "form-control";
		$this->provinsi_id->EditCustomAttributes = "";
		$this->provinsi_id->EditValue = $this->provinsi_id->CurrentValue;
		$this->provinsi_id->PlaceHolder = RemoveHtml($this->provinsi_id->caption());

		// kabupaten_id
		$this->kabupaten_id->EditAttrs["class"] = "form-control";
		$this->kabupaten_id->EditCustomAttributes = "";
		$this->kabupaten_id->EditValue = $this->kabupaten_id->CurrentValue;
		$this->kabupaten_id->PlaceHolder = RemoveHtml($this->kabupaten_id->caption());

		// kecamatan_id
		$this->kecamatan_id->EditAttrs["class"] = "form-control";
		$this->kecamatan_id->EditCustomAttributes = "";
		$this->kecamatan_id->EditValue = $this->kecamatan_id->CurrentValue;
		$this->kecamatan_id->PlaceHolder = RemoveHtml($this->kecamatan_id->caption());

		// kelurahan_id
		$this->kelurahan_id->EditAttrs["class"] = "form-control";
		$this->kelurahan_id->EditCustomAttributes = "";
		$this->kelurahan_id->EditValue = $this->kelurahan_id->CurrentValue;
		$this->kelurahan_id->PlaceHolder = RemoveHtml($this->kelurahan_id->caption());

		// rw_id
		$this->rw_id->EditAttrs["class"] = "form-control";
		$this->rw_id->EditCustomAttributes = "";
		$this->rw_id->EditValue = $this->rw_id->CurrentValue;
		$this->rw_id->PlaceHolder = RemoveHtml($this->rw_id->caption());

		// rt_id
		$this->rt_id->EditAttrs["class"] = "form-control";
		$this->rt_id->EditCustomAttributes = "";
		$this->rt_id->EditValue = $this->rt_id->CurrentValue;
		$this->rt_id->PlaceHolder = RemoveHtml($this->rt_id->caption());

		// alamat_id
		$this->alamat_id->EditAttrs["class"] = "form-control";
		$this->alamat_id->EditCustomAttributes = "";
		$this->alamat_id->EditValue = $this->alamat_id->CurrentValue;
		$this->alamat_id->PlaceHolder = RemoveHtml($this->alamat_id->caption());

		// nomor_rumah
		$this->nomor_rumah->EditAttrs["class"] = "form-control";
		$this->nomor_rumah->EditCustomAttributes = "";
		if (!$this->nomor_rumah->Raw)
			$this->nomor_rumah->CurrentValue = HtmlDecode($this->nomor_rumah->CurrentValue);
		$this->nomor_rumah->EditValue = $this->nomor_rumah->CurrentValue;
		$this->nomor_rumah->PlaceHolder = RemoveHtml($this->nomor_rumah->caption());

		// status_warga_id
		$this->status_warga_id->EditCustomAttributes = "";

		// keterangan_warga
		$this->keterangan_warga->EditAttrs["class"] = "form-control";
		$this->keterangan_warga->EditCustomAttributes = "";
		$this->keterangan_warga->EditValue = $this->keterangan_warga->CurrentValue;
		$this->keterangan_warga->PlaceHolder = RemoveHtml($this->keterangan_warga->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->bansos_id);
					$doc->exportCaption($this->jenis_bantuan_id);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->sumber_bantuan_id);
					$doc->exportCaption($this->pengambilan_bantuuan_id);
					$doc->exportCaption($this->frekuensi);
					$doc->exportCaption($this->bulan);
					$doc->exportCaption($this->tahun);
					$doc->exportCaption($this->keterangan_bantuan);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->kk);
					$doc->exportCaption($this->nik);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->provinsi_id);
					$doc->exportCaption($this->kabupaten_id);
					$doc->exportCaption($this->kecamatan_id);
					$doc->exportCaption($this->kelurahan_id);
					$doc->exportCaption($this->rw_id);
					$doc->exportCaption($this->rt_id);
					$doc->exportCaption($this->alamat_id);
					$doc->exportCaption($this->nomor_rumah);
					$doc->exportCaption($this->status_warga_id);
					$doc->exportCaption($this->keterangan_warga);
				} else {
					$doc->exportCaption($this->bansos_id);
					$doc->exportCaption($this->warga_id);
					$doc->exportCaption($this->jenis_bantuan_id);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->sumber_bantuan_id);
					$doc->exportCaption($this->pengambilan_bantuuan_id);
					$doc->exportCaption($this->frekuensi);
					$doc->exportCaption($this->bulan);
					$doc->exportCaption($this->tahun);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->kk);
					$doc->exportCaption($this->nik);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->provinsi_id);
					$doc->exportCaption($this->kabupaten_id);
					$doc->exportCaption($this->kecamatan_id);
					$doc->exportCaption($this->kelurahan_id);
					$doc->exportCaption($this->rw_id);
					$doc->exportCaption($this->rt_id);
					$doc->exportCaption($this->alamat_id);
					$doc->exportCaption($this->nomor_rumah);
					$doc->exportCaption($this->status_warga_id);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->bansos_id);
						$doc->exportField($this->jenis_bantuan_id);
						$doc->exportField($this->type);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->sumber_bantuan_id);
						$doc->exportField($this->pengambilan_bantuuan_id);
						$doc->exportField($this->frekuensi);
						$doc->exportField($this->bulan);
						$doc->exportField($this->tahun);
						$doc->exportField($this->keterangan_bantuan);
						$doc->exportField($this->status);
						$doc->exportField($this->kk);
						$doc->exportField($this->nik);
						$doc->exportField($this->nama);
						$doc->exportField($this->provinsi_id);
						$doc->exportField($this->kabupaten_id);
						$doc->exportField($this->kecamatan_id);
						$doc->exportField($this->kelurahan_id);
						$doc->exportField($this->rw_id);
						$doc->exportField($this->rt_id);
						$doc->exportField($this->alamat_id);
						$doc->exportField($this->nomor_rumah);
						$doc->exportField($this->status_warga_id);
						$doc->exportField($this->keterangan_warga);
					} else {
						$doc->exportField($this->bansos_id);
						$doc->exportField($this->warga_id);
						$doc->exportField($this->jenis_bantuan_id);
						$doc->exportField($this->type);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->sumber_bantuan_id);
						$doc->exportField($this->pengambilan_bantuuan_id);
						$doc->exportField($this->frekuensi);
						$doc->exportField($this->bulan);
						$doc->exportField($this->tahun);
						$doc->exportField($this->status);
						$doc->exportField($this->kk);
						$doc->exportField($this->nik);
						$doc->exportField($this->nama);
						$doc->exportField($this->provinsi_id);
						$doc->exportField($this->kabupaten_id);
						$doc->exportField($this->kecamatan_id);
						$doc->exportField($this->kelurahan_id);
						$doc->exportField($this->rw_id);
						$doc->exportField($this->rt_id);
						$doc->exportField($this->alamat_id);
						$doc->exportField($this->nomor_rumah);
						$doc->exportField($this->status_warga_id);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>