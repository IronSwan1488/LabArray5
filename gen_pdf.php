<?php
    require('tfpdf/tfpdf.php');

    $mysqli = new mysqli("localhost", "f0474306_root", "1488", "f0474306_OSystems");
    if (!$mysqli->connect_errno) {
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

    $pdf = new tFPDF();
    $pdf->AddFont('PDFFont','','pixel.ttf');
    $pdf->SetFont('PDFFont','',12);
    $pdf->AddPage();

    $pdf->Cell(50);
    $pdf->Cell(80,10,'Операционные системы',1,0,'C');
    $pdf->Ln(20);

    $pdf->SetFillColor(200,200,200);
    $pdf->SetFontSize(6);

    $header = array("п/п","Название","Тип оборудования","Разрядность","Разработчик","Пользователи","Ключ","Дата приобретения","Дата окончания","URL магазина");
    $w = array(6,23,25,15,25,20,20,20,18,23);
    $h = 10;
    for ($c = 0; $c < 10; $c++){
        $pdf->Cell($w[$c],$h,$header[$c],'LRTB','0','',true);
    }
    $pdf->Ln();

    if ($result){
        $counter = 1;
        while ($row = $result->fetch_row()){
            $pdf->Cell($w[0],$h,$counter,'LRBT','0','C',true);
            $pdf->Cell($w[1],$h,$row[0],'LRB');

            for ($c = 2; $c < 10; $c++){
                if ($c==7 || $c==8){
                    $row[$c-1] = date('d-m-Y', strtotime($row[$c-1]));
                }
                $pdf->Cell($w[$c],$h,$row[$c-1],'RB');
            }
            $pdf->Ln();
            $counter++;
        }
    }

    $pdf->Output("I",'Games.pdf',true);
?>