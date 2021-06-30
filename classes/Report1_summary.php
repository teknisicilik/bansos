<?php
namespace PHPMaker2020\bansos;

/**
 * Page class
 */
class Report1_summary extends Report1
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}";

	// Table name
	public $TableName = 'Report1';

	// Page object name
	public $PageObjName = "Report1_summary";

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Report1)
		if (!isset($GLOBALS["Report1"]) || get_class($GLOBALS["Report1"]) == PROJECT_NAMESPACE . "Report1") {
			$GLOBALS["Report1"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Report1"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Report1');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fsummary";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->isExport() && !$this->isExport("print") && $fn = Config("REPORT_EXPORT_FUNCTIONS." . $this->Export)) {
			$content = ob_get_clean();
			$this->$fn($content);
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}

		// Exit if not in dashboard
		if (!$DashboardReport)
			exit();
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		if (!$Security->isLoggedIn()) // Logged in
			return FALSE;
		if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar]))
			$lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
		$lookup->RenderEditFunc = ""; // Set up edit renderer

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
	}

	// Initialize common variables
	public $HideOptions = FALSE;
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Records
	public $GroupRecords = [];
	public $DetailRecords = [];
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count (start from 1 for each group)
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = "";
	public $SearchPanelClass = "ew-search-panel collapse"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $DrillDownList = "";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $TotalCount;
	public $PageTotalCount;
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb,
			$DashboardReport, $CustomExportType, $ReportExportType;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canReport()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header
		$ReportExportType = $ExportType; // Report export type, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";

		// Set field visibility for detail fields
		$this->type->setVisibility();
		$this->tahun_bantuan->setVisibility();
		$this->kk->setVisibility();
		$this->nik->setVisibility();
		$this->nama->setVisibility();
		$this->kecamatan_id->setVisibility();
		$this->kelurahan_id->setVisibility();
		$this->rw_id->setVisibility();
		$this->rt_id->setVisibility();
		$this->nama_kecamatan->setVisibility();
		$this->nama_kelurahan->setVisibility();
		$this->nama_rw->setVisibility();
		$this->nama_rt->setVisibility();

		// Handle drill down
		$drillDownFilter = $this->getDrillDownFilter();
		$DrillDownInPanel = $this->DrillDownInPanel;
		if ($this->DrillDown)
			AddFilter($this->Filter, $drillDownFilter);

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load custom filters
		$this->Page_FilterLoad();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->SearchWhere, $extendedFilter);

		// Call Page Selecting event
		$this->Page_Selecting($this->SearchWhere);

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Get sort
		$this->Sort = $this->getSort();

		// Update filter
		AddFilter($this->Filter, $this->SearchWhere);

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
				if ($this->SearchWhere == "0=101") {
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($Language->phrase("NoRecord"));
				}
		}

		// Hide export options if export/dashboard report/hide options
		if ($this->isExport() || $DashboardReport || $this->HideOptions)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report/hide options
		if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Get group records
		if ($this->TotalGroups > 0) {
			$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
			$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
			$grpRs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->GroupRecords = $grpRs->getRows(); // Get records of first grouping field
			$this->loadGroupRowValues();
			$this->GroupCount = 1;
		}

		// Init detail records
		$this->DetailRecords = [];
		$this->setupFieldCount();

		// Set the last group to display if not export all
		if ($this->ExportAll && $this->isExport()) {
			$this->StopGroup = $this->TotalGroups;
		} else {
			$this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
		}

		// Stop group <= total number of groups
		if (intval($this->StopGroup) > intval($this->TotalGroups))
			$this->StopGroup = $this->TotalGroups;
		$this->RecordCount = 0;
		$this->RecordIndex = 0;

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load group row values
	public function loadGroupRowValues()
	{
		$cnt = count($this->GroupRecords); // Get record count
		if ($this->GroupCount < $cnt)
			$this->jenis_bantuan_id->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->jenis_bantuan_id->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["jenis_bantuan_id"] = $record['jenis_bantuan_id'];
			$data["bantuan_id"] = $record['bantuan_id'];
			$data["type"] = $record['type'];
			$data["tahun_bantuan"] = $record['tahun_bantuan'];
			$data["warga_id"] = $record['warga_id'];
			$data["kk"] = $record['kk'];
			$data["nik"] = $record['nik'];
			$data["nama"] = $record['nama'];
			$data["provinsi_id"] = $record['provinsi_id'];
			$data["kabupaten_id"] = $record['kabupaten_id'];
			$data["kecamatan_id"] = $record['kecamatan_id'];
			$data["kelurahan_id"] = $record['kelurahan_id'];
			$data["rw_id"] = $record['rw_id'];
			$data["rt_id"] = $record['rt_id'];
			$data["alamat_id"] = $record['alamat_id'];
			$data["nomor_rumah"] = $record['nomor_rumah'];
			$data["status_bantuan"] = $record['status_bantuan'];
			$data["nama_kecamatan"] = $record['nama_kecamatan'];
			$data["nama_kelurahan"] = $record['nama_kelurahan'];
			$data["nama_rw"] = $record['nama_rw'];
			$data["nama_rt"] = $record['nama_rt'];
			$this->Rows[] = $data;
		}
		$this->jenis_bantuan_id->setDbValue(GroupValue($this->jenis_bantuan_id, $record['jenis_bantuan_id']));
		$this->bantuan_id->setDbValue($record['bantuan_id']);
		$this->type->setDbValue($record['type']);
		$this->tahun_bantuan->setDbValue($record['tahun_bantuan']);
		$this->keterangan_bantuan->setDbValue($record['keterangan_bantuan']);
		$this->warga_id->setDbValue($record['warga_id']);
		$this->kk->setDbValue($record['kk']);
		$this->nik->setDbValue($record['nik']);
		$this->nama->setDbValue($record['nama']);
		$this->provinsi_id->setDbValue($record['provinsi_id']);
		$this->kabupaten_id->setDbValue($record['kabupaten_id']);
		$this->kecamatan_id->setDbValue($record['kecamatan_id']);
		$this->kelurahan_id->setDbValue($record['kelurahan_id']);
		$this->rw_id->setDbValue($record['rw_id']);
		$this->rt_id->setDbValue($record['rt_id']);
		$this->alamat_id->setDbValue($record['alamat_id']);
		$this->nomor_rumah->setDbValue($record['nomor_rumah']);
		$this->keterangan->setDbValue($record['keterangan']);
		$this->status_bantuan->setDbValue($record['status_bantuan']);
		$this->nama_kecamatan->setDbValue($record['nama_kecamatan']);
		$this->nama_kelurahan->setDbValue($record['nama_kelurahan']);
		$this->nama_rw->setDbValue($record['nama_rw']);
		$this->nama_rt->setDbValue($record['nama_rt']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->jenis_bantuan_id;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
			$this->PageTotalCount = count($records);
		} elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$cnt = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$cnt = 0;
			}
			$this->TotalCount = $cnt;
			$hasSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// jenis_bantuan_id
		// bantuan_id
		// type
		// tahun_bantuan
		// kk
		// nik
		// nama
		// kecamatan_id
		// kelurahan_id
		// rw_id
		// rt_id
		// nama_kecamatan
		// nama_kelurahan
		// nama_rw
		// nama_rt

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// jenis_bantuan_id
			$this->jenis_bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenis_bantuan_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
			else
				$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $this->jenis_bantuan_id->Lookup !== NULL && is_array($this->jenis_bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jenis_bantuan_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->jenis_bantuan_id->EditValue = array_values($this->jenis_bantuan_id->Lookup->Options);
				if ($this->jenis_bantuan_id->AdvancedSearch->ViewValue == "")
					$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jenis_bantuan_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`na` = 'n'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->jenis_bantuan_id->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $this->jenis_bantuan_id->displayValue($arwrk);
				} else {
					$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenis_bantuan_id->EditValue = $arwrk;
			}

			// bantuan_id
			$this->bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->bantuan_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->bantuan_id->AdvancedSearch->ViewValue = $this->bantuan_id->lookupCacheOption($curVal);
			else
				$this->bantuan_id->AdvancedSearch->ViewValue = $this->bantuan_id->Lookup !== NULL && is_array($this->bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->bantuan_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->bantuan_id->EditValue = array_values($this->bantuan_id->Lookup->Options);
				if ($this->bantuan_id->AdvancedSearch->ViewValue == "")
					$this->bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->bantuan_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->bantuan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->bantuan_id->AdvancedSearch->ViewValue = $this->bantuan_id->displayValue($arwrk);
				} else {
					$this->bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->bantuan_id->EditValue = $arwrk;
			}

			// type
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = $this->type->options(TRUE);

			// tahun_bantuan
			$this->tahun_bantuan->EditAttrs["class"] = "form-control";
			$this->tahun_bantuan->EditCustomAttributes = "";
			$this->tahun_bantuan->EditValue = HtmlEncode($this->tahun_bantuan->AdvancedSearch->SearchValue);
			$this->tahun_bantuan->PlaceHolder = RemoveHtml($this->tahun_bantuan->caption());

			// kecamatan_id
			$this->kecamatan_id->EditAttrs["class"] = "form-control";
			$this->kecamatan_id->EditCustomAttributes = "";
			$this->kecamatan_id->EditValue = HtmlEncode($this->kecamatan_id->AdvancedSearch->SearchValue);
			$curVal = strval($this->kecamatan_id->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->kecamatan_id->EditValue = $this->kecamatan_id->lookupCacheOption($curVal);
				if ($this->kecamatan_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`idkabupaten` = ".kabupatenId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->kecamatan_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kecamatan_id->EditValue = $this->kecamatan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kecamatan_id->EditValue = HtmlEncode($this->kecamatan_id->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->kecamatan_id->EditValue = NULL;
			}
			$this->kecamatan_id->PlaceHolder = RemoveHtml($this->kecamatan_id->caption());

			// kelurahan_id
			$this->kelurahan_id->EditAttrs["class"] = "form-control";
			$this->kelurahan_id->EditCustomAttributes = "";
			$this->kelurahan_id->EditValue = HtmlEncode($this->kelurahan_id->AdvancedSearch->SearchValue);
			$curVal = strval($this->kelurahan_id->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->kelurahan_id->EditValue = $this->kelurahan_id->lookupCacheOption($curVal);
				if ($this->kelurahan_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`kecamatan_id` ".filterKelurahan()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->kelurahan_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kelurahan_id->EditValue = $this->kelurahan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kelurahan_id->EditValue = HtmlEncode($this->kelurahan_id->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->kelurahan_id->EditValue = NULL;
			}
			$this->kelurahan_id->PlaceHolder = RemoveHtml($this->kelurahan_id->caption());

			// rw_id
			$this->rw_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->rw_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->rw_id->AdvancedSearch->ViewValue = $this->rw_id->lookupCacheOption($curVal);
			else
				$this->rw_id->AdvancedSearch->ViewValue = $this->rw_id->Lookup !== NULL && is_array($this->rw_id->Lookup->Options) ? $curVal : NULL;
			if ($this->rw_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->rw_id->EditValue = array_values($this->rw_id->Lookup->Options);
				if ($this->rw_id->AdvancedSearch->ViewValue == "")
					$this->rw_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->rw_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->rw_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->rw_id->AdvancedSearch->ViewValue = $this->rw_id->displayValue($arwrk);
				} else {
					$this->rw_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->rw_id->EditValue = $arwrk;
			}

			// rt_id
			$this->rt_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->rt_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->rt_id->AdvancedSearch->ViewValue = $this->rt_id->lookupCacheOption($curVal);
			else
				$this->rt_id->AdvancedSearch->ViewValue = $this->rt_id->Lookup !== NULL && is_array($this->rt_id->Lookup->Options) ? $curVal : NULL;
			if ($this->rt_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->rt_id->EditValue = array_values($this->rt_id->Lookup->Options);
				if ($this->rt_id->AdvancedSearch->ViewValue == "")
					$this->rt_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->rt_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->rt_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->rt_id->AdvancedSearch->ViewValue = $this->rt_id->displayValue($arwrk);
				} else {
					$this->rt_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->rt_id->EditValue = $arwrk;
			}
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->jenis_bantuan_id->groupValue(); // Set up group attribute
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 2)
				$this->RowAttrs["data-group-2"] = $this->bantuan_id->groupValue(); // Set up group attribute 2

			// jenis_bantuan_id
			$curVal = strval($this->jenis_bantuan_id->groupValue());
			if ($curVal != "") {
				$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
				if ($this->jenis_bantuan_id->GroupViewValue === NULL) { // Lookup from database
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
						$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->groupValue();
					}
				}
			} else {
				$this->jenis_bantuan_id->GroupViewValue = NULL;
			}
			$this->jenis_bantuan_id->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->jenis_bantuan_id->ViewCustomAttributes = "";
			$this->jenis_bantuan_id->GroupViewValue = DisplayGroupValue($this->jenis_bantuan_id, $this->jenis_bantuan_id->GroupViewValue);

			// bantuan_id
			$curVal = strval($this->bantuan_id->groupValue());
			if ($curVal != "") {
				$this->bantuan_id->GroupViewValue = $this->bantuan_id->lookupCacheOption($curVal);
				if ($this->bantuan_id->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bantuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->bantuan_id->GroupViewValue = $this->bantuan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bantuan_id->GroupViewValue = $this->bantuan_id->groupValue();
					}
				}
			} else {
				$this->bantuan_id->GroupViewValue = NULL;
			}
			$this->bantuan_id->CellCssClass = ($this->RowGroupLevel == 2 ? "ew-rpt-grp-summary-2" : "ew-rpt-grp-field-2");
			$this->bantuan_id->ViewCustomAttributes = "";
			$this->bantuan_id->GroupViewValue = DisplayGroupValue($this->bantuan_id, $this->bantuan_id->GroupViewValue);

			// jenis_bantuan_id
			$this->jenis_bantuan_id->HrefValue = "";

			// bantuan_id
			$this->bantuan_id->HrefValue = "";

			// type
			$this->type->HrefValue = "";

			// tahun_bantuan
			$this->tahun_bantuan->HrefValue = "";

			// kk
			$this->kk->HrefValue = "";

			// nik
			$this->nik->HrefValue = "";

			// nama
			$this->nama->HrefValue = "";

			// kecamatan_id
			$this->kecamatan_id->HrefValue = "";

			// kelurahan_id
			$this->kelurahan_id->HrefValue = "";

			// rw_id
			$this->rw_id->HrefValue = "";

			// rt_id
			$this->rt_id->HrefValue = "";

			// nama_kecamatan
			$this->nama_kecamatan->HrefValue = "";

			// nama_kelurahan
			$this->nama_kelurahan->HrefValue = "";

			// nama_rw
			$this->nama_rw->HrefValue = "";

			// nama_rt
			$this->nama_rt->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->jenis_bantuan_id->groupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->bantuan_id->groupValue(); // Set up group attribute 2
			} else {
			$this->RowAttrs["data-group"] = $this->jenis_bantuan_id->groupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->bantuan_id->groupValue(); // Set up group attribute 2
			}

			// jenis_bantuan_id
			$curVal = strval($this->jenis_bantuan_id->groupValue());
			if ($curVal != "") {
				$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
				if ($this->jenis_bantuan_id->GroupViewValue === NULL) { // Lookup from database
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
						$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenis_bantuan_id->GroupViewValue = $this->jenis_bantuan_id->groupValue();
					}
				}
			} else {
				$this->jenis_bantuan_id->GroupViewValue = NULL;
			}
			$this->jenis_bantuan_id->CellCssClass = "ew-rpt-grp-field-1";
			$this->jenis_bantuan_id->ViewCustomAttributes = "";
			$this->jenis_bantuan_id->GroupViewValue = DisplayGroupValue($this->jenis_bantuan_id, $this->jenis_bantuan_id->GroupViewValue);
			if (!$this->jenis_bantuan_id->LevelBreak)
				$this->jenis_bantuan_id->GroupViewValue = "&nbsp;";
			else
				$this->jenis_bantuan_id->LevelBreak = FALSE;

			// bantuan_id
			$curVal = strval($this->bantuan_id->groupValue());
			if ($curVal != "") {
				$this->bantuan_id->GroupViewValue = $this->bantuan_id->lookupCacheOption($curVal);
				if ($this->bantuan_id->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->bantuan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->bantuan_id->GroupViewValue = $this->bantuan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->bantuan_id->GroupViewValue = $this->bantuan_id->groupValue();
					}
				}
			} else {
				$this->bantuan_id->GroupViewValue = NULL;
			}
			$this->bantuan_id->CellCssClass = "ew-rpt-grp-field-2";
			$this->bantuan_id->ViewCustomAttributes = "";
			$this->bantuan_id->GroupViewValue = DisplayGroupValue($this->bantuan_id, $this->bantuan_id->GroupViewValue);
			if (!$this->bantuan_id->LevelBreak)
				$this->bantuan_id->GroupViewValue = "&nbsp;";
			else
				$this->bantuan_id->LevelBreak = FALSE;

			// type
			if (strval($this->type->CurrentValue) != "") {
				$this->type->ViewValue = $this->type->optionCaption($this->type->CurrentValue);
			} else {
				$this->type->ViewValue = NULL;
			}
			$this->type->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->type->ViewCustomAttributes = "";

			// tahun_bantuan
			$this->tahun_bantuan->ViewValue = $this->tahun_bantuan->CurrentValue;
			$this->tahun_bantuan->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->tahun_bantuan->ViewCustomAttributes = "";

			// kk
			$this->kk->ViewValue = $this->kk->CurrentValue;
			$this->kk->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->kk->ViewCustomAttributes = "";

			// nik
			$this->nik->ViewValue = $this->nik->CurrentValue;
			$this->nik->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->nik->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->nama->ViewCustomAttributes = "";

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
			$this->kecamatan_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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
			$this->kelurahan_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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
			$this->rw_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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
			$this->rt_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->rt_id->ViewCustomAttributes = "";

			// nama_kecamatan
			$this->nama_kecamatan->ViewValue = $this->nama_kecamatan->CurrentValue;
			$this->nama_kecamatan->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->nama_kecamatan->ViewCustomAttributes = "";

			// nama_kelurahan
			$this->nama_kelurahan->ViewValue = $this->nama_kelurahan->CurrentValue;
			$this->nama_kelurahan->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->nama_kelurahan->ViewCustomAttributes = "";

			// nama_rw
			$this->nama_rw->ViewValue = $this->nama_rw->CurrentValue;
			$this->nama_rw->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->nama_rw->ViewCustomAttributes = "";

			// nama_rt
			$this->nama_rt->ViewValue = $this->nama_rt->CurrentValue;
			$this->nama_rt->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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

			// tahun_bantuan
			$this->tahun_bantuan->LinkCustomAttributes = "";
			$this->tahun_bantuan->HrefValue = "";
			$this->tahun_bantuan->TooltipValue = "";

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
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// jenis_bantuan_id
			$currentValue = $this->jenis_bantuan_id->GroupViewValue;
			$viewValue = &$this->jenis_bantuan_id->GroupViewValue;
			$viewAttrs = &$this->jenis_bantuan_id->ViewAttrs;
			$cellAttrs = &$this->jenis_bantuan_id->CellAttrs;
			$hrefValue = &$this->jenis_bantuan_id->HrefValue;
			$linkAttrs = &$this->jenis_bantuan_id->LinkAttrs;
			$this->Cell_Rendered($this->jenis_bantuan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// bantuan_id
			$currentValue = $this->bantuan_id->GroupViewValue;
			$viewValue = &$this->bantuan_id->GroupViewValue;
			$viewAttrs = &$this->bantuan_id->ViewAttrs;
			$cellAttrs = &$this->bantuan_id->CellAttrs;
			$hrefValue = &$this->bantuan_id->HrefValue;
			$linkAttrs = &$this->bantuan_id->LinkAttrs;
			$this->Cell_Rendered($this->bantuan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// jenis_bantuan_id
			$currentValue = $this->jenis_bantuan_id->groupValue();
			$viewValue = &$this->jenis_bantuan_id->GroupViewValue;
			$viewAttrs = &$this->jenis_bantuan_id->ViewAttrs;
			$cellAttrs = &$this->jenis_bantuan_id->CellAttrs;
			$hrefValue = &$this->jenis_bantuan_id->HrefValue;
			$linkAttrs = &$this->jenis_bantuan_id->LinkAttrs;
			$this->Cell_Rendered($this->jenis_bantuan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// bantuan_id
			$currentValue = $this->bantuan_id->groupValue();
			$viewValue = &$this->bantuan_id->GroupViewValue;
			$viewAttrs = &$this->bantuan_id->ViewAttrs;
			$cellAttrs = &$this->bantuan_id->CellAttrs;
			$hrefValue = &$this->bantuan_id->HrefValue;
			$linkAttrs = &$this->bantuan_id->LinkAttrs;
			$this->Cell_Rendered($this->bantuan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// type
			$currentValue = $this->type->CurrentValue;
			$viewValue = &$this->type->ViewValue;
			$viewAttrs = &$this->type->ViewAttrs;
			$cellAttrs = &$this->type->CellAttrs;
			$hrefValue = &$this->type->HrefValue;
			$linkAttrs = &$this->type->LinkAttrs;
			$this->Cell_Rendered($this->type, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// tahun_bantuan
			$currentValue = $this->tahun_bantuan->CurrentValue;
			$viewValue = &$this->tahun_bantuan->ViewValue;
			$viewAttrs = &$this->tahun_bantuan->ViewAttrs;
			$cellAttrs = &$this->tahun_bantuan->CellAttrs;
			$hrefValue = &$this->tahun_bantuan->HrefValue;
			$linkAttrs = &$this->tahun_bantuan->LinkAttrs;
			$this->Cell_Rendered($this->tahun_bantuan, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// kk
			$currentValue = $this->kk->CurrentValue;
			$viewValue = &$this->kk->ViewValue;
			$viewAttrs = &$this->kk->ViewAttrs;
			$cellAttrs = &$this->kk->CellAttrs;
			$hrefValue = &$this->kk->HrefValue;
			$linkAttrs = &$this->kk->LinkAttrs;
			$this->Cell_Rendered($this->kk, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nik
			$currentValue = $this->nik->CurrentValue;
			$viewValue = &$this->nik->ViewValue;
			$viewAttrs = &$this->nik->ViewAttrs;
			$cellAttrs = &$this->nik->CellAttrs;
			$hrefValue = &$this->nik->HrefValue;
			$linkAttrs = &$this->nik->LinkAttrs;
			$this->Cell_Rendered($this->nik, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nama
			$currentValue = $this->nama->CurrentValue;
			$viewValue = &$this->nama->ViewValue;
			$viewAttrs = &$this->nama->ViewAttrs;
			$cellAttrs = &$this->nama->CellAttrs;
			$hrefValue = &$this->nama->HrefValue;
			$linkAttrs = &$this->nama->LinkAttrs;
			$this->Cell_Rendered($this->nama, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// kecamatan_id
			$currentValue = $this->kecamatan_id->CurrentValue;
			$viewValue = &$this->kecamatan_id->ViewValue;
			$viewAttrs = &$this->kecamatan_id->ViewAttrs;
			$cellAttrs = &$this->kecamatan_id->CellAttrs;
			$hrefValue = &$this->kecamatan_id->HrefValue;
			$linkAttrs = &$this->kecamatan_id->LinkAttrs;
			$this->Cell_Rendered($this->kecamatan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// kelurahan_id
			$currentValue = $this->kelurahan_id->CurrentValue;
			$viewValue = &$this->kelurahan_id->ViewValue;
			$viewAttrs = &$this->kelurahan_id->ViewAttrs;
			$cellAttrs = &$this->kelurahan_id->CellAttrs;
			$hrefValue = &$this->kelurahan_id->HrefValue;
			$linkAttrs = &$this->kelurahan_id->LinkAttrs;
			$this->Cell_Rendered($this->kelurahan_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// rw_id
			$currentValue = $this->rw_id->CurrentValue;
			$viewValue = &$this->rw_id->ViewValue;
			$viewAttrs = &$this->rw_id->ViewAttrs;
			$cellAttrs = &$this->rw_id->CellAttrs;
			$hrefValue = &$this->rw_id->HrefValue;
			$linkAttrs = &$this->rw_id->LinkAttrs;
			$this->Cell_Rendered($this->rw_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// rt_id
			$currentValue = $this->rt_id->CurrentValue;
			$viewValue = &$this->rt_id->ViewValue;
			$viewAttrs = &$this->rt_id->ViewAttrs;
			$cellAttrs = &$this->rt_id->CellAttrs;
			$hrefValue = &$this->rt_id->HrefValue;
			$linkAttrs = &$this->rt_id->LinkAttrs;
			$this->Cell_Rendered($this->rt_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nama_kecamatan
			$currentValue = $this->nama_kecamatan->CurrentValue;
			$viewValue = &$this->nama_kecamatan->ViewValue;
			$viewAttrs = &$this->nama_kecamatan->ViewAttrs;
			$cellAttrs = &$this->nama_kecamatan->CellAttrs;
			$hrefValue = &$this->nama_kecamatan->HrefValue;
			$linkAttrs = &$this->nama_kecamatan->LinkAttrs;
			$this->Cell_Rendered($this->nama_kecamatan, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nama_kelurahan
			$currentValue = $this->nama_kelurahan->CurrentValue;
			$viewValue = &$this->nama_kelurahan->ViewValue;
			$viewAttrs = &$this->nama_kelurahan->ViewAttrs;
			$cellAttrs = &$this->nama_kelurahan->CellAttrs;
			$hrefValue = &$this->nama_kelurahan->HrefValue;
			$linkAttrs = &$this->nama_kelurahan->LinkAttrs;
			$this->Cell_Rendered($this->nama_kelurahan, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nama_rw
			$currentValue = $this->nama_rw->CurrentValue;
			$viewValue = &$this->nama_rw->ViewValue;
			$viewAttrs = &$this->nama_rw->ViewAttrs;
			$cellAttrs = &$this->nama_rw->CellAttrs;
			$hrefValue = &$this->nama_rw->HrefValue;
			$linkAttrs = &$this->nama_rw->LinkAttrs;
			$this->Cell_Rendered($this->nama_rw, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// nama_rt
			$currentValue = $this->nama_rt->CurrentValue;
			$viewValue = &$this->nama_rt->ViewValue;
			$viewAttrs = &$this->nama_rt->ViewAttrs;
			$cellAttrs = &$this->nama_rt->CellAttrs;
			$hrefValue = &$this->nama_rt->HrefValue;
			$linkAttrs = &$this->nama_rt->LinkAttrs;
			$this->Cell_Rendered($this->nama_rt, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}
	private $_groupCounts = [];

	// Get group count
	public function getGroupCount(...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "") {
			return -1;
		} elseif ($key == "0") { // Number of first level groups
			$i = 1;
			while (isset($this->_groupCounts[strval($i)]))
				$i++;
			return $i - 1;
		}
		return isset($this->_groupCounts[$key]) ? $this->_groupCounts[$key] : -1;
	}

	// Set group count
	public function setGroupCount($value, ...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "")
			return;
		$this->_groupCounts[$key] = $value;
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->jenis_bantuan_id->Visible)
			$this->GroupColumnCount += 1;
		if ($this->bantuan_id->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->type->Visible)
			$this->DetailColumnCount += 1;
		if ($this->tahun_bantuan->Visible)
			$this->DetailColumnCount += 1;
		if ($this->kk->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nik->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nama->Visible)
			$this->DetailColumnCount += 1;
		if ($this->kecamatan_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->kelurahan_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->rw_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->rt_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nama_kecamatan->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nama_kelurahan->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nama_rw->Visible)
			$this->DetailColumnCount += 1;
		if ($this->nama_rt->Visible)
			$this->DetailColumnCount += 1;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
		} elseif (SameText($type, "word")) {
			return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
		} elseif (SameText($type, "pdf")) {
			return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
		} elseif (SameText($type, "email")) {
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Report1" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Report1\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : "";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsummary\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_jenis_bantuan_id":
					$lookupFilter = function() {
						return "`na` = 'n'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_bantuan_id":
					break;
				case "x_type":
					break;
				case "x_provinsi_id":
					$lookupFilter = function() {
						return "`id` = ".provinsiId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_kabupaten_id":
					$lookupFilter = function() {
						return "`id` = ".kabupatenId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_kecamatan_id":
					$lookupFilter = function() {
						return "`idkabupaten` = ".kabupatenId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_kelurahan_id":
					$lookupFilter = function() {
						return "`kecamatan_id` ".filterKelurahan()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_rw_id":
					break;
				case "x_rt_id":
					break;
				case "x_alamat_id":
					$lookupFilter = function() {
						return "`na` = 'n'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_status_bantuan":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_jenis_bantuan_id":
							break;
						case "x_bantuan_id":
							break;
						case "x_provinsi_id":
							break;
						case "x_kabupaten_id":
							break;
						case "x_kecamatan_id":
							break;
						case "x_kelurahan_id":
							break;
						case "x_rw_id":
							break;
						case "x_rt_id":
							break;
						case "x_alamat_id":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export report to Excel
	public function exportReportExcel($html)
	{
		global $ExportFileName;
		$charset = Config("PROJECT_CHARSET");
		AddHeader("Content-Type", "application/vnd.ms-excel" . ($charset ? "; charset=" . $charset : ""));
		AddHeader("Content-Disposition", "attachment; filename=" . $ExportFileName . ".xls");
		AddHeader("Set-Cookie", "fileDownload=true; path=/");
		Write($html);
	}

// Export PDF
	public function exportReportPdf($html)
	{
		global $ExportFileName;
		@ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
		set_time_limit(Config("PDF_TIME_LIMIT"));
		$html = CheckHtml($html);
		if (Config("DEBUG")) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "CPDF"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = $this->ExportPageSize;
		$pageOrientation = $this->ExportPageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] != 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		header('Set-Cookie: fileDownload=true; path=/');
		$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
		$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		DeleteTempImages();
		exit();
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = Param(Config("TABLE_START_GROUP"), "");
		$pageNo = Param("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups != 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (Param(Config("TABLE_GROUP_PER_PAGE")) !== NULL) {
			$wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() != "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "`nama` ASC";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->jenis_bantuan_id->setSort("");
			$this->bantuan_id->setSort("");
			$this->type->setSort("");
			$this->tahun_bantuan->setSort("");
			$this->kk->setSort("");
			$this->nik->setSort("");
			$this->nama->setSort("");
			$this->kecamatan_id->setSort("");
			$this->kelurahan_id->setSort("");
			$this->rw_id->setSort("");
			$this->rt_id->setSort("");
			$this->nama_kecamatan->setSort("");
			$this->nama_kelurahan->setSort("");
			$this->nama_rw->setSort("");
			$this->nama_rt->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->jenis_bantuan_id); // jenis_bantuan_id
			$this->updateSort($this->bantuan_id); // bantuan_id
			$this->updateSort($this->type); // type
			$this->updateSort($this->tahun_bantuan); // tahun_bantuan
			$this->updateSort($this->kk); // kk
			$this->updateSort($this->nik); // nik
			$this->updateSort($this->nama); // nama
			$this->updateSort($this->kecamatan_id); // kecamatan_id
			$this->updateSort($this->kelurahan_id); // kelurahan_id
			$this->updateSort($this->rw_id); // rw_id
			$this->updateSort($this->rt_id); // rt_id
			$this->updateSort($this->nama_kecamatan); // nama_kecamatan
			$this->updateSort($this->nama_kelurahan); // nama_kelurahan
			$this->updateSort($this->nama_rw); // nama_rw
			$this->updateSort($this->nama_rt); // nama_rt
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}

		// Set up default sort
		if ($this->getOrderBy() == "") {
			$this->setOrderBy("`nama` ASC");
			$this->nama->setSort("ASC");
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$restoreSession = FALSE;
		$restoreDefault = FALSE;

		// Reset search command
		if (Get("cmd", "") == "reset") {

			// Set default values
			$this->jenis_bantuan_id->AdvancedSearch->unsetSession();
			$this->bantuan_id->AdvancedSearch->unsetSession();
			$this->type->AdvancedSearch->unsetSession();
			$this->tahun_bantuan->AdvancedSearch->unsetSession();
			$this->kecamatan_id->AdvancedSearch->unsetSession();
			$this->kelurahan_id->AdvancedSearch->unsetSession();
			$this->rw_id->AdvancedSearch->unsetSession();
			$this->rt_id->AdvancedSearch->unsetSession();
			$restoreDefault = TRUE;
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field jenis_bantuan_id
			$this->getDropDownValue($this->jenis_bantuan_id);

			// Field bantuan_id
			$this->getDropDownValue($this->bantuan_id);

			// Field type
			$this->getDropDownValue($this->type);

			// Field tahun_bantuan
			if ($this->tahun_bantuan->AdvancedSearch->get()) {
			}

			// Field kecamatan_id
			if ($this->kecamatan_id->AdvancedSearch->get()) {
				if (FieldDataType($this->kecamatan_id->Type) == DATATYPE_DATE) // Format default date format
					$this->kecamatan_id->AdvancedSearch->SearchValue = FormatDateTime($this->kecamatan_id->AdvancedSearch->SearchValue, 0);
			}

			// Field kelurahan_id
			if ($this->kelurahan_id->AdvancedSearch->get()) {
				if (FieldDataType($this->kelurahan_id->Type) == DATATYPE_DATE) // Format default date format
					$this->kelurahan_id->AdvancedSearch->SearchValue = FormatDateTime($this->kelurahan_id->AdvancedSearch->SearchValue, 0);
			}

			// Field rw_id
			$this->getDropDownValue($this->rw_id);

			// Field rt_id
			$this->getDropDownValue($this->rt_id);
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$restoreDefault = TRUE;
			if ($this->jenis_bantuan_id->AdvancedSearch->issetSession()) { // Field jenis_bantuan_id
				$this->jenis_bantuan_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->bantuan_id->AdvancedSearch->issetSession()) { // Field bantuan_id
				$this->bantuan_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->type->AdvancedSearch->issetSession()) { // Field type
				$this->type->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->tahun_bantuan->AdvancedSearch->issetSession()) { // Field tahun_bantuan
				$this->tahun_bantuan->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->kecamatan_id->AdvancedSearch->issetSession()) { // Field kecamatan_id
				$this->kecamatan_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->kelurahan_id->AdvancedSearch->issetSession()) { // Field kelurahan_id
				$this->kelurahan_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->rw_id->AdvancedSearch->issetSession()) { // Field rw_id
				$this->rw_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->rt_id->AdvancedSearch->issetSession()) { // Field rt_id
				$this->rt_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
		}

		// Restore default
		if ($restoreDefault)
			$this->loadDefaultFilters();

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL and save to session
		$this->buildDropDownFilter($this->jenis_bantuan_id, $filter, $this->jenis_bantuan_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field jenis_bantuan_id
		$this->jenis_bantuan_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->bantuan_id, $filter, $this->bantuan_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field bantuan_id
		$this->bantuan_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->type, $filter, $this->type->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field type
		$this->type->AdvancedSearch->save();
		$this->buildExtendedFilter($this->tahun_bantuan, $filter, FALSE, TRUE); // Field tahun_bantuan
		$this->tahun_bantuan->AdvancedSearch->save();
		$this->buildExtendedFilter($this->kecamatan_id, $filter, FALSE, TRUE); // Field kecamatan_id
		$this->kecamatan_id->AdvancedSearch->save();
		$this->buildExtendedFilter($this->kelurahan_id, $filter, FALSE, TRUE); // Field kelurahan_id
		$this->kelurahan_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->rw_id, $filter, $this->rw_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field rw_id
		$this->rw_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->rt_id, $filter, $this->rt_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field rt_id
		$this->rt_id->AdvancedSearch->save();

		// Field jenis_bantuan_id
		LoadDropDownList($this->jenis_bantuan_id->EditValue, $this->jenis_bantuan_id->AdvancedSearch->SearchValue);

		// Field bantuan_id
		LoadDropDownList($this->bantuan_id->EditValue, $this->bantuan_id->AdvancedSearch->SearchValue);

		// Field type
		$this->type->EditValue = ["T","N"];

		// Field rw_id
		LoadDropDownList($this->rw_id->EditValue, $this->rw_id->AdvancedSearch->SearchValue);

		// Field rt_id
		LoadDropDownList($this->rt_id->EditValue, $this->rt_id->AdvancedSearch->SearchValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk != "") {
					if ($sql != "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql != "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, Config("NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if ($fld->GroupSql != "") // Use grouping SQL for search if exists
				$fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != INIT_VALUE && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal != "" && $fldVal != INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fld->GroupSql == "" && $fldOpr != "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk != "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn != "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk != "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = $fld->Param;
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if (is_array($val))
				$val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val); 
			$fld->AdvancedSearch->setSearchValue($val);
			return TRUE;
		}
		return FALSE;
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk != "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk != "");
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			$FormError .= ($FormError != "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for extended filters
		*/
		// Field jenis_bantuan_id

		$this->jenis_bantuan_id->AdvancedSearch->loadDefault();

		// Field bantuan_id
		$this->bantuan_id->AdvancedSearch->loadDefault();

		// Field type
		$this->type->AdvancedSearch->loadDefault();

		// Field tahun_bantuan
		$this->tahun_bantuan->AdvancedSearch->loadDefault();

		// Field kecamatan_id
		$this->kecamatan_id->AdvancedSearch->loadDefault();

		// Field kelurahan_id
		$this->kelurahan_id->AdvancedSearch->loadDefault();

		// Field rw_id
		$this->rw_id->AdvancedSearch->loadDefault();

		// Field rt_id
		$this->rt_id->AdvancedSearch->loadDefault();
	}

	// Show list of filters
	public function showFilterList()
	{
		global $Language;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field jenis_bantuan_id
		$extWrk = "";
		$this->buildDropDownFilter($this->jenis_bantuan_id, $extWrk, $this->jenis_bantuan_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->jenis_bantuan_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field bantuan_id
		$extWrk = "";
		$this->buildDropDownFilter($this->bantuan_id, $extWrk, $this->bantuan_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->bantuan_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field type
		$extWrk = "";
		$this->buildDropDownFilter($this->type, $extWrk, $this->type->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->type->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field tahun_bantuan
		$extWrk = "";
		$this->buildExtendedFilter($this->tahun_bantuan, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->tahun_bantuan->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field kecamatan_id
		$extWrk = "";
		$this->buildExtendedFilter($this->kecamatan_id, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->kecamatan_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field kelurahan_id
		$extWrk = "";
		$this->buildExtendedFilter($this->kelurahan_id, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->kelurahan_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field rw_id
		$extWrk = "";
		$this->buildDropDownFilter($this->rw_id, $extWrk, $this->rw_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->rw_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field rt_id
		$extWrk = "";
		$this->buildDropDownFilter($this->rt_id, $extWrk, $this->rt_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->rt_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Show Filters
		if ($filterList != "") {
			$message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
				$Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Field jenis_bantuan_id
		$wrk = "";
		$wrk = ($this->jenis_bantuan_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->jenis_bantuan_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_jenis_bantuan_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field bantuan_id
		$wrk = "";
		$wrk = ($this->bantuan_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->bantuan_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_bantuan_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field type
		$wrk = "";
		$wrk = ($this->type->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->type->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_type\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field tahun_bantuan
		$wrk = "";
		if ($this->tahun_bantuan->AdvancedSearch->SearchValue != "" || $this->tahun_bantuan->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_tahun_bantuan\":\"" . JsEncode($this->tahun_bantuan->AdvancedSearch->SearchValue) . "\"," .
				"\"z_tahun_bantuan\":\"" . JsEncode($this->tahun_bantuan->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_tahun_bantuan\":\"" . JsEncode($this->tahun_bantuan->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_tahun_bantuan\":\"" . JsEncode($this->tahun_bantuan->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_tahun_bantuan\":\"" . JsEncode($this->tahun_bantuan->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field kecamatan_id
		$wrk = "";
		if ($this->kecamatan_id->AdvancedSearch->SearchValue != "" || $this->kecamatan_id->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_kecamatan_id\":\"" . JsEncode($this->kecamatan_id->AdvancedSearch->SearchValue) . "\"," .
				"\"z_kecamatan_id\":\"" . JsEncode($this->kecamatan_id->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_kecamatan_id\":\"" . JsEncode($this->kecamatan_id->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_kecamatan_id\":\"" . JsEncode($this->kecamatan_id->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_kecamatan_id\":\"" . JsEncode($this->kecamatan_id->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field kelurahan_id
		$wrk = "";
		if ($this->kelurahan_id->AdvancedSearch->SearchValue != "" || $this->kelurahan_id->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_kelurahan_id\":\"" . JsEncode($this->kelurahan_id->AdvancedSearch->SearchValue) . "\"," .
				"\"z_kelurahan_id\":\"" . JsEncode($this->kelurahan_id->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_kelurahan_id\":\"" . JsEncode($this->kelurahan_id->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_kelurahan_id\":\"" . JsEncode($this->kelurahan_id->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_kelurahan_id\":\"" . JsEncode($this->kelurahan_id->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field rw_id
		$wrk = "";
		$wrk = ($this->rw_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->rw_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_rw_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field rt_id
		$wrk = "";
		$wrk = ($this->rt_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->rt_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_rt_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") != "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field jenis_bantuan_id
		if (!$this->jenis_bantuan_id->AdvancedSearch->getFromArray($filter))
			$this->jenis_bantuan_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->jenis_bantuan_id->AdvancedSearch->save();

		// Field bantuan_id
		if (!$this->bantuan_id->AdvancedSearch->getFromArray($filter))
			$this->bantuan_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->bantuan_id->AdvancedSearch->save();

		// Field type
		if (!$this->type->AdvancedSearch->getFromArray($filter))
			$this->type->AdvancedSearch->loadDefault(); // Clear filter
		$this->type->AdvancedSearch->save();

		// Field tahun_bantuan
		if (!$this->tahun_bantuan->AdvancedSearch->getFromArray($filter))
			$this->tahun_bantuan->AdvancedSearch->loadDefault(); // Clear filter
		$this->tahun_bantuan->AdvancedSearch->save();

		// Field kecamatan_id
		if (!$this->kecamatan_id->AdvancedSearch->getFromArray($filter))
			$this->kecamatan_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->kecamatan_id->AdvancedSearch->save();

		// Field kelurahan_id
		if (!$this->kelurahan_id->AdvancedSearch->getFromArray($filter))
			$this->kelurahan_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->kelurahan_id->AdvancedSearch->save();

		// Field rw_id
		if (!$this->rw_id->AdvancedSearch->getFromArray($filter))
			$this->rw_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->rw_id->AdvancedSearch->save();

		// Field rt_id
		if (!$this->rt_id->AdvancedSearch->getFromArray($filter))
			$this->rt_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->rt_id->AdvancedSearch->save();
		return TRUE;
	}

	// Return drill down filter
	protected function getDrillDownFilter()
	{
		global $Language;
		$filterList = "";
		$filter = "";
		$opt = Param("d", "");
		if ($opt == "1" || $opt == "2") {
			$mastertable = Param("s", ""); // Get source table
			$sql = Param("bantuan_id", "");
			$sql = Decrypt($sql);
			$sql = str_replace("@bantuan_id", "`bantuan_id`", $sql);
			if ($sql != "") {
				if ($filter != "") $filter .= " AND ";
				$filter .= $sql;
				if ($sql != "1=1")
					$filterList .= "<div><span class=\"ew-filter-caption\">" . $this->bantuan_id->caption() . "</span><span class=\"ew-filter-value\">$sql</span></div>";
			}
			$sql = Param("warga_id", "");
			$sql = Decrypt($sql);
			$sql = str_replace("@warga_id", "`warga_id`", $sql);
			if ($sql != "") {
				if ($filter != "") $filter .= " AND ";
				$filter .= $sql;
				if ($sql != "1=1")
					$filterList .= "<div><span class=\"ew-filter-caption\">" . $this->warga_id->caption() . "</span><span class=\"ew-filter-value\">$sql</span></div>";
			}
		}
		if ($opt == "1" || $opt == "2")
			$this->DrillDown = TRUE;
		if ($opt == "1") {
			$this->DrillDownInPanel = TRUE;
			$GLOBALS["SkipHeaderFooter"] = TRUE;
		}
		if ($filter != "") {
			if ($filterList == "")
				$filterList = "<div><span class=\"ew-filter-value\">" . $Language->phrase("DrillDownAllRecords") . "</span></div>";
			$this->DrillDownList = "<div id=\"ew-drilldown-filters\">" . $Language->phrase("DrillDownFilters") . "</div>" . $filterList;
		}
		return $filter;
	}

	// Show drill down filters
	public function showDrillDownList()
	{
		$divclass = "";
		if ($this->DrillDownList != "") {
			$message = "<div id=\"ew-drilldown-list\"" . $divclass . "><div class=\"alert alert-info\">" . $this->DrillDownList . "</div></div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>