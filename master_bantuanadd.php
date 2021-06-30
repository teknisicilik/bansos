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
$master_bantuan_add = new master_bantuan_add();

// Run the page
$master_bantuan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_bantuan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_bantuanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmaster_bantuanadd = currentForm = new ew.Form("fmaster_bantuanadd", "add");

	// Validate form
	fmaster_bantuanadd.validate = function() {
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
			<?php if ($master_bantuan_add->jenis_bantuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_bantuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->jenis_bantuan_id->caption(), $master_bantuan_add->jenis_bantuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->nama->caption(), $master_bantuan_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->type->caption(), $master_bantuan_add->type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->jumlah->caption(), $master_bantuan_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->sumber_bantuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sumber_bantuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->sumber_bantuan_id->caption(), $master_bantuan_add->sumber_bantuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->pengambilan_bantuuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pengambilan_bantuuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->pengambilan_bantuuan_id->caption(), $master_bantuan_add->pengambilan_bantuuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->frekuensi->Required) { ?>
				elm = this.getElements("x" + infix + "_frekuensi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->frekuensi->caption(), $master_bantuan_add->frekuensi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->bulan->caption(), $master_bantuan_add->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->tahun->caption(), $master_bantuan_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_bantuan_add->tahun->errorMessage()) ?>");
			<?php if ($master_bantuan_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->keterangan->caption(), $master_bantuan_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_add->status->caption(), $master_bantuan_add->status->RequiredErrorMessage)) ?>");
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
	fmaster_bantuanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_bantuanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_bantuanadd.lists["x_jenis_bantuan_id"] = <?php echo $master_bantuan_add->jenis_bantuan_id->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_add->jenis_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanadd.lists["x_type"] = <?php echo $master_bantuan_add->type->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_type"].options = <?php echo JsonEncode($master_bantuan_add->type->options(FALSE, TRUE)) ?>;
	fmaster_bantuanadd.lists["x_sumber_bantuan_id"] = <?php echo $master_bantuan_add->sumber_bantuan_id->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_sumber_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_add->sumber_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanadd.lists["x_pengambilan_bantuuan_id"] = <?php echo $master_bantuan_add->pengambilan_bantuuan_id->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_pengambilan_bantuuan_id"].options = <?php echo JsonEncode($master_bantuan_add->pengambilan_bantuuan_id->lookupOptions()) ?>;
	fmaster_bantuanadd.lists["x_bulan"] = <?php echo $master_bantuan_add->bulan->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_bulan"].options = <?php echo JsonEncode($master_bantuan_add->bulan->options(FALSE, TRUE)) ?>;
	fmaster_bantuanadd.lists["x_status"] = <?php echo $master_bantuan_add->status->Lookup->toClientList($master_bantuan_add) ?>;
	fmaster_bantuanadd.lists["x_status"].options = <?php echo JsonEncode($master_bantuan_add->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fmaster_bantuanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_bantuan_add->showPageHeader(); ?>
<?php
$master_bantuan_add->showMessage();
?>
<form name="fmaster_bantuanadd" id="fmaster_bantuanadd" class="<?php echo $master_bantuan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_bantuan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$master_bantuan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($master_bantuan_add->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<div id="r_jenis_bantuan_id" class="form-group row">
		<label id="elh_master_bantuan_jenis_bantuan_id" for="x_jenis_bantuan_id" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->jenis_bantuan_id->caption() ?><?php echo $master_bantuan_add->jenis_bantuan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->jenis_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_jenis_bantuan_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $master_bantuan_add->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x_jenis_bantuan_id" name="x_jenis_bantuan_id"<?php echo $master_bantuan_add->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $master_bantuan_add->jenis_bantuan_id->selectOptionListHtml("x_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $master_bantuan_add->jenis_bantuan_id->Lookup->getParamTag($master_bantuan_add, "p_x_jenis_bantuan_id") ?>
</span>
<?php echo $master_bantuan_add->jenis_bantuan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_master_bantuan_nama" for="x_nama" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->nama->caption() ?><?php echo $master_bantuan_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->nama->cellAttributes() ?>>
<span id="el_master_bantuan_nama">
<input type="text" data-table="master_bantuan" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_add->nama->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_add->nama->EditValue ?>"<?php echo $master_bantuan_add->nama->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_master_bantuan_type" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->type->caption() ?><?php echo $master_bantuan_add->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->type->cellAttributes() ?>>
<span id="el_master_bantuan_type">
<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_type" data-value-separator="<?php echo $master_bantuan_add->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $master_bantuan_add->type->editAttributes() ?>></div>
<div id="dsl_x_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_add->type->radioButtonListHtml(FALSE, "x_type") ?>
</div></div>
</span>
<?php echo $master_bantuan_add->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_master_bantuan_jumlah" for="x_jumlah" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->jumlah->caption() ?><?php echo $master_bantuan_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->jumlah->cellAttributes() ?>>
<span id="el_master_bantuan_jumlah">
<input type="text" data-table="master_bantuan" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_add->jumlah->EditValue ?>"<?php echo $master_bantuan_add->jumlah->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<div id="r_sumber_bantuan_id" class="form-group row">
		<label id="elh_master_bantuan_sumber_bantuan_id" for="x_sumber_bantuan_id" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->sumber_bantuan_id->caption() ?><?php echo $master_bantuan_add->sumber_bantuan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->sumber_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_sumber_bantuan_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sumber_bantuan_id"><?php echo EmptyValue(strval($master_bantuan_add->sumber_bantuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_add->sumber_bantuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_add->sumber_bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_add->sumber_bantuan_id->ReadOnly || $master_bantuan_add->sumber_bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sumber_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_add->sumber_bantuan_id->Lookup->getParamTag($master_bantuan_add, "p_x_sumber_bantuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_add->sumber_bantuan_id->displayValueSeparatorAttribute() ?>" name="x_sumber_bantuan_id" id="x_sumber_bantuan_id" value="<?php echo $master_bantuan_add->sumber_bantuan_id->CurrentValue ?>"<?php echo $master_bantuan_add->sumber_bantuan_id->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->sumber_bantuan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<div id="r_pengambilan_bantuuan_id" class="form-group row">
		<label id="elh_master_bantuan_pengambilan_bantuuan_id" for="x_pengambilan_bantuuan_id" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->pengambilan_bantuuan_id->caption() ?><?php echo $master_bantuan_add->pengambilan_bantuuan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_pengambilan_bantuuan_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pengambilan_bantuuan_id"><?php echo EmptyValue(strval($master_bantuan_add->pengambilan_bantuuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_add->pengambilan_bantuuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_add->pengambilan_bantuuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_add->pengambilan_bantuuan_id->ReadOnly || $master_bantuan_add->pengambilan_bantuuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pengambilan_bantuuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_add->pengambilan_bantuuan_id->Lookup->getParamTag($master_bantuan_add, "p_x_pengambilan_bantuuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_pengambilan_bantuuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_add->pengambilan_bantuuan_id->displayValueSeparatorAttribute() ?>" name="x_pengambilan_bantuuan_id" id="x_pengambilan_bantuuan_id" value="<?php echo $master_bantuan_add->pengambilan_bantuuan_id->CurrentValue ?>"<?php echo $master_bantuan_add->pengambilan_bantuuan_id->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->pengambilan_bantuuan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->frekuensi->Visible) { // frekuensi ?>
	<div id="r_frekuensi" class="form-group row">
		<label id="elh_master_bantuan_frekuensi" for="x_frekuensi" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->frekuensi->caption() ?><?php echo $master_bantuan_add->frekuensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->frekuensi->cellAttributes() ?>>
<span id="el_master_bantuan_frekuensi">
<input type="text" data-table="master_bantuan" data-field="x_frekuensi" name="x_frekuensi" id="x_frekuensi" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_add->frekuensi->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_add->frekuensi->EditValue ?>"<?php echo $master_bantuan_add->frekuensi->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->frekuensi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_master_bantuan_bulan" for="x_bulan" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->bulan->caption() ?><?php echo $master_bantuan_add->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->bulan->cellAttributes() ?>>
<span id="el_master_bantuan_bulan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_bulan" data-value-separator="<?php echo $master_bantuan_add->bulan->displayValueSeparatorAttribute() ?>" id="x_bulan" name="x_bulan"<?php echo $master_bantuan_add->bulan->editAttributes() ?>>
			<?php echo $master_bantuan_add->bulan->selectOptionListHtml("x_bulan") ?>
		</select>
</div>
</span>
<?php echo $master_bantuan_add->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_master_bantuan_tahun" for="x_tahun" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->tahun->caption() ?><?php echo $master_bantuan_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->tahun->cellAttributes() ?>>
<span id="el_master_bantuan_tahun">
<input type="text" data-table="master_bantuan" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_bantuan_add->tahun->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_add->tahun->EditValue ?>"<?php echo $master_bantuan_add->tahun->editAttributes() ?>>
</span>
<?php echo $master_bantuan_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_master_bantuan_keterangan" for="x_keterangan" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->keterangan->caption() ?><?php echo $master_bantuan_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->keterangan->cellAttributes() ?>>
<span id="el_master_bantuan_keterangan">
<textarea data-table="master_bantuan" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($master_bantuan_add->keterangan->getPlaceHolder()) ?>"<?php echo $master_bantuan_add->keterangan->editAttributes() ?>><?php echo $master_bantuan_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $master_bantuan_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($master_bantuan_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_master_bantuan_status" for="x_status" class="<?php echo $master_bantuan_add->LeftColumnClass ?>"><?php echo $master_bantuan_add->status->caption() ?><?php echo $master_bantuan_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $master_bantuan_add->RightColumnClass ?>"><div <?php echo $master_bantuan_add->status->cellAttributes() ?>>
<span id="el_master_bantuan_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_status" data-value-separator="<?php echo $master_bantuan_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $master_bantuan_add->status->editAttributes() ?>>
			<?php echo $master_bantuan_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $master_bantuan_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("bantuan", explode(",", $master_bantuan->getCurrentDetailTable())) && $bantuan->DetailAdd) {
?>
<?php if ($master_bantuan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bantuan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bantuangrid.php" ?>
<?php } ?>
<?php if (!$master_bantuan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $master_bantuan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_bantuan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$master_bantuan_add->showPageFooter();
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
$master_bantuan_add->terminate();
?>