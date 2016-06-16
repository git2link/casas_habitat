<?php


    require_once 'application/libraries/fpdf/class.fpdf.php';

    class PDF extends FPDF{
        
        
        function Header(){
            $this->Image('img/logo_final.png',10,10);
            
            $this->Cell(120);
            $this->SetFont('Helvetica','',8);
            $this->SetTextColor(44, 44, 44);
            $this->Cell(0,0,utf8_decode($this->date),0,0,'R');
            
            $this->Ln(10);
            $this->SetFont('Helvetica','B',15);
            $this->Cell(70);
            $this->Cell(0,0,utf8_decode($this->title),0,0,'L');
        }

        // Pie de página
        function Footer(){
            $this->SetY(-20);
            $this->SetFont('Helvetica','I',6);
            $this->MultiCell(192,5,utf8_decode('Mensaje Casas Habitat'),0,'L',false);

            $this->SetY(-10);
            $this->SetFont('Helvetica','I',8);
            $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'R');
        }

        function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0){
            // resize font
            $subFontSizeold = $this->FontSizePt;
            $this->SetFontSize($subFontSize);

            // reposition y
            $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
            $subX        = $this->x;
            $subY        = $this->y;
            $this->SetXY($subX, $subY - $subOffset);

            //Output text
            $this->Write($h, $txt, $link);

            // restore y position
            $subX        = $this->x;
            $subY        = $this->y;
            $this->SetXY($subX,   $subY + $subOffset);

            // restore font size
            $this->SetFontSize($subFontSizeold);
        }


        function drawForm($pdf, $title='', $subtitle='', $arrHeader=[], $arrData=[], $drawLine=1, $fill = 0){
            $height = 6; 
            $pdf->SetDrawColor(200,200,200);
            if ( $pdf->GetY()>230) {
                $pdf->AddPage();
            }
        //----------------------------------------------------------------Title---------------------------------------------------------------------------
            if ($title!='') {
                $pdf->ln($height);
                $pdf->SetFont('Helvetica','B',12);
                //$pdf->Cell(192,$height,utf8_decode(ucwords($title)),0,0,'C');
                $pdf->Cell(192,$height,utf8_decode($title),0,0,'C');
                $pdf->ln();
            }
        //-------------------Sub-Title--------------------------------------
            if ($subtitle!='') {
                $pdf->SetFont('Helvetica','B',10);
                //$pdf->Cell(192,$height,utf8_decode(ucwords($subtitle)),0,0,'L');
                $pdf->Cell(192,$height,utf8_decode($subtitle),0,0,'L');
                $pdf->ln();
            }
        //-------------------Header-------------------------------------
            $nCol = count($arrHeader);
            if ($nCol >0) {
                $yStart = $pdf->GetY();
                $pdf->SetFont('Helvetica','B',10);
                $pdf->SetFillColor(204, 204, 255);

                if ($fill==1) {
                    $pdf->SetTextColor(100 , 100, 100);
                }else{
                    $pdf->SetTextColor(44, 44, 44);   
                }

                foreach ($arrHeader as $key => $value) {
                    //$pdf->Cell(192/$nCol,$height,utf8_decode(ucwords($value)),0,0,'L',$fill);
                    $pdf->Cell(192/$nCol,$height,utf8_decode($value),0,0,'L',$fill);
                }

                $pdf->SetTextColor(44, 44, 44); 

                $pdf->ln();
            }
        //-------------------Info-------------------------------------
            $auxY = 0;

            $pdf->SetFont('Helvetica','',8);

            $yStartInf = $pdf->GetY();  

            $countArrData = 1;

            foreach ($arrData as $key => $value) {
                    //$pdf->MultiCell(192/$nCol,$height,utf8_decode(ucwords($value)),0,'L',0);
                $pdf->MultiCell(192/$nCol,$height,utf8_decode($value),0,'L',0);
                if ($pdf->GetY() > $auxY) { $auxY = $pdf->GetY(); }
                $pdf->SetXY($pdf->GetX() + ((192/$nCol) * $countArrData),$yStartInf);
                $countArrData = $countArrData +1;
            }

            $pdf->ln();
        //-------------------LineDraw-------------------------------------
            $hLine = $auxY - $yStart;

            $pdf->SetY($yStart);

            if ($drawLine==1) {
                for ($i = 1; $i <= $nCol; $i++) {   $pdf->Cell(192/$nCol,$hLine,utf8_decode(''),1,0,'L');    }
                $pdf->ln();
            }else{
                for ($i = 1; $i <= $nCol; $i++) {   $pdf->Cell(192/$nCol,$hLine,utf8_decode(''),0,0,'L');    }
                $pdf->ln();
            }
            return $hLine;
        }

        function BasicTable($header, $data){
            $this->SetFillColor(51, 122, 183);
            $this->SetTextColor(255,255,255);//Letras
            $this->SetDrawColor(221, 221, 221); //Lineas
            $this->SetLineWidth(.3);
            $this->SetFont('Helvetica','B',8);

            $pageWidth = 192;
            $maxCharLen = 140;
            $colLen = 0;
            $colElemTotal = count($header);
            $maxWidth = floatval($pageWidth/$colElemTotal);
            $arrWidth = [];
            $arrWidthAux = [];
            $flagImporte=false;
            $sumAnchoGenerado=0;

//---------------       Calcula Ancho Automatico        -----------------------------------
            $countCol_1=0;

            foreach ($header as $col) {
                $ancho = floatval(($pageWidth*(strlen($col)))/$maxCharLen);
                if ($ancho>$maxWidth) {
                $ancho = $maxWidth;
                }
                //$arrWidthAux[$countCol] = $ancho;
                $arrWidth[$countCol_1] = $ancho;                
                $countCol_1 = $countCol_1 + 1;
            }

            $countCol_1=0;
            foreach ($data as $row) {
                foreach($row as $col){
                $ancho = floatval(($pageWidth*(strlen($col)))/$maxCharLen);
                if ($ancho>$maxWidth) {
                    $ancho = $maxWidth;
                }
                //$arrWidthAux[$countCol] = $ancho;
                if ($ancho > $arrWidth[$countCol_1]) {
                    $arrWidth[$countCol_1] = $ancho;
                }
                //$arrWidth[$countCol] = $ancho;                
                $countCol_1 = $countCol_1 + 1;
                }

                $countCol_1=0;
            }

            $countCol_1=0;
            foreach ($header as $col) {
                $sumAnchoGenerado = $sumAnchoGenerado + $arrWidth[$countCol_1];
                $countCol_1 = $countCol_1 + 1;
            }

            $spaceToAdd = floatval(($pageWidth-$sumAnchoGenerado)/$colElemTotal);

            $countCol_1=0;
            foreach ($arrWidth as $col) {
                $arrWidth[$countCol_1] = $arrWidth[$countCol_1] + $spaceToAdd;
                $countCol_1 = $countCol_1 + 1;
            }
//---------------       Calcula Ancho Automatico Fin        -----------------------------------
//---------------       Titulos Cabeceras               -----------------------------------
            $countCol_1=0;
            foreach($header as $col){

                if ($col=='Total Acumulado') {
                $flagImporte=true;
                }
                $this->Cell($arrWidth[$countCol_1],5,utf8_decode($col),1,0,'C',true);
                $countCol_1 = $countCol_1 + 1;
            }
//---------------       Titulos Cabeceras   Fin         -----------------------------------
//---------------       Calcula Alto Cell / Multicel                -----------------------------------
            $countCol_1 = 0;
            $multiplo = 0;
            $arrHeight = [];
            $countRow_1 = 0;
            foreach ($data as $row) {
                $flagBreakLine=false;

                foreach($row as $col){
                $lenMaxByCol = intval(($arrWidth[$countCol_1] * $maxCharLen)/$pageWidth);

                if (strlen($col) > $lenMaxByCol) {
                    $flagBreakLine=true;
                    $multiploAux =intval(strlen($col)/$lenMaxByCol);

                    if ($multiploAux > $multiplo) {
                        $multiplo = $multiploAux;
                    }
                }
                $countCol_1 = $countCol_1 + 1;
                }
                
                $countCol_1=0; 

                if ($flagBreakLine==true){
                $arrHeight[$countRow_1] = 5 * ($multiplo + 1);
                $multiplo = 0;
                }else{
                $arrHeight[$countRow_1] = 5;
                }

                $countRow_1 = $countRow_1 + 1;
            }

//---------------       Calcula Alto Cell / Multicel Fin                -----------------------------------
            $this->Ln();
            $this->SetFont('Helvetica','',8);
            
            $this->SetTextColor(44, 44, 44);//Letras
            // Datos
            $flagBreakLine=false;

            $contRow=0;
            $dataTotal=count($data);
            $flagTotal=false;

            $countRow_1 = 0;
            foreach($data as $row){
            
                if (($this->GetY())>200) {
                $this->AddPage();
                }

                $flagBreakLine=false;
                $contCol=0;
                $colTotal = count($row);
                $countCol_1 = 0;
                foreach($row as $col){
                $lenMaxByCol = intval(($arrWidth[$countCol_1] * $maxCharLen)/$pageWidth);
                $this->SetTextColor(44, 44, 44);

                $this->SetFillColor(255, 255, 255);

                if (($colTotal-1)==$contCol) { 
                    $flagImporte=false;
                }

                $contCol=$contCol+1;

                $x = $this->GetX();
                $y = $this->GetY();

                $this->Cell($arrWidth[$countCol_1],$arrHeight[$countRow_1],utf8_decode(''),1,0,'C',true);

                $this->SetXY($x,$y);

                if (strlen($col)> $lenMaxByCol) {
                    $flagBreakLine=true;
                    $this->MultiAlignCell($arrWidth[$countCol_1],5,$col,0,0,'C',false); 
                }else{
                    $this->Cell($arrWidth[$countCol_1],$arrHeight[$countRow_1],utf8_decode($col),0,0,'C',false);
                }

                $countCol_1 = $countCol_1 + 1;

                }

                if ($flagBreakLine==true){
                    $this->Ln($arrHeight[$countRow_1]);
                }else{
                    $this->Ln($arrHeight[$countRow_1]);
                }
                $countCol_1 = 0;
                $countRow_1 = $countRow_1 + 1;

                $contRow = $contRow+1;
            }
        }

        private function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
        {
            $x = $this->GetX() + $w;
            $y = $this->GetY();

            $this->MultiCell($w,$h,utf8_decode($text),$border,$align,$fill);

            if( $ln==0 )
            {
                $this->SetXY($x,$y);
            }
        }
    }

?>