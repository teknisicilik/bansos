<?php
namespace PHPMaker2020\bansos;

/**
 * Page class
 */
class master_bantuan_list extends master_bantuan
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}";

	// Table name
	public $TableName = 'master_bantuan';

	// Page object name
	public $PageObjName = "master_bantuan_list";

	// Grid form hidden field names
	public $FormName = "fmaster_bantuanlist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

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
		if ($this->TableName)
			return $Language->phrase($this->PageID);
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
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
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
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
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

		// Table object (master_bantuan)
		if (!isset($GLOBALS["master_bantuan"]) || get_class($GLOBALS["master_bantuan"]) == PROJECT_NAMESPACE . "master_bantuan") {
			$GLOBALS["master_bantuan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["master_bantuan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "master_bantuanadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "master_bantuandelete.php";
		$this->MultiUpdateUrl = "master_bantuanupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'master_bantuan');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fmaster_bantuanlistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
		global $master_bantuan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($master_bantuan);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
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
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canList()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

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

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->id->setVisibility();
		$this->jenis_bantuan_id->setVisibility();
		$this->nama->setVisibility();
		$this->type->setVisibility();
		$this->jumlah->setVisibility();
		$this->sumber_bantuan_id->setVisibility();
		$this->pengambilan_bantuuan_id->setVisibility();
		$this->frekuensi->setVisibility();
		$this->bulan->setVisibility();
		$this->tahun->setVisibility();
		$this->keterangan->Visible = FALSE;
		$this->status->setVisibility();
		$this->na->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->jenis_bantuan_id);
		$this->setupLookupOptions($this->sumber_bantuan_id);
		$this->setupLookupOptions($this->pengambilan_bantuuan_id);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_jenis_bantuan_id") && $CurrentForm->hasValue("o_jenis_bantuan_id") && $this->jenis_bantuan_id->CurrentValue != $this->jenis_bantuan_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_nama") && $CurrentForm->hasValue("o_nama") && $this->nama->CurrentValue != $this->nama->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_type") && $CurrentForm->hasValue("o_type") && $this->type->CurrentValue != $this->type->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jumlah") && $CurrentForm->hasValue("o_jumlah") && $this->jumlah->CurrentValue != $this->jumlah->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_sumber_bantuan_id") && $CurrentForm->hasValue("o_sumber_bantuan_id") && $this->sumber_bantuan_id->CurrentValue != $this->sumber_bantuan_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_pengambilan_bantuuan_id") && $CurrentForm->hasValue("o_pengambilan_bantuuan_id") && $this->pengambilan_bantuuan_id->CurrentValue != $this->pengambilan_bantuuan_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_frekuensi") && $CurrentForm->hasValue("o_frekuensi") && $this->frekuensi->CurrentValue != $this->frekuensi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_bulan") && $CurrentForm->hasValue("o_bulan") && $this->bulan->CurrentValue != $this->bulan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tahun") && $CurrentForm->hasValue("o_tahun") && $this->tahun->CurrentValue != $this->tahun->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_status") && $CurrentForm->hasValue("o_status") && $this->status->CurrentValue != $this->status->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_na") && $CurrentForm->hasValue("o_na") && ConvertToBool($this->na->CurrentValue) != ConvertToBool($this->na->OldValue))
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->jenis_bantuan_id->AdvancedSearch->toJson(), ","); // Field jenis_bantuan_id
		$filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
		$filterList = Concat($filterList, $this->type->AdvancedSearch->toJson(), ","); // Field type
		$filterList = Concat($filterList, $this->jumlah->AdvancedSearch->toJson(), ","); // Field jumlah
		$filterList = Concat($filterList, $this->sumber_bantuan_id->AdvancedSearch->toJson(), ","); // Field sumber_bantuan_id
		$filterList = Concat($filterList, $this->pengambilan_bantuuan_id->AdvancedSearch->toJson(), ","); // Field pengambilan_bantuuan_id
		$filterList = Concat($filterList, $this->frekuensi->AdvancedSearch->toJson(), ","); // Field frekuensi
		$filterList = Concat($filterList, $this->bulan->AdvancedSearch->toJson(), ","); // Field bulan
		$filterList = Concat($filterList, $this->tahun->AdvancedSearch->toJson(), ","); // Field tahun
		$filterList = Concat($filterList, $this->keterangan->AdvancedSearch->toJson(), ","); // Field keterangan
		$filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
		$filterList = Concat($filterList, $this->na->AdvancedSearch->toJson(), ","); // Field na
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fmaster_bantuanlistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field jenis_bantuan_id
		$this->jenis_bantuan_id->AdvancedSearch->SearchValue = @$filter["x_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchOperator = @$filter["z_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchCondition = @$filter["v_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchValue2 = @$filter["y_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchOperator2 = @$filter["w_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->save();

		// Field nama
		$this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
		$this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
		$this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
		$this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
		$this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
		$this->nama->AdvancedSearch->save();

		// Field type
		$this->type->AdvancedSearch->SearchValue = @$filter["x_type"];
		$this->type->AdvancedSearch->SearchOperator = @$filter["z_type"];
		$this->type->AdvancedSearch->SearchCondition = @$filter["v_type"];
		$this->type->AdvancedSearch->SearchValue2 = @$filter["y_type"];
		$this->type->AdvancedSearch->SearchOperator2 = @$filter["w_type"];
		$this->type->AdvancedSearch->save();

		// Field jumlah
		$this->jumlah->AdvancedSearch->SearchValue = @$filter["x_jumlah"];
		$this->jumlah->AdvancedSearch->SearchOperator = @$filter["z_jumlah"];
		$this->jumlah->AdvancedSearch->SearchCondition = @$filter["v_jumlah"];
		$this->jumlah->AdvancedSearch->SearchValue2 = @$filter["y_jumlah"];
		$this->jumlah->AdvancedSearch->SearchOperator2 = @$filter["w_jumlah"];
		$this->jumlah->AdvancedSearch->save();

		// Field sumber_bantuan_id
		$this->sumber_bantuan_id->AdvancedSearch->SearchValue = @$filter["x_sumber_bantuan_id"];
		$this->sumber_bantuan_id->AdvancedSearch->SearchOperator = @$filter["z_sumber_bantuan_id"];
		$this->sumber_bantuan_id->AdvancedSearch->SearchCondition = @$filter["v_sumber_bantuan_id"];
		$this->sumber_bantuan_id->AdvancedSearch->SearchValue2 = @$filter["y_sumber_bantuan_id"];
		$this->sumber_bantuan_id->AdvancedSearch->SearchOperator2 = @$filter["w_sumber_bantuan_id"];
		$this->sumber_bantuan_id->AdvancedSearch->save();

		// Field pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id->AdvancedSearch->SearchValue = @$filter["x_pengambilan_bantuuan_id"];
		$this->pengambilan_bantuuan_id->AdvancedSearch->SearchOperator = @$filter["z_pengambilan_bantuuan_id"];
		$this->pengambilan_bantuuan_id->AdvancedSearch->SearchCondition = @$filter["v_pengambilan_bantuuan_id"];
		$this->pengambilan_bantuuan_id->AdvancedSearch->SearchValue2 = @$filter["y_pengambilan_bantuuan_id"];
		$this->pengambilan_bantuuan_id->AdvancedSearch->SearchOperator2 = @$filter["w_pengambilan_bantuuan_id"];
		$this->pengambilan_bantuuan_id->AdvancedSearch->save();

		// Field frekuensi
		$this->frekuensi->AdvancedSearch->SearchValue = @$filter["x_frekuensi"];
		$this->frekuensi->AdvancedSearch->SearchOperator = @$filter["z_frekuensi"];
		$this->frekuensi->AdvancedSearch->SearchCondition = @$filter["v_frekuensi"];
		$this->frekuensi->AdvancedSearch->SearchValue2 = @$filter["y_frekuensi"];
		$this->frekuensi->AdvancedSearch->SearchOperator2 = @$filter["w_frekuensi"];
		$this->frekuensi->AdvancedSearch->save();

		// Field bulan
		$this->bulan->AdvancedSearch->SearchValue = @$filter["x_bulan"];
		$this->bulan->AdvancedSearch->SearchOperator = @$filter["z_bulan"];
		$this->bulan->AdvancedSearch->SearchCondition = @$filter["v_bulan"];
		$this->bulan->AdvancedSearch->SearchValue2 = @$filter["y_bulan"];
		$this->bulan->AdvancedSearch->SearchOperator2 = @$filter["w_bulan"];
		$this->bulan->AdvancedSearch->save();

		// Field tahun
		$this->tahun->AdvancedSearch->SearchValue = @$filter["x_tahun"];
		$this->tahun->AdvancedSearch->SearchOperator = @$filter["z_tahun"];
		$this->tahun->AdvancedSearch->SearchCondition = @$filter["v_tahun"];
		$this->tahun->AdvancedSearch->SearchValue2 = @$filter["y_tahun"];
		$this->tahun->AdvancedSearch->SearchOperator2 = @$filter["w_tahun"];
		$this->tahun->AdvancedSearch->save();

		// Field keterangan
		$this->keterangan->AdvancedSearch->SearchValue = @$filter["x_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator = @$filter["z_keterangan"];
		$this->keterangan->AdvancedSearch->SearchCondition = @$filter["v_keterangan"];
		$this->keterangan->AdvancedSearch->SearchValue2 = @$filter["y_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_keterangan"];
		$this->keterangan->AdvancedSearch->save();

		// Field status
		$this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
		$this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
		$this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
		$this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
		$this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
		$this->status->AdvancedSearch->save();

		// Field na
		$this->na->AdvancedSearch->SearchValue = @$filter["x_na"];
		$this->na->AdvancedSearch->SearchOperator = @$filter["z_na"];
		$this->na->AdvancedSearch->SearchCondition = @$filter["v_na"];
		$this->na->AdvancedSearch->SearchValue2 = @$filter["y_na"];
		$this->na->AdvancedSearch->SearchOperator2 = @$filter["w_na"];
		$this->na->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		$this->buildSearchSql($where, $this->id, $default, FALSE); // id
		$this->buildSearchSql($where, $this->jenis_bantuan_id, $default, FALSE); // jenis_bantuan_id
		$this->buildSearchSql($where, $this->nama, $default, FALSE); // nama
		$this->buildSearchSql($where, $this->type, $default, FALSE); // type
		$this->buildSearchSql($where, $this->jumlah, $default, FALSE); // jumlah
		$this->buildSearchSql($where, $this->sumber_bantuan_id, $default, FALSE); // sumber_bantuan_id
		$this->buildSearchSql($where, $this->pengambilan_bantuuan_id, $default, FALSE); // pengambilan_bantuuan_id
		$this->buildSearchSql($where, $this->frekuensi, $default, FALSE); // frekuensi
		$this->buildSearchSql($where, $this->bulan, $default, FALSE); // bulan
		$this->buildSearchSql($where, $this->tahun, $default, FALSE); // tahun
		$this->buildSearchSql($where, $this->keterangan, $default, FALSE); // keterangan
		$this->buildSearchSql($where, $this->status, $default, FALSE); // status
		$this->buildSearchSql($where, $this->na, $default, FALSE); // na

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->id->AdvancedSearch->save(); // id
			$this->jenis_bantuan_id->AdvancedSearch->save(); // jenis_bantuan_id
			$this->nama->AdvancedSearch->save(); // nama
			$this->type->AdvancedSearch->save(); // type
			$this->jumlah->AdvancedSearch->save(); // jumlah
			$this->sumber_bantuan_id->AdvancedSearch->save(); // sumber_bantuan_id
			$this->pengambilan_bantuuan_id->AdvancedSearch->save(); // pengambilan_bantuuan_id
			$this->frekuensi->AdvancedSearch->save(); // frekuensi
			$this->bulan->AdvancedSearch->save(); // bulan
			$this->tahun->AdvancedSearch->save(); // tahun
			$this->keterangan->AdvancedSearch->save(); // keterangan
			$this->status->AdvancedSearch->save(); // status
			$this->na->AdvancedSearch->save(); // na
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->nama, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->jumlah, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->frekuensi, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->bulan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->keterangan, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jenis_bantuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->type->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jumlah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->sumber_bantuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pengambilan_bantuuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->frekuensi->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->bulan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tahun->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->keterangan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->na->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->id->AdvancedSearch->unsetSession();
		$this->jenis_bantuan_id->AdvancedSearch->unsetSession();
		$this->nama->AdvancedSearch->unsetSession();
		$this->type->AdvancedSearch->unsetSession();
		$this->jumlah->AdvancedSearch->unsetSession();
		$this->sumber_bantuan_id->AdvancedSearch->unsetSession();
		$this->pengambilan_bantuuan_id->AdvancedSearch->unsetSession();
		$this->frekuensi->AdvancedSearch->unsetSession();
		$this->bulan->AdvancedSearch->unsetSession();
		$this->tahun->AdvancedSearch->unsetSession();
		$this->keterangan->AdvancedSearch->unsetSession();
		$this->status->AdvancedSearch->unsetSession();
		$this->na->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->id->AdvancedSearch->load();
		$this->jenis_bantuan_id->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->type->AdvancedSearch->load();
		$this->jumlah->AdvancedSearch->load();
		$this->sumber_bantuan_id->AdvancedSearch->load();
		$this->pengambilan_bantuuan_id->AdvancedSearch->load();
		$this->frekuensi->AdvancedSearch->load();
		$this->bulan->AdvancedSearch->load();
		$this->tahun->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->na->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->id); // id
			$this->updateSort($this->jenis_bantuan_id); // jenis_bantuan_id
			$this->updateSort($this->nama); // nama
			$this->updateSort($this->type); // type
			$this->updateSort($this->jumlah); // jumlah
			$this->updateSort($this->sumber_bantuan_id); // sumber_bantuan_id
			$this->updateSort($this->pengambilan_bantuuan_id); // pengambilan_bantuuan_id
			$this->updateSort($this->frekuensi); // frekuensi
			$this->updateSort($this->bulan); // bulan
			$this->updateSort($this->tahun); // tahun
			$this->updateSort($this->status); // status
			$this->updateSort($this->na); // na
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->id->setSort("");
				$this->jenis_bantuan_id->setSort("");
				$this->nama->setSort("");
				$this->type->setSort("");
				$this->jumlah->setSort("");
				$this->sumber_bantuan_id->setSort("");
				$this->pengambilan_bantuuan_id->setSort("");
				$this->frekuensi->setSort("");
				$this->bulan->setSort("");
				$this->tahun->setSort("");
				$this->status->setSort("");
				$this->na->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// "detail_bantuan"
		$item = &$this->ListOptions->add("detail_bantuan");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'bantuan') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["bantuan_grid"]))
			$GLOBALS["bantuan_grid"] = new bantuan_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("bantuan");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
			}
		}

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"master_bantuan\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"master_bantuan\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_bantuan"
		$opt = $this->ListOptions["detail_bantuan"];
		if ($Security->allowList(CurrentProjectID() . 'bantuan')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("bantuan", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("bantuanlist.php?" . Config("TABLE_SHOW_MASTER") . "=master_bantuan&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["bantuan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'master_bantuan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=bantuan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "bantuan";
			}
			if ($GLOBALS["bantuan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'master_bantuan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=bantuan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "bantuan";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		if (IsMobile())
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"master_bantuan\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = $this->GridAddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_bantuan");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=bantuan");
		if (!isset($GLOBALS["bantuan"]))
			$GLOBALS["bantuan"] = new bantuan();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["bantuan"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["bantuan"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'master_bantuan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "bantuan";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fmaster_bantuanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fmaster_bantuanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fmaster_bantuanlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as $option)
				$option->hideAllOptions();

			// Grid-Add
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
		$links = "";
		$btngrps = "";
		$sqlwrk = "`bansos_id`=" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "";

		// Column "detail_bantuan"
		if ($this->DetailPages && $this->DetailPages["bantuan"] && $this->DetailPages["bantuan"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_bantuan"];
			$url = "bantuanpreview.php?t=master_bantuan&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"bantuan\" data-url=\"" . $url . "\" class=\"btn-group btn-group-sm\">";
			if ($Security->isLoggedIn()) {
				$label = $Language->TablePhrase("bantuan", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"bantuan\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("bantuanlist.php?" . Config("TABLE_SHOW_MASTER") . "=master_bantuan&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . $Language->TablePhrase("bantuan", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</button>";
			}
			if (!isset($GLOBALS["bantuan_grid"]))
				$GLOBALS["bantuan_grid"] = new bantuan_grid();
			if ($GLOBALS["bantuan_grid"]->DetailView && $Security->canView() && $Security->isLoggedIn()) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=bantuan");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</button>";
			}
			if ($GLOBALS["bantuan_grid"]->DetailEdit && $Security->canEdit() && $Security->isLoggedIn()) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=bantuan");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</button>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}

		// Hide detail items if necessary
		$this->ListOptions->hideDetailItemsForDropDown();

		// Column "preview"
		$option = $this->ListOptions["preview"];
		if (!$option) { // Add preview column
			$option = &$this->ListOptions->add("preview");
			$option->OnLeft = TRUE;
			if ($option->OnLeft) {
				$option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
			} else {
				$option->moveTo($this->ListOptions->itemPos("checkbox"));
			}
			$option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
			$option->ShowInDropDown = FALSE;
			$option->ShowInButtonGroup = FALSE;
		}
		if ($option) {
			$option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}

		// Column "details" (Multiple details)
		$option = $this->ListOptions["details"];
		if ($option) {
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->jenis_bantuan_id->CurrentValue = NULL;
		$this->jenis_bantuan_id->OldValue = $this->jenis_bantuan_id->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->type->CurrentValue = "T";
		$this->type->OldValue = $this->type->CurrentValue;
		$this->jumlah->CurrentValue = NULL;
		$this->jumlah->OldValue = $this->jumlah->CurrentValue;
		$this->sumber_bantuan_id->CurrentValue = NULL;
		$this->sumber_bantuan_id->OldValue = $this->sumber_bantuan_id->CurrentValue;
		$this->pengambilan_bantuuan_id->CurrentValue = NULL;
		$this->pengambilan_bantuuan_id->OldValue = $this->pengambilan_bantuuan_id->CurrentValue;
		$this->frekuensi->CurrentValue = NULL;
		$this->frekuensi->OldValue = $this->frekuensi->CurrentValue;
		$this->bulan->CurrentValue = NULL;
		$this->bulan->OldValue = $this->bulan->CurrentValue;
		$this->tahun->CurrentValue = NULL;
		$this->tahun->OldValue = $this->tahun->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->status->CurrentValue = 0;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->na->CurrentValue = "n";
		$this->na->OldValue = $this->na->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// id
		if (!$this->isAddOrEdit() && $this->id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id->AdvancedSearch->SearchValue != "" || $this->id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jenis_bantuan_id
		if (!$this->isAddOrEdit() && $this->jenis_bantuan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenis_bantuan_id->AdvancedSearch->SearchValue != "" || $this->jenis_bantuan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama
		if (!$this->isAddOrEdit() && $this->nama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama->AdvancedSearch->SearchValue != "" || $this->nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// type
		if (!$this->isAddOrEdit() && $this->type->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->type->AdvancedSearch->SearchValue != "" || $this->type->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// jumlah
		if (!$this->isAddOrEdit() && $this->jumlah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jumlah->AdvancedSearch->SearchValue != "" || $this->jumlah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// sumber_bantuan_id
		if (!$this->isAddOrEdit() && $this->sumber_bantuan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->sumber_bantuan_id->AdvancedSearch->SearchValue != "" || $this->sumber_bantuan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// pengambilan_bantuuan_id
		if (!$this->isAddOrEdit() && $this->pengambilan_bantuuan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->pengambilan_bantuuan_id->AdvancedSearch->SearchValue != "" || $this->pengambilan_bantuuan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// frekuensi
		if (!$this->isAddOrEdit() && $this->frekuensi->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->frekuensi->AdvancedSearch->SearchValue != "" || $this->frekuensi->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// bulan
		if (!$this->isAddOrEdit() && $this->bulan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bulan->AdvancedSearch->SearchValue != "" || $this->bulan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// tahun
		if (!$this->isAddOrEdit() && $this->tahun->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tahun->AdvancedSearch->SearchValue != "" || $this->tahun->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// keterangan
		if (!$this->isAddOrEdit() && $this->keterangan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->keterangan->AdvancedSearch->SearchValue != "" || $this->keterangan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// status
		if (!$this->isAddOrEdit() && $this->status->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->status->AdvancedSearch->SearchValue != "" || $this->status->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// na
		if (!$this->isAddOrEdit() && $this->na->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->na->AdvancedSearch->SearchValue != "" || $this->na->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);

		// Check field name 'jenis_bantuan_id' first before field var 'x_jenis_bantuan_id'
		$val = $CurrentForm->hasValue("jenis_bantuan_id") ? $CurrentForm->getValue("jenis_bantuan_id") : $CurrentForm->getValue("x_jenis_bantuan_id");
		if (!$this->jenis_bantuan_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jenis_bantuan_id->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_bantuan_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenis_bantuan_id"))
			$this->jenis_bantuan_id->setOldValue($CurrentForm->getValue("o_jenis_bantuan_id"));

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_nama"))
			$this->nama->setOldValue($CurrentForm->getValue("o_nama"));

		// Check field name 'type' first before field var 'x_type'
		$val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
		if (!$this->type->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->type->Visible = FALSE; // Disable update for API request
			else
				$this->type->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_type"))
			$this->type->setOldValue($CurrentForm->getValue("o_type"));

		// Check field name 'jumlah' first before field var 'x_jumlah'
		$val = $CurrentForm->hasValue("jumlah") ? $CurrentForm->getValue("jumlah") : $CurrentForm->getValue("x_jumlah");
		if (!$this->jumlah->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jumlah->Visible = FALSE; // Disable update for API request
			else
				$this->jumlah->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jumlah"))
			$this->jumlah->setOldValue($CurrentForm->getValue("o_jumlah"));

		// Check field name 'sumber_bantuan_id' first before field var 'x_sumber_bantuan_id'
		$val = $CurrentForm->hasValue("sumber_bantuan_id") ? $CurrentForm->getValue("sumber_bantuan_id") : $CurrentForm->getValue("x_sumber_bantuan_id");
		if (!$this->sumber_bantuan_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sumber_bantuan_id->Visible = FALSE; // Disable update for API request
			else
				$this->sumber_bantuan_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_sumber_bantuan_id"))
			$this->sumber_bantuan_id->setOldValue($CurrentForm->getValue("o_sumber_bantuan_id"));

		// Check field name 'pengambilan_bantuuan_id' first before field var 'x_pengambilan_bantuuan_id'
		$val = $CurrentForm->hasValue("pengambilan_bantuuan_id") ? $CurrentForm->getValue("pengambilan_bantuuan_id") : $CurrentForm->getValue("x_pengambilan_bantuuan_id");
		if (!$this->pengambilan_bantuuan_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pengambilan_bantuuan_id->Visible = FALSE; // Disable update for API request
			else
				$this->pengambilan_bantuuan_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pengambilan_bantuuan_id"))
			$this->pengambilan_bantuuan_id->setOldValue($CurrentForm->getValue("o_pengambilan_bantuuan_id"));

		// Check field name 'frekuensi' first before field var 'x_frekuensi'
		$val = $CurrentForm->hasValue("frekuensi") ? $CurrentForm->getValue("frekuensi") : $CurrentForm->getValue("x_frekuensi");
		if (!$this->frekuensi->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->frekuensi->Visible = FALSE; // Disable update for API request
			else
				$this->frekuensi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_frekuensi"))
			$this->frekuensi->setOldValue($CurrentForm->getValue("o_frekuensi"));

		// Check field name 'bulan' first before field var 'x_bulan'
		$val = $CurrentForm->hasValue("bulan") ? $CurrentForm->getValue("bulan") : $CurrentForm->getValue("x_bulan");
		if (!$this->bulan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->bulan->Visible = FALSE; // Disable update for API request
			else
				$this->bulan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_bulan"))
			$this->bulan->setOldValue($CurrentForm->getValue("o_bulan"));

		// Check field name 'tahun' first before field var 'x_tahun'
		$val = $CurrentForm->hasValue("tahun") ? $CurrentForm->getValue("tahun") : $CurrentForm->getValue("x_tahun");
		if (!$this->tahun->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tahun->Visible = FALSE; // Disable update for API request
			else
				$this->tahun->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tahun"))
			$this->tahun->setOldValue($CurrentForm->getValue("o_tahun"));

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_status"))
			$this->status->setOldValue($CurrentForm->getValue("o_status"));

		// Check field name 'na' first before field var 'x_na'
		$val = $CurrentForm->hasValue("na") ? $CurrentForm->getValue("na") : $CurrentForm->getValue("x_na");
		if (!$this->na->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->na->Visible = FALSE; // Disable update for API request
			else
				$this->na->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_na"))
			$this->na->setOldValue($CurrentForm->getValue("o_na"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->jenis_bantuan_id->CurrentValue = $this->jenis_bantuan_id->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->type->CurrentValue = $this->type->FormValue;
		$this->jumlah->CurrentValue = $this->jumlah->FormValue;
		$this->sumber_bantuan_id->CurrentValue = $this->sumber_bantuan_id->FormValue;
		$this->pengambilan_bantuuan_id->CurrentValue = $this->pengambilan_bantuuan_id->FormValue;
		$this->frekuensi->CurrentValue = $this->frekuensi->FormValue;
		$this->bulan->CurrentValue = $this->bulan->FormValue;
		$this->tahun->CurrentValue = $this->tahun->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->na->CurrentValue = $this->na->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->jenis_bantuan_id->setDbValue($row['jenis_bantuan_id']);
		$this->nama->setDbValue($row['nama']);
		$this->type->setDbValue($row['type']);
		$this->jumlah->setDbValue($row['jumlah']);
		$this->sumber_bantuan_id->setDbValue($row['sumber_bantuan_id']);
		$this->pengambilan_bantuuan_id->setDbValue($row['pengambilan_bantuuan_id']);
		$this->frekuensi->setDbValue($row['frekuensi']);
		$this->bulan->setDbValue($row['bulan']);
		$this->tahun->setDbValue($row['tahun']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->status->setDbValue($row['status']);
		$this->na->setDbValue($row['na']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['jenis_bantuan_id'] = $this->jenis_bantuan_id->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['type'] = $this->type->CurrentValue;
		$row['jumlah'] = $this->jumlah->CurrentValue;
		$row['sumber_bantuan_id'] = $this->sumber_bantuan_id->CurrentValue;
		$row['pengambilan_bantuuan_id'] = $this->pengambilan_bantuuan_id->CurrentValue;
		$row['frekuensi'] = $this->frekuensi->CurrentValue;
		$row['bulan'] = $this->bulan->CurrentValue;
		$row['tahun'] = $this->tahun->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['na'] = $this->na->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// jenis_bantuan_id
		// nama
		// type
		// jumlah
		// sumber_bantuan_id
		// pengambilan_bantuuan_id
		// frekuensi
		// bulan
		// tahun
		// keterangan
		// status
		// na

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

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

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

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

			// status
			if (strval($this->status->CurrentValue) != "") {
				$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

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

			// jenis_bantuan_id
			$this->jenis_bantuan_id->LinkCustomAttributes = "";
			$this->jenis_bantuan_id->HrefValue = "";
			$this->jenis_bantuan_id->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// na
			$this->na->LinkCustomAttributes = "";
			$this->na->HrefValue = "";
			$this->na->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id
			// jenis_bantuan_id

			$this->jenis_bantuan_id->EditAttrs["class"] = "form-control";
			$this->jenis_bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenis_bantuan_id->CurrentValue));
			if ($curVal != "")
				$this->jenis_bantuan_id->ViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
			else
				$this->jenis_bantuan_id->ViewValue = $this->jenis_bantuan_id->Lookup !== NULL && is_array($this->jenis_bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jenis_bantuan_id->ViewValue !== NULL) { // Load from cache
				$this->jenis_bantuan_id->EditValue = array_values($this->jenis_bantuan_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jenis_bantuan_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`na` = 'n'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->jenis_bantuan_id->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenis_bantuan_id->EditValue = $arwrk;
			}

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// type
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = $this->type->options(FALSE);

			// jumlah
			$this->jumlah->EditAttrs["class"] = "form-control";
			$this->jumlah->EditCustomAttributes = "";
			if (!$this->jumlah->Raw)
				$this->jumlah->CurrentValue = HtmlDecode($this->jumlah->CurrentValue);
			$this->jumlah->EditValue = HtmlEncode($this->jumlah->CurrentValue);
			$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

			// sumber_bantuan_id
			$this->sumber_bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->sumber_bantuan_id->CurrentValue));
			if ($curVal != "")
				$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->lookupCacheOption($curVal);
			else
				$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->Lookup !== NULL && is_array($this->sumber_bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->sumber_bantuan_id->ViewValue !== NULL) { // Load from cache
				$this->sumber_bantuan_id->EditValue = array_values($this->sumber_bantuan_id->Lookup->Options);
				if ($this->sumber_bantuan_id->ViewValue == "")
					$this->sumber_bantuan_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->sumber_bantuan_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sumber_bantuan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->sumber_bantuan_id->ViewValue = $this->sumber_bantuan_id->displayValue($arwrk);
				} else {
					$this->sumber_bantuan_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sumber_bantuan_id->EditValue = $arwrk;
			}

			// pengambilan_bantuuan_id
			$this->pengambilan_bantuuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->pengambilan_bantuuan_id->CurrentValue));
			if ($curVal != "")
				$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->lookupCacheOption($curVal);
			else
				$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->Lookup !== NULL && is_array($this->pengambilan_bantuuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->pengambilan_bantuuan_id->ViewValue !== NULL) { // Load from cache
				$this->pengambilan_bantuuan_id->EditValue = array_values($this->pengambilan_bantuuan_id->Lookup->Options);
				if ($this->pengambilan_bantuuan_id->ViewValue == "")
					$this->pengambilan_bantuuan_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pengambilan_bantuuan_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pengambilan_bantuuan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pengambilan_bantuuan_id->ViewValue = $this->pengambilan_bantuuan_id->displayValue($arwrk);
				} else {
					$this->pengambilan_bantuuan_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pengambilan_bantuuan_id->EditValue = $arwrk;
			}

			// frekuensi
			$this->frekuensi->EditAttrs["class"] = "form-control";
			$this->frekuensi->EditCustomAttributes = "";
			if (!$this->frekuensi->Raw)
				$this->frekuensi->CurrentValue = HtmlDecode($this->frekuensi->CurrentValue);
			$this->frekuensi->EditValue = HtmlEncode($this->frekuensi->CurrentValue);
			$this->frekuensi->PlaceHolder = RemoveHtml($this->frekuensi->caption());

			// bulan
			$this->bulan->EditAttrs["class"] = "form-control";
			$this->bulan->EditCustomAttributes = "";
			$this->bulan->EditValue = $this->bulan->options(TRUE);

			// tahun
			$this->tahun->EditAttrs["class"] = "form-control";
			$this->tahun->EditCustomAttributes = "";
			$this->tahun->EditValue = HtmlEncode($this->tahun->CurrentValue);
			$this->tahun->PlaceHolder = RemoveHtml($this->tahun->caption());

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(TRUE);

			// na
			$this->na->EditCustomAttributes = "";
			$this->na->EditValue = $this->na->options(FALSE);

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// jenis_bantuan_id
			$this->jenis_bantuan_id->LinkCustomAttributes = "";
			$this->jenis_bantuan_id->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";

			// jumlah
			$this->jumlah->LinkCustomAttributes = "";
			$this->jumlah->HrefValue = "";

			// sumber_bantuan_id
			$this->sumber_bantuan_id->LinkCustomAttributes = "";
			$this->sumber_bantuan_id->HrefValue = "";

			// pengambilan_bantuuan_id
			$this->pengambilan_bantuuan_id->LinkCustomAttributes = "";
			$this->pengambilan_bantuuan_id->HrefValue = "";

			// frekuensi
			$this->frekuensi->LinkCustomAttributes = "";
			$this->frekuensi->HrefValue = "";

			// bulan
			$this->bulan->LinkCustomAttributes = "";
			$this->bulan->HrefValue = "";

			// tahun
			$this->tahun->LinkCustomAttributes = "";
			$this->tahun->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// na
			$this->na->LinkCustomAttributes = "";
			$this->na->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = RemoveHtml($this->id->caption());

			// jenis_bantuan_id
			$this->jenis_bantuan_id->EditAttrs["class"] = "form-control";
			$this->jenis_bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenis_bantuan_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $this->jenis_bantuan_id->lookupCacheOption($curVal);
			else
				$this->jenis_bantuan_id->AdvancedSearch->ViewValue = $this->jenis_bantuan_id->Lookup !== NULL && is_array($this->jenis_bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jenis_bantuan_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->jenis_bantuan_id->EditValue = array_values($this->jenis_bantuan_id->Lookup->Options);
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
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenis_bantuan_id->EditValue = $arwrk;
			}

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// type
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = $this->type->options(FALSE);

			// jumlah
			$this->jumlah->EditAttrs["class"] = "form-control";
			$this->jumlah->EditCustomAttributes = "";
			if (!$this->jumlah->Raw)
				$this->jumlah->AdvancedSearch->SearchValue = HtmlDecode($this->jumlah->AdvancedSearch->SearchValue);
			$this->jumlah->EditValue = HtmlEncode($this->jumlah->AdvancedSearch->SearchValue);
			$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

			// sumber_bantuan_id
			$this->sumber_bantuan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->sumber_bantuan_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->sumber_bantuan_id->AdvancedSearch->ViewValue = $this->sumber_bantuan_id->lookupCacheOption($curVal);
			else
				$this->sumber_bantuan_id->AdvancedSearch->ViewValue = $this->sumber_bantuan_id->Lookup !== NULL && is_array($this->sumber_bantuan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->sumber_bantuan_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->sumber_bantuan_id->EditValue = array_values($this->sumber_bantuan_id->Lookup->Options);
				if ($this->sumber_bantuan_id->AdvancedSearch->ViewValue == "")
					$this->sumber_bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->sumber_bantuan_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sumber_bantuan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->sumber_bantuan_id->AdvancedSearch->ViewValue = $this->sumber_bantuan_id->displayValue($arwrk);
				} else {
					$this->sumber_bantuan_id->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sumber_bantuan_id->EditValue = $arwrk;
			}

			// pengambilan_bantuuan_id
			$this->pengambilan_bantuuan_id->EditAttrs["class"] = "form-control";
			$this->pengambilan_bantuuan_id->EditCustomAttributes = "";

			// frekuensi
			$this->frekuensi->EditAttrs["class"] = "form-control";
			$this->frekuensi->EditCustomAttributes = "";
			if (!$this->frekuensi->Raw)
				$this->frekuensi->AdvancedSearch->SearchValue = HtmlDecode($this->frekuensi->AdvancedSearch->SearchValue);
			$this->frekuensi->EditValue = HtmlEncode($this->frekuensi->AdvancedSearch->SearchValue);
			$this->frekuensi->PlaceHolder = RemoveHtml($this->frekuensi->caption());

			// bulan
			$this->bulan->EditAttrs["class"] = "form-control";
			$this->bulan->EditCustomAttributes = "";
			$this->bulan->EditValue = $this->bulan->options(TRUE);

			// tahun
			$this->tahun->EditAttrs["class"] = "form-control";
			$this->tahun->EditCustomAttributes = "";
			$this->tahun->EditValue = HtmlEncode($this->tahun->AdvancedSearch->SearchValue);
			$this->tahun->PlaceHolder = RemoveHtml($this->tahun->caption());

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(TRUE);

			// na
			$this->na->EditCustomAttributes = "";
			$this->na->EditValue = $this->na->options(FALSE);
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->tahun->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tahun->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
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
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->jenis_bantuan_id->Required) {
			if (!$this->jenis_bantuan_id->IsDetailKey && $this->jenis_bantuan_id->FormValue != NULL && $this->jenis_bantuan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_bantuan_id->caption(), $this->jenis_bantuan_id->RequiredErrorMessage));
			}
		}
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->type->Required) {
			if ($this->type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
			}
		}
		if ($this->jumlah->Required) {
			if (!$this->jumlah->IsDetailKey && $this->jumlah->FormValue != NULL && $this->jumlah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlah->caption(), $this->jumlah->RequiredErrorMessage));
			}
		}
		if ($this->sumber_bantuan_id->Required) {
			if (!$this->sumber_bantuan_id->IsDetailKey && $this->sumber_bantuan_id->FormValue != NULL && $this->sumber_bantuan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sumber_bantuan_id->caption(), $this->sumber_bantuan_id->RequiredErrorMessage));
			}
		}
		if ($this->pengambilan_bantuuan_id->Required) {
			if (!$this->pengambilan_bantuuan_id->IsDetailKey && $this->pengambilan_bantuuan_id->FormValue != NULL && $this->pengambilan_bantuuan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pengambilan_bantuuan_id->caption(), $this->pengambilan_bantuuan_id->RequiredErrorMessage));
			}
		}
		if ($this->frekuensi->Required) {
			if (!$this->frekuensi->IsDetailKey && $this->frekuensi->FormValue != NULL && $this->frekuensi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->frekuensi->caption(), $this->frekuensi->RequiredErrorMessage));
			}
		}
		if ($this->bulan->Required) {
			if (!$this->bulan->IsDetailKey && $this->bulan->FormValue != NULL && $this->bulan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bulan->caption(), $this->bulan->RequiredErrorMessage));
			}
		}
		if ($this->tahun->Required) {
			if (!$this->tahun->IsDetailKey && $this->tahun->FormValue != NULL && $this->tahun->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tahun->caption(), $this->tahun->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tahun->FormValue)) {
			AddMessage($FormError, $this->tahun->errorMessage());
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->na->Required) {
			if ($this->na->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->na->caption(), $this->na->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Check if records exist for detail table 'bantuan'
		if (!isset($GLOBALS["bantuan"]))
			$GLOBALS["bantuan"] = new bantuan();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["bantuan"]->loadRs("`bansos_id` = " . QuotedValue($row['id'], DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$relatedRecordMsg = str_replace("%t", "bantuan", $Language->phrase("RelatedRecordExists"));
				$this->setFailureMessage($relatedRecordMsg);
				return FALSE;
			}
		}

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// jenis_bantuan_id
		$this->jenis_bantuan_id->setDbValueDef($rsnew, $this->jenis_bantuan_id->CurrentValue, 0, FALSE);

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, "", FALSE);

		// type
		$this->type->setDbValueDef($rsnew, $this->type->CurrentValue, "", strval($this->type->CurrentValue) == "");

		// jumlah
		$this->jumlah->setDbValueDef($rsnew, $this->jumlah->CurrentValue, "", FALSE);

		// sumber_bantuan_id
		$this->sumber_bantuan_id->setDbValueDef($rsnew, $this->sumber_bantuan_id->CurrentValue, 0, FALSE);

		// pengambilan_bantuuan_id
		$this->pengambilan_bantuuan_id->setDbValueDef($rsnew, $this->pengambilan_bantuuan_id->CurrentValue, 0, FALSE);

		// frekuensi
		$this->frekuensi->setDbValueDef($rsnew, $this->frekuensi->CurrentValue, "", FALSE);

		// bulan
		$this->bulan->setDbValueDef($rsnew, $this->bulan->CurrentValue, "", FALSE);

		// tahun
		$this->tahun->setDbValueDef($rsnew, $this->tahun->CurrentValue, 0, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, 0, FALSE);

		// na
		$this->na->setDbValueDef($rsnew, strval($this->na->CurrentValue) == "y" ? "y" : "n", "n", strval($this->na->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->id->AdvancedSearch->load();
		$this->jenis_bantuan_id->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->type->AdvancedSearch->load();
		$this->jumlah->AdvancedSearch->load();
		$this->sumber_bantuan_id->AdvancedSearch->load();
		$this->pengambilan_bantuuan_id->AdvancedSearch->load();
		$this->frekuensi->AdvancedSearch->load();
		$this->bulan->AdvancedSearch->load();
		$this->tahun->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->na->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fmaster_bantuanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fmaster_bantuanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fmaster_bantuanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_master_bantuan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_master_bantuan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fmaster_bantuanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fmaster_bantuanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_type":
					break;
				case "x_sumber_bantuan_id":
					break;
				case "x_pengambilan_bantuuan_id":
					break;
				case "x_bulan":
					break;
				case "x_status":
					break;
				case "x_na":
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
						case "x_sumber_bantuan_id":
							break;
						case "x_pengambilan_bantuuan_id":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>