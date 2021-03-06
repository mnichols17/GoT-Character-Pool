<?php
require('Data.php');

class Content
{
    private static function createData() {
        $d = new Data();
        $d::CSVtoJSON();

        $url = '../data/entries.json';
        $data = file_get_contents($url);
        return(json_decode($data));
    }

    private static function getPoints($answers, $data): int {
        $correct = 0;
        foreach($answers as $q => $a) {
            if($data->$q == $a) {
                if (strpos($q, '4') == true) {
                    $correct += 4;
                    continue;
                }
                $correct++;
                //console.log(); fix the point system
            }
        }
        return $correct;
    }

    public static function makeLeaderboard() {
        $jso = self::createData();
        $entries = array();

        foreach($jso as $entry => $key) {
            if($entry != 'answers') {
                array_push($entries, [$entry, self::getPoints($jso->answers, $jso->$entry)]);
            }
        }

        $entries = self::ranker($entries);

        foreach($entries as $entry) {
            echo("<tr><td style='width:80%;'><a href='../src/user.php?entry=" . $entry[0] . "'>" . $entry[0] . "</a></td><td>" . $entry[1]. "</td></tr>");
        }
    }

    private static function ranker($entries) {

       for($i = 1; $i < sizeof($entries); $i++) {
            for($j = 0; $j < sizeof($entries); $j++) {
                if($entries[$i][1] > $entries[$j][1]){
                    $temp = $entries[$i];
                    $entries[$i] = $entries[$j];
                    $entries[$j] = $temp;
                }
            }
        }
        return $entries;
    }

    public static function createStatus() {
        $jso = self::createData();
        $html = "<tbody>" . self::charTable($jso->answers) . "</tbody>";
        return($html);
    }

    public static function getEntry($entry): array {
        $jso = self::createData();

        $html = "<tbody>" . self::charTable($jso->$entry) . "</tbody>";
        return array($html, self::getPoints($jso->answers,$jso->$entry));
    }

    private static function charTable($entry) {
        $html = "";

        foreach($entry as $key => $value) {
            if($value != "Alive" && $value != "Dead" && $value != "WW"){
                $html .= "<tr><td style='width:80%;' scope=\"row\">" . $key . "</td><td class='unknown'>" . $value . "</td></tr>";
            } else {
                $html .= "<tr><td scope=\"row\">" . $key . "</td><td class='" . strtolower($value) . "'>" . $value . "</td></tr>";
            }
        }
        return $html;
    }
}
