<html>
<head>
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="style.css"/>
<head>
    <table>
        <?php
        $n = 10;
        echo '<tr><td></td>';
        for ($i = 1; $i <= $n; $i++) {
           echo "<td>$i</td>";
        }
        echo '</tr>';
        for ($i = 1; $i <= $n; $i++) {
            echo "<tr><td>$i</td>";
            for ($j = 1; $j <= $n; $j++) {
                if ($j == $i)
                    echo '<td class="diaog">'.($i*$j).'</td>';
                else
                    echo '<td>'.($i*$j).'</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</html>
