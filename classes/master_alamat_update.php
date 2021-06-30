<?php
namespace PHPMaker2020\bansos;

/**
 * Page class
 */
class master_alamat_update extends master_alamat
{

	// Page ID
	public $PageID = "update";

	// Project ID
	public $ProjectID = "{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}";

	// Table name
	public $TableName = 'master_alamat';

	// Page object name
	public $PageObjName = "master_alamat_update";

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

		// Table object (master_alamat)
		if (!isset($GLOBALS["master_alamat"]) || get_class($GLOBALS["master_alamat"]) == PROJECT_NAMESPACE . "master_alamat") {
			$GLOBALS["master_alamat"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["master_alamat"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'update');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'master_alamat');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
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
		global $master_alamat;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($master_alamat);
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
					if ($pageName == "master_alamatview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-update-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $RecKeys;
	public $Disabled;
	public $UpdateCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("master_alamatlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->provinsi_id->setVisibility();
		$this->kabupaten_id->setVisibility();
		$this->kecamatan_id->setVisibility();
		$this->kelurahan_id->setVisibility();
		$this->rw_id->setVisibility();
		$this->rt_id->setVisibility();
		$this->nama->Visible = FALSE;
		$this->na->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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
		$this->setupLookupOptions($this->provinsi_id);
		$this->setupLookupOptions($this->kabupaten_id);
		$this->setupLookupOptions($this->kecamatan_id);
		$this->setupLookupOptions($this->kelurahan_id);
		$this->setupLookupOptions($this->rw_id);
		$this->setupLookupOptions($this->rt_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-update-form ew-horizontal";

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		if (Post("action") !== NULL && Post("action") !== "") {

			// Get action
			$this->CurrentAction = Post("action");
			$this->loadFormValues(); // Get form values

			// Validate form
			if (!$this->validateForm()) {
				$this->CurrentAction = "show"; // Form error, reset action
				$this->setFailureMessage($FormError);
			}
		} else {
			$this->loadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->terminate("master_alamatlist.php"); // No records selected, return to list
		if ($this->isUpdate()) {
				if ($this->updateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
					$this->terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->restoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = ROWTYPE_EDIT; // Render edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	protected function loadMultiUpdateValues()
	{
		$this->CurrentFilter = $this->getFilterFromRecordKeys();

		// Load recordset
		if ($this->Recordset = $this->loadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->provinsi_id->setDbValue($this->Recordset->fields('provinsi_id'));
					$this->kabupaten_id->setDbValue($this->Recordset->fields('kabupaten_id'));
					$this->kecamatan_id->setDbValue($this->Recordset->fields('kecamatan_id'));
					$this->kelurahan_id->setDbValue($this->Recordset->fields('kelurahan_id'));
					$this->rw_id->setDbValue($this->Recordset->fields('rw_id'));
					$this->rt_id->setDbValue($this->Recordset->fields('rt_id'));
				} else {
					if (!CompareValue($this->provinsi_id->DbValue, $this->Recordset->fields('provinsi_id')))
						$this->provinsi_id->CurrentValue = NULL;
					if (!CompareValue($this->kabupaten_id->DbValue, $this->Recordset->fields('kabupaten_id')))
						$this->kabupaten_id->CurrentValue = NULL;
					if (!CompareValue($this->kecamatan_id->DbValue, $this->Recordset->fields('kecamatan_id')))
						$this->kecamatan_id->CurrentValue = NULL;
					if (!CompareValue($this->kelurahan_id->DbValue, $this->Recordset->fields('kelurahan_id')))
						$this->kelurahan_id->CurrentValue = NULL;
					if (!CompareValue($this->rw_id->DbValue, $this->Recordset->fields('rw_id')))
						$this->rw_id->CurrentValue = NULL;
					if (!CompareValue($this->rt_id->DbValue, $this->Recordset->fields('rt_id')))
						$this->rt_id->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->moveNext();
			}
			$this->Recordset->close();
		}
	}

	// Set up key value
	protected function setupKeyValues($key)
	{
		$keyFld = $key;
		if (!is_numeric($keyFld))
			return FALSE;
		$this->id->OldValue = $keyFld;
		return TRUE;
	}

	// Update all selected rows
	protected function updateRows()
	{
		global $Language;
		$conn = $this->getConnection();
		$conn->beginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->getFilterFromRecordKeys(FALSE);
		$sql = $this->getCurrentSql();
		$rsold = $conn->execute($sql);

		// Update all rows
		$key = "";
		foreach ($this->RecKeys as $reckey) {
			if ($this->setupKeyValues($reckey)) {
				$thisKey = $reckey;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$updateRows = $this->editRow(); // Update this row
			} else {
				$updateRows = FALSE;
			}
			if (!$updateRows)
				break; // Update failed
			if ($key != "")
				$key .= ", ";
			$key .= $thisKey;
		}

		// Check if all rows updated
		if ($updateRows) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->execute($sql);
		} else {
			$conn->rollbackTrans(); // Rollback transaction
		}
		return $updateRows;
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'provinsi_id' first before field var 'x_provinsi_id'
		$val = $CurrentForm->hasValue("provinsi_id") ? $CurrentForm->getValue("provinsi_id") : $CurrentForm->getValue("x_provinsi_id");
		if (!$this->provinsi_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->provinsi_id->Visible = FALSE; // Disable update for API request
			else
				$this->provinsi_id->setFormValue($val);
		}
		$this->provinsi_id->MultiUpdate = $CurrentForm->getValue("u_provinsi_id");

		// Check field name 'kabupaten_id' first before field var 'x_kabupaten_id'
		$val = $CurrentForm->hasValue("kabupaten_id") ? $CurrentForm->getValue("kabupaten_id") : $CurrentForm->getValue("x_kabupaten_id");
		if (!$this->kabupaten_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kabupaten_id->Visible = FALSE; // Disable update for API request
			else
				$this->kabupaten_id->setFormValue($val);
		}
		$this->kabupaten_id->MultiUpdate = $CurrentForm->getValue("u_kabupaten_id");

		// Check field name 'kecamatan_id' first before field var 'x_kecamatan_id'
		$val = $CurrentForm->hasValue("kecamatan_id") ? $CurrentForm->getValue("kecamatan_id") : $CurrentForm->getValue("x_kecamatan_id");
		if (!$this->kecamatan_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kecamatan_id->Visible = FALSE; // Disable update for API request
			else
				$this->kecamatan_id->setFormValue($val);
		}
		$this->kecamatan_id->MultiUpdate = $CurrentForm->getValue("u_kecamatan_id");

		// Check field name 'kelurahan_id' first before field var 'x_kelurahan_id'
		$val = $CurrentForm->hasValue("kelurahan_id") ? $CurrentForm->getValue("kelurahan_id") : $CurrentForm->getValue("x_kelurahan_id");
		if (!$this->kelurahan_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->kelurahan_id->Visible = FALSE; // Disable update for API request
			else
				$this->kelurahan_id->setFormValue($val);
		}
		$this->kelurahan_id->MultiUpdate = $CurrentForm->getValue("u_kelurahan_id");

		// Check field name 'rw_id' first before field var 'x_rw_id'
		$val = $CurrentForm->hasValue("rw_id") ? $CurrentForm->getValue("rw_id") : $CurrentForm->getValue("x_rw_id");
		if (!$this->rw_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->rw_id->Visible = FALSE; // Disable update for API request
			else
				$this->rw_id->setFormValue($val);
		}
		$this->rw_id->MultiUpdate = $CurrentForm->getValue("u_rw_id");

		// Check field name 'rt_id' first before field var 'x_rt_id'
		$val = $CurrentForm->hasValue("rt_id") ? $CurrentForm->getValue("rt_id") : $CurrentForm->getValue("x_rt_id");
		if (!$this->rt_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->rt_id->Visible = FALSE; // Disable update for API request
			else
				$this->rt_id->setFormValue($val);
		}
		$this->rt_id->MultiUpdate = $CurrentForm->getValue("u_rt_id");

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->provinsi_id->CurrentValue = $this->provinsi_id->FormValue;
		$this->kabupaten_id->CurrentValue = $this->kabupaten_id->FormValue;
		$this->kecamatan_id->CurrentValue = $this->kecamatan_id->FormValue;
		$this->kelurahan_id->CurrentValue = $this->kelurahan_id->FormValue;
		$this->rw_id->CurrentValue = $this->rw_id->FormValue;
		$this->rt_id->CurrentValue = $this->rt_id->FormValue;
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
		$this->provinsi_id->setDbValue($row['provinsi_id']);
		$this->kabupaten_id->setDbValue($row['kabupaten_id']);
		$this->kecamatan_id->setDbValue($row['kecamatan_id']);
		$this->kelurahan_id->setDbValue($row['kelurahan_id']);
		$this->rw_id->setDbValue($row['rw_id']);
		$this->rt_id->setDbValue($row['rt_id']);
		$this->nama->setDbValue($row['nama']);
		$this->na->setDbValue($row['na']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['provinsi_id'] = NULL;
		$row['kabupaten_id'] = NULL;
		$row['kecamatan_id'] = NULL;
		$row['kelurahan_id'] = NULL;
		$row['rw_id'] = NULL;
		$row['rt_id'] = NULL;
		$row['nama'] = NULL;
		$row['na'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// provinsi_id
		// kabupaten_id
		// kecamatan_id
		// kelurahan_id
		// rw_id
		// rt_id
		// nama
		// na

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// provinsi_id
			$this->provinsi_id->EditAttrs["class"] = "form-control";
			$this->provinsi_id->EditCustomAttributes = "";
			$this->provinsi_id->EditValue = HtmlEncode($this->provinsi_id->CurrentValue);
			$curVal = strval($this->provinsi_id->CurrentValue);
			if ($curVal != "") {
				$this->provinsi_id->EditValue = $this->provinsi_id->lookupCacheOption($curVal);
				if ($this->provinsi_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`id` = ".provinsiId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->provinsi_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->provinsi_id->EditValue = $this->provinsi_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->provinsi_id->EditValue = HtmlEncode($this->provinsi_id->CurrentValue);
					}
				}
			} else {
				$this->provinsi_id->EditValue = NULL;
			}
			$this->provinsi_id->PlaceHolder = RemoveHtml($this->provinsi_id->caption());

			// kabupaten_id
			$this->kabupaten_id->EditAttrs["class"] = "form-control";
			$this->kabupaten_id->EditCustomAttributes = "";
			$this->kabupaten_id->EditValue = HtmlEncode($this->kabupaten_id->CurrentValue);
			$curVal = strval($this->kabupaten_id->CurrentValue);
			if ($curVal != "") {
				$this->kabupaten_id->EditValue = $this->kabupaten_id->lookupCacheOption($curVal);
				if ($this->kabupaten_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`id` = ".kabupatenId()."";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->kabupaten_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kabupaten_id->EditValue = $this->kabupaten_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kabupaten_id->EditValue = HtmlEncode($this->kabupaten_id->CurrentValue);
					}
				}
			} else {
				$this->kabupaten_id->EditValue = NULL;
			}
			$this->kabupaten_id->PlaceHolder = RemoveHtml($this->kabupaten_id->caption());

			// kecamatan_id
			$this->kecamatan_id->EditAttrs["class"] = "form-control";
			$this->kecamatan_id->EditCustomAttributes = "";
			$this->kecamatan_id->EditValue = HtmlEncode($this->kecamatan_id->CurrentValue);
			$curVal = strval($this->kecamatan_id->CurrentValue);
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
						$this->kecamatan_id->EditValue = HtmlEncode($this->kecamatan_id->CurrentValue);
					}
				}
			} else {
				$this->kecamatan_id->EditValue = NULL;
			}
			$this->kecamatan_id->PlaceHolder = RemoveHtml($this->kecamatan_id->caption());

			// kelurahan_id
			$this->kelurahan_id->EditAttrs["class"] = "form-control";
			$this->kelurahan_id->EditCustomAttributes = "";
			$this->kelurahan_id->EditValue = HtmlEncode($this->kelurahan_id->CurrentValue);
			$curVal = strval($this->kelurahan_id->CurrentValue);
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
						$this->kelurahan_id->EditValue = HtmlEncode($this->kelurahan_id->CurrentValue);
					}
				}
			} else {
				$this->kelurahan_id->EditValue = NULL;
			}
			$this->kelurahan_id->PlaceHolder = RemoveHtml($this->kelurahan_id->caption());

