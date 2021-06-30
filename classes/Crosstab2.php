<?php namespace PHPMaker2020\bansos; ?>
<?php

/**
 * Table class for Crosstab2
 */
class Crosstab2 extends CrosstabTable
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
		$this->TableVar = 'Crosstab2';
		$this->TableName = 'Crosstab2';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`rekap_bantuan2`";
		$this->ReportSourceTable = 'rekap_bantuan2'; // Report source table
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

		// id
		$this->id = new ReportField('Crosstab2', 'Crosstab2', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['id'] = &$this->id;

		// bansos_id
		$this->bansos_id = new ReportField('Crosstab2', 'Crosstab2', 'x_bansos_id', 'bansos_id', '`bansos_id`', '`bansos_id`', 3, 11, -1, FALSE, '`bansos_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bansos_id->GroupingFieldId = 1;
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
		$this->bansos_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->bansos_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['bansos_id'] = &$this->bansos_id;

		// warga_id
		$this->warga_id = new ReportField('Crosstab2', 'Crosstab2', 'x_warga_id', 'warga_id', '`warga_id`', '`warga_id`', 3, 11, -1, FALSE, '`EV__warga_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
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
		$this->warga_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['warga_id'] = &$this->warga_id;

		// jenis_bantuan_id
		$this->jenis_bantuan_id = new ReportField('Crosstab2', 'Crosstab2', 'x_jenis_bantuan_id', 'jenis_bantuan_id', '`jenis_bantuan_id`', '`jenis_bantuan_id`', 3, 11, -1, FALSE, '`jenis_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenis_bantuan_id->GroupingFieldId = 2;
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
		$this->jenis_bantuan_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['jenis_bantuan_id'] = &$this->jenis_bantuan_id;

		// type
		$this->type = new ReportField('Crosstab2', 'Crosstab2', 'x_type', 'type', '`type`', '`type`', 202, 1, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->type->GroupingFieldId = 3;
		$this->type->Nullable = FALSE; // NOT NULL field
		$this->type->Sortable = TRUE; // Allow sort
		$this->type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->type->Lookup = new Lookup('type', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->type->Lookup = new Lookup('type', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->type->Lookup = new Lookup('type', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->type->OptionCount = 2;
		$this->type->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->type->SourceTableVar = 'rekap_bantuan2';
		$this->fields['type'] = &$this->type;

		// jumlah
		$this->jumlah = new ReportField('Crosstab2', 'Crosstab2', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 200, 100, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Nullable = FALSE; // NOT NULL field
		$this->jumlah->Required = TRUE; // Required field
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->SourceTableVar = 'rekap_bantuan2';
		$this->fields['jumlah'] = &$this->jumlah;

		// sumber_bantuan_id
		$this->sumber_bantuan_id = new ReportField('Crosstab2', 'Crosstab2', 'x_sumber_bantuan_id', 'sumber_bantuan_id', '`sumber_bantuan_id`', '`sumber_bantuan_id`', 3, 11, -1, FALSE, '`sumber_bantuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->sumber_bantuan_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['sumber_bantuan_id'] = &$this->sumber_bantuan_id;

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id = new ReportField('Crosstab2', 'Crosstab2', 'x_pengambilan_bantuuan_id', 'pengambilan_bantuuan_id', '`pengambilan_bantuuan_id`', '`pengambilan_bantuuan_id`', 3, 11, -1, FALSE, '`pengambilan_bantuuan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->pengambilan_bantuuan_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['pengambilan_bantuuan_id'] = &$this->pengambilan_bantuuan_id;

		// frekuensi
		$this->frekuensi = new ReportField('Crosstab2', 'Crosstab2', 'x_frekuensi', 'frekuensi', '`frekuensi`', '`frekuensi`', 200, 100, -1, FALSE, '`frekuensi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->frekuensi->Nullable = FALSE; // NOT NULL field
		$this->frekuensi->Required = TRUE; // Required field
		$this->frekuensi->Sortable = TRUE; // Allow sort
		$this->frekuensi->SourceTableVar = 'rekap_bantuan2';
		$this->fields['frekuensi'] = &$this->frekuensi;

		// bulan
		$this->bulan = new ReportField('Crosstab2', 'Crosstab2', 'x_bulan', 'bulan', '`bulan`', '`bulan`', 200, 10, -1, FALSE, '`bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->bulan->Nullable = FALSE; // NOT NULL field
		$this->bulan->Required = TRUE; // Required field
		$this->bulan->Sortable = TRUE; // Allow sort
		$this->bulan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->bulan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->bulan->Lookup = new Lookup('bulan', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->bulan->Lookup = new Lookup('bulan', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->bulan->Lookup = new Lookup('bulan', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->bulan->OptionCount = 12;
		$this->bulan->SourceTableVar = 'rekap_bantuan2';
		$this->fields['bulan'] = &$this->bulan;

		// tahun
		$this->tahun = new ReportField('Crosstab2', 'Crosstab2', 'x_tahun', 'tahun', '`tahun`', '`tahun`', 3, 11, -1, FALSE, '`tahun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tahun->Nullable = FALSE; // NOT NULL field
		$this->tahun->Required = TRUE; // Required field
		$this->tahun->Sortable = TRUE; // Allow sort
		$this->tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->tahun->SourceTableVar = 'rekap_bantuan2';
		$this->fields['tahun'] = &$this->tahun;

		// keterangan_bantuan
		$this->keterangan_bantuan = new ReportField('Crosstab2', 'Crosstab2', 'x_keterangan_bantuan', 'keterangan_bantuan', '`keterangan_bantuan`', '`keterangan_bantuan`', 201, 65535, -1, FALSE, '`keterangan_bantuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_bantuan->Sortable = TRUE; // Allow sort
		$this->keterangan_bantuan->SourceTableVar = 'rekap_bantuan2';
		$this->fields['keterangan_bantuan'] = &$this->keterangan_bantuan;

		// status
		$this->status = new ReportField('Crosstab2', 'Crosstab2', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->status->Lookup = new Lookup('status', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'Crosstab2', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status->OptionCount = 3;
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->status->SourceTableVar = 'rekap_bantuan2';
		$this->fields['status'] = &$this->status;

		// kk
		$this->kk = new ReportField('Crosstab2', 'Crosstab2', 'x_kk', 'kk', '`kk`', '`kk`', 200, 100, -1, FALSE, '`kk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kk->Nullable = FALSE; // NOT NULL field
		$this->kk->Required = TRUE; // Required field
		$this->kk->Sortable = TRUE; // Allow sort
		$this->kk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->kk->SourceTableVar = 'rekap_bantuan2';
		$this->fields['kk'] = &$this->kk;

		// nik
		$this->nik = new ReportField('Crosstab2', 'Crosstab2', 'x_nik', 'nik', '`nik`', '`nik`', 20, 16, -1, FALSE, '`nik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik->Nullable = FALSE; // NOT NULL field
		$this->nik->Required = TRUE; // Required field
		$this->nik->Sortable = TRUE; // Allow sort
		$this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->nik->SourceTableVar = 'rekap_bantuan2';
		$this->fields['nik'] = &$this->nik;

		// nama
		$this->nama = new ReportField('Crosstab2', 'Crosstab2', 'x_nama', 'nama', '`nama`', '`nama`', 200, 100, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Nullable = FALSE; // NOT NULL field
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->nama->SourceTableVar = 'rekap_bantuan2';
		$this->fields['nama'] = &$this->nama;

		// provinsi_id
		$this->provinsi_id = new ReportField('Crosstab2', 'Crosstab2', 'x_provinsi_id', 'provinsi_id', '`provinsi_id`', '`provinsi_id`', 20, 20, -1, FALSE, '`provinsi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->provinsi_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['provinsi_id'] = &$this->provinsi_id;

		// kabupaten_id
		$this->kabupaten_id = new ReportField('Crosstab2', 'Crosstab2', 'x_kabupaten_id', 'kabupaten_id', '`kabupaten_id`', '`kabupaten_id`', 20, 20, -1, FALSE, '`kabupaten_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kabupaten_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['kabupaten_id'] = &$this->kabupaten_id;

		// kecamatan_id
		$this->kecamatan_id = new ReportField('Crosstab2', 'Crosstab2', 'x_kecamatan_id', 'kecamatan_id', '`kecamatan_id`', '`kecamatan_id`', 20, 20, -1, FALSE, '`kecamatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kecamatan_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['kecamatan_id'] = &$this->kecamatan_id;

		// kelurahan_id
		$this->kelurahan_id = new ReportField('Crosstab2', 'Crosstab2', 'x_kelurahan_id', 'kelurahan_id', '`kelurahan_id`', '`kelurahan_id`', 20, 20, -1, FALSE, '`kelurahan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kelurahan_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['kelurahan_id'] = &$this->kelurahan_id;

		// rw_id
		$this->rw_id = new ReportField('Crosstab2', 'Crosstab2', 'x_rw_id', 'rw_id', '`rw_id`', '`rw_id`', 20, 20, -1, FALSE, '`rw_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->rw_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['rw_id'] = &$this->rw_id;

		// rt_id
		$this->rt_id = new ReportField('Crosstab2', 'Crosstab2', 'x_rt_id', 'rt_id', '`rt_id`', '`rt_id`', 20, 20, -1, FALSE, '`rt_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->rt_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['rt_id'] = &$this->rt_id;

		// alamat_id
		$this->alamat_id = new ReportField('Crosstab2', 'Crosstab2', 'x_alamat_id', 'alamat_id', '`alamat_id`', '`alamat_id`', 3, 11, -1, FALSE, '`alamat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->alamat_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['alamat_id'] = &$this->alamat_id;

		// nomor_rumah
		$this->nomor_rumah = new ReportField('Crosstab2', 'Crosstab2', 'x_nomor_rumah', 'nomor_rumah', '`nomor_rumah`', '`nomor_rumah`', 200, 10, -1, FALSE, '`nomor_rumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_rumah->Nullable = FALSE; // NOT NULL field
		$this->nomor_rumah->Required = TRUE; // Required field
		$this->nomor_rumah->Sortable = TRUE; // Allow sort
		$this->nomor_rumah->SourceTableVar = 'rekap_bantuan2';
		$this->fields['nomor_rumah'] = &$this->nomor_rumah;

		// status_warga_id
		$this->status_warga_id = new ReportField('Crosstab2', 'Crosstab2', 'x_status_warga_id', 'status_warga_id', '`status_warga_id`', '`status_warga_id`', 3, 11, -1, FALSE, '`status_warga_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->status_warga_id->SourceTableVar = 'rekap_bantuan2';
		$this->fields['status_warga_id'] = &$this->status_warga_id;

		// keterangan_warga
		$this->keterangan_warga = new ReportField('Crosstab2', 'Crosstab2', 'x_keterangan_warga', 'keterangan_warga', '`keterangan_warga`', '`keterangan_warga`', 201, 65535, -1, FALSE, '`keterangan_warga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan_warga->Sortable = TRUE; // Allow sort
		$this->keterangan_warga->SourceTableVar = 'rekap_bantuan2';
		$this->fields['keterangan_warga'] = &$this->keterangan_warga;
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
		$firstGroupField = &$this->bansos_id;
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
		return ($this->_columnField != "") ? $this->_columnField : "`tahun`";
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
		return ($this->_sqlDistinctSelect != "") ? $this->_sqlDistinctSelect : "SELECT DISTINCT `tahun` FROM `rekap_bantuan2`";
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
		return ($this->_sqlDistinctOrderBy != "") ? $this->_sqlDistinctOrderBy : "`tahun` ASC";
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
		$this->Columns = Init2DArray($this->ColumnCount + 1, 4, NULL);
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

		$groupCount = 3;
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
		$this->bansos_id->ViewValue = GetDropDownDisplayValue($this->bansos_id->CurrentValue, "", 0);
		$this->jenis_bantuan_id->ViewValue = GetDropDownDisplayValue($this->jenis_bantuan_id->CurrentValue, "", 0);
		$this->type->ViewValue = GetDropDownDisplayValue($this->type->CurrentValue, "", 0);
		$this->tahun->ViewValue = $this->tahun->CurrentValue;
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT `bansos_id`, `jenis_bantuan_id`, `type`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
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
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "`bansos_id`, `jenis_bantuan_id`, `type`";
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