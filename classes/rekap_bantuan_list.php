<?php
namespace PHPMaker2020\bansos;

/**
 * Page class
 */
class rekap_bantuan_list extends rekap_bantuan
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}";

	// Table name
	public $TableName = 'rekap_bantuan';

	// Page object name
	public $PageObjName = "rekap_bantuan_list";

	// Grid form hidden field names
	public $FormName = "frekap_bantuanlist";
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

		// Table object (rekap_bantuan)
		if (!isset($GLOBALS["rekap_bantuan"]) || get_class($GLOBALS["rekap_bantuan"]) == PROJECT_NAMESPACE . "rekap_bantuan") {
			$GLOBALS["rekap_bantuan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rekap_bantuan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "rekap_bantuanadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "rekap_bantuandelete.php";
		$this->MultiUpdateUrl = "rekap_bantuanupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'rekap_bantuan');

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
		$this->FilterOptions->TagClassName = "ew-filter-option frekap_bantuanlistsrch";

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
		global $rekap_bantuan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($rekap_bantuan);
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
			$key .= @$ar['bantuan_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['warga_id'];
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
			$this->bantuan_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->warga_id->Visible = FALSE;
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
		$this->jenis_bantuan_id->setVisibility();
		$this->bantuan_id->setVisibility();
		$this->type->setVisibility();
		$this->jumlah->Visible = FALSE;
		$this->sumber_bantuan_id->Visible = FALSE;
		$this->pengambilan_bantuuan_id->Visible = FALSE;
		$this->tahun_bantuan->setVisibility();
		$this->keterangan_bantuan->Visible = FALSE;
		$this->warga_id->Visible = FALSE;
		$this->kk->setVisibility();
		$this->nik->setVisibility();
		$this->nama->setVisibility();
		$this->provinsi_id->Visible = FALSE;
		$this->kabupaten_id->Visible = FALSE;
		$this->kecamatan_id->setVisibility();
		$this->kelurahan_id->setVisibility();
		$this->rw_id->setVisibility();
		$this->rt_id->setVisibility();
		$this->alamat_id->setVisibility();
		$this->nomor_rumah->setVisibility();
		$this->keterangan->Visible = FALSE;
		$this->status_bantuan->setVisibility();
		$this->nama_kecamatan->Visible = FALSE;
		$this->nama_kelurahan->Visible = FALSE;
		$this->nama_rw->Visible = FALSE;
		$this->nama_rt->Visible = FALSE;
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
		$this->setupLookupOptions($this->bantuan_id);
		$this->setupLookupOptions($this->sumber_bantuan_id);
		$this->setupLookupOptions($this->pengambilan_bantuuan_id);
		$this->setupLookupOptions($this->provinsi_id);
		$this->setupLookupOptions($this->kabupaten_id);
		$this->setupLookupOptions($this->kecamatan_id);
		$this->setupLookupOptions($this->kelurahan_id);
		$this->setupLookupOptions($this->rw_id);
		$this->setupLookupOptions($this->rt_id);
		$this->setupLookupOptions($this->alamat_id);

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
		if (count($arKeyFlds) >= 2) {
			$this->bantuan_id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->bantuan_id->OldValue))
				return FALSE;
			$this->warga_id->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->warga_id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->jenis_bantuan_id->AdvancedSearch->toJson(), ","); // Field jenis_bantuan_id
		$filterList = Concat($filterList, $this->bantuan_id->AdvancedSearch->toJson(), ","); // Field bantuan_id
		$filterList = Concat($filterList, $this->type->AdvancedSearch->toJson(), ","); // Field type
		$filterList = Concat($filterList, $this->jumlah->AdvancedSearch->toJson(), ","); // Field jumlah
		$filterList = Concat($filterList, $this->sumber_bantuan_id->AdvancedSearch->toJson(), ","); // Field sumber_bantuan_id
		$filterList = Concat($filterList, $this->pengambilan_bantuuan_id->AdvancedSearch->toJson(), ","); // Field pengambilan_bantuuan_id
		$filterList = Concat($filterList, $this->tahun_bantuan->AdvancedSearch->toJson(), ","); // Field tahun_bantuan
		$filterList = Concat($filterList, $this->keterangan_bantuan->AdvancedSearch->toJson(), ","); // Field keterangan_bantuan
		$filterList = Concat($filterList, $this->warga_id->AdvancedSearch->toJson(), ","); // Field warga_id
		$filterList = Concat($filterList, $this->kk->AdvancedSearch->toJson(), ","); // Field kk
		$filterList = Concat($filterList, $this->nik->AdvancedSearch->toJson(), ","); // Field nik
		$filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
		$filterList = Concat($filterList, $this->provinsi_id->AdvancedSearch->toJson(), ","); // Field provinsi_id
		$filterList = Concat($filterList, $this->kabupaten_id->AdvancedSearch->toJson(), ","); // Field kabupaten_id
		$filterList = Concat($filterList, $this->kecamatan_id->AdvancedSearch->toJson(), ","); // Field kecamatan_id
		$filterList = Concat($filterList, $this->kelurahan_id->AdvancedSearch->toJson(), ","); // Field kelurahan_id
		$filterList = Concat($filterList, $this->rw_id->AdvancedSearch->toJson(), ","); // Field rw_id
		$filterList = Concat($filterList, $this->rt_id->AdvancedSearch->toJson(), ","); // Field rt_id
		$filterList = Concat($filterList, $this->alamat_id->AdvancedSearch->toJson(), ","); // Field alamat_id
		$filterList = Concat($filterList, $this->nomor_rumah->AdvancedSearch->toJson(), ","); // Field nomor_rumah
		$filterList = Concat($filterList, $this->keterangan->AdvancedSearch->toJson(), ","); // Field keterangan
		$filterList = Concat($filterList, $this->status_bantuan->AdvancedSearch->toJson(), ","); // Field status_bantuan
		$filterList = Concat($filterList, $this->nama_kecamatan->AdvancedSearch->toJson(), ","); // Field nama_kecamatan
		$filterList = Concat($filterList, $this->nama_kelurahan->AdvancedSearch->toJson(), ","); // Field nama_kelurahan
		$filterList = Concat($filterList, $this->nama_rw->AdvancedSearch->toJson(), ","); // Field nama_rw
		$filterList = Concat($filterList, $this->nama_rt->AdvancedSearch->toJson(), ","); // Field nama_rt
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
			$UserProfile->setSearchFilters(CurrentUserName(), "frekap_bantuanlistsrch", $filters);
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

		// Field jenis_bantuan_id
		$this->jenis_bantuan_id->AdvancedSearch->SearchValue = @$filter["x_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchOperator = @$filter["z_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchCondition = @$filter["v_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchValue2 = @$filter["y_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->SearchOperator2 = @$filter["w_jenis_bantuan_id"];
		$this->jenis_bantuan_id->AdvancedSearch->save();

		// Field bantuan_id
		$this->bantuan_id->AdvancedSearch->SearchValue = @$filter["x_bantuan_id"];
		$this->bantuan_id->AdvancedSearch->SearchOperator = @$filter["z_bantuan_id"];
		$this->bantuan_id->AdvancedSearch->SearchCondition = @$filter["v_bantuan_id"];
		$this->bantuan_id->AdvancedSearch->SearchValue2 = @$filter["y_bantuan_id"];
		$this->bantuan_id->AdvancedSearch->SearchOperator2 = @$filter["w_bantuan_id"];
		$this->bantuan_id->AdvancedSearch->save();

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

		// Field tahun_bantuan
		$this->tahun_bantuan->AdvancedSearch->SearchValue = @$filter["x_tahun_bantuan"];
		$this->tahun_bantuan->AdvancedSearch->SearchOperator = @$filter["z_tahun_bantuan"];
		$this->tahun_bantuan->AdvancedSearch->SearchCondition = @$filter["v_tahun_bantuan"];
		$this->tahun_bantuan->AdvancedSearch->SearchValue2 = @$filter["y_tahun_bantuan"];
		$this->tahun_bantuan->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_bantuan"];
		$this->tahun_bantuan->AdvancedSearch->save();

		// Field keterangan_bantuan
		$this->keterangan_bantuan->AdvancedSearch->SearchValue = @$filter["x_keterangan_bantuan"];
		$this->keterangan_bantuan->AdvancedSearch->SearchOperator = @$filter["z_keterangan_bantuan"];
		$this->keterangan_bantuan->AdvancedSearch->SearchCondition = @$filter["v_keterangan_bantuan"];
		$this->keterangan_bantuan->AdvancedSearch->SearchValue2 = @$filter["y_keterangan_bantuan"];
		$this->keterangan_bantuan->AdvancedSearch->SearchOperator2 = @$filter["w_keterangan_bantuan"];
		$this->keterangan_bantuan->AdvancedSearch->save();

		// Field warga_id
		$this->warga_id->AdvancedSearch->SearchValue = @$filter["x_warga_id"];
		$this->warga_id->AdvancedSearch->SearchOperator = @$filter["z_warga_id"];
		$this->warga_id->AdvancedSearch->SearchCondition = @$filter["v_warga_id"];
		$this->warga_id->AdvancedSearch->SearchValue2 = @$filter["y_warga_id"];
		$this->warga_id->AdvancedSearch->SearchOperator2 = @$filter["w_warga_id"];
		$this->warga_id->AdvancedSearch->save();

		// Field kk
		$this->kk->AdvancedSearch->SearchValue = @$filter["x_kk"];
		$this->kk->AdvancedSearch->SearchOperator = @$filter["z_kk"];
		$this->kk->AdvancedSearch->SearchCondition = @$filter["v_kk"];
		$this->kk->AdvancedSearch->SearchValue2 = @$filter["y_kk"];
		$this->kk->AdvancedSearch->SearchOperator2 = @$filter["w_kk"];
		$this->kk->AdvancedSearch->save();

		// Field nik
		$this->nik->AdvancedSearch->SearchValue = @$filter["x_nik"];
		$this->nik->AdvancedSearch->SearchOperator = @$filter["z_nik"];
		$this->nik->AdvancedSearch->SearchCondition = @$filter["v_nik"];
		$this->nik->AdvancedSearch->SearchValue2 = @$filter["y_nik"];
		$this->nik->AdvancedSearch->SearchOperator2 = @$filter["w_nik"];
		$this->nik->AdvancedSearch->save();

		// Field nama
		$this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
		$this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
		$this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
		$this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
		$this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
		$this->nama->AdvancedSearch->save();

		// Field provinsi_id
		$this->provinsi_id->AdvancedSearch->SearchValue = @$filter["x_provinsi_id"];
		$this->provinsi_id->AdvancedSearch->SearchOperator = @$filter["z_provinsi_id"];
		$this->provinsi_id->AdvancedSearch->SearchCondition = @$filter["v_provinsi_id"];
		$this->provinsi_id->AdvancedSearch->SearchValue2 = @$filter["y_provinsi_id"];
		$this->provinsi_id->AdvancedSearch->SearchOperator2 = @$filter["w_provinsi_id"];
		$this->provinsi_id->AdvancedSearch->save();

		// Field kabupaten_id
		$this->kabupaten_id->AdvancedSearch->SearchValue = @$filter["x_kabupaten_id"];
		$this->kabupaten_id->AdvancedSearch->SearchOperator = @$filter["z_kabupaten_id"];
		$this->kabupaten_id->AdvancedSearch->SearchCondition = @$filter["v_kabupaten_id"];
		$this->kabupaten_id->AdvancedSearch->SearchValue2 = @$filter["y_kabupaten_id"];
		$this->kabupaten_id->AdvancedSearch->SearchOperator2 = @$filter["w_kabupaten_id"];
		$this->kabupaten_id->AdvancedSearch->save();

		// Field kecamatan_id
		$this->kecamatan_id->AdvancedSearch->SearchValue = @$filter["x_kecamatan_id"];
		$this->kecamatan_id->AdvancedSearch->SearchOperator = @$filter["z_kecamatan_id"];
		$this->kecamatan_id->AdvancedSearch->SearchCondition = @$filter["v_kecamatan_id"];
		$this->kecamatan_id->AdvancedSearch->SearchValue2 = @$filter["y_kecamatan_id"];
		$this->kecamatan_id->AdvancedSearch->SearchOperator2 = @$filter["w_kecamatan_id"];
		$this->kecamatan_id->AdvancedSearch->save();

		// Field kelurahan_id
		$this->kelurahan_id->AdvancedSearch->SearchValue = @$filter["x_kelurahan_id"];
		$this->kelurahan_id->AdvancedSearch->SearchOperator = @$filter["z_kelurahan_id"];
		$this->kelurahan_id->AdvancedSearch->SearchCondition = @$filter["v_kelurahan_id"];
		$this->kelurahan_id->AdvancedSearch->SearchValue2 = @$filter["y_kelurahan_id"];
		$this->kelurahan_id->AdvancedSearch->SearchOperator2 = @$filter["w_kelurahan_id"];
		$this->kelurahan_id->AdvancedSearch->save();

		// Field rw_id
		$this->rw_id->AdvancedSearch->SearchValue = @$filter["x_rw_id"];
		$this->rw_id->AdvancedSearch->SearchOperator = @$filter["z_rw_id"];
		$this->rw_id->AdvancedSearch->SearchCondition = @$filter["v_rw_id"];
		$this->rw_id->AdvancedSearch->SearchValue2 = @$filter["y_rw_id"];
		$this->rw_id->AdvancedSearch->SearchOperator2 = @$filter["w_rw_id"];
		$this->rw_id->AdvancedSearch->save();

		// Field rt_id
		$this->rt_id->AdvancedSearch->SearchValue = @$filter["x_rt_id"];
		$this->rt_id->AdvancedSearch->SearchOperator = @$filter["z_rt_id"];
		$this->rt_id->AdvancedSearch->SearchCondition = @$filter["v_rt_id"];
		$this->rt_id->AdvancedSearch->SearchValue2 = @$filter["y_rt_id"];
		$this->rt_id->AdvancedSearch->SearchOperator2 = @$filter["w_rt_id"];
		$this->rt_id->AdvancedSearch->save();

		// Field alamat_id
		$this->alamat_id->AdvancedSearch->SearchValue = @$filter["x_alamat_id"];
		$this->alamat_id->AdvancedSearch->SearchOperator = @$filter["z_alamat_id"];
		$this->alamat_id->AdvancedSearch->SearchCondition = @$filter["v_alamat_id"];
		$this->alamat_id->AdvancedSearch->SearchValue2 = @$filter["y_alamat_id"];
		$this->alamat_id->AdvancedSearch->SearchOperator2 = @$filter["w_alamat_id"];
		$this->alamat_id->AdvancedSearch->save();

		// Field nomor_rumah
		$this->nomor_rumah->AdvancedSearch->SearchValue = @$filter["x_nomor_rumah"];
		$this->nomor_rumah->AdvancedSearch->SearchOperator = @$filter["z_nomor_rumah"];
		$this->nomor_rumah->AdvancedSearch->SearchCondition = @$filter["v_nomor_rumah"];
		$this->nomor_rumah->AdvancedSearch->SearchValue2 = @$filter["y_nomor_rumah"];
		$this->nomor_rumah->AdvancedSearch->SearchOperator2 = @$filter["w_nomor_rumah"];
		$this->nomor_rumah->AdvancedSearch->save();

		// Field keterangan
		$this->keterangan->AdvancedSearch->SearchValue = @$filter["x_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator = @$filter["z_keterangan"];
		$this->keterangan->AdvancedSearch->SearchCondition = @$filter["v_keterangan"];
		$this->keterangan->AdvancedSearch->SearchValue2 = @$filter["y_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_keterangan"];
		$this->keterangan->AdvancedSearch->save();

		// Field status_bantuan
		$this->status_bantuan->AdvancedSearch->SearchValue = @$filter["x_status_bantuan"];
		$this->status_bantuan->AdvancedSearch->SearchOperator = @$filter["z_status_bantuan"];
		$this->status_bantuan->AdvancedSearch->SearchCondition = @$filter["v_status_bantuan"];
		$this->status_bantuan->AdvancedSearch->SearchValue2 = @$filter["y_status_bantuan"];
		$this->status_bantuan->AdvancedSearch->SearchOperator2 = @$filter["w_status_bantuan"];
		$this->status_bantuan->AdvancedSearch->save();

		// Field nama_kecamatan
		$this->nama_kecamatan->AdvancedSearch->SearchValue = @$filter["x_nama_kecamatan"];
		$this->nama_kecamatan->AdvancedSearch->SearchOperator = @$filter["z_nama_kecamatan"];
		$this->nama_kecamatan->AdvancedSearch->SearchCondition = @$filter["v_nama_kecamatan"];
		$this->nama_kecamatan->AdvancedSearch->SearchValue2 = @$filter["y_nama_kecamatan"];
		$this->nama_kecamatan->AdvancedSearch->SearchOperator2 = @$filter["w_nama_kecamatan"];
		$this->nama_kecamatan->AdvancedSearch->save();

		// Field nama_kelurahan
		$this->nama_kelurahan->AdvancedSearch->SearchValue = @$filter["x_nama_kelurahan"];
		$this->nama_kelurahan->AdvancedSearch->SearchOperator = @$filter["z_nama_kelurahan"];
		$this->nama_kelurahan->AdvancedSearch->SearchCondition = @$filter["v_nama_kelurahan"];
		$this->nama_kelurahan->AdvancedSearch->SearchValue2 = @$filter["y_nama_kelurahan"];
		$this->nama_kelurahan->AdvancedSearch->SearchOperator2 = @$filter["w_nama_kelurahan"];
		$this->nama_kelurahan->AdvancedSearch->save();

		// Field nama_rw
		$this->nama_rw->AdvancedSearch->SearchValue = @$filter["x_nama_rw"];
		$this->nama_rw->AdvancedSearch->SearchOperator = @$filter["z_nama_rw"];
		$this->nama_rw->AdvancedSearch->SearchCondition = @$filter["v_nama_rw"];
		$this->nama_rw->AdvancedSearch->SearchValue2 = @$filter["y_nama_rw"];
		$this->nama_rw->AdvancedSearch->SearchOperator2 = @$filter["w_nama_rw"];
		$this->nama_rw->AdvancedSearch->save();

		// Field nama_rt
		$this->nama_rt->AdvancedSearch->SearchValue = @$filter["x_nama_rt"];
		$this->nama_rt->AdvancedSearch->SearchOperator = @$filter["z_nama_rt"];
		$this->nama_rt->AdvancedSearch->SearchCondition = @$filter["v_nama_rt"];
		$this->nama_rt->AdvancedSearch->SearchValue2 = @$filter["y_nama_rt"];
		$this->nama_rt->AdvancedSearch->SearchOperator2 = @$filter["w_nama_rt"];
		$this->nama_rt->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		$this->buildSearchSql($where, $this->jenis_bantuan_id, $default, FALSE); // jenis_bantuan_id
		$this->buildSearchSql($where, $this->bantuan_id, $default, FALSE); // bantuan_id
		$this->buildSearchSql($where, $this->type, $default, FALSE); // type
		$this->buildSearchSql($where, $this->jumlah, $default, FALSE); // jumlah
		$this->buildSearchSql($where, $this->sumber_bantuan_id, $default, FALSE); // sumber_bantuan_id
		$this->buildSearchSql($where, $this->pengambilan_bantuuan_id, $default, FALSE); // pengambilan_bantuuan_id
		$this->buildSearchSql($where, $this->tahun_bantuan, $default, FALSE); // tahun_bantuan
		$this->buildSearchSql($where, $this->keterangan_bantuan, $default, FALSE); // keterangan_bantuan
		$this->buildSearchSql($where, $this->warga_id, $default, FALSE); // warga_id
		$this->buildSearchSql($where, $this->kk, $default, FALSE); // kk
		$this->buildSearchSql($where, $this->nik, $default, FALSE); // nik
		$this->buildSearchSql($where, $this->nama, $default, FALSE); // nama
		$this->buildSearchSql($where, $this->provinsi_id, $default, FALSE); // provinsi_id
		$this->buildSearchSql($where, $this->kabupaten_id, $default, FALSE); // kabupaten_id
		$this->buildSearchSql($where, $this->kecamatan_id, $default, FALSE); // kecamatan_id
		$this->buildSearchSql($where, $this->kelurahan_id, $default, FALSE); // kelurahan_id
		$this->buildSearchSql($where, $this->rw_id, $default, FALSE); // rw_id
		$this->buildSearchSql($where, $this->rt_id, $default, FALSE); // rt_id
		$this->buildSearchSql($where, $this->alamat_id, $default, FALSE); // alamat_id
		$this->buildSearchSql($where, $this->nomor_rumah, $default, FALSE); // nomor_rumah
		$this->buildSearchSql($where, $this->keterangan, $default, FALSE); // keterangan
		$this->buildSearchSql($where, $this->status_bantuan, $default, FALSE); // status_bantuan
		$this->buildSearchSql($where, $this->nama_kecamatan, $default, FALSE); // nama_kecamatan
		$this->buildSearchSql($where, $this->nama_kelurahan, $default, FALSE); // nama_kelurahan
		$this->buildSearchSql($where, $this->nama_rw, $default, FALSE); // nama_rw
		$this->buildSearchSql($where, $this->nama_rt, $default, FALSE); // nama_rt

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->jenis_bantuan_id->AdvancedSearch->save(); // jenis_bantuan_id
			$this->bantuan_id->AdvancedSearch->save(); // bantuan_id
			$this->type->AdvancedSearch->save(); // type
			$this->jumlah->AdvancedSearch->save(); // jumlah
			$this->sumber_bantuan_id->AdvancedSearch->save(); // sumber_bantuan_id
			$this->pengambilan_bantuuan_id->AdvancedSearch->save(); // pengambilan_bantuuan_id
			$this->tahun_bantuan->AdvancedSearch->save(); // tahun_bantuan
			$this->keterangan_bantuan->AdvancedSearch->save(); // keterangan_bantuan
			$this->warga_id->AdvancedSearch->save(); // warga_id
			$this->kk->AdvancedSearch->save(); // kk
			$this->nik->AdvancedSearch->save(); // nik
			$this->nama->AdvancedSearch->save(); // nama
			$this->provinsi_id->AdvancedSearch->save(); // provinsi_id
			$this->kabupaten_id->AdvancedSearch->save(); // kabupaten_id
			$this->kecamatan_id->AdvancedSearch->save(); // kecamatan_id
			$this->kelurahan_id->AdvancedSearch->save(); // kelurahan_id
			$this->rw_id->AdvancedSearch->save(); // rw_id
			$this->rt_id->AdvancedSearch->save(); // rt_id
			$this->alamat_id->AdvancedSearch->save(); // alamat_id
			$this->nomor_rumah->AdvancedSearch->save(); // nomor_rumah
			$this->keterangan->AdvancedSearch->save(); // keterangan
			$this->status_bantuan->AdvancedSearch->save(); // status_bantuan
			$this->nama_kecamatan->AdvancedSearch->save(); // nama_kecamatan
			$this->nama_kelurahan->AdvancedSearch->save(); // nama_kelurahan
			$this->nama_rw->AdvancedSearch->save(); // nama_rw
			$this->nama_rt->AdvancedSearch->save(); // nama_rt
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
		$this->buildBasicSearchSql($where, $this->jumlah, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->keterangan_bantuan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->kk, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nik, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nama, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->alamat_id, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nomor_rumah, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->keterangan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nama_kecamatan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nama_kelurahan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nama_rw, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->nama_rt, $arKeywords, $type);
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
		if ($this->jenis_bantuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->bantuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->type->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->jumlah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->sumber_bantuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pengambilan_bantuuan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tahun_bantuan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->keterangan_bantuan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->warga_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kk->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nik->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->provinsi_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kabupaten_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kecamatan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kelurahan_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->rw_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->rt_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->alamat_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nomor_rumah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->keterangan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->status_bantuan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama_kecamatan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama_kelurahan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama_rw->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->nama_rt->AdvancedSearch->issetSession())
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
		$this->status_bantuan->AdvancedSearch->loadDefault();
		return TRUE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->jenis_bantuan_id->AdvancedSearch->unsetSession();
		$this->bantuan_id->AdvancedSearch->unsetSession();
		$this->type->AdvancedSearch->unsetSession();
		$this->jumlah->AdvancedSearch->unsetSession();
		$this->sumber_bantuan_id->AdvancedSearch->unsetSession();
		$this->pengambilan_bantuuan_id->AdvancedSearch->unsetSession();
		$this->tahun_bantuan->AdvancedSearch->unsetSession();
		$this->keterangan_bantuan->AdvancedSearch->unsetSession();
		$this->warga_id->AdvancedSearch->unsetSession();
		$this->kk->AdvancedSearch->unsetSession();
		$this->nik->AdvancedSearch->unsetSession();
		$this->nama->AdvancedSearch->unsetSession();
		$this->provinsi_id->AdvancedSearch->unsetSession();
		$this->kabupaten_id->AdvancedSearch->unsetSession();
		$this->kecamatan_id->AdvancedSearch->unsetSession();
		$this->kelurahan_id->AdvancedSearch->unsetSession();
		$this->rw_id->AdvancedSearch->unsetSession();
		$this->rt_id->AdvancedSearch->unsetSession();
		$this->alamat_id->AdvancedSearch->unsetSession();
		$this->nomor_rumah->AdvancedSearch->unsetSession();
		$this->keterangan->AdvancedSearch->unsetSession();
		$this->status_bantuan->AdvancedSearch->unsetSession();
		$this->nama_kecamatan->AdvancedSearch->unsetSession();
		$this->nama_kelurahan->AdvancedSearch->unsetSession();
		$this->nama_rw->AdvancedSearch->unsetSession();
		$this->nama_rt->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->jenis_bantuan_id->AdvancedSearch->load();
		$this->bantuan_id->AdvancedSearch->load();
		$this->type->AdvancedSearch->load();
		$this->jumlah->AdvancedSearch->load();
		$this->sumber_bantuan_id->AdvancedSearch->load();
		$this->pengambilan_bantuuan_id->AdvancedSearch->load();
		$this->tahun_bantuan->AdvancedSearch->load();
		$this->keterangan_bantuan->AdvancedSearch->load();
		$this->warga_id->AdvancedSearch->load();
		$this->kk->AdvancedSearch->load();
		$this->nik->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->provinsi_id->AdvancedSearch->load();
		$this->kabupaten_id->AdvancedSearch->load();
		$this->kecamatan_id->AdvancedSearch->load();
		$this->kelurahan_id->AdvancedSearch->load();
		$this->rw_id->AdvancedSearch->load();
		$this->rt_id->AdvancedSearch->load();
		$this->alamat_id->AdvancedSearch->load();
		$this->nomor_rumah->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->status_bantuan->AdvancedSearch->load();
		$this->nama_kecamatan->AdvancedSearch->load();
		$this->nama_kelurahan->AdvancedSearch->load();
		$this->nama_rw->AdvancedSearch->load();
		$this->nama_rt->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
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
			$this->updateSort($this->alamat_id); // alamat_id
			$this->updateSort($this->nomor_rumah); // nomor_rumah
			$this->updateSort($this->status_bantuan); // status_bantuan
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
				$this->alamat_id->setSort("");
				$this->nomor_rumah->setSort("");
				$this->status_bantuan->setSort("");
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
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"rekap_bantuan\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

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

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->bantuan_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->warga_id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"frekap_bantuanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"frekap_bantuanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.frekap_bantuanlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// jenis_bantuan_id
		if (!$this->isAddOrEdit() && $this->jenis_bantuan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->jenis_bantuan_id->AdvancedSearch->SearchValue != "" || $this->jenis_bantuan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// bantuan_id
		if (!$this->isAddOrEdit() && $this->bantuan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bantuan_id->AdvancedSearch->SearchValue != "" || $this->bantuan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// tahun_bantuan
		if (!$this->isAddOrEdit() && $this->tahun_bantuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->tahun_bantuan->AdvancedSearch->SearchValue != "" || $this->tahun_bantuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// keterangan_bantuan
		if (!$this->isAddOrEdit() && $this->keterangan_bantuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->keterangan_bantuan->AdvancedSearch->SearchValue != "" || $this->keterangan_bantuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// warga_id
		if (!$this->isAddOrEdit() && $this->warga_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->warga_id->AdvancedSearch->SearchValue != "" || $this->warga_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kk
		if (!$this->isAddOrEdit() && $this->kk->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kk->AdvancedSearch->SearchValue != "" || $this->kk->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nik
		if (!$this->isAddOrEdit() && $this->nik->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nik->AdvancedSearch->SearchValue != "" || $this->nik->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama
		if (!$this->isAddOrEdit() && $this->nama->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama->AdvancedSearch->SearchValue != "" || $this->nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// provinsi_id
		if (!$this->isAddOrEdit() && $this->provinsi_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->provinsi_id->AdvancedSearch->SearchValue != "" || $this->provinsi_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kabupaten_id
		if (!$this->isAddOrEdit() && $this->kabupaten_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kabupaten_id->AdvancedSearch->SearchValue != "" || $this->kabupaten_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kecamatan_id
		if (!$this->isAddOrEdit() && $this->kecamatan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kecamatan_id->AdvancedSearch->SearchValue != "" || $this->kecamatan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kelurahan_id
		if (!$this->isAddOrEdit() && $this->kelurahan_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kelurahan_id->AdvancedSearch->SearchValue != "" || $this->kelurahan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// rw_id
		if (!$this->isAddOrEdit() && $this->rw_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->rw_id->AdvancedSearch->SearchValue != "" || $this->rw_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// rt_id
		if (!$this->isAddOrEdit() && $this->rt_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->rt_id->AdvancedSearch->SearchValue != "" || $this->rt_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// alamat_id
		if (!$this->isAddOrEdit() && $this->alamat_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->alamat_id->AdvancedSearch->SearchValue != "" || $this->alamat_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nomor_rumah
		if (!$this->isAddOrEdit() && $this->nomor_rumah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nomor_rumah->AdvancedSearch->SearchValue != "" || $this->nomor_rumah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// keterangan
		if (!$this->isAddOrEdit() && $this->keterangan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->keterangan->AdvancedSearch->SearchValue != "" || $this->keterangan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// status_bantuan
		if (!$this->isAddOrEdit() && $this->status_bantuan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->status_bantuan->AdvancedSearch->SearchValue != "" || $this->status_bantuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama_kecamatan
		if (!$this->isAddOrEdit() && $this->nama_kecamatan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama_kecamatan->AdvancedSearch->SearchValue != "" || $this->nama_kecamatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama_kelurahan
		if (!$this->isAddOrEdit() && $this->nama_kelurahan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama_kelurahan->AdvancedSearch->SearchValue != "" || $this->nama_kelurahan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama_rw
		if (!$this->isAddOrEdit() && $this->nama_rw->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama_rw->AdvancedSearch->SearchValue != "" || $this->nama_rw->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// nama_rt
		if (!$this->isAddOrEdit() && $this->nama_rt->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->nama_rt->AdvancedSearch->SearchValue != "" || $this->nama_rt->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
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
		$this->jenis_bantuan_id->setDbValue($row['jenis_bantuan_id']);
		$this->bantuan_id->setDbValue($row['bantuan_id']);
		$this->type->setDbValue($row['type']);
		$this->jumlah->setDbValue($row['jumlah']);
		$this->sumber_bantuan_id->setDbValue($row['sumber_bantuan_id']);
		$this->pengambilan_bantuuan_id->setDbValue($row['pengambilan_bantuuan_id']);
		$this->tahun_bantuan->setDbValue($row['tahun_bantuan']);
		$this->keterangan_bantuan->setDbValue($row['keterangan_bantuan']);
		$this->warga_id->setDbValue($row['warga_id']);
		$this->kk->setDbValue($row['kk']);
		$this->nik->setDbValue($row['nik']);
		$this->nama->setDbValue($row['nama']);
		$this->provinsi_id->setDbValue($row['provinsi_id']);
		$this->kabupaten_id->setDbValue($row['kabupaten_id']);
		$this->kecamatan_id->setDbValue($row['kecamatan_id']);
		$this->kelurahan_id->setDbValue($row['kelurahan_id']);
		$this->rw_id->setDbValue($row['rw_id']);
		$this->rt_id->setDbValue($row['rt_id']);
		$this->alamat_id->setDbValue($row['alamat_id']);
		$this->nomor_rumah->setDbValue($row['nomor_rumah']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->status_bantuan->setDbValue($row['status_bantuan']);
		$this->nama_kecamatan->setDbValue($row['nama_kecamatan']);
		$this->nama_kelurahan->setDbValue($row['nama_kelurahan']);
		$this->nama_rw->setDbValue($row['nama_rw']);
		$this->nama_rt->setDbValue($row['nama_rt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['jenis_bantuan_id'] = NULL;
		$row['bantuan_id'] = NULL;
		$row['type'] = NULL;
		$row['jumlah'] = NULL;
		$row['sumber_bantuan_id'] = NULL;
		$row['pengambilan_bantuuan_id'] = NULL;
		$row['tahun_bantuan'] = NULL;
		$row['keterangan_bantuan'] = NULL;
		$row['warga_id'] = NULL;
		$row['kk'] = NULL;
		$row['nik'] = NULL;
		$row['nama'] = NULL;
		$row['provinsi_id'] = NULL;
		$row['kabupaten_id'] = NULL;
		$row['kecamatan_id'] = NULL;
		$row['kelurahan_id'] = NULL;
		$row['rw_id'] = NULL;
		$row['rt_id'] = NULL;
		$row['alamat_id'] = NULL;
		$row['nomor_rumah'] = NULL;
		$row['keterangan'] = NULL;
		$row['status_bantuan'] = NULL;
		$row['nama_kecamatan'] = NULL;
		$row['nama_kelurahan'] = NULL;
		$row['nama_rw'] = NULL;
		$row['nama_rt'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("bantuan_id")) != "")
			$this->bantuan_id->OldValue = $this->getKey("bantuan_id"); // bantuan_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("warga_id")) != "")
			$this->warga_id->OldValue = $this->getKey("warga_id"); // warga_id
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// alamat_id
			$this->alamat_id->LinkCustomAttributes = "";
			$this->alamat_id->HrefValue = "";
			$this->alamat_id->TooltipValue = "";

			// nomor_rumah
			$this->nomor_rumah->LinkCustomAttributes = "";
			$this->nomor_rumah->HrefValue = "";
			$this->nomor_rumah->TooltipValue = "";

			// status_bantuan
			$this->status_bantuan->LinkCustomAttributes = "";
			$this->status_bantuan->HrefValue = "";
			$this->status_bantuan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

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

			// kk
			$this->kk->EditAttrs["class"] = "form-control";
			$this->kk->EditCustomAttributes = "";
			if (!$this->kk->Raw)
				$this->kk->AdvancedSearch->SearchValue = HtmlDecode($this->kk->AdvancedSearch->SearchValue);
			$this->kk->EditValue = HtmlEncode($this->kk->AdvancedSearch->SearchValue);
			$this->kk->PlaceHolder = RemoveHtml($this->kk->caption());

			// nik
			$this->nik->EditAttrs["class"] = "form-control";
			$this->nik->EditCustomAttributes = "";
			$this->nik->EditValue = HtmlEncode($this->nik->AdvancedSearch->SearchValue);
			$this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

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

			// alamat_id
			$this->alamat_id->EditAttrs["class"] = "form-control";
			$this->alamat_id->EditCustomAttributes = "";
			$this->alamat_id->EditValue = HtmlEncode($this->alamat_id->AdvancedSearch->SearchValue);
			$curVal = strval($this->alamat_id->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->alamat_id->EditValue = $this->alamat_id->lookupCacheOption($curVal);
				if ($this->alamat_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`na` = 'n'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->alamat_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->alamat_id->EditValue = $this->alamat_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->alamat_id->EditValue = HtmlEncode($this->alamat_id->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->alamat_id->EditValue = NULL;
			}
			$this->alamat_id->PlaceHolder = RemoveHtml($this->alamat_id->caption());

			// nomor_rumah
			$this->nomor_rumah->EditAttrs["class"] = "form-control";
			$this->nomor_rumah->EditCustomAttributes = "";
			if (!$this->nomor_rumah->Raw)
				$this->nomor_rumah->AdvancedSearch->SearchValue = HtmlDecode($this->nomor_rumah->AdvancedSearch->SearchValue);
			$this->nomor_rumah->EditValue = HtmlEncode($this->nomor_rumah->AdvancedSearch->SearchValue);
			$this->nomor_rumah->PlaceHolder = RemoveHtml($this->nomor_rumah->caption());

			// status_bantuan
			$this->status_bantuan->EditCustomAttributes = "";
			$this->status_bantuan->EditValue = $this->status_bantuan->options(FALSE);
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
		if (!CheckInteger($this->tahun_bantuan->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tahun_bantuan->errorMessage());
		}
		if (!CheckInteger($this->kecamatan_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->kecamatan_id->errorMessage());
		}
		if (!CheckInteger($this->kelurahan_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->kelurahan_id->errorMessage());
		}
		if (!CheckInteger($this->alamat_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->alamat_id->errorMessage());
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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->jenis_bantuan_id->AdvancedSearch->load();
		$this->bantuan_id->AdvancedSearch->load();
		$this->type->AdvancedSearch->load();
		$this->jumlah->AdvancedSearch->load();
		$this->sumber_bantuan_id->AdvancedSearch->load();
		$this->pengambilan_bantuuan_id->AdvancedSearch->load();
		$this->tahun_bantuan->AdvancedSearch->load();
		$this->keterangan_bantuan->AdvancedSearch->load();
		$this->warga_id->AdvancedSearch->load();
		$this->kk->AdvancedSearch->load();
		$this->nik->AdvancedSearch->load();
		$this->nama->AdvancedSearch->load();
		$this->provinsi_id->AdvancedSearch->load();
		$this->kabupaten_id->AdvancedSearch->load();
		$this->kecamatan_id->AdvancedSearch->load();
		$this->kelurahan_id->AdvancedSearch->load();
		$this->rw_id->AdvancedSearch->load();
		$this->rt_id->AdvancedSearch->load();
		$this->alamat_id->AdvancedSearch->load();
		$this->nomor_rumah->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->status_bantuan->AdvancedSearch->load();
		$this->nama_kecamatan->AdvancedSearch->load();
		$this->nama_kelurahan->AdvancedSearch->load();
		$this->nama_rw->AdvancedSearch->load();
		$this->nama_rt->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.frekap_bantuanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.frekap_bantuanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.frekap_bantuanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_rekap_bantuan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_rekap_bantuan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.frekap_bantuanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frekap_bantuanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ResetSearch") . "\" data-caption=\"" . $Language->phrase("ResetSearch") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ResetSearchBtn") . "</a>";
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
				case "x_bantuan_id":
					break;
				case "x_type":
					break;
				case "x_sumber_bantuan_id":
					break;
				case "x_pengambilan_bantuuan_id":
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
						case "x_sumber_bantuan_id":
							break;
						case "x_pengambilan_bantuuan_id":
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