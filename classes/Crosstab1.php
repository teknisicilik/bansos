<?php namespace PHPMaker2020\bansos; ?>
<?php

/**
 * Table class for Crosstab1
 */
class Crosstab1 extends CrosstabTable
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
	public $bantuan_id;
	public $jenis_bantuan_id;
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
	public $type;
	public $nama_kecamatan;
	public $nama_kelurahan;
	public $nama_rw;
	public $nama_rt;
	public $sumber_bantuan_id;
	public $pengambilan_bantuuan_id;
	public $jumlah;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Crosstab1';
		$this->TableName = 'Crosstab1';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`rekap_bantuan`";
		$this->ReportSourceTable = 'rekap_bantuan'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// bantuan_id
		$this->bantuan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_bantuan_id', 'bantuan_id', '`bantuan_id`', '`bantuan_id`', 3, 11, -1, FALSE, '`bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bantuan_id->GroupingFieldId = 2;
		$this->bantuan_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->bantuan_id->IsPrimaryKey = TRUE; // Primary key field
		$this->bantuan_id->Sortable = FALSE; // Allow sort
		$this->bantuan_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bantuan_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->bantuan_id->Lookup = new Lookup('bantuan_id', 'master_bantuan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->bantuan_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->bantuan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['bantuan_id'] = &$this->bantuan_id;

		// jenis_bantuan_id
		$this->jenis_bantuan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_jenis_bantuan_id', 'jenis_bantuan_id', '`jenis_bantuan_id`', '`jenis_bantuan_id`', 3, 11, -1, FALSE, '`jenis_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenis_bantuan_id->GroupingFieldId = 1;
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
		$this->jenis_bantuan_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->jenis_bantuan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['jenis_bantuan_id'] = &$this->jenis_bantuan_id;

		// tahun_bantuan
		$this->tahun_bantuan = new ReportField('Crosstab1', 'Crosstab1', 'x_tahun_bantuan', 'tahun_bantuan', '`tahun_bantuan`', '`tahun_bantuan`', 3, 11, -1, FALSE, '`tahun_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun_bantuan->Nullable = FALSE; // NOT NULL field
		$this->tahun_bantuan->Required = TRUE; // Required field
		$this->tahun_bantuan->Sortable = TRUE; // Allow sort
		$this->tahun_bantuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->tahun_bantuan->SourceTableVar = 'rekap_bantuan';
		$this->fields['tahun_bantuan'] = &$this->tahun_bantuan;

		// keterangan_bantuan
		$this->keterangan_bantuan = new ReportField('Crosstab1', 'Crosstab1', 'x_keterangan_bantuan', 'keterangan_bantuan', '`keterangan_bantuan`', '`keterangan_bantuan`', 201, 65535, -1, FALSE, '`keterangan_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_bantuan->Sortable = TRUE; // Allow sort
		$this->keterangan_bantuan->SourceTableVar = 'rekap_bantuan';
		$this->fields['keterangan_bantuan'] = &$this->keterangan_bantuan;

		// warga_id
		$this->warga_id = new ReportField('Crosstab1', 'Crosstab1', 'x_warga_id', 'warga_id', '`warga_id`', '`warga_id`', 3, 11, -1, FALSE, '`warga_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->warga_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->warga_id->IsPrimaryKey = TRUE; // Primary key field
		$this->warga_id->Sortable = TRUE; // Allow sort
		$this->warga_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->warga_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['warga_id'] = &$this->warga_id;

		// kk
		$this->kk = new ReportField('Crosstab1', 'Crosstab1', 'x_kk', 'kk', '`kk`', '`kk`', 200, 100, -1, FALSE, '`kk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kk->Nullable = FALSE; // NOT NULL field
		$this->kk->Required = TRUE; // Required field
		$this->kk->Sortable = TRUE; // Allow sort
		$this->kk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->kk->SourceTableVar = 'rekap_bantuan';
		$this->fields['kk'] = &$this->kk;

		// nik
		$this->nik = new ReportField('Crosstab1', 'Crosstab1', 'x_nik', 'nik', '`nik`', '`nik`', 20, 16, -1, FALSE, '`nik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik->Nullable = FALSE; // NOT NULL field
		$this->nik->Required = TRUE; // Required field
		$this->nik->Sortable = TRUE; // Allow sort
		$this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->nik->SourceTableVar = 'rekap_bantuan';
		$this->fields['nik'] = &$this->nik;

		// nama
		$this->nama = new ReportField('Crosstab1', 'Crosstab1', 'x_nama', 'nama', '`nama`', '`nama`', 200, 100, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Nullable = FALSE; // NOT NULL field
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->nama->SourceTableVar = 'rekap_bantuan';
		$this->fields['nama'] = &$this->nama;

		// provinsi_id
		$this->provinsi_id = new ReportField('Crosstab1', 'Crosstab1', 'x_provinsi_id', 'provinsi_id', '`provinsi_id`', '`provinsi_id`', 20, 20, -1, FALSE, '`provinsi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->provinsi_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['provinsi_id'] = &$this->provinsi_id;

		// kabupaten_id
		$this->kabupaten_id = new ReportField('Crosstab1', 'Crosstab1', 'x_kabupaten_id', 'kabupaten_id', '`kabupaten_id`', '`kabupaten_id`', 20, 20, -1, FALSE, '`kabupaten_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kabupaten_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['kabupaten_id'] = &$this->kabupaten_id;

		// kecamatan_id
		$this->kecamatan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_kecamatan_id', 'kecamatan_id', '`kecamatan_id`', '`kecamatan_id`', 20, 20, -1, FALSE, '`kecamatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kecamatan_id->GroupingFieldId = 3;
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
		$this->kecamatan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['kecamatan_id'] = &$this->kecamatan_id;

		// kelurahan_id
		$this->kelurahan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_kelurahan_id', 'kelurahan_id', '`kelurahan_id`', '`kelurahan_id`', 20, 20, -1, FALSE, '`kelurahan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kelurahan_id->GroupingFieldId = 4;
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
		$this->kelurahan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['kelurahan_id'] = &$this->kelurahan_id;

		// rw_id
		$this->rw_id = new ReportField('Crosstab1', 'Crosstab1', 'x_rw_id', 'rw_id', '`rw_id`', '`rw_id`', 20, 20, -1, FALSE, '`rw_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rw_id->GroupingFieldId = 5;
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
		$this->rw_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->rw_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['rw_id'] = &$this->rw_id;

		// rt_id
		$this->rt_id = new ReportField('Crosstab1', 'Crosstab1', 'x_rt_id', 'rt_id', '`rt_id`', '`rt_id`', 20, 20, -1, FALSE, '`rt_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rt_id->GroupingFieldId = 6;
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
		$this->rt_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->rt_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['rt_id'] = &$this->rt_id;

		// alamat_id
		$this->alamat_id = new ReportField('Crosstab1', 'Crosstab1', 'x_alamat_id', 'alamat_id', '`alamat_id`', '`alamat_id`', 3, 11, -1, FALSE, '`alamat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->alamat_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['alamat_id'] = &$this->alamat_id;

		// nomor_rumah
		$this->nomor_rumah = new ReportField('Crosstab1', 'Crosstab1', 'x_nomor_rumah', 'nomor_rumah', '`nomor_rumah`', '`nomor_rumah`', 200, 10, -1, FALSE, '`nomor_rumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_rumah->Nullable = FALSE; // NOT NULL field
		$this->nomor_rumah->Required = TRUE; // Required field
		$this->nomor_rumah->Sortable = TRUE; // Allow sort
		$this->nomor_rumah->SourceTableVar = 'rekap_bantuan';
		$this->fields['nomor_rumah'] = &$this->nomor_rumah;

		// keterangan
		$this->keterangan = new ReportField('Crosstab1', 'Crosstab1', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 201, 65535, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->keterangan->SourceTableVar = 'rekap_bantuan';
		$this->fields['keterangan'] = &$this->keterangan;

		// status_bantuan
		$this->status_bantuan = new ReportField('Crosstab1', 'Crosstab1', 'x_status_bantuan', 'status_bantuan', '`status_bantuan`', '`status_bantuan`', 202, 1, -1, FALSE, '`status_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status_bantuan->Nullable = FALSE; // NOT NULL field
		$this->status_bantuan->Required = TRUE; // Required field
		$this->status_bantuan->Sortable = TRUE; // Allow sort
		$this->status_bantuan->DataType = DATATYPE_BOOLEAN;
		$this->status_bantuan->TrueValue = "y";
		$this->status_bantuan->FalseValue = "n";
		switch ($CurrentLanguage) {
			case "en":
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status_bantuan->Lookup = new Lookup('status_bantuan', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status_bantuan->OptionCount = 2;
		$this->status_bantuan->AdvancedSearch->SearchValueDefault = 'n';
		$this->status_bantuan->AdvancedSearch->SearchOperatorDefault = "=";
		$this->status_bantuan->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->status_bantuan->AdvancedSearch->SearchConditionDefault = "AND";
		$this->status_bantuan->SourceTableVar = 'rekap_bantuan';
		$this->fields['status_bantuan'] = &$this->status_bantuan;

		// type
		$this->type = new ReportField('Crosstab1', 'Crosstab1', 'x_type', 'type', '`type`', '`type`', 202, 1, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->type->Nullable = FALSE; // NOT NULL field
		$this->type->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->type->Lookup = new Lookup('type', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->type->Lookup = new Lookup('type', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->type->Lookup = new Lookup('type', 'Crosstab1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->type->OptionCount = 2;
		$this->type->SourceTableVar = 'rekap_bantuan';
		$this->fields['type'] = &$this->type;

		// nama_kecamatan
		$this->nama_kecamatan = new ReportField('Crosstab1', 'Crosstab1', 'x_nama_kecamatan', 'nama_kecamatan', '`nama_kecamatan`', '`nama_kecamatan`', 200, 30, -1, FALSE, '`nama_kecamatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_kecamatan->Nullable = FALSE; // NOT NULL field
		$this->nama_kecamatan->Required = TRUE; // Required field
		$this->nama_kecamatan->Sortable = TRUE; // Allow sort
		$this->nama_kecamatan->SourceTableVar = 'rekap_bantuan';
		$this->fields['nama_kecamatan'] = &$this->nama_kecamatan;

		// nama_kelurahan
		$this->nama_kelurahan = new ReportField('Crosstab1', 'Crosstab1', 'x_nama_kelurahan', 'nama_kelurahan', '`nama_kelurahan`', '`nama_kelurahan`', 200, 40, -1, FALSE, '`nama_kelurahan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_kelurahan->Nullable = FALSE; // NOT NULL field
		$this->nama_kelurahan->Required = TRUE; // Required field
		$this->nama_kelurahan->Sortable = TRUE; // Allow sort
		$this->nama_kelurahan->SourceTableVar = 'rekap_bantuan';
		$this->fields['nama_kelurahan'] = &$this->nama_kelurahan;

		// nama_rw
		$this->nama_rw = new ReportField('Crosstab1', 'Crosstab1', 'x_nama_rw', 'nama_rw', '`nama_rw`', '`nama_rw`', 200, 100, -1, FALSE, '`nama_rw`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_rw->Nullable = FALSE; // NOT NULL field
		$this->nama_rw->Required = TRUE; // Required field
		$this->nama_rw->Sortable = TRUE; // Allow sort
		$this->nama_rw->SourceTableVar = 'rekap_bantuan';
		$this->fields['nama_rw'] = &$this->nama_rw;

		// nama_rt
		$this->nama_rt = new ReportField('Crosstab1', 'Crosstab1', 'x_nama_rt', 'nama_rt', '`nama_rt`', '`nama_rt`', 200, 100, -1, FALSE, '`nama_rt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_rt->Nullable = FALSE; // NOT NULL field
		$this->nama_rt->Required = TRUE; // Required field
		$this->nama_rt->Sortable = TRUE; // Allow sort
		$this->nama_rt->SourceTableVar = 'rekap_bantuan';
		$this->fields['nama_rt'] = &$this->nama_rt;

		// sumber_bantuan_id
		$this->sumber_bantuan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_sumber_bantuan_id', 'sumber_bantuan_id', '`sumber_bantuan_id`', '`sumber_bantuan_id`', 3, 11, -1, FALSE, '`sumber_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sumber_bantuan_id->Nullable = FALSE; // NOT NULL field
		$this->sumber_bantuan_id->Required = TRUE; // Required field
		$this->sumber_bantuan_id->Sortable = TRUE; // Allow sort
		$this->sumber_bantuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->sumber_bantuan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['sumber_bantuan_id'] = &$this->sumber_bantuan_id;

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id = new ReportField('Crosstab1', 'Crosstab1', 'x_pengambilan_bantuuan_id', 'pengambilan_bantuuan_id', '`pengambilan_bantuuan_id`', '`pengambilan_bantuuan_id`', 3, 11, -1, FALSE, '`pengambilan_bantuuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pengambilan_bantuuan_id->Nullable = FALSE; // NOT NULL field
		$this->pengambilan_bantuuan_id->Required = TRUE; // Required field
		$this->pengambilan_bantuuan_id->Sortable = TRUE; // Allow sort
		$this->pengambilan_bantuuan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->pengambilan_bantuuan_id->SourceTableVar = 'rekap_bantuan';
		$this->fields['pengambilan_bantuuan_id'] = &$this->pengambilan_bantuuan_id;

		// jumlah
		$this->jumlah = new ReportField('Crosstab1', 'Crosstab1', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 200, 100, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Nullable = FALSE; // NOT NULL field
		$this->jumlah->Required = TRUE; // Required field
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->SourceTableVar = 'rekap_bantuan';
		$this->fields['jumlah'] = &$this->jumlah;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
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
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->jenis_bantuan_id;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Crosstab properties
	private $_sqlSelectAggregate = "";
	private $_sqlGroupByAggregate = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Group By Aggregate
	public function getSqlGroupByAggregate()
	{
		return ($this->_sqlGroupByAggregate != "") ? $this->_sqlGroupByAggregate : "";
	}
	public function setSqlGroupByAggregate($v)
	{
		$this->_sqlGroupByAggregate = $v;
	}

	// Table level SQL
	private $_columnField = "";
	private $_columnDateType = "";
	private $_columnCaptions = "";
	private $_columnNames = "";
	private $_columnValues = "";
	private $_sqlDistinctSelect = "";
	private $_sqlDistinctWhere = "";
	private $_sqlDistinctOrderBy = "";
	public $Columns;
	public $ColumnCount;
	public $Col;
	public $DistinctColumnFields = "";
	private $_columnLoaded = FALSE;

	// Column field
	public function getColumnField()
	{
		return ($this->_columnField != "") ? $this->_columnField : "`tahun_bantuan`";
	}
	public function setColumnField($v)
	{
		$this->_columnField = $v;
	}

	// Column date type
	public function getColumnDateType()
	{
		return ($this->_columnDateType != "") ? $this->_columnDateType : "";
	}
	public function setColumnDateType($v)
	{
		$this->_columnDateType = $v;
	}

	// Column captions
	public function getColumnCaptions()
	{
		global $Language;
		return ($this->_columnCaptions != "") ? $this->_columnCaptions : "";
	}
	public function setColumnCaptions($v)
	{
		$this->_columnCaptions = $v;
	}

	// Column names
	public function getColumnNames()
	{
		return ($this->_columnNames != "") ? $this->_columnNames : "";
	}
	public function setColumnNames($v)
	{
		$this->_columnNames = $v;
	}

	// Column values
	public function getColumnValues()
	{
		return ($this->_columnValues != "") ? $this->_columnValues : "";
	}
	public function setColumnValues($v)
	{
		$this->_columnValues = $v;
	}

	// Select Distinct
	public function getSqlDistinctSelect()
	{
		return ($this->_sqlDistinctSelect != "") ? $this->_sqlDistinctSelect : "SELECT DISTINCT `tahun_bantuan` FROM `rekap_bantuan`";
	}
	public function setSqlDistinctSelect($v)
	{
		$this->_sqlDistinctSelect = $v;
	}

	// Distinct Where
	public function getSqlDistinctWhere()
	{
		$where = ($this->_sqlDistinctWhere != "") ? $this->_sqlDistinctWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlDistinctWhere($v)
	{
		$this->_sqlDistinctWhere = $v;
	}

	// Distinct Order By
	public function getSqlDistinctOrderBy()
	{
		return ($this->_sqlDistinctOrderBy != "") ? $this->_sqlDistinctOrderBy : "`tahun_bantuan` ASC";
	}
	public function setSqlDistinctOrderBy($v)
	{
		$this->_sqlDistinctOrderBy = $v;
	}

	// Load column values
	public function loadColumnValues($filter = "")
	{
		global $Language;

		// Data already loaded, return
		if ($this->_columnLoaded)
			return;
		$conn = $this->getConnection();

		// Build SQL
		$sql = BuildReportSql($this->getSqlDistinctSelect(), $this->getSqlDistinctWhere(), "", "", $this->getSqlDistinctOrderBy(), $filter, "");

		// Load recordset
		$rscol = $conn->execute($sql);

		// Get distinct column count
		$this->ColumnCount = ($rscol) ? $rscol->recordCount() : 0;

/* Uncomment to show phrase
		if ($this->ColumnCount == 0) {
			if ($rscol)
				$rscol->close();
			echo "<p>" . $Language->phrase("NoDistinctColVals") . $sql . "</p>";
			exit();
		}
*/
		$this->Columns = Init2DArray($this->ColumnCount + 1, 7, NULL);
		$colcnt = 0;
		while ($rscol && !$rscol->EOF) {
			if ($rscol->fields[0] === NULL) {
				$wrkValue = Config("NULL_VALUE");
				$wrkCaption = $Language->phrase("NullLabel");
			} elseif (strval($rscol->fields[0]) == "") {
				$wrkValue = EMPTY_VALUE;
				$wrkCaption = $Language->phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Columns[$colcnt] = new CrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->moveNext();
		}
		if ($rscol)
			$rscol->close();

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$groupCount = 6;
		$this->SummaryFields[0] = new SummaryField('x_warga_id', 'warga_id', '`warga_id`', 'COUNT');
		$this->SummaryFields[0]->SummaryCaption = $Language->phrase("RptCnt");
		$this->SummaryFields[0]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = 0;

		// Update crosstab SQL
		$sqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($i = 1; $i <= $this->ColumnCount; $i++) {
				$fld = CrosstabFieldExpression($smry->SummaryType, $smry->Expression, $this->getColumnField(), $this->getColumnDateType(), $this->Columns[$i]->Value, "", "C" . $is . $i, $this->Dbid);
				if ($sqlFlds != "")
					$sqlFlds .= ", ";
				$sqlFlds .= $fld;
			}
		}
		$this->DistinctColumnFields = $sqlFlds ?: "NULL"; // In case ColumnCount = 0
		$this->_columnLoaded = TRUE;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->bantuan_id->ViewValue = GetDropDownDisplayValue($this->bantuan_id->CurrentValue, "", 0);
		$this->jenis_bantuan_id->ViewValue = GetDropDownDisplayValue($this->jenis_bantuan_id->CurrentValue, "", 0);
		$this->tahun_bantuan->ViewValue = $this->tahun_bantuan->CurrentValue;
		$this->kecamatan_id->ViewValue = $this->kecamatan_id->CurrentValue;
		$this->kelurahan_id->ViewValue = $this->kelurahan_id->CurrentValue;
		$this->rw_id->ViewValue = GetDropDownDisplayValue($this->rw_id->CurrentValue, "", 0);
		$this->rt_id->ViewValue = GetDropDownDisplayValue($this->rt_id->CurrentValue, "", 0);
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT `jenis_bantuan_id`, `bantuan_id`, `kecamatan_id`, `kelurahan_id`, `rw_id`, `rt_id`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
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
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "`jenis_bantuan_id`, `bantuan_id`, `kecamatan_id`, `kelurahan_id`, `rw_id`, `rt_id`";
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
			return "";
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
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		return $this->keyUrl("", $this->getUrlParm());
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
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
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

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
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