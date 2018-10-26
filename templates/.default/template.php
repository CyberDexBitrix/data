<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arParams['BLOCK_LIST'] as $key => $value){?>
    <?if($value){?>
        <div>
            <u><?=$value?></u>
        
            <?foreach($arParams['FIELDS_LIST'] as $key1 => $value1){
                if($value1){?>
                    <div>
                        <div><?=$value1?> : <?var_dump($arParams[md5($value.$value1)])?></div>
                    </div>
                <?}?>
            <?}?>
        </div>
    <?}?>
<?}?>