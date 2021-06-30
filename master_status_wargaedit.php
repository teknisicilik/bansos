<?php
namespace PHPMaker2020\bansos;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$master_status_warga_edit = new master_status_warga_edit();

// Run the page
$master_status_warga_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_status_warga_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_status_wargaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmaster_status_wargaedit = currentForm = new ew.Form("fmaster_status_wargaedit", "edit");

	// Validate form
	fmaster_status_wargaedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($master_status_warga_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_status_warga_edit->nama->caption(), $master_status_warga_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_status_warga_edit->na->Required) { ?>
				elm = this.getElements("x" + infix + "_na");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_status_warga_edit->na->caption(), $master_status_warga_edit->na->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fmaster_status_wargaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_status_wargaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_status_wargaedit.lists["x_na"] = <?php echo $master_status_warga_edit->na->Lookup->toClientList($master_status_warga_edit) ?>;
	fmaster_status_wargaedit.lists["x_na"].options = <?php echo JsonEncode($master_status_warga_edit->na->options(FALSE, TRUE)) ?>;
	loadjs.done("fmaster_status_wargaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_status_warga_edit->showPageHeader(); ?>
<?php
$master_status_warga_edit->showMessage();
?>
<form name="fmaster_status_wargaedit" id="fmaster_status_wargaedit" class="<?php echo $master_status_warga_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_status_warga">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$master_status_warga_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($master_status_warga_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_master_status_warga_nama" for="x_nama" class="<?php echo $master_status_warga_edit->LeftColumnClass ?>"><?php echo $master_status_warga_edit->nama->caption() ?><?php echo $master_status_warga_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_status_warga_edit->RightColumnClass ?>"><div <?php echo $master_status_warga_edit->nama->cellAttributes() ?>>
<span id="el_master_status_warga_nama">
<input type="text" data-table="master_status_warga" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_status_warga_edit->nama->getPlaceHolder()) ?>" value="<?php echo $master_status_warga_edit->nama->EditValue ?>"<?php echo $master_status_warga_edit->nama->editAttributes() ?>>
</span>
<?php echo $master_status_warga_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_status_warga_edit->na->Visible) { // na ?>
	<div id="r_na" class="form-group row">
		<label id="elh_master_status_warga_na" class="<?php echo $master_status_warga_edit->LeftColumnClass ?>"><?php echo $master_status_warga_edit->na->caption() ?><?php echo $master_status_warga_edit->na->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_status_warga_edit->RightColumnClass ?>"><div <?php echo $master_status_warga_edit->na->cellAttributes() ?>>
<span id="el_master_status_warga_na">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_status_warga" data-field="x_na" data-value-separator="<?php echo $master_status_warga_edit->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $master_status_warga_edit->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_status_warga_edit->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
<?php echo $master_status_warga_edit->na->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="master_status_warga" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($master_status_warga_edit->id->CurrentValue) ?>">
<?php if (!$master_status_warga_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $master_status_warga_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_status_warga_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$master_status_warga_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$master_status_warga_edit->terminate();
?>