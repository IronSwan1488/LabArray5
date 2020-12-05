<?php
    require_once('php_excel/Classes/PHPExcel.php');
    require_once('php_excel/Classes/PHPExcel/Writer/Excel2007.php');

    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno){
        $result = $mysqli->query("SELECT
            OS.name,
            OS.type,
            OS.bitness,
            OS.developer,
            OS.users,

            os_keys.key_code,
            os_keys.purchase_date,
            os_keys.expiry_date,

            store.url

            FROM os_keys
            LEFT JOIN OS ON os_keys.os_id=OS.id
            LEFT JOIN store ON os_keys.store_id=store.id"
        );
    }
    
    $xls = new PHPExcel();
    // Устанавливаем индекс активного листа
    $xls->setActiveSheetIndex(0);
    // Получаем активный лист
    $sheet = $xls->getActiveSheet();
    // Подписываем лист
    $sheet->setTitle('Операционные системы');
    // Вставляем текст в ячейку A1
    $sheet->setCellValue("A1", 'Операционные системы');
    $sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
    // Объединяем ячейки
    $sheet->mergeCells('A1:J1');
    // Выравнивание текста
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $c = 0;

    $header = array("п/п","Название","Тип оборудования","Разрядность","Разработчик","Пользователи","Ключ","Дата приобретения","Дата окончания","URL магазина");
    foreach ($header as $h){
        $sheet->setCellValueByColumnAndRow($c,2,$h);
        // Применяем выравнивание
        $sheet->getColumnDimensionByColumn($c)->setAutoSize(true);
        $c++;
    }

    if ($result){
        $r = 3;
        // Для каждой строки из запроса
        while ($row = $result->fetch_row()){
            $c = 0;

            $sheet->setCellValueByColumnAndRow($c,$r,$r-2);
            $c++;

            foreach ($row as $cell){
                if ($c==7 || $c==8){
                    $cell = date('d-m-Y', strtotime($cell));
                }
                $sheet->setCellValueByColumnAndRow($c,$r,$cell);
                $c++;
            }
            $r++;
        }
    }

    header('Content-Type: application/xls');
    header('Content-Disposition: inline; filename=OS.xls');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');

    $objWriter = new PHPExcel_Writer_Excel5($xls);
    $objWriter->save('php://output');
?>