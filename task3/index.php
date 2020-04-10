<html>
<head>
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        function table($x=10, $y=10) {
            $s = '<table>';
            $s = $s.'<tr><td></td>';
            for ($i = 1; $i <= $x; $i++) {
                $s = $s."<td>$i</td>";
            }
            $s = $s.'</tr>';
            for ($i = 1; $i <= $y; $i++) {
                $s = $s.'<tr><td>'.$i.'</td>';
                for ($j = 1; $j <= $x; $j++) {
                    $s = $s.'<td>'.($i*$j).'</td>';
                }
                $s = $s.'</tr>';
            }
            $s = $s.'</table>';
            return $s;
        }
 
        $x = $_GET['x'] ? $_GET['x'] : 10;
        $y = $_GET['y'] ? $_GET['y'] : 10;
        echo table($x, $y);
    ?>
</body>
</html>
