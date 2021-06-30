<?php namespace PHPMaker2020\bansos; ?>
<?php

/**
 * Table class for master_warga
 */
class master_warga extends DbTable
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
	public $status_warga_id;
	public $na;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'master_warga';
		$this->TableName = 'master_warga';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`master_warga`";
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
		$this->id = new DbField('master_warga', 'master_warga', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kk
		$this->kk = new DbField('master_warga', 'master_warga', 'x_kk', 'kk', '`kk`', '`kk`', 200, 100, -1, FALSE, '`kk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kk->Nullable = FALSE; // NOT NULL field
		$this->kk->Required = TRUE; // Required field
		$this->kk->Sortable = TRUE; // Allow sort
		$this->kk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kk'] = &$this->kk;

		// nik
		$this->nik = new DbField('master_warga', 'master_warga', 'x_nik', 'nik', '`nik`', '`nik`', 20, 16, -1, FALSE, '`nik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik->Nullable = FALSE; // NOT NULL field
		$this->nik->Required = TRUE; // Required field
		$this->nik->Sortable = TRUE; // Allow sort
		$this->nik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nik'] = &$this->nik;

		// nama
		$this->nama = new DbField('master_warga', 'master_warga', 'x_nama', 'nama', '`nama`', '`nama`', 200, 100, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Nullable = FALSE; // NOT NULL field
		$this->nama->Required = TRUE; // Required field
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// provinsi_id
		$this->provinsi_id = new DbField('master_warga', 'master_warga', 'x_provinsi_id', 'provinsi_id', '`provinsi_id`', '`provinsi_id`', 20, 20, -1, FALSE, '`provinsi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kabupaten_id = new DbField('master_warga', 'master_warga', 'x_kabupaten_id', 'kabupaten_id', '`kabupaten_id`', '`kabupaten_id`', 20, 20, -1, FALSE, '`kabupaten_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kecamatan_id = new DbField('master_warga', 'master_warga', 'x_kecamatan_id', 'kecamatan_id', '`kecamatan_id`', '`kecamatan_id`', 20, 20, -1, FALSE, '`kecamatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->kelurahan_id = new DbField('master_warga', 'master_warga', 'x_kelurahan_id', 'kelurahan_id', '`kelurahan_id`', '`kelurahan_id`', 20, 20, -1, FALSE, '`kelurahan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->rw_id = new DbField('master_warga', 'master_warga', 'x_rw_id', 'rw_id', '`rw_id`', '`rw_id`', 20, 20, -1, FALSE, '`rw_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->rt_id = new DbField('master_warga', 'master_warga', 'x_rt_id', 'rt_id', '`rt_id`', '`rt_id`', 20, 20, -1, FALSE, '`rt_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->alamat_id = new DbField('master_warga', 'master_warga', 'x_alamat_id', 'alamat_id', '`alamat_id`', '`alamat_id`', 3, 11, -1, FALSE, '`alamat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->nomor_rumah = new DbField('master_warga', 'master_warga', 'x_nomor_rumah', 'nomor_rumah', '`nomor_rumah`', '`nomor_rumah`', 200, 10, -1, FALSE, '`nomor_rumah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_rumah->Nullable = FALSE; // NOT NULL field
		$this->nomor_rumah->Required = TRUE; // Required field
		$this->nomor_rumah->Sortable = TRUE; // Allow sort
		$this->fields['nomor_rumah'] = &$this->nomor_rumah;

		// keterangan
		$this->keterangan = new DbField('master_warga', 'master_warga', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 201, 65535, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// status_warga_id
		$this->status_warga_id = new DbField('master_warga', 'master_warga', 'x_status_warga_id', 'status_warga_id', '`status_warga_id`', '`status_warga_id`', 3, 11, -1, FALSE, '`status_warga_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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

		// na
		$this->na = new DbField('master_warga', 'master_warga', 'x_na', 'na', '`na`', '`na`', 202, 1, -1, FALSE, '`na`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->na->Nullable = FALSE; // NOT NULL field
		$this->na->Sortable = TRUE; // Allow sort
		$this->na->DataType = DATATYPE_BOOLEAN;
		$this->na->TrueValue = "y";
		$this->na->FalseValue = "n";
		switch ($CurrentLanguage) {
			case "en":
				$this->na->Lookup = new Lookup('na', 'master_warga', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			case "id":
				$this->na->Lookup = new Lookup('na', 'master_warga', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->na->Lookup = new Lookup('na', 'master_warga', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->na->OptionCount = 2;
		$this->na->AdvancedSearch->SearchValueDefault = "n";
		$this->na->AdvancedSearch->SearchOperatorDefault = "=";
		$this->na->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->na->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['na'] = &$this->na;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`master_warga`";
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
		$this->status_warga_id->DbValue = $row['status_warga_id'];
		$this->na->DbValue = $row['na'];
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
			return "master_wargalist.php";
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
		if ($pageName == "master_wargaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "master_wargaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "master_wargaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "master_wargalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("master_wargaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("master_wargaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "master_wargaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "master_wargaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("master_wargaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("master_wargaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("master_wargadelete.php", $this->getUrlParm());
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
		$this->status_warga_id->setDbValue($rs->fields('status_warga_id'));
		$this->na->setDbValue($rs->fields('na'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
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
		// status_warga_id
		// na
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

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

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

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

		// na
		if (ConvertToBool($this->na->CurrentValue)) {
			$this->na->ViewValue = $this->na->tagCaption(2) != "" ? $this->na->tagCaption(2) : "Tidak";
		} else {
			$this->na->ViewValue = $this->na->tagCaption(1) != "" ? $this->na->tagCaption(1) : "Ya";
		}
		$this->na->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

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

		// status_warga_id
		$this->status_warga_id->LinkCustomAttributes = "";
		$this->status_warga_id->HrefValue = "";
		$this->status_warga_id->TooltipValue = "";

		// na
		$this->na->LinkCustomAttributes = "";
		$this->na->HrefValue = "";
		$this->na->TooltipValue = "";

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

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// status_warga_id
		$this->status_warga_id->EditCustomAttributes = "";

		// na
		$this->na->EditCustomAttributes = "";
		$this->na->EditValue = $this->na->options(FALSE);

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
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->status_warga_id);
					$doc->exportCaption($this->na);
				} else {
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
						$doc->exportField($this->keterangan);
						$doc->exportField($this->status_warga_id);
						$doc->exportField($this->na);
					} else {
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
		// $id = $this->id->CurrentValue;
		// $alamat_id = $this->alamat_id->CurrentValue;
		// $get_alamat = get1row("SELECT * FROM master_alamat WHERE id = $alamat_id");
		// if (!empty($get_alamat)) {
		// 	$provinsi_id = $get_alamat['provinsi_id'];
		// 	$kabupaten_id = $get_alamat['kabupaten_id'];
		// 	$kecamatan_id = $get_alamat['kecamatan_id'];
		// 	$kelurahan_id = $get_alamat['kelurahan_id'];
		// 	$rw_id = $get_alamat['rw_id'];
		// 	$rt_id = $get_alamat['rt_id'];
		// 	$sql_update = "UPDATE master_warga SET provinsi_id = $provinsi_id, kabupaten_id = $kabupaten_id, kecamatan_id = $kecamatan_id, kelurahan_id = $kelurahan_id,rw_id = $rw_id, rt_id = $rt_id WHERE id = $id";
		// 	_query($sql_update);
		// }

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>