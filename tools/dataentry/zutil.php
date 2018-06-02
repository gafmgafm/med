<?php

function tabulate($prefix, $data, $headers) {
    $headers[] = 'Actions';
    tableHeader($headers);
    foreach ($data as $row) {
        echo '<tr>'.PHP_EOL;
        echo "<td><a href={$prefix}_edit.php?id={$row[0]}>{$row[0]}</a></td>".PHP_EOL;
        for ($i=1; $i < sizeof($row); $i++) {
            echo "<td>{$row[$i]}</td>".PHP_EOL;
        }
        echo "<td><a href={$prefix}_delete.php?id={$row[0]}>Delete</a></td>".PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }
    tableFooter();
}

class HtmlHelper {

    public static function tableHeader($headers) {
        echo '<table class="table table-striped table-hover table-sm">'.PHP_EOL;
        echo '<thead class="thead-dark">'.PHP_EOL;
        echo '<tr>'.PHP_EOL;
        foreach ($headers as $header) {
            echo '<th>'.$header.'</th>'.PHP_EOL;
        }
        echo '</tr>'.PHP_EOL;
        echo '</thead>'.PHP_EOL;
    }

    public static function tableRow($row) {
        echo '<tr>'.PHP_EOL;
        foreach ($row as $cell) {
            echo "<td>$cell</td>".PHP_EOL;
        }
        echo '</tr>'.PHP_EOL;
    }
    
    public static function tableFooter() {
        echo '</table>'.PHP_EOL;
    }

    public static function formSelect($data, $name, $selected = null, $required = true) {
        echo "<select class=\"form-control\" name=$name id=$name";
        if ($required) echo ' required=required';
        echo '>'.PHP_EOL;
        foreach ($data as $item) {
            $id = $item[0];
            echo "\t<option value=\"$id\"";
            if ($id == $selected) echo ' selected=selected';
            echo ">{$item[1]}</option>".PHP_EOL;
        }
        echo '</select>'.PHP_EOL;
    }

}

?>