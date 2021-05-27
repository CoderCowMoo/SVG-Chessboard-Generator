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
        $col1 = $_GET["Col1"]; // Get Col1 and Col2
        $col2 = $_GET["Col2"];

        if (isset($_GET['bordercol'])) { /* The ifs after this are for checking if bordercol, bordersize and cellsize are already set, if not, it will
                                            revert to default values */
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

        $x = 70; // Initialise the x and y starting positions of the cells path.
        $x2 = $size + $x;
        $y = 70;
        $y2 = $y + $size;
        $state = 2;
        if (isset($col1, $col2, $bordercol)) { /* A little script to set the inputs of colour 1 and 2 and border clour to the colour that was 
                                                  already there instead of going to black. */
            echo "<script>\n",
                 "document.getElementById('col1').setAttribute('value', '" . $col1 . "');\n",
                 "document.getElementById('col2').setAttribute('value', '" . $col2 . "');\n",
                 "document.getElementById('bordercol').setAttribute('value', '" . $bordercol . "');\n",
                 "</script>\n"; 
        }

        echo "<svg width='3000' height='3000'>";   
        for ($counter = 0; $counter < 8; $counter++) { // Columns
            for ($counterx = 0; $counterx < 8; $counterx++) { // Rows
                if ($state % 2 == 0) { //if it is even then make a cell of colour 1
                    echo "<path d='M ". $x . " " . $y . " L " . $x2 . " " . $y . " L " . $x2 . " " . $y2 . " L ". $x . " " . $y2 . " Z' fill = '" . $col1 . "'/>\n";
                }
                else { //if odd then colour 2
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
        echo "</svg>"; //path above this comment is the border path.
        ?>  
    </body>
</html>
