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
$rt_edit = new rt_edit();

// Run the page
$rt_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frtedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	frtedit = currentForm = new ew.Form("frtedit", "edit");

	// Validate form
	frtedit.validate = function() {
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
			<?php if ($rt_edit->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_edit->rw_id->caption(), $rt_edit->rw_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rt_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_edit->nama->caption(), $rt_edit->nama->RequiredErrorMessage)) ?>");
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
	frtedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frtedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frtedit.lists["x_rw_id"] = <?php echo $rt_edit->rw_id->Lookup->toClientList($rt_edit) ?>;
	frtedit.lists["x_rw_id"].options = <?php echo JsonEncode($rt_edit->rw_id->lookupOptions()) ?>;
	loadjs.done("frtedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rt_edit->showPageHeader(); ?>
<?php
$rt_edit->showMessage();
?>
<form name="frtedit" id="frtedit" class="<?php echo $rt_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rt">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$rt_edit->IsModal ?>">
<?php if ($rt->getCurrentMasterTable() == "rw") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rw">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($rt_edit->rw_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($rt_edit->rw_id->Visible) { // rw_id ?>
	<div id="r_rw_id" class="form-group row">
		<label id="elh_rt_rw_id" for="x_rw_id" class="<?php echo $rt_edit->LeftColumnClass ?>"><?php echo $rt_edit->rw_id->caption() ?><?php echo $rt_edit->rw_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rt_edit->RightColumnClass ?>"><div <?php echo $rt_edit->rw_id->cellAttributes() ?>>
<?php if ($rt_edit->rw_id->getSessionValue() != "") { ?>
<span id="el_rt_rw_id">
<span<?php echo $rt_edit->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_edit->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_rw_id" name="x_rw_id" value="<?php echo HtmlEncode($rt_edit->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_rt_rw_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rw_id"><?php echo EmptyValue(strval($rt_edit->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_edit->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_edit->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_edit->rw_id->ReadOnly || $rt_edit->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_edit->rw_id->Lookup->getParamTag($rt_edit, "p_x_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_edit->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo $rt_edit->rw_id->CurrentValue ?>"<?php echo $rt_edit->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $rt_edit->rw_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rt_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_rt_nama" for="x_nama" class="<?php echo $rt_edit->LeftColumnClass ?>"><?php echo $rt_edit->nama->caption() ?><?php echo $rt_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rt_edit->RightColumnClass ?>"><div <?php echo $rt_edit->nama->cellAttributes() ?>>
<span id="el_rt_nama">
<input type="text" data-table="rt" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_edit->nama->getPlaceHolder()) ?>" value="<?php echo $rt_edit->nama->EditValue ?>"<?php echo $rt_edit->nama->editAttributes() ?>>
</span>
<?php echo $rt_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="rt" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($rt_edit->id->CurrentValue) ?>">
<?php if (!$rt_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rt_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rt_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rt_edit->showPageFooter();
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
$rt_edit->terminate();
?>