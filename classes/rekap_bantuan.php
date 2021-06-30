<?php namespace PHPMaker2020\bansos; ?>
<?php

/**
 * Table class for rekap_bantuan
 */
class rekap_bantuan extends DbTable
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
	public $jenis_bantuan_id;
	public $bantuan_id;
	public $type;
	public $jumlah;
	public $sumber_bantuan_id;
	public $pengambilan_bantuuan_id;
	public $tahun_bantuan;
	public $keterangan_bantuan;
	public $warga_id;
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
	public $keterangan;
	public $status_bantuan;
	public $nama_kecamatan;
	public $nama_kelurahan;
	public $nama_rw;
	public $nama_rt;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'rekap_bantuan';
		$this->TableName = 'rekap_bantuan';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`rekap_bantuan`";
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

		// jenis_bantuan_id
		$this->jenis_bantuan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_jenis_bantuan_id', 'jenis_bantuan_id', '`jenis_bantuan_id`', '`jenis_bantuan_id`', 3, 11, -1, FALSE, '`jenis_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenis_bantuan_id->Nullable = FALSE; // NOT NULL field
		$this->jenis_bantuan_id->Required = TRUE; // Required field
		$this->jenis_bantuan_id->Sortable = TRUE; // Allow sort
		$this->jenis_bantuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenis_bantuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], ["x_bantuan_id"], [], [], [], [], '', '');
				break;
			case "id":
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], ["x_bantuan_id"], [], [], [], [], '', '');
				break;
			default:
				$this->jenis_bantuan_id->Lookup = new Lookup('jenis_bantuan_id', 'master_jenis_bantuan', FALSE, 'id', ["nama","","",""], [], ["x_bantuan_id"], [], [], [], [], '', '');
				break;
		}
		$this->jenis_bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis_bantuan_id'] = &$this->jenis_bantuan_id;

		// bantuan_id
		$this->bantuan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_bantuan_id', 'bantuan_id', '`bantuan_id`', '`bantuan_id`', 3, 11, -1, FALSE, '`bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bantuan_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->bantuan_id->IsPrimaryKey = TRUE; // Primary key field
		$this->bantuan_id->Sortable = FALSE; // Allow sort
		$this->bantuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bantuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","tahun","",""], ["x_jenis_bantuan_id"], [], ["jenis_bantuan_id"], ["x_jenis_bantuan_id"], [], [], '', '');
				break;
			case "id":
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","tahun","",""], ["x_jenis_bantuan_id"], [], ["jenis_bantuan_id"], ["x_jenis_bantuan_id"], [], [], '', '');
				break;
			default:
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","tahun","",""], ["x_jenis_bantuan_id"], [], ["jenis_bantuan_id"], ["x_jenis_bantuan_id"], [], [], '', '');
				break;
		}
		$this->bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bantuan_id'] = &$this->bantuan_id;

		// type
		$this->type = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_type', 'type', '`type`', '`type`', 202, 1, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->type->Nullable = FALSE; // NOT NULL field
		$this->type->Sortable = TRUE; // Allow sort
		$this->type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->type->Lookup = new Lookup('type', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->type->OptionCount = 2;
		$this->fields['type'] = &$this->type;

		// jumlah
		$this->jumlah = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 200, 100, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Nullable = FALSE; // NOT NULL field
		$this->jumlah->Required = TRUE; // Required field
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->fields['jumlah'] = &$this->jumlah;

		// sumber_bantuan_id
		$this->sumber_bantuan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_sumber_bantuan_id', 'sumber_bantuan_id', '`sumber_bantuan_id`', '`sumber_bantuan_id`', 3, 11, -1, FALSE, '`sumber_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->pengambilan_bantuuan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_pengambilan_bantuuan_id', 'pengambilan_bantuuan_id', '`pengambilan_bantuuan_id`', '`pengambilan_bantuuan_id`', 3, 11, -1, FALSE, '`pengambilan_bantuuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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

		// tahun_bantuan
		$this->tahun_bantuan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_tahun_bantuan', 'tahun_bantuan', '`tahun_bantuan`', '`tahun_bantuan`', 3, 11, -1, FALSE, '`tahun_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_bantuan->Nullable = FALSE; // NOT NULL field
		$this->tahun_bantuan->Required = TRUE; // Required field
		$this->tahun_bantuan->Sortable = TRUE; // Allow sort
		$this->tahun_bantuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tahun_bantuan'] = &$this->tahun_bantuan;

		// keterangan_bantuan
		$this->keterangan_bantuan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_keterangan_bantuan', 'keterangan_bantuan', '`keterangan_bantuan`', '`keterangan_bantuan`', 201, 65535, -1, FALSE, '`keterangan_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_bantuan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan_bantuan'] = &$this->keterangan_bantuan;

		// warga_id
		$this->warga_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_warga_id', 'warga_id', '`warga_id`', '`warga_id`', 3, 11, -1, FALSE, '`warga_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->warga_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->warga_id->IsPrimaryKey = TRUE; // Primary key field
		$this->warga_id->Sortable = TRUE; // Allow sort
		$this->warga_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['warga_id'] = &$this->warga_id;

		// kk
		$this->kk = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_kk', 'kk', '`kk`', '`kk`', 200, 100, -1, FALSE, '`kk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kk->Nullable = FALSE; // NOT NULL field
		$this->kk->Required = TRUE; // Required field
		$this->kk->Sortable = TRUE; // Allow sort
		$this->kk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kk'] = &$this->kk;

		// nik
		$this->nik = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nik', 'nik', '`nik`', '`nik`', 20, 16, -1, FALSE, '`nik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik->Nullable = FALSE; // NOT NULL field
		$this->nik->Required = TRUE; // Required field
		$this->nik->Sortable = TRUE; // Allow sort
		$this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nik'] = &$this->nik;

		// nama
		$this->nama = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nama', 'nama', '`nama`', '`nama`', 200, 100, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Nullable = FALSE; // NOT NULL field
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// provinsi_id
		$this->provinsi_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_provinsi_id', 'provinsi_id', '`provinsi_id`', '`provinsi_id`', 20, 20, -1, FALSE, '`provinsi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kabupaten_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_kabupaten_id', 'kabupaten_id', '`kabupaten_id`', '`kabupaten_id`', 20, 20, -1, FALSE, '`kabupaten_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kecamatan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_kecamatan_id', 'kecamatan_id', '`kecamatan_id`', '`kecamatan_id`', 20, 20, -1, FALSE, '`kecamatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kelurahan_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_kelurahan_id', 'kelurahan_id', '`kelurahan_id`', '`kelurahan_id`', 20, 20, -1, FALSE, '`kelurahan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->rw_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_rw_id', 'rw_id', '`rw_id`', '`rw_id`', 20, 20, -1, FALSE, '`rw_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rw_id->Nullable = FALSE; // NOT NULL field
		$this->rw_id->Required = TRUE; // Required field
		$this->rw_id->Sortable = TRUE; // Allow sort
		$this->rw_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rw_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
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
		$this->rt_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_rt_id', 'rt_id', '`rt_id`', '`rt_id`', 20, 20, -1, FALSE, '`rt_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rt_id->Nullable = FALSE; // NOT NULL field
		$this->rt_id->Required = TRUE; // Required field
		$this->rt_id->Sortable = TRUE; // Allow sort
		$this->rt_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rt_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
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
		$this->alamat_id = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_alamat_id', 'alamat_id', '`alamat_id`', '`alamat_id`', 3, 11, -1, FALSE, '`alamat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->nomor_rumah = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nomor_rumah', 'nomor_rumah', '`nomor_rumah`', '`nomor_rumah`', 200, 10, -1, FALSE, '`nomor_rumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_rumah->Nullable = FALSE; // NOT NULL field
		$this->nomor_rumah->Required = TRUE; // Required field
		$this->nomor_rumah->Sortable = TRUE; // Allow sort
		$this->fields['nomor_rumah'] = &$this->nomor_rumah;

		// keterangan
		$this->keterangan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 201, 65535, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// status_bantuan
		$this->status_bantuan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_status_bantuan', 'status_bantuan', '`status_bantuan`', '`status_bantuan`', 202, 1, -1, FALSE, '`status_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status_bantuan->Nullable = FALSE; // NOT NULL field
		$this->status_bantuan->Required = TRUE; // Required field
		$this->status_bantuan->Sortable = TRUE; // Allow sort
		$this->status_bantuan->DataType = DATATYPE_BOOLEAN;
		$this->status_bantuan->TrueValue = "y";
		$this->status_bantuan->FalseValue = "n";
		switch ($CurrentLanguage) {
			case "en":
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'rekap_bantuan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status_bantuan->OptionCount = 2;
		$this->status_bantuan->AdvancedSearch->SearchValueDefault = 'n';
		$this->status_bantuan->AdvancedSearch->SearchOperatorDefault = "=";
		$this->status_bantuan->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->status_bantuan->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['status_bantuan'] = &$this->status_bantuan;

		// nama_kecamatan
		$this->nama_kecamatan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nama_kecamatan', 'nama_kecamatan', '`nama_kecamatan`', '`nama_kecamatan`', 200, 30, -1, FALSE, '`nama_kecamatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_kecamatan->Nullable = FALSE; // NOT NULL field
		$this->nama_kecamatan->Required = TRUE; // Required field
		$this->nama_kecamatan->Sortable = TRUE; // Allow sort
		$this->fields['nama_kecamatan'] = &$this->nama_kecamatan;

		// nama_kelurahan
		$this->nama_kelurahan = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nama_kelurahan', 'nama_kelurahan', '`nama_kelurahan`', '`nama_kelurahan`', 200, 40, -1, FALSE, '`nama_kelurahan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_kelurahan->Nullable = FALSE; // NOT NULL field
		$this->nama_kelurahan->Required = TRUE; // Required field
		$this->nama_kelurahan->Sortable = TRUE; // Allow sort
		$this->fields['nama_kelurahan'] = &$this->nama_kelurahan;

		// nama_rw
		$this->nama_rw = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nama_rw', 'nama_rw', '`nama_rw`', '`nama_rw`', 200, 100, -1, FALSE, '`nama_rw`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_rw->Nullable = FALSE; // NOT NULL field
		$this->nama_rw->Required = TRUE; // Required field
		$this->nama_rw->Sortable = TRUE; // Allow sort
		$this->fields['nama_rw'] = &$this->nama_rw;

		// nama_rt
		$this->nama_rt = new DbField('rekap_bantuan', 'rekap_bantuan', 'x_nama_rt', 'nama_rt', '`nama_rt`', '`nama_rt`', 200, 100, -1, FALSE, '`nama_rt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_rt->Nullable = FALSE; // NOT NULL field
		$this->nama_rt->Required = TRUE; // Required field
		$this->nama_rt->Sortable = TRUE; // Allow sort
		$this->fields['nama_rt'] = &$this->nama_rt;
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
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`rekap_bantuan`";
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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
			$this->bantuan_id->setDbValue($conn->insert_ID());
			$rs['bantuan_id'] = $this->bantuan_id->DbValue;

			// Get insert id if necessary
			$this->warga_id->setDbValue($conn->insert_ID());
			$rs['warga_id'] = $this->warga_id->DbValue;
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
			if (array_key_exists('bantuan_id', $rs))
				AddFilter($where, QuotedName('bantuan_id', $this->Dbid) . '=' . QuotedValue($rs['bantuan_id'], $this->bantuan_id->DataType, $this->Dbid));
			if (array_key_exists('warga_id', $rs))
				AddFilter($where, QuotedName('warga_id', $this->Dbid) . '=' . QuotedValue($rs['warga_id'], $this->warga_id->DataType, $this->Dbid));
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
		$this->jenis_bantuan_id->DbValue = $row['jenis_bantuan_id'];
		$this->bantuan_id->DbValue = $row['bantuan_id'];
		$this->type->DbValue = $row['type'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->sumber_bantuan_id->DbValue = $row['sumber_bantuan_id'];
		$this->pengambilan_bantuuan_id->DbValue = $row['pengambilan_bantuuan_id'];
		$this->tahun_bantuan->DbValue = $row['tahun_bantuan'];
		$this->keterangan_bantuan->DbValue = $row['keterangan_bantuan'];
		$this->warga_id->DbValue = $row['warga_id'];
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
		$this->keterangan->DbValue = $row['keterangan'];
		$this->status_bantuan->DbValue = $row['status_bantuan'];
		$this->nama_kecamatan->DbValue = $row['nama_kecamatan'];
		$this->nama_kelurahan->DbValue = $row['nama_kelurahan'];
		$this->nama_rw->DbValue = $row['nama_rw'];
		$this->nama_rt->DbValue = $row['nama_rt'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`bantuan_id` = @bantuan_id@ AND `warga_id` = @warga_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('bantuan_id', $row) ? $row['bantuan_id'] : NULL;
		else
			$val = $this->bantuan_id->OldValue !== NULL ? $this->bantuan_id->OldValue : $this->bantuan_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@bantuan_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('warga_id', $row) ? $row['warga_id'] : NULL;
		else
			$val = $this->warga_id->OldValue !== NULL ? $this->warga_id->OldValue : $this->warga_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@warga_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "rekap_bantuanlist.php";
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
		if ($pageName == "rekap_bantuanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "rekap_bantuanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "rekap_bantuanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "rekap_bantuanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("rekap_bantuanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("rekap_bantuanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "rekap_bantuanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "rekap_bantuanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("rekap_bantuanedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("rekap_bantuanadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("rekap_bantuandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "bantuan_id:" . JsonEncode($this->bantuan_id->CurrentValue, "number");
		$json .= ",warga_id:" . JsonEncode($this->warga_id->CurrentValue, "number");
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
		if ($this->bantuan_id->CurrentValue != NULL) {
			$url .= "bantuan_id=" . urlencode($this->bantuan_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->warga_id->CurrentValue != NULL) {
			$url .= "&warga_id=" . urlencode($this->warga_id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("bantuan_id") !== NULL)
				$arKey[] = Param("bantuan_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("warga_id") !== NULL)
				$arKey[] = Param("warga_id");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // bantuan_id
					continue;
				if (!is_numeric($key[1])) // warga_id
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
				$this->bantuan_id->CurrentValue = $key[0];
			else
				$this->bantuan_id->OldValue = $key[0];
			if ($setCurrent)
				$this->warga_id->CurrentValue = $key[1];
			else
				$this->warga_id->OldValue = $key[1];
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
		$this->jenis_bantuan_id->setDbValue($rs->fields('jenis_bantuan_id'));
		$this->bantuan_id->setDbValue($rs->fields('bantuan_id'));
		$this->type->setDbValue($rs->fields('type'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->sumber_bantuan_id->setDbValue($rs->fields('sumber_bantuan_id'));
		$this->pengambilan_bantuuan_id->setDbValue($rs->fields('pengambilan_bantuuan_id'));
		$this->tahun_bantuan->setDbValue($rs->fields('tahun_bantuan'));
		$this->keterangan_bantuan->setDbValue($rs->fields('keterangan_bantuan'));
		$this->warga_id->setDbValue($rs->fields('warga_id'));
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
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->status_bantuan->setDbValue($rs->fields('status_bantuan'));
		$this->nama_kecamatan->setDbValue($rs->fields('nama_kecamatan'));
		$this->nama_kelurahan->setDbValue($rs->fields('nama_kelurahan'));
		$this->nama_rw->setDbValue($rs->fields('nama_rw'));
		$this->nama_rt->setDbValue($rs->fields('nama_rt'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// jenis_bantuan_id
		// bantuan_id
		// type
		// jumlah
		// sumber_bantuan_id
		// pengambilan_bantuuan_id
		// tahun_bantuan
		// keterangan_bantuan
		// warga_id
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
		// keterangan
		// status_bantuan
		// nama_kecamatan
		// nama_kelurahan
		// nama_rw
		// nama_rt
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

		// bantuan_id
		$curVal = strval($this->bantuan_id->CurrentValue);
		if ($curVal != "") {
			$this->bantuan_id->ViewValue = $this->bantuan_id->lookupCacheOption($curVal);
			if ($this->bantuan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->bantuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->bantuan_id->ViewValue = $this->bantuan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bantuan_id->ViewValue = $this->bantuan_id->CurrentValue;
				}
			}
		} else {
			$this->bantuan_id->ViewValue = NULL;
		}
		$this->bantuan_id->ViewCustomAttributes = "";

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

		// tahun_bantuan
		$this->tahun_bantuan->ViewValue = $this->tahun_bantuan->CurrentValue;
		$this->tahun_bantuan->ViewCustomAttributes = "";

		// keterangan_bantuan
		$this->keterangan_bantuan->ViewValue = $this->keterangan_bantuan->CurrentValue;
		$this->keterangan_bantuan->ViewCustomAttributes = "";

		// warga_id
		$this->warga_id->ViewValue = $this->warga_id->CurrentValue;
		$this->warga_id->ViewCustomAttributes = "";

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

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// status_bantuan
		if (ConvertToBool($this->status_bantuan->CurrentValue)) {
			$this->status_bantuan->ViewValue = $this->status_bantuan->tagCaption(2) != "" ? $this->status_bantuan->tagCaption(2) : "Tidak";
		} else {
			$this->status_bantuan->ViewValue = $this->status_bantuan->tagCaption(1) != "" ? $this->status_bantuan->tagCaption(1) : "Ya";
		}
		$this->status_bantuan->ViewCustomAttributes = "";

		// nama_kecamatan
		$this->nama_kecamatan->ViewValue = $this->nama_kecamatan->CurrentValue;
		$this->nama_kecamatan->ViewCustomAttributes = "";

		// nama_kelurahan
		$this->nama_kelurahan->ViewValue = $this->nama_kelurahan->CurrentValue;
		$this->nama_kelurahan->ViewCustomAttributes = "";

		// nama_rw
		$this->nama_rw->ViewValue = $this->nama_rw->CurrentValue;
		$this->nama_rw->ViewCustomAttributes = "";

		// nama_rt
		$this->nama_rt->ViewValue = $this->nama_rt->CurrentValue;
		$this->nama_rt->ViewCustomAttributes = "";

		// jenis_bantuan_id
		$this->jenis_bantuan_id->LinkCustomAttributes = "";
		$this->jenis_bantuan_id->HrefValue = "";
		$this->jenis_bantuan_id->TooltipValue = "";

		// bantuan_id
		$this->bantuan_id->LinkCustomAttributes = "";
		$this->bantuan_id->HrefValue = "";
		$this->bantuan_id->TooltipValue = "";

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

		// tahun_bantuan
		$this->tahun_bantuan->LinkCustomAttributes = "";
		$this->tahun_bantuan->HrefValue = "";
		$this->tahun_bantuan->TooltipValue = "";

		// keterangan_bantuan
		$this->keterangan_bantuan->LinkCustomAttributes = "";
		$this->keterangan_bantuan->HrefValue = "";
		$this->keterangan_bantuan->TooltipValue = "";

		// warga_id
		$this->warga_id->LinkCustomAttributes = "";
		$this->warga_id->HrefValue = "";
		$this->warga_id->TooltipValue = "";

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

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// status_bantuan
		$this->status_bantuan->LinkCustomAttributes = "";
		$this->status_bantuan->HrefValue = "";
		$this->status_bantuan->TooltipValue = "";

		// nama_kecamatan
		$this->nama_kecamatan->LinkCustomAttributes = "";
		$this->nama_kecamatan->HrefValue = "";
		$this->nama_kecamatan->TooltipValue = "";

		// nama_kelurahan
		$this->nama_kelurahan->LinkCustomAttributes = "";
		$this->nama_kelurahan->HrefValue = "";
		$this->nama_kelurahan->TooltipValue = "";

		// nama_rw
		$this->nama_rw->LinkCustomAttributes = "";
		$this->nama_rw->HrefValue = "";
		$this->nama_rw->TooltipValue = "";

		// nama_rt
		$this->nama_rt->LinkCustomAttributes = "";
		$this->nama_rt->HrefValue = "";
		$this->nama_rt->TooltipValue = "";

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

		// jenis_bantuan_id
		$this->jenis_bantuan_id->EditCustomAttributes = "";

		// bantuan_id
		$this->bantuan_id->EditAttrs["class"] = "form-control";
		$this->bantuan_id->EditCustomAttributes = "";
		$curVal = strval($this->bantuan_id->CurrentValue);
		if ($curVal != "") {
			$this->bantuan_id->EditValue = $this->bantuan_id->lookupCacheOption($curVal);
			if ($this->bantuan_id->EditValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->bantuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->bantuan_id->EditValue = $this->bantuan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->bantuan_id->EditValue = $this->bantuan_id->CurrentValue;
				}
			}
		} else {
			$this->bantuan_id->EditValue = NULL;
		}
		$this->bantuan_id->ViewCustomAttributes = "";

		// type
		$this->type->EditCustomAttributes = "";
		$this->type->EditValue = $this->type->options(TRUE);

		// jumlah
		$this->jumlah->EditAttrs["class"] = "form-control";
		$this->jumlah->EditCustomAttributes = "";
		if (!$this->jumlah->Raw)
			$this->jumlah->CurrentValue = HtmlDecode($this->jumlah->CurrentValue);
		$this->jumlah->EditValue = $this->jumlah->CurrentValue;
		$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

		// sumber_bantuan_id
		$this->sumber_bantuan_id->EditCustomAttributes = "";

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id->EditCustomAttributes = "";

		// tahun_bantuan
		$this->tahun_bantuan->EditAttrs["class"] = "form-control";
		$this->tahun_bantuan->EditCustomAttributes = "";
		$this->tahun_bantuan->EditValue = $this->tahun_bantuan->CurrentValue;
		$this->tahun_bantuan->PlaceHolder = RemoveHtml($this->tahun_bantuan->caption());

		// keterangan_bantuan
		$this->keterangan_bantuan->EditAttrs["class"] = "form-control";
		$this->keterangan_bantuan->EditCustomAttributes = "";
		$this->keterangan_bantuan->EditValue = $this->keterangan_bantuan->CurrentValue;
		$this->keterangan_bantuan->PlaceHolder = RemoveHtml($this->keterangan_bantuan->caption());

		// warga_id
		$this->warga_id->EditAttrs["class"] = "form-control";
		$this->warga_id->EditCustomAttributes = "";
		$this->warga_id->EditValue = $this->warga_id->CurrentValue;
		$this->warga_id->ViewCustomAttributes = "";

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
		$this->rw_id->EditCustomAttributes = "";

		// rt_id
		$this->rt_id->EditCustomAttributes = "";

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

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// status_bantuan
		$this->status_bantuan->EditCustomAttributes = "";
		$this->status_bantuan->EditValue = $this->status_bantuan->options(FALSE);

		// nama_kecamatan
		$this->nama_kecamatan->EditAttrs["class"] = "form-control";
		$this->nama_kecamatan->EditCustomAttributes = "";
		if (!$this->nama_kecamatan->Raw)
			$this->nama_kecamatan->CurrentValue = HtmlDecode($this->nama_kecamatan->CurrentValue);
		$this->nama_kecamatan->EditValue = $this->nama_kecamatan->CurrentValue;
		$this->nama_kecamatan->PlaceHolder = RemoveHtml($this->nama_kecamatan->caption());

		// nama_kelurahan
		$this->nama_kelurahan->EditAttrs["class"] = "form-control";
		$this->nama_kelurahan->EditCustomAttributes = "";
		if (!$this->nama_kelurahan->Raw)
			$this->nama_kelurahan->CurrentValue = HtmlDecode($this->nama_kelurahan->CurrentValue);
		$this->nama_kelurahan->EditValue = $this->nama_kelurahan->CurrentValue;
		$this->nama_kelurahan->PlaceHolder = RemoveHtml($this->nama_kelurahan->caption());

		// nama_rw
		$this->nama_rw->EditAttrs["class"] = "form-control";
		$this->nama_rw->EditCustomAttributes = "";
		if (!$this->nama_rw->Raw)
			$this->nama_rw->CurrentValue = HtmlDecode($this->nama_rw->CurrentValue);
		$this->nama_rw->EditValue = $this->nama_rw->CurrentValue;
		$this->nama_rw->PlaceHolder = RemoveHtml($this->nama_rw->caption());

		// nama_rt
		$this->nama_rt->EditAttrs["class"] = "form-control";
		$this->nama_rt->EditCustomAttributes = "";
		if (!$this->nama_rt->Raw)
			$this->nama_rt->CurrentValue = HtmlDecode($this->nama_rt->CurrentValue);
		$this->nama_rt->EditValue = $this->nama_rt->CurrentValue;
		$this->nama_rt->PlaceHolder = RemoveHtml($this->nama_rt->caption());

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
					$doc->exportCaption($this->jenis_bantuan_id);
					$doc->exportCaption($this->bantuan_id);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->sumber_bantuan_id);
					$doc->exportCaption($this->pengambilan_bantuuan_id);
					$doc->exportCaption($this->tahun_bantuan);
					$doc->exportCaption($this->keterangan_bantuan);
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
					$doc->exportCaption($this->status_bantuan);
				} else {
					$doc->exportCaption($this->jenis_bantuan_id);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->sumber_bantuan_id);
					$doc->exportCaption($this->pengambilan_bantuuan_id);
					$doc->exportCaption($this->tahun_bantuan);
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
					$doc->exportCaption($this->nama_kecamatan);
					$doc->exportCaption($this->nama_kelurahan);
					$doc->exportCaption($this->nama_rw);
					$doc->exportCaption($this->nama_rt);
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
						$doc->exportField($this->jenis_bantuan_id);
						$doc->exportField($this->bantuan_id);
						$doc->exportField($this->type);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->sumber_bantuan_id);
						$doc->exportField($this->pengambilan_bantuuan_id);
						$doc->exportField($this->tahun_bantuan);
						$doc->exportField($this->keterangan_bantuan);
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
						$doc->exportField($this->status_bantuan);
					} else {
						$doc->exportField($this->jenis_bantuan_id);
						$doc->exportField($this->type);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->sumber_bantuan_id);
						$doc->exportField($this->pengambilan_bantuuan_id);
						$doc->exportField($this->tahun_bantuan);
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
						$doc->exportField($this->nama_kecamatan);
						$doc->exportField($this->nama_kelurahan);
						$doc->exportField($this->nama_rw);
						$doc->exportField($this->nama_rt);
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