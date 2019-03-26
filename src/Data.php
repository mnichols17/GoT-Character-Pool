<?php

class Data
{
    private static function CSVtoJSON($filename) {
        $r = $records = $titles = array();
        $r['answers'] = json_decode(file_get_contents('../data/answers.json'));
        $count = 0;

        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($count == 0) {
                    $titles = $row;
                } else {
                    array_push($records, $row);
                }
                $count++;
            }
            fclose($handle);
        }
        foreach($records as $record) {
            $d = array();
            for($i = 2; $i < sizeof($record); $i++){
                $d[$titles[$i]] = $record[$i];
            }
            $r[$record[1]] = $d;
        }

        $records = json_encode($r);
        $handle = fopen('../data/entries.json', 'w');
        fwrite($handle, $records);
        fclose($handle);
    }

    public static function getJSON() {
        self::CSVtoJSON('../data/data.csv');
    }
}