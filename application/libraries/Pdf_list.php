<?php


class PDF_list {

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('pdf');
    }

    public function casa_prospecto( $data ){
        
        extract( $data );
        
        $pdf            = new PDF('P','mm','letter');
        $pdf->title     = 'Titulo del documento';
        $pdf->date      = 'Fecha';
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        $pdf->ln(10);
        
        $arrDataHd  =   array(  'Tipo', 
                                'Paquete', 
                                'Clave', 
                                'Credito Anterior');

        $arrDataRes =   array(  $tipo, 
                                $paquete, 
                                $clave, 
                                $credito_anterior);

        $pdf->drawForm($pdf, '', '', $arrDataHd, $arrDataRes, 0, 1);

        $pdf->ln(5);

        $arrDataHd  =   array(  'Calle y numero', 
                                'Manzana', 
                                'Lote', 
                                'Municipio');

        $arrDataRes =   array(  $calle_numero, 
                                $manzana, 
                                $lote, 
                                $municipio);

        $pdf->drawForm($pdf, 'Detalles de la vivienda', 'Ubicación', $arrDataHd, $arrDataRes, 0, 1);

        $arrDataHd  =   array(  'Colonia', 
                                'Estado', 
                                'Codigo postal');

        $arrDataRes =   array(  $colonia, 
                                $estado, 
                                $codigo_postal);

        $pdf->drawForm($pdf, '', '', $arrDataHd, $arrDataRes, 0, 1);

        $pdf->ln(5);

        $arrDataHd  =   array(  'Tipo de vivienda', 
                                'm2 de terreno', 
                                'm2 de contrucción', 
                                'Pisos/nivel');

        $arrDataRes =   array(  $tipo_vivienda, 
                                $m2_terreno, 
                                $m2_construccion, 
                                $pisos_nivel);

        $pdf->drawForm($pdf, '', 'Descripción', $arrDataHd, $arrDataRes, 0, 1);

        $arrDataHd  =   array(  'Recamaras', 
                                'Baños', 
                                'Estacionamiento');

        $arrDataRes =   array(  $recamaras, 
                                $banios, 
                                $estacionamiento);

        $pdf->drawForm($pdf, '', '', $arrDataHd, $arrDataRes, 0, 1);

        $arrDataHd  =   array( 'Observaciones' );
        
        $arrDataRes =   array( $observaciones );

        $pdf->drawForm($pdf, '', '', $arrDataHd, $arrDataRes, 0, 1);

        $pdf->ln(10);
        
        $pdf->SetFont('Helvetica','B', 12);
        
        if ( count($imagenes)>0 ) {
            $pdf->Cell(190,0,utf8_decode('Imagenes de visita'),0,0,'C');

            $pdf->ln(5);
            
            $img_x = 70;
            $img_y = 60;

            foreach ($imagenes as $row) {
                
                if ($pdf->GetY() > 210) {

                    $pdf->AddPage();
                    $pdf->Image('server/casas/files/' . $casa_k . '/' . $row['nombre'] , $img_x + 10 , 30, 50, 50);
                    $pdf->ln( $img_y + 10 );

                }else{

                    $pdf->Image('server/casas/files/' . $casa_k . '/' . $row['nombre'] , $pdf->GetX() + $img_x , $pdf->GetY(), 50, 50);
                    $pdf->ln( $img_y );
                    
                }
            }
        }
            

        $pdf->Output("prueba.pdf","I");
    }
}  
?>