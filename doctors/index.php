<?php
namespace doctors;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/** @global $APPLICATION */
$APPLICATION->SetTitle('Врачи');
$APPLICATION->SetAdditionalCSS('/doctors/style.css');

use Models\Lists\DoctorsValTable as DoctorsTable;
use Models\Lists\ProtseduryValTable as ProtsTable;

$all_doctors = [];
$cur_doctor = '';

$path = trim($_GET["path"], '/');
$action = '';
$doctor_name = '';
$protsedury = [];

if(!empty($path)) {
    $path_parts = explode('/', $path);
    if (sizeof($path_parts) < 3) {
        if (sizeof($path_parts) == 2 && $path_parts[0] == 'edit') {
            $action = 'edit';
            $doctor_name = $path_parts[1];
        } else if (sizeof($path_parts) == 1 && in_array($path_parts[0], ['new', 'newproc'])) {
            $action = $path_parts[0];
        } else $doctor_name = $path_parts[0];
    }
}

if (!empty($doctor_name)) {
    $cur_doctor = DoctorsTable::query()
        ->setSelect([
                '*',
                'NAME' => 'ELEMENT.NAME',
                'PROTSEDURY',
                'ID' => 'ELEMENT.ID'])
        ->where('NAME', $doctor_name)
        ->fetch();
    if (is_array($cur_doctor)) {
        if ($cur_doctor['PROTSEDURY']) {
            $protsedury = ProtsTable::query()
                ->setSelect(['NAME' => 'ELEMENT.NAME'])
                ->where('ELEMENT.ID', 'in', $cur_doctor['PROTSEDURY'])
                ->fetchAll();
        }
    }
    else {
        header('Location: /doctors/');
        exit();
    }
}

if(empty($doctor_name) && empty($action)){
    $all_doctors = DoctorsTable::query()
        ->setSelect(['*', "NAME" => "ELEMENT.NAME", "ID" => "ELEMENT.ID"])
        ->fetchAll();
};

?>
    <?php if(!$doctor_name):?>
    <div class="doctors">
        <h1>Все врачи</h1>
        <div class="doctors__items">
            <?php foreach ($all_doctors as $doctor): ?>
                <a href="/doctors/<?=$doctor['NAME'];?>">
                    <div class="doctors__item"><?=$doctor['FAMILIYA'];?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif;?>



    <?php if($doctor_name):?>
    <div><a class="doctors__link-back" href="/doctors/">Вернуться к выбору врача</a></div>
        <h2 class="doctors__name">ФИО врача:</h2>
        <div><?=$cur_doctor['FAMILIYA']. ' ' . $cur_doctor['IMYA']. ' ' . $cur_doctor['OTCHESTVO'];?></div>
        <h2>Процедуры:</h2>
        <div>
            <? foreach ($protsedury as $proc):?>
                <div><?=$proc['NAME'];?></div>
            <?php endforeach; ?>
        </div>
    <?php endif;?>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>