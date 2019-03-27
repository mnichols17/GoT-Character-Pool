<?php

class Data
{
    public static function CSVtoJSON() {
        $json = $entries = $titles = array();
        $count = 0;

        if (($handle = fopen('../data/data.csv', "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($count == 0) {
                    $titles = $row;
                } else {
                    array_push($entries, $row);
                }
                $count++;
            }
            fclose($handle);
        }
        foreach($entries as $entry) {
            $temp = array();
            for($i = 2; $i < sizeof($entry); $i++){
                $temp[$titles[$i]] = $entry[$i];
            }
            $json[$entry[1]] = $temp;
        }

        foreach($json as $name => $entry){
            $json[$name] = self::translate($entry, $titles);
        }

        $json['answers'] = json_decode(file_get_contents('../data/answers.json'));

        $handle = fopen('../data/entries.json', 'w');
        fwrite($handle, json_encode($json));
        fclose($handle);
    }

    private static function translate($entry, $titles) {
        foreach($titles as $title){
            if($title !== "Your Name" && $title !== "Timestamp") {
                switch($entry[$title]){
                    case "Dead (Become a White Walker)":
                        $entry[$title] = "WW";
                        break;
                    case "Dead (Not a White Walker)":
                        $entry[$title] = "Dead";
                        break;
                    default:
                        break;
                }
            }
        }
        return $entry;
    }
}