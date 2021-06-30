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
$master_warga_add = new master_warga_add();

// Run the page
$master_warga_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_warga_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_wargaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmaster_wargaadd = currentForm = new ew.Form("fmaster_wargaadd", "add");

	// Validate form
	fmaster_wargaadd.validate = function() {
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
			<?php if ($master_warga_add->kk->Required) { ?>
				elm = this.getElements("x" + infix + "_kk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->kk->caption(), $master_warga_add->kk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kk");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->kk->errorMessage()) ?>");
			<?php if ($master_warga_add->nik->Required) { ?>
				elm = this.getElements("x" + infix + "_nik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->nik->caption(), $master_warga_add->nik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->nik->errorMessage()) ?>");
			<?php if ($master_warga_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->nama->caption(), $master_warga_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_warga_add->provinsi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->provinsi_id->caption(), $master_warga_add->provinsi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->provinsi_id->errorMessage()) ?>");
			<?php if ($master_warga_add->kabupaten_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->kabupaten_id->caption(), $master_warga_add->kabupaten_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->kabupaten_id->errorMessage()) ?>");
			<?php if ($master_warga_add->kecamatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->kecamatan_id->caption(), $master_warga_add->kecamatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->kecamatan_id->errorMessage()) ?>");
			<?php if ($master_warga_add->kelurahan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->kelurahan_id->caption(), $master_warga_add->kelurahan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->kelurahan_id->errorMessage()) ?>");
			<?php if ($master_warga_add->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->rw_id->caption(), $master_warga_add->rw_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->rw_id->errorMessage()) ?>");
			<?php if ($master_warga_add->rt_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rt_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->rt_id->caption(), $master_warga_add->rt_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rt_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->rt_id->errorMessage()) ?>");
			<?php if ($master_warga_add->alamat_id->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->alamat_id->caption(), $master_warga_add->alamat_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_alamat_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_warga_add->alamat_id->errorMessage()) ?>");
			<?php if ($master_warga_add->nomor_rumah->Required) { ?>
				elm = this.getElements("x" + infix + "_nomor_rumah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->nomor_rumah->caption(), $master_warga_add->nomor_rumah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_warga_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->keterangan->caption(), $master_warga_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_warga_add->status_warga_id->Required) { ?>
				elm = this.getElements("x" + infix + "_status_warga_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_warga_add->status_warga_id->caption(), $master_warga_add->status_warga_id->RequiredErrorMessage)) ?>");
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
	fmaster_wargaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_wargaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_wargaadd.lists["x_provinsi_id"] = <?php echo $master_warga_add->provinsi_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_provinsi_id"].options = <?php echo JsonEncode($master_warga_add->provinsi_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_provinsi_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_kabupaten_id"] = <?php echo $master_warga_add->kabupaten_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_kabupaten_id"].options = <?php echo JsonEncode($master_warga_add->kabupaten_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_kabupaten_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_kecamatan_id"] = <?php echo $master_warga_add->kecamatan_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_kecamatan_id"].options = <?php echo JsonEncode($master_warga_add->kecamatan_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_kelurahan_id"] = <?php echo $master_warga_add->kelurahan_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_kelurahan_id"].options = <?php echo JsonEncode($master_warga_add->kelurahan_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_rw_id"] = <?php echo $master_warga_add->rw_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_rw_id"].options = <?php echo JsonEncode($master_warga_add->rw_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_rw_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_rt_id"] = <?php echo $master_warga_add->rt_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_rt_id"].options = <?php echo JsonEncode($master_warga_add->rt_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_rt_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_alamat_id"] = <?php echo $master_warga_add->alamat_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_alamat_id"].options = <?php echo JsonEncode($master_warga_add->alamat_id->lookupOptions()) ?>;
	fmaster_wargaadd.autoSuggests["x_alamat_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargaadd.lists["x_status_warga_id"] = <?php echo $master_warga_add->status_warga_id->Lookup->toClientList($master_warga_add) ?>;
	fmaster_wargaadd.lists["x_status_warga_id"].options = <?php echo JsonEncode($master_warga_add->status_warga_id->lookupOptions()) ?>;
	loadjs.done("fmaster_wargaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_warga_add->showPageHeader(); ?>
<?php
$master_warga_add->showMessage();
?>
<form name="fmaster_wargaadd" id="fmaster_wargaadd" class="<?php echo $master_warga_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_warga">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$master_warga_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($master_warga_add->kk->Visible) { // kk ?>
	<div id="r_kk" class="form-group row">
		<label id="elh_master_warga_kk" for="x_kk" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->kk->caption() ?><?php echo $master_warga_add->kk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->kk->cellAttributes() ?>>
<span id="el_master_warga_kk">
<input type="text" data-table="master_warga" data-field="x_kk" name="x_kk" id="x_kk" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_warga_add->kk->getPlaceHolder()) ?>" value="<?php echo $master_warga_add->kk->EditValue ?>"<?php echo $master_warga_add->kk->editAttributes() ?>>
</span>
<?php echo $master_warga_add->kk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->nik->Visible) { // nik ?>
	<div id="r_nik" class="form-group row">
		<label id="elh_master_warga_nik" for="x_nik" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->nik->caption() ?><?php echo $master_warga_add->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->nik->cellAttributes() ?>>
<span id="el_master_warga_nik">
<input type="text" data-table="master_warga" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($master_warga_add->nik->getPlaceHolder()) ?>" value="<?php echo $master_warga_add->nik->EditValue ?>"<?php echo $master_warga_add->nik->editAttributes() ?>>
</span>
<?php echo $master_warga_add->nik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_master_warga_nama" for="x_nama" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->nama->caption() ?><?php echo $master_warga_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->nama->cellAttributes() ?>>
<span id="el_master_warga_nama">
<input type="text" data-table="master_warga" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_warga_add->nama->getPlaceHolder()) ?>" value="<?php echo $master_warga_add->nama->EditValue ?>"<?php echo $master_warga_add->nama->editAttributes() ?>>
</span>
<?php echo $master_warga_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->provinsi_id->Visible) { // provinsi_id ?>
	<div id="r_provinsi_id" class="form-group row">
		<label id="elh_master_warga_provinsi_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->provinsi_id->caption() ?><?php echo $master_warga_add->provinsi_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->provinsi_id->cellAttributes() ?>>
<span id="el_master_warga_provinsi_id">
<?php
$onchange = $master_warga_add->provinsi_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->provinsi_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_provinsi_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_provinsi_id" id="sv_x_provinsi_id" value="<?php echo RemoveHtml($master_warga_add->provinsi_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->provinsi_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->provinsi_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->provinsi_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_add->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_provinsi_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_add->provinsi_id->ReadOnly || $master_warga_add->provinsi_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_add->provinsi_id->displayValueSeparatorAttribute() ?>" name="x_provinsi_id" id="x_provinsi_id" value="<?php echo HtmlEncode($master_warga_add->provinsi_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_provinsi_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->provinsi_id->Lookup->getParamTag($master_warga_add, "p_x_provinsi_id") ?>
</span>
<?php echo $master_warga_add->provinsi_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->kabupaten_id->Visible) { // kabupaten_id ?>
	<div id="r_kabupaten_id" class="form-group row">
		<label id="elh_master_warga_kabupaten_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->kabupaten_id->caption() ?><?php echo $master_warga_add->kabupaten_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->kabupaten_id->cellAttributes() ?>>
<span id="el_master_warga_kabupaten_id">
<?php
$onchange = $master_warga_add->kabupaten_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->kabupaten_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kabupaten_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kabupaten_id" id="sv_x_kabupaten_id" value="<?php echo RemoveHtml($master_warga_add->kabupaten_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->kabupaten_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->kabupaten_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->kabupaten_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_add->kabupaten_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kabupaten_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_add->kabupaten_id->ReadOnly || $master_warga_add->kabupaten_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_kabupaten_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_add->kabupaten_id->displayValueSeparatorAttribute() ?>" name="x_kabupaten_id" id="x_kabupaten_id" value="<?php echo HtmlEncode($master_warga_add->kabupaten_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_kabupaten_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->kabupaten_id->Lookup->getParamTag($master_warga_add, "p_x_kabupaten_id") ?>
</span>
<?php echo $master_warga_add->kabupaten_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->kecamatan_id->Visible) { // kecamatan_id ?>
	<div id="r_kecamatan_id" class="form-group row">
		<label id="elh_master_warga_kecamatan_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->kecamatan_id->caption() ?><?php echo $master_warga_add->kecamatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->kecamatan_id->cellAttributes() ?>>
<span id="el_master_warga_kecamatan_id">
<?php
$onchange = $master_warga_add->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($master_warga_add->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_add->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_add->kecamatan_id->ReadOnly || $master_warga_add->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_add->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($master_warga_add->kecamatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->kecamatan_id->Lookup->getParamTag($master_warga_add, "p_x_kecamatan_id") ?>
</span>
<?php echo $master_warga_add->kecamatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->kelurahan_id->Visible) { // kelurahan_id ?>
	<div id="r_kelurahan_id" class="form-group row">
		<label id="elh_master_warga_kelurahan_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->kelurahan_id->caption() ?><?php echo $master_warga_add->kelurahan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->kelurahan_id->cellAttributes() ?>>
<span id="el_master_warga_kelurahan_id">
<?php
$onchange = $master_warga_add->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($master_warga_add->kelurahan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_add->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_add->kelurahan_id->ReadOnly || $master_warga_add->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_add->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($master_warga_add->kelurahan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->kelurahan_id->Lookup->getParamTag($master_warga_add, "p_x_kelurahan_id") ?>
</span>
<?php echo $master_warga_add->kelurahan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->rw_id->Visible) { // rw_id ?>
	<div id="r_rw_id" class="form-group row">
		<label id="elh_master_warga_rw_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->rw_id->caption() ?><?php echo $master_warga_add->rw_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->rw_id->cellAttributes() ?>>
<span id="el_master_warga_rw_id">
<?php
$onchange = $master_warga_add->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->rw_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rw_id">
	<input type="text" class="form-control" name="sv_x_rw_id" id="sv_x_rw_id" value="<?php echo RemoveHtml($master_warga_add->rw_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->rw_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->rw_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->rw_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_warga" data-field="x_rw_id" data-value-separator="<?php echo $master_warga_add->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo HtmlEncode($master_warga_add->rw_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_rw_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->rw_id->Lookup->getParamTag($master_warga_add, "p_x_rw_id") ?>
</span>
<?php echo $master_warga_add->rw_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->rt_id->Visible) { // rt_id ?>
	<div id="r_rt_id" class="form-group row">
		<label id="elh_master_warga_rt_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->rt_id->caption() ?><?php echo $master_warga_add->rt_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->rt_id->cellAttributes() ?>>
<span id="el_master_warga_rt_id">
<?php
$onchange = $master_warga_add->rt_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->rt_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rt_id">
	<input type="text" class="form-control" name="sv_x_rt_id" id="sv_x_rt_id" value="<?php echo RemoveHtml($master_warga_add->rt_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->rt_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->rt_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->rt_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_warga" data-field="x_rt_id" data-value-separator="<?php echo $master_warga_add->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="<?php echo HtmlEncode($master_warga_add->rt_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_rt_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->rt_id->Lookup->getParamTag($master_warga_add, "p_x_rt_id") ?>
</span>
<?php echo $master_warga_add->rt_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->alamat_id->Visible) { // alamat_id ?>
	<div id="r_alamat_id" class="form-group row">
		<label id="elh_master_warga_alamat_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->alamat_id->caption() ?><?php echo $master_warga_add->alamat_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->alamat_id->cellAttributes() ?>>
<span id="el_master_warga_alamat_id">
<?php
$onchange = $master_warga_add->alamat_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_add->alamat_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_alamat_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_alamat_id" id="sv_x_alamat_id" value="<?php echo RemoveHtml($master_warga_add->alamat_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_add->alamat_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_add->alamat_id->getPlaceHolder()) ?>"<?php echo $master_warga_add->alamat_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_add->alamat_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_alamat_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_add->alamat_id->ReadOnly || $master_warga_add->alamat_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_alamat_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_add->alamat_id->displayValueSeparatorAttribute() ?>" name="x_alamat_id" id="x_alamat_id" value="<?php echo HtmlEncode($master_warga_add->alamat_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargaadd"], function() {
	fmaster_wargaadd.createAutoSuggest({"id":"x_alamat_id","forceSelect":true});
});
</script>
<?php echo $master_warga_add->alamat_id->Lookup->getParamTag($master_warga_add, "p_x_alamat_id") ?>
</span>
<?php echo $master_warga_add->alamat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->nomor_rumah->Visible) { // nomor_rumah ?>
	<div id="r_nomor_rumah" class="form-group row">
		<label id="elh_master_warga_nomor_rumah" for="x_nomor_rumah" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->nomor_rumah->caption() ?><?php echo $master_warga_add->nomor_rumah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->nomor_rumah->cellAttributes() ?>>
<span id="el_master_warga_nomor_rumah">
<input type="text" data-table="master_warga" data-field="x_nomor_rumah" name="x_nomor_rumah" id="x_nomor_rumah" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($master_warga_add->nomor_rumah->getPlaceHolder()) ?>" value="<?php echo $master_warga_add->nomor_rumah->EditValue ?>"<?php echo $master_warga_add->nomor_rumah->editAttributes() ?>>
</span>
<?php echo $master_warga_add->nomor_rumah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_master_warga_keterangan" for="x_keterangan" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->keterangan->caption() ?><?php echo $master_warga_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->keterangan->cellAttributes() ?>>
<span id="el_master_warga_keterangan">
<textarea data-table="master_warga" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($master_warga_add->keterangan->getPlaceHolder()) ?>"<?php echo $master_warga_add->keterangan->editAttributes() ?>><?php echo $master_warga_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $master_warga_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_warga_add->status_warga_id->Visible) { // status_warga_id ?>
	<div id="r_status_warga_id" class="form-group row">
		<label id="elh_master_warga_status_warga_id" for="x_status_warga_id" class="<?php echo $master_warga_add->LeftColumnClass ?>"><?php echo $master_warga_add->status_warga_id->caption() ?><?php echo $master_warga_add->status_warga_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_warga_add->RightColumnClass ?>"><div <?php echo $master_warga_add->status_warga_id->cellAttributes() ?>>
<span id="el_master_warga_status_warga_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($master_warga_add->status_warga_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $master_warga_add->status_warga_id->ViewValue ?></button>
		<div id="dsl_x_status_warga_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $master_warga_add->status_warga_id->radioButtonListHtml(TRUE, "x_status_warga_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status_warga_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_warga" data-field="x_status_warga_id" data-value-separator="<?php echo $master_warga_add->status_warga_id->displayValueSeparatorAttribute() ?>" name="x_status_warga_id" id="x_status_warga_id" value="{value}"<?php echo $master_warga_add->status_warga_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$master_warga_add->status_warga_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $master_warga_add->status_warga_id->Lookup->getParamTag($master_warga_add, "p_x_status_warga_id") ?>
</span>
<?php echo $master_warga_add->status_warga_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$master_warga_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $master_warga_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_warga_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$master_warga_add->showPageFooter();
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
$master_warga_add->terminate();
?>