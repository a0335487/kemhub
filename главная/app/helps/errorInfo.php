<? if (count($errMsg) > 0): ?>
    <? foreach ($errMsg as $error): ?>
        <li><?=$error;?></li>
    <?endforeach;?>
<?endif;?>