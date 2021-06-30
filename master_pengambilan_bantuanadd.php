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
$master_pengambilan_bantuan_add = new master_pengambilan_bantuan_add();

// Run the page
$master_pengambilan_bantuan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_pengambilan_bantuan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_pengambilan_bantuanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmaster_pengambilan_bantuanadd = currentForm = new ew.Form("fmaster_pengambilan_bantuanadd", "add");

	// Validate form
	fmaster_pengambilan_bantuanadd.validate = function() {
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
			<?php if ($master_pengambilan_bantuan_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_pengambilan_bantuan_add->nama->caption(), $master_pengambilan_bantuan_add->nama->RequiredErrorMessage)) ?>");
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
	fmaster_pengambilan_bantuanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_pengambilan_bantuanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmaster_pengambilan_bantuanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_pengambilan_bantuan_add->showPageHeader(); ?>
<?php
$master_pengambilan_bantuan_add->showMessage();
?>
<form name="fmaster_pengambilan_bantuanadd" id="fmaster_pengambilan_bantuanadd" class="<?php echo $master_pengambilan_bantuan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_pengambilan_bantuan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$master_pengambilan_bantuan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($master_pengambilan_bantuan_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_master_pengambilan_bantuan_nama" for="x_nama" class="<?php echo $master_pengambilan_bantuan_add->LeftColumnClass ?>"><?php echo $master_pengambilan_bantuan_add->nama->caption() ?><?php echo $master_pengambilan_bantuan_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_pengambilan_bantuan_add->RightColumnClass ?>"><div <?php echo $master_pengambilan_bantuan_add->nama->cellAttributes() ?>>
<span id="el_master_pengambilan_bantuan_nama">
<input type="text" data-table="master_pengambilan_bantuan" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_pengambilan_bantuan_add->nama->getPlaceHolder()) ?>" value="<?php echo $master_pengambilan_bantuan_add->nama->EditValue ?>"<?php echo $master_pengambilan_bantuan_add->nama->editAttributes() ?>>
</span>
<?php echo $master_pengambilan_bantuan_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$master_pengambilan_bantuan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $master_pengambilan_bantuan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_pengambilan_bantuan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$master_pengambilan_bantuan_add->showPageFooter();
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
$master_pengambilan_bantuan_add->terminate();
?>