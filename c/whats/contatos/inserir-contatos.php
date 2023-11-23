<?php

include "../conn.php";

if(isset($_FILES['file'])) {
    $arquivo = $_FILES['file'];
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

    $lista = $_POST['lista'];

    if($extensao === 'xlsx') {
        require_once 'vendor/autoload.php';

        $arquivo_nome = date('dmy').$arquivo['name'];
        $arquivo_caminho = 'arquivos/'.$arquivo_nome;

        move_uploaded_file($arquivo['tmp_name'], $arquivo_caminho);

        $objPHPExcel = PHPExcel_IOFactory::load($arquivo_caminho);
        $sheet = $objPHPExcel->getActiveSheet();

        $column = @$_POST['name_column'];
        $phoneColumn = $_POST['phone_column'];
        $lastRow = $sheet->getHighestRow($column);

        if(isset($column)){
        
             for ($i = 1; $i <= $lastRow; $i++) {
                $name = $sheet->getCell($column.$i)->getValue();
                $phone = $sheet->getCell($phoneColumn.$i)->getValue();
                $phone  = str_replace(' ', '', $phone);
                $name = explode(' ', $name)[0];
                $contador = strlen($phone);

                if(preg_match('/[a-zA-Z]/', $phone)){

                }else{
                    if($contador > 5){
                        $pdo->query("INSERT INTO leads (lista, nome, num) VALUES ('$lista', '$name', '$phone')");
                    }     
                }

                
            }

        }else{
            
            for ($i = 1; $i <= $lastRow; $i++) {
                $phone = $sheet->getCell($phoneColumn.$i)->getValue();
                $phone  = str_replace(' ', '', $phone);
                $contador = strlen($phone);

                if(preg_match('/[a-zA-Z]/', $phone)){

                }else{
                    if($contador > 5){
                        $pdo->query("INSERT INTO leads (lista, num) VALUES ('$lista', '$phone')");
                    }
                }
            }
        }

        echo 1;
        
        unlink($arquivo_caminho);
    }
}

?>

