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
$bantuan_add = new bantuan_add();

// Run the page
$bantuan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbantuanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbantuanadd = currentForm = new ew.Form("fbantuanadd", "add");

	// Validate form
	fbantuanadd.validate = function() {
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
			<?php if ($bantuan_add->bansos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_bansos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_add->bansos_id->caption(), $bantuan_add->bansos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bantuan_add->warga_id->Required) { ?>
				elm = this.getElements("x" + infix + "_warga_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_add->warga_id->caption(), $bantuan_add->warga_id->RequiredErrorMessage)) ?>");
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
	fbantuanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbantuanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbantuanadd.lists["x_bansos_id"] = <?php echo $bantuan_add->bansos_id->Lookup->toClientList($bantuan_add) ?>;
	fbantuanadd.lists["x_bansos_id"].options = <?php echo JsonEncode($bantuan_add->bansos_id->lookupOptions()) ?>;
	fbantuanadd.lists["x_warga_id"] = <?php echo $bantuan_add->warga_id->Lookup->toClientList($bantuan_add) ?>;
	fbantuanadd.lists["x_warga_id"].options = <?php echo JsonEncode($bantuan_add->warga_id->lookupOptions()) ?>;
	loadjs.done("fbantuanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bantuan_add->showPageHeader(); ?>
<?php
$bantuan_add->showMessage();
?>
<form name="fbantuanadd" id="fbantuanadd" class="<?php echo $bantuan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bantuan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bantuan_add->IsModal ?>">
<?php if ($bantuan->getCurrentMasterTable() == "master_bantuan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="master_bantuan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($bantuan_add->bansos_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($bantuan_add->bansos_id->Visible) { // bansos_id ?>
	<div id="r_bansos_id" class="form-group row">
		<label id="elh_bantuan_bansos_id" for="x_bansos_id" class="<?php echo $bantuan_add->LeftColumnClass ?>"><?php echo $bantuan_add->bansos_id->caption() ?><?php echo $bantuan_add->bansos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bantuan_add->RightColumnClass ?>"><div <?php echo $bantuan_add->bansos_id->cellAttributes() ?>>
<?php if ($bantuan_add->bansos_id->getSessionValue() != "") { ?>
<span id="el_bantuan_bansos_id">
<span<?php echo $bantuan_add->bansos_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_add->bansos_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bansos_id" name="x_bansos_id" value="<?php echo HtmlEncode($bantuan_add->bansos_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bantuan_bansos_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bansos_id"><?php echo EmptyValue(strval($bantuan_add->bansos_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_add->bansos_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_add->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_add->bansos_id->ReadOnly || $bantuan_add->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_add->bansos_id->Lookup->getParamTag($bantuan_add, "p_x_bansos_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_add->bansos_id->displayValueSeparatorAttribute() ?>" name="x_bansos_id" id="x_bansos_id" value="<?php echo $bantuan_add->bansos_id->CurrentValue ?>"<?php echo $bantuan_add->bansos_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $bantuan_add->bansos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bantuan_add->warga_id->Visible) { // warga_id ?>
	<div id="r_warga_id" class="form-group row">
		<label id="elh_bantuan_warga_id" for="x_warga_id" class="<?php echo $bantuan_add->LeftColumnClass ?>"><?php echo $bantuan_add->warga_id->caption() ?><?php echo $bantuan_add->warga_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bantuan_add->RightColumnClass ?>"><div <?php echo $bantuan_add->warga_id->cellAttributes() ?>>
<span id="el_bantuan_warga_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_warga_id"><?php echo EmptyValue(strval($bantuan_add->warga_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_add->warga_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_add->warga_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_add->warga_id->ReadOnly || $bantuan_add->warga_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_warga_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_add->warga_id->Lookup->getParamTag($bantuan_add, "p_x_warga_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_add->warga_id->displayValueSeparatorAttribute() ?>" name="x_warga_id" id="x_warga_id" value="<?php echo $bantuan_add->warga_id->CurrentValue ?>"<?php echo $bantuan_add->warga_id->editAttributes() ?>>
</span>
<?php echo $bantuan_add->warga_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bantuan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bantuan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bantuan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bantuan_add->showPageFooter();
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
$bantuan_add->terminate();
?>