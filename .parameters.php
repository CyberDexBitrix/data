<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
    "GROUPS" => array(
        "DATA" => array(
            "NAME" => "Список полей и блоков данных"
        ),
        "TYPES" => array(
            "NAME" => "Типы полей"
        ),
    ),
	"PARAMETERS" => array(
        "VARS" => array(
    		"PARENT" => "DATA",
    		"NAME" => "Простые строки",
    		"TYPE" => "STRING",
    		"MULTIPLE" => "Y",
            "REFRESH" => "Y",
    	),
        "BLOCK_LIST" => array(
    		"PARENT" => "DATA",
    		"NAME" => "Список блоков",
    		"TYPE" => "STRING",
    		"MULTIPLE" => "Y",
            "REFRESH" => "Y",
            "DEFAULT" => array('Контент')
    	), 
        "FIELDS_LIST" => array(
    		"PARENT" => "DATA",
    		"NAME" => "Список полей блока",
    		"TYPE" => "STRING",
    		"MULTIPLE" => "Y",
            "REFRESH" => "Y",
    	),
	)
);

foreach($arCurrentValues['FIELDS_LIST'] as $key1 => $value1){
    if($value1){
        $arComponentParameters["PARAMETERS"]['TYPE'.$key1] = array(
        	"NAME" => 'Тип поля '.$value1,
    		"TYPE" => "LIST",
    		"VALUES" => array('Строка','Файл','Чекбокс','Цвет','Список','Дата','Инфоблок','Текст','HTML','Картинки'),
    		"DEFAULT" => array("STRING"),
    		"PARENT" => 'TYPES',
            "REFRESH" => "Y",
        );
    }
}

$fieldsTypes = array('STRING','FILE','CHECKBOX','COLORPICKER','STRING','CUSTOM','LIST','CUSTOM','CUSTOM','STRING');

foreach($arCurrentValues['BLOCK_LIST'] as $key => $value){
    if($value){
        $arComponentParameters["GROUPS"]['FIELD_'.$key] = array(
        	"NAME" => $value
        );
        foreach($arCurrentValues['FIELDS_LIST'] as $key1 => $value1){
            if($value1){
                
                $arComponentParameters["PARAMETERS"][md5($value.$value1)] = array(
                	"NAME" => $value1,
            		"TYPE" => $fieldsTypes[$arCurrentValues['TYPE'.$key1]],
            		"PARENT" => 'FIELD_'.$key,
                );
                if($arCurrentValues['TYPE'.$key1] == "1"){

                    $ext = 'wmv,wma,flv,vp6,mp3,mp4,aac,jpg,jpeg,gif,png';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["FD_TARGET"] = "F";
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["FD_EXT"] = $ext;
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["FD_UPLOAD"] = true;
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["FD_USE_MEDIALIB"] = true;
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["FD_MEDIALIB_TYPES"] = Array('video', 'sound');

                }elseif($arCurrentValues['TYPE'.$key1] == "4"){
                    
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]["MULTIPLE"] = "Y";
                    
                }elseif($arCurrentValues['TYPE'.$key1] == "5"){
                    
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_FILE'] = '/bitrix/components/dex/data/settings.js';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_EVENT'] = 'OnDateEdit';
                    
                }elseif($arCurrentValues['TYPE'.$key1] == "6"){
                    
                    CModule::IncludeModule("iblock");

                    $db_iblock = CIBlock::GetList(Array(),Array());
                    while($arRes = $db_iblock->Fetch()) $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['VALUES'] = $arIBlocks;    
                                    
                }elseif($arCurrentValues['TYPE'.$key1] == "7"){
                    
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_FILE'] = '/bitrix/components/dex/data/settings.js';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_EVENT'] = 'OnTextAreaConstruct';
                    
                }elseif($arCurrentValues['TYPE'.$key1] == "8"){
                    
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_FILE'] = '/bitrix/components/dex/data/settings.js';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_EVENT'] = 'OnTextEdit';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['JS_DATA'] = $value1;
                    
                    
                }elseif($arCurrentValues['TYPE'.$key1] == "9"){
                    
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['NAME'] = 'Количество файлов';
                    $arComponentParameters["PARAMETERS"][md5($value.$value1)]['REFRESH'] = 'Y';
                    //$arComponentParameters["PARAMETERS"][md5($value.$value1)]["MULTIPLE"] = "Y";
                    
                    for($i=1;$i<$arCurrentValues[md5($value.$value1)]+1;$i++){
                        $arComponentParameters["PARAMETERS"][md5($value.$value1).$i] = array(
                        	"NAME" => 'Картинка '.$i,
                    		"TYPE" => "FILE",
                    		"PARENT" => 'FIELD_'.$key,
                        );
                    }
                }
            }
        }
    }   
}

$arComponentParameters["PARAMETERS"]["CACHE_TIME"] =  array("DEFAULT"=>36000000);