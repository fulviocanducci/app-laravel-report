<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório - Test</title>    
    <style>
        @page {
            margin: 120px 50px 80px 50px;
        }
        body{
            font-size: 11px;
        }
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            border-top: 0px solid gray;
            padding-top: 5px;
        }        
        #head{
            background-repeat: no-repeat;
            /*font-size: 25px;*/
            text-align: center;
            height: 30px;
            width: 100%;
            position: fixed;
            top: -50px;
            left: 0;
            right: 0;
            margin: auto;
            border: 0px solid #ccc;
        }
        #corpo{
            width: 100%;
            position: relative;
            margin: auto;
        }
        table {
          width: 100%;
          border-collapse: collapse;
        }
    </style>
</head>
<body>
    @yield("body")
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
            $size = 9;
            $font = $fontMetrics->getFont("times");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>