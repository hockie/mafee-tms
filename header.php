<?php

// Compatibility with PHP Report Maker 3
if (!isset($Language)) {
	include_once "ewcfg7.php";
	include_once "ewshared7.php";
	$Language = new cLanguage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $Language->ProjectPhrase("BodyTitle") ?></title>
	<link rel="icon" type="image/x-icon" href="./images/favicon.png">
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="yui280/build/button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="yui280/build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="yui280/build/autocomplete/assets/skins/sam/autocomplete.css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<?php } ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
<meta name="generator" content="PHPMaker v7.0.0.0">
  
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="yui280/build/utilities/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="yui280/build/button/button-min.js"></script>
<script type="text/javascript" src="yui280/build/container/container-min.js"></script>
<script type="text/javascript" src="yui280/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="yui280/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "jpg,jpeg,png,doc,pdf,docx,zip,rar"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup7.php"; // lookup file name

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="js/ewp7.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="js/userfn7.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js");
//-->

</script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><img src="images/merlogo.png" alt="" border="0"></div>
	<!-- header (end) -->
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>	
			<td class="ewMenuColumn">
			<!-- left column (begin) -->
<?php include "ewmenu.php" ?>
			<!-- left column (end) -->
			</td>
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="phpmaker"><b><?php echo $Language->ProjectPhrase("BodyTitle") ?></b></p>
<?php } ?>
