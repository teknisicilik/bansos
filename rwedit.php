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
$rw_edit = new rw_edit();

// Run the page
$rw_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frwedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	frwedit = currentForm = new ew.Form("frwedit", "edit");

	// Validate form
	frwedit.validate = function() {
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
			<?php if ($rw_edit->desa_id->Required) { ?>
				elm = this.getElements("x" + infix + "_desa_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_edit->desa_id->caption(), $rw_edit->desa_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rw_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_edit->nama->caption(), $rw_edit->nama->RequiredErrorMessage)) ?>");
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
	frwedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frwedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frwedit.lists["x_desa_id"] = <?php echo $rw_edit->desa_id->Lookup->toClientList($rw_edit) ?>;
	frwedit.lists["x_desa_id"].options = <?php echo JsonEncode($rw_edit->desa_id->lookupOptions()) ?>;
	loadjs.done("frwedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rw_edit->showPageHeader(); ?>
<?php
$rw_edit->showMessage();
?>
<form name="frwedit" id="frwedit" class="<?php echo $rw_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rw">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$rw_edit->IsModal ?>">
<?php if ($rw->getCurrentMasterTable() == "desa") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="desa">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($rw_edit->desa_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($rw_edit->desa_id->Visible) { // desa_id ?>
	<div id="r_desa_id" class="form-group row">
		<label id="elh_rw_desa_id" for="x_desa_id" class="<?php echo $rw_edit->LeftColumnClass ?>"><?php echo $rw_edit->desa_id->caption() ?><?php echo $rw_edit->desa_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rw_edit->RightColumnClass ?>"><div <?php echo $rw_edit->desa_id->cellAttributes() ?>>
<?php if ($rw_edit->desa_id->getSessionValue() != "") { ?>
<span id="el_rw_desa_id">
<span<?php echo $rw_edit->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_edit->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_desa_id" name="x_desa_id" value="<?php echo HtmlEncode($rw_edit->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_rw_desa_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_desa_id"><?php echo EmptyValue(strval($rw_edit->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_edit->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_edit->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_edit->desa_id->ReadOnly || $rw_edit->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_edit->desa_id->Lookup->getParamTag($rw_edit, "p_x_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_edit->desa_id->displayValueSeparatorAttribute() ?>" name="x_desa_id" id="x_desa_id" value="<?php echo $rw_edit->desa_id->CurrentValue ?>"<?php echo $rw_edit->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $rw_edit->desa_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rw_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_rw_nama" for="x_nama" class="<?php echo $rw_edit->LeftColumnClass ?>"><?php echo $rw_edit->nama->caption() ?><?php echo $rw_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rw_edit->RightColumnClass ?>"><div <?php echo $rw_edit->nama->cellAttributes() ?>>
<span id="el_rw_nama">
<input type="text" data-table="rw" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_edit->nama->getPlaceHolder()) ?>" value="<?php echo $rw_edit->nama->EditValue ?>"<?php echo $rw_edit->nama->editAttributes() ?>>
</span>
<?php echo $rw_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="rw" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($rw_edit->id->CurrentValue) ?>">
<?php
	if (in_array("rt", explode(",", $rw->getCurrentDetailTable())) && $rt->DetailEdit) {
?>
<?php if ($rw->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("rt", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rtgrid.php" ?>
<?php } ?>
<?php if (!$rw_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rw_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rw_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rw_edit->showPageFooter();
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
$rw_edit->terminate();
?>