<?php
namespace PHPMaker2020\bansos;

/**
 * Page class
 */
class rekap_bantuan2_view extends rekap_bantuan2
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}";

	// Table name
	public $TableName = 'rekap_bantuan2';

	// Page object name
	public $PageObjName = "rekap_bantuan2_view";

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

		// Table object (rekap_bantuan2)
		if (!isset($GLOBALS["rekap_bantuan2"]) || get_class($GLOBALS["rekap_bantuan2"]) == PROJECT_NAMESPACE . "rekap_bantuan2") {
			$GLOBALS["rekap_bantuan2"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rekap_bantuan2"];
		}
		$keyUrl = "";
		if (Get("id") !== NULL) {
			$this->RecKey["id"] = Get("id");
			$keyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'rekap_bantuan2');

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

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
		global $rekap_bantuan2;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($rekap_bantuan2);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "rekap_bantuan2view.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("rekap_bantuan2list.php"));
				else
					$this->terminate(GetUrl("login.php"));
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
		if (Get("id") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("id");
		}

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

		// Setup export options
		$this->setupExportOptions();
		$this->id->setVisibility();
		$this->bansos_id->setVisibility();
		$this->warga_id->setVisibility();
		$this->jenis_bantuan_id->setVisibility();
		$this->type->setVisibility();
		$this->jumlah->setVisibility();
		$this->sumber_bantuan_id->setVisibility();
		$this->pengambilan_bantuuan_id->setVisibility();
		$this->frekuensi->setVisibility();
		$this->bulan->setVisibility();
		$this->tahun->setVisibility();
		$this->keterangan_bantuan->setVisibility();
		$this->status->setVisibility();
		$this->kk->setVisibility();
		$this->nik->setVisibility();
		$this->nama->setVisibility();
		$this->provinsi_id->setVisibility();
		$this->kabupaten_id->setVisibility();
		$this->kecamatan_id->setVisibility();
		$this->kelurahan_id->setVisibility();
		$this->rw_id->setVisibility();
		$this->rt_id->setVisibility();
		$this->alamat_id->setVisibility();
		$this->nomor_rumah->setVisibility();
		$this->status_warga_id->setVisibility();
		$this->keterangan_warga->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

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

		// Set up lookup cache
		$this->setupLookupOptions($this->bansos_id);
		$this->setupLookupOptions($this->warga_id);
		$this->setupLookupOptions($this->jenis_bantuan_id);
		$this->setupLookupOptions($this->sumber_bantuan_id);
		$this->setupLookupOptions($this->pengambilan_bantuuan_id);
		$this->setupLookupOptions($this->provinsi_id);
		$this->setupLookupOptions($this->kabupaten_id);
		$this->setupLookupOptions($this->kecamatan_id);
		$this->setupLookupOptions($this->kelurahan_id);
		$this->setupLookupOptions($this->rw_id);
		$this->setupLookupOptions($this->rt_id);
		$this->setupLookupOptions($this->alamat_id);
		$this->setupLookupOptions($this->status_warga_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->RecKey["id"] = $this->id->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->id->setFormValue(Route(2));
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display
					$this->StartRecord = 1; // Initialize start position
					if ($this->Recordset = $this->loadRecordset()) // Load records
						$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecords <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$this->terminate("rekap_bantuan2list.php"); // Return to list page
					} elseif ($loadCurrentRecord) { // Load current record position
						$this->setupStartRecord(); // Set up start record position

						// Point to current record
						if ($this->StartRecord <= $this->TotalRecords) {
							$matchRecord = TRUE;
							$this->Recordset->move($this->StartRecord - 1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (SameString($this->id->CurrentValue, $this->Recordset->fields('id'))) {
								$this->setStartRecordNumber($this->StartRecord); // Save record position
								$matchRecord = TRUE;
								break;
							} else {
								$this->StartRecord++;
								$this->Recordset->moveNext();
							}
						}
					}
					if (!$matchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "rekap_bantuan2list.php"; // No matching record, return to list
					} else {
						$this->loadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "rekap_bantuan2list.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		$this->bansos_id->setDbValue($row['bansos_id']);
		$this->warga_id->setDbValue($row['warga_id']);
		if (array_key_exists('EV__warga_id', $rs->fields)) {
			$this->warga_id->VirtualValue = $rs->fields('EV__warga_id'); // Set up virtual field value
		} else {
			$this->warga_id->VirtualValue = ""; // Clear value
		}
		$this->jenis_bantuan_id->setDbValue($row['jenis_bantuan_id']);
		$this->type->setDbValue($row['type']);
		$this->jumlah->setDbValue($row['jumlah']);
		$this->sumber_bantuan_id->setDbValue($row['sumber_bantuan_id']);
		$this->pengambilan_bantuuan_id->setDbValue($row['pengambilan_bantuuan_id']);
		$this->frekuensi->setDbValue($row['frekuensi']);
		$this->bulan->setDbValue($row['bulan']);
		$this->tahun->setDbValue($row['tahun']);
		$this->keterangan_bantuan->setDbValue($row['keterangan_bantuan']);
		$this->status->setDbValue($row['status']);
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
		$this->status_warga_id->setDbValue($row['status_warga_id']);
		$this->keterangan_warga->setDbValue($row['keterangan_warga']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['bansos_id'] = NULL;
		$row['warga_id'] = NULL;
		$row['jenis_bantuan_id'] = NULL;
		$row['type'] = NULL;
		$row['jumlah'] = NULL;
		$row['sumber_bantuan_id'] = NULL;
		$row['pengambilan_bantuuan_id'] = NULL;
		$row['frekuensi'] = NULL;
		$row['bulan'] = NULL;
		$row['tahun'] = NULL;
		$row['keterangan_bantuan'] = NULL;
		$row['status'] = NULL;
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
		$row['status_warga_id'] = NULL;
		$row['keterangan_warga'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.frekap_bantuan2view, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.frekap_bantuan2view, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.frekap_bantuan2view, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_rekap_bantuan2" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_rekap_bantuan2\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.frekap_bantuan2view, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Visible = TRUE;

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
		$selectLimit = FALSE;

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
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
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
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("rekap_bantuan2list.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$this->MultiPages = $pages;
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
				case "x_bansos_id":
					$lookupFilter = function() {
						return "`na` = 'n'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_warga_id":
					break;
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
				case "x_status_warga_id":
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
						case "x_bansos_id":
							break;
						case "x_warga_id":
							break;
						case "x_jenis_bantuan_id":
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
						case "x_status_warga_id":
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
} // End class
?>