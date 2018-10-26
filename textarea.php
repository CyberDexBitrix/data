<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_js.php");
?>

<script type="text/javascript">
	BX.WindowManager.Get().SetTitle('<?=$_POST['fieldName']?>');
</script>

<?$APPLICATION->IncludeComponent(
	"bitrix:fileman.light_editor",
	"",
	Array(
		"CONTENT" => $_POST['TEXT'],
		"WIDTH" => "100%",
		"HEIGHT" => "475",
		"ID" => "TEXT",
		"INPUT_ID" => "HTML_TEXT",
		"INPUT_NAME" => "TEXT",
		"JS_OBJ_NAME" => "redactor",
		"RESIZABLE" => "N",
		"USE_FILE_DIALOGS" => "Y",
		"VIDEO_ALLOW_VIDEO" => "N",
		"VIDEO_BUFFER" => "20",
		"VIDEO_LOGO" => "",
		"VIDEO_MAX_HEIGHT" => "480",
		"VIDEO_MAX_WIDTH" => "640",
		"VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
		"VIDEO_WINDOWLESS" => "Y",
		"VIDEO_WMODE" => "transparent",
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_js.php");?>