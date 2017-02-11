<?php
if (isset($_GET['in'])) {
    
    // Открыть текстовый файл
    $f = fopen("../common/seconds" . $_GET['admin'] . ".txt", "w");
    
    // Записать строку текста
    fwrite($f, $_GET['in']);
    
    // Закрыть текстовый файл
    fclose($f);
    
    if ($_GET['in'] == '0') {
        $file = "../common/seconds" . $_GET['admin'] . ".txt";
        unlink($file);
        $file = "../common/question" . $_GET['admin'] . ".txt";
        unlink($file);
    }
}
?>