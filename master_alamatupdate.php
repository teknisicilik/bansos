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
$master_alamat_update = new master_alamat_update();

// Run the page
$master_alamat_update->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_alamat_update->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_alamatupdate, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "update";
	fmaster_alamatupdate = currentForm = new ew.Form("fmaster_alamatupdate", "update");

	// Validate form
	fmaster_alamatupdate.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		if (!ew.updateSelected(fobj)) {
			ew.alert(ew.language.phrase("NoFieldSelected"));
			return false;
		}
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($master_alamat_update->provinsi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				uelm = this.getElements("u" + infix + "_provinsi_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->provinsi_id->caption(), $master_alamat_update->provinsi_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				uelm = this.getElements("u" + infix + "_provinsi_id");
				if (uelm && uelm.checked && elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_update->provinsi_id->errorMessage()) ?>");
			<?php if ($master_alamat_update->kabupaten_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				uelm = this.getElements("u" + infix + "_kabupaten_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->kabupaten_id->caption(), $master_alamat_update->kabupaten_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				uelm = this.getElements("u" + infix + "_kabupaten_id");
				if (uelm && uelm.checked && elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_update->kabupaten_id->errorMessage()) ?>");
			<?php if ($master_alamat_update->kecamatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				uelm = this.getElements("u" + infix + "_kecamatan_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->kecamatan_id->caption(), $master_alamat_update->kecamatan_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				uelm = this.getElements("u" + infix + "_kecamatan_id");
				if (uelm && uelm.checked && elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_update->kecamatan_id->errorMessage()) ?>");
			<?php if ($master_alamat_update->kelurahan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				uelm = this.getElements("u" + infix + "_kelurahan_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->kelurahan_id->caption(), $master_alamat_update->kelurahan_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				uelm = this.getElements("u" + infix + "_kelurahan_id");
				if (uelm && uelm.checked && elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_update->kelurahan_id->errorMessage()) ?>");
			<?php if ($master_alamat_update->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				uelm = this.getElements("u" + infix + "_rw_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->rw_id->caption(), $master_alamat_update->rw_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>
			<?php if ($master_alamat_update->rt_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rt_id");
				uelm = this.getElements("u" + infix + "_rt_id");
				if (uelm && uelm.checked) {
					if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
						return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_update->rt_id->caption(), $master_alamat_update->rt_id->RequiredErrorMessage)) ?>");
				}
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fmaster_alamatupdate.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_alamatupdate.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_alamatupdate.lists["x_provinsi_id"] = <?php echo $master_alamat_update->provinsi_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_provinsi_id"].options = <?php echo JsonEncode($master_alamat_update->provinsi_id->lookupOptions()) ?>;
	fmaster_alamatupdate.autoSuggests["x_provinsi_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatupdate.lists["x_kabupaten_id"] = <?php echo $master_alamat_update->kabupaten_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_kabupaten_id"].options = <?php echo JsonEncode($master_alamat_update->kabupaten_id->lookupOptions()) ?>;
	fmaster_alamatupdate.autoSuggests["x_kabupaten_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatupdate.lists["x_kecamatan_id"] = <?php echo $master_alamat_update->kecamatan_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_kecamatan_id"].options = <?php echo JsonEncode($master_alamat_update->kecamatan_id->lookupOptions()) ?>;
	fmaster_alamatupdate.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatupdate.lists["x_kelurahan_id"] = <?php echo $master_alamat_update->kelurahan_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_kelurahan_id"].options = <?php echo JsonEncode($master_alamat_update->kelurahan_id->lookupOptions()) ?>;
	fmaster_alamatupdate.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatupdate.lists["x_rw_id"] = <?php echo $master_alamat_update->rw_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_rw_id"].options = <?php echo JsonEncode($master_alamat_update->rw_id->lookupOptions()) ?>;
	fmaster_alamatupdate.lists["x_rt_id"] = <?php echo $master_alamat_update->rt_id->Lookup->toClientList($master_alamat_update) ?>;
	fmaster_alamatupdate.lists["x_rt_id"].options = <?php echo JsonEncode($master_alamat_update->rt_id->lookupOptions()) ?>;
	loadjs.done("fmaster_alamatupdate");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_alamat_update->showPageHeader(); ?>
<?php
$master_alamat_update->showMessage();
?>
<form name="fmaster_alamatupdate" id="fmaster_alamatupdate" class="<?php echo $master_alamat_update->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_alamat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$master_alamat_update->IsModal ?>">
<?php foreach ($master_alamat_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_master_alamatupdate" class="ew-update-div"><!-- page -->
	<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="u" id="u" onclick="ew.selectAll(this);"><label class="custom-control-label" for="u"><?php echo $Language->phrase("UpdateSelectAll") ?></label>
	</div>
<?php if ($master_alamat_update->provinsi_id->Visible) { // provinsi_id ?>
	<div id="r_provinsi_id" class="form-group row">
		<label class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_provinsi_id" id="u_provinsi_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->provinsi_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_provinsi_id"><?php echo $master_alamat_update->provinsi_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->provinsi_id->cellAttributes() ?>>
<span id="el_master_alamat_provinsi_id">
<?php
$onchange = $master_alamat_update->provinsi_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_update->provinsi_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_provinsi_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_provinsi_id" id="sv_x_provinsi_id" value="<?php echo RemoveHtml($master_alamat_update->provinsi_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_update->provinsi_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_update->provinsi_id->getPlaceHolder()) ?>"<?php echo $master_alamat_update->provinsi_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_provinsi_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->provinsi_id->ReadOnly || $master_alamat_update->provinsi_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->provinsi_id->displayValueSeparatorAttribute() ?>" name="x_provinsi_id" id="x_provinsi_id" value="<?php echo HtmlEncode($master_alamat_update->provinsi_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatupdate"], function() {
	fmaster_alamatupdate.createAutoSuggest({"id":"x_provinsi_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_update->provinsi_id->Lookup->getParamTag($master_alamat_update, "p_x_provinsi_id") ?>
</span>
<?php echo $master_alamat_update->provinsi_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_alamat_update->kabupaten_id->Visible) { // kabupaten_id ?>
	<div id="r_kabupaten_id" class="form-group row">
		<label class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_kabupaten_id" id="u_kabupaten_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->kabupaten_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_kabupaten_id"><?php echo $master_alamat_update->kabupaten_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->kabupaten_id->cellAttributes() ?>>
<span id="el_master_alamat_kabupaten_id">
<?php
$onchange = $master_alamat_update->kabupaten_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_update->kabupaten_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kabupaten_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kabupaten_id" id="sv_x_kabupaten_id" value="<?php echo RemoveHtml($master_alamat_update->kabupaten_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_update->kabupaten_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_update->kabupaten_id->getPlaceHolder()) ?>"<?php echo $master_alamat_update->kabupaten_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->kabupaten_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kabupaten_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->kabupaten_id->ReadOnly || $master_alamat_update->kabupaten_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->kabupaten_id->displayValueSeparatorAttribute() ?>" name="x_kabupaten_id" id="x_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_update->kabupaten_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatupdate"], function() {
	fmaster_alamatupdate.createAutoSuggest({"id":"x_kabupaten_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_update->kabupaten_id->Lookup->getParamTag($master_alamat_update, "p_x_kabupaten_id") ?>
</span>
<?php echo $master_alamat_update->kabupaten_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_alamat_update->kecamatan_id->Visible) { // kecamatan_id ?>
	<div id="r_kecamatan_id" class="form-group row">
		<label class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_kecamatan_id" id="u_kecamatan_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->kecamatan_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_kecamatan_id"><?php echo $master_alamat_update->kecamatan_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->kecamatan_id->cellAttributes() ?>>
<span id="el_master_alamat_kecamatan_id">
<?php
$onchange = $master_alamat_update->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_update->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($master_alamat_update->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_update->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_update->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_update->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->kecamatan_id->ReadOnly || $master_alamat_update->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_update->kecamatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatupdate"], function() {
	fmaster_alamatupdate.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_update->kecamatan_id->Lookup->getParamTag($master_alamat_update, "p_x_kecamatan_id") ?>
</span>
<?php echo $master_alamat_update->kecamatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_alamat_update->kelurahan_id->Visible) { // kelurahan_id ?>
	<div id="r_kelurahan_id" class="form-group row">
		<label class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_kelurahan_id" id="u_kelurahan_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->kelurahan_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_kelurahan_id"><?php echo $master_alamat_update->kelurahan_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->kelurahan_id->cellAttributes() ?>>
<span id="el_master_alamat_kelurahan_id">
<?php
$onchange = $master_alamat_update->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_update->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($master_alamat_update->kelurahan_id->EditValue) ?>" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($master_alamat_update->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_update->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_update->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->kelurahan_id->ReadOnly || $master_alamat_update->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_update->kelurahan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatupdate"], function() {
	fmaster_alamatupdate.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_update->kelurahan_id->Lookup->getParamTag($master_alamat_update, "p_x_kelurahan_id") ?>
</span>
<?php echo $master_alamat_update->kelurahan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_alamat_update->rw_id->Visible) { // rw_id ?>
	<div id="r_rw_id" class="form-group row">
		<label for="x_rw_id" class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_rw_id" id="u_rw_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->rw_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_rw_id"><?php echo $master_alamat_update->rw_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->rw_id->cellAttributes() ?>>
<span id="el_master_alamat_rw_id">
<?php $master_alamat_update->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rw_id"><?php echo EmptyValue(strval($master_alamat_update->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_update->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->rw_id->ReadOnly || $master_alamat_update->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_update->rw_id->Lookup->getParamTag($master_alamat_update, "p_x_rw_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo $master_alamat_update->rw_id->CurrentValue ?>"<?php echo $master_alamat_update->rw_id->editAttributes() ?>>
</span>
<?php echo $master_alamat_update->rw_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_alamat_update->rt_id->Visible) { // rt_id ?>
	<div id="r_rt_id" class="form-group row">
		<label for="x_rt_id" class="<?php echo $master_alamat_update->LeftColumnClass ?>"><div class="custom-control custom-checkbox">
<input type="checkbox" name="u_rt_id" id="u_rt_id" class="custom-control-input ew-multi-select" value="1"<?php echo $master_alamat_update->rt_id->MultiUpdate == "1" ? " checked" : "" ?>>
<label class="custom-control-label" for="u_rt_id"><?php echo $master_alamat_update->rt_id->caption() ?></label></div></label>
		<div class="<?php echo $master_alamat_update->RightColumnClass ?>"><div <?php echo $master_alamat_update->rt_id->cellAttributes() ?>>
<span id="el_master_alamat_rt_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rt_id"><?php echo EmptyValue(strval($master_alamat_update->rt_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_update->rt_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_update->rt_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_update->rt_id->ReadOnly || $master_alamat_update->rt_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rt_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_update->rt_id->Lookup->getParamTag($master_alamat_update, "p_x_rt_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_update->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="<?php echo $master_alamat_update->rt_id->CurrentValue ?>"<?php echo $master_alamat_update->rt_id->editAttributes() ?>>
</span>
<?php echo $master_alamat_update->rt_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page -->
<?php if (!$master_alamat_update->IsModal) { ?>
	<div class="form-group row"><!-- buttons .form-group -->
		<div class="<?php echo $master_alamat_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_alamat_update->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$master_alamat_update->showPageFooter();
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
$master_alamat_update->terminate();
?>