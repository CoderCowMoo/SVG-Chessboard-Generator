<!DOCTYPE html>
<html>
    <head>
        <title>Chessboard Generator</title>
    </head>
    <body>
        <h1>Chessboard Generator</h1>
        <form method="GET">
            Colour 1: <input type="color" name="Col1" id = "col1"><br><br>
            Colour 2: <input type="color" name="Col2" id = "col2"><br><br>
            Size of cell: <input type = "text" name = 'cellsize' id = "cellsize"> px (default is 50)<br><br>
            Border size: <input type = "text" name = 'bordersize' id = "bordersize"> px (default is 3)<br><br>
            Border colour: <input type = "color" name = "bordercol" id = "bordercol"><br><br>
            <input type="submit">
        </form>
        <?php
        $col1 = $_GET["Col1"];
        $col2 = $_GET["Col2"];

        if (isset($_GET['bordercol'])) {
            $bordercol = (string)$_GET["bordercol"];
        }

        if (isset($_GET['bordersize'])) {
            $bordersize = (int)$_GET["bordersize"];
            if ($bordersize == 0) {
                $bordersize = 3;
            }
        }
        else {
            $bordersize = 3;
        }
        if (isset($_GET['cellsize'])) {
            $size = (int)$_GET["cellsize"];
            if ($size == 0) {
                $size = 50;
            }
        }

        $x = 70;
        $x2 = $size + $x;
        $y = 70;
        $y2 = $y + $size;
        $state = 2;
        if (isset($col1, $col2)) {
            echo "<script>\n",
                 "document.getElementById('col1').setAttribute('value', '" . $col1 . "');\n",
                 "document.getElementById('col2').setAttribute('value', '" . $col2 . "');\n",
                 "</script>\n"; 
        }

        echo "<svg width='3000' height='3000'>";   
        for ($counter = 0; $counter < 8; $counter++) { // Columns
            for ($counterx = 0; $counterx < 8; $counterx++) { // Rows
                if ($state % 2 == 0) {
                    echo "<path d='M ". $x . " " . $y . " L " . $x2 . " " . $y . " L " . $x2 . " " . $y2 . " L ". $x . " " . $y2 . " Z' fill = '" . $col1 . "'/>\n";
                }
                else {
                    echo "<path d='M ". $x . " " . $y . " L " . $x2 . " " . $y . " L " . $x2 . " " . $y2 . " L ". $x . " " . $y2 . " Z' fill = '" . $col2 . "'/>\n";
                }
                $x += $size;
                $x2 += $size;
                $state += 1;
            }
            $y += $size;
            $y2 = $y + $size;
            $x = 70;
            $x2 = $x + $size;
            $state += 1;
            $border = $size * 8 + 70;
        }
        echo "<path d='M 70 70 L ". $border . " 70 L " . $border . " " . $border . " L 70 " . $border . " L 70 70' style= 'fill: none;' stroke-width = '" . $bordersize . "' stroke = '" . $bordercol . "'/>";
        echo "</svg>";
        ?>  
    </body>
</html>