			// rw_id
			$this->rw_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->rw_id->CurrentValue));
			if ($curVal != "")
				$this->rw_id->ViewValue = $this->rw_id->lookupCacheOption($curVal);
			else
				$this->rw_id->ViewValue = $this->rw_id->Lookup !== NULL && is_array($this->rw_id->Lookup->Options) ? $curVal : NULL;
			if ($this->rw_id->ViewValue !== NULL) { // Load from cache
				$this->rw_id->EditValue = array_values($this->rw_id->Lookup->Options);
				if ($this->rw_id->ViewValue == "")
					$this->rw_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->rw_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->rw_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->rw_id->ViewValue = $this->rw_id->displayValue($arwrk);
				} else {
					$this->rw_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->rw_id->EditValue = $arwrk;
			}

			// rt_id
			$this->rt_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->rt_id->CurrentValue));
			if ($curVal != "")
				$this->rt_id->ViewValue = $this->rt_id->lookupCacheOption($curVal);
			else
				$this->rt_id->ViewValue = $this->rt_id->Lookup !== NULL && is_array($this->rt_id->Lookup->Options) ? $curVal : NULL;
			if ($this->rt_id->ViewValue !== NULL) { // Load from cache
				$this->rt_id->EditValue = array_values($this->rt_id->Lookup->Options);
				if ($this->rt_id->ViewValue == "")
					$this->rt_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->rt_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->rt_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->rt_id->ViewValue = $this->rt_id->displayValue($arwrk);
				} else {
					$this->rt_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->rt_id->EditValue = $arwrk;
			}

			// Edit refer script
			// provinsi_id

			$this->provinsi_id->LinkCustomAttributes = "";
			$this->provinsi_id->HrefValue = "";

			// kabupaten_id
			$this->kabupaten_id->LinkCustomAttributes = "";
			$this->kabupaten_id->HrefValue = "";

			// kecamatan_id
			$this->kecamatan_id->LinkCustomAttributes = "";
			$this->kecamatan_id->HrefValue = "";

			// kelurahan_id
			$this->kelurahan_id->LinkCustomAttributes = "";
			$this->kelurahan_id->HrefValue = "";

			// rw_id
			$this->rw_id->LinkCustomAttributes = "";
			$this->rw_id->HrefValue = "";

			// rt_id
			$this->rt_id->LinkCustomAttributes = "";
			$this->rt_id->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";
		$updateCnt = 0;
		if ($this->provinsi_id->MultiUpdate == "1")
			$updateCnt++;
		if ($this->kabupaten_id->MultiUpdate == "1")
			$updateCnt++;
		if ($this->kecamatan_id->MultiUpdate == "1")
			$updateCnt++;
		if ($this->kelurahan_id->MultiUpdate == "1")
			$updateCnt++;
		if ($this->rw_id->MultiUpdate == "1")
			$updateCnt++;
		if ($this->rt_id->MultiUpdate == "1")
			$updateCnt++;
		if ($updateCnt == 0) {
			$FormError = $Language->phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->provinsi_id->Required) {
			if ($this->provinsi_id->MultiUpdate != "" && !$this->provinsi_id->IsDetailKey && $this->provinsi_id->FormValue != NULL && $this->provinsi_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->provinsi_id->caption(), $this->provinsi_id->RequiredErrorMessage));
			}
		}
		if ($this->provinsi_id->MultiUpdate != "") {
			if (!CheckInteger($this->provinsi_id->FormValue)) {
				AddMessage($FormError, $this->provinsi_id->errorMessage());
			}
		}
		if ($this->kabupaten_id->Required) {
			if ($this->kabupaten_id->MultiUpdate != "" && !$this->kabupaten_id->IsDetailKey && $this->kabupaten_id->FormValue != NULL && $this->kabupaten_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kabupaten_id->caption(), $this->kabupaten_id->RequiredErrorMessage));
			}
		}
		if ($this->kabupaten_id->MultiUpdate != "") {
			if (!CheckInteger($this->kabupaten_id->FormValue)) {
				AddMessage($FormError, $this->kabupaten_id->errorMessage());
			}
		}
		if ($this->kecamatan_id->Required) {
			if ($this->kecamatan_id->MultiUpdate != "" && !$this->kecamatan_id->IsDetailKey && $this->kecamatan_id->FormValue != NULL && $this->kecamatan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kecamatan_id->caption(), $this->kecamatan_id->RequiredErrorMessage));
			}
		}
		if ($this->kecamatan_id->MultiUpdate != "") {
			if (!CheckInteger($this->kecamatan_id->FormValue)) {
				AddMessage($FormError, $this->kecamatan_id->errorMessage());
			}
		}
		if ($this->kelurahan_id->Required) {
			if ($this->kelurahan_id->MultiUpdate != "" && !$this->kelurahan_id->IsDetailKey && $this->kelurahan_id->FormValue != NULL && $this->kelurahan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kelurahan_id->caption(), $this->kelurahan_id->RequiredErrorMessage));
			}
		}
		if ($this->kelurahan_id->MultiUpdate != "") {
			if (!CheckInteger($this->kelurahan_id->FormValue)) {
				AddMessage($FormError, $this->kelurahan_id->errorMessage());
			}
		}
		if ($this->rw_id->Required) {
			if ($this->rw_id->MultiUpdate != "" && !$this->rw_id->IsDetailKey && $this->rw_id->FormValue != NULL && $this->rw_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rw_id->caption(), $this->rw_id->RequiredErrorMessage));
			}
		}
		if ($this->rt_id->Required) {
			if ($this->rt_id->MultiUpdate != "" && !$this->rt_id->IsDetailKey && $this->rt_id->FormValue != NULL && $this->rt_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rt_id->caption(), $this->rt_id->RequiredErrorMessage));
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// provinsi_id
			$this->provinsi_id->setDbValueDef($rsnew, $this->provinsi_id->CurrentValue, 0, $this->provinsi_id->ReadOnly || $this->provinsi_id->MultiUpdate != "1");

			// kabupaten_id
			$this->kabupaten_id->setDbValueDef($rsnew, $this->kabupaten_id->CurrentValue, 0, $this->kabupaten_id->ReadOnly || $this->kabupaten_id->MultiUpdate != "1");

			// kecamatan_id
			$this->kecamatan_id->setDbValueDef($rsnew, $this->kecamatan_id->CurrentValue, 0, $this->kecamatan_id->ReadOnly || $this->kecamatan_id->MultiUpdate != "1");

			// kelurahan_id
			$this->kelurahan_id->setDbValueDef($rsnew, $this->kelurahan_id->CurrentValue, 0, $this->kelurahan_id->ReadOnly || $this->kelurahan_id->MultiUpdate != "1");

			// rw_id
			$this->rw_id->setDbValueDef($rsnew, $this->rw_id->CurrentValue, 0, $this->rw_id->ReadOnly || $this->rw_id->MultiUpdate != "1");

			// rt_id
			$this->rt_id->setDbValueDef($rsnew, $this->rt_id->CurrentValue, 0, $this->rt_id->ReadOnly || $this->rt_id->MultiUpdate != "1");

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("master_alamatlist.php"), "", $this->TableVar, TRUE);
		$pageId = "update";
		$Breadcrumb->add("update", $pageId, $url);
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
} // End class
?>