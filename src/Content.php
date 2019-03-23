<?php
/**
 * Created by PhpStorm.
 * User: michaelnichols
 * Date: 2019-03-20
 * Time: 03:55
 */

class Content
{
    public static function createData() {
        $url = '../data/entries.json';
        $data = file_get_contents($url);
        return(json_decode($data));
    }

    public static function getPoints($answers, $data): int {
        $correct = 0;
        foreach($answers as $q => $a) {
            if($data->$q == $a) {
                $correct++;
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

    public static function ranker($entries) {

        for($i = 1; $i < sizeof($entries); $i++){
            if($entries[$i][1] > $entries[$i-1][1]){
                $temp = $entries[$i];
                $entries[$i] = $entries[$i-1];
                $entries[$i-1] = $temp;
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

    public static function charTable($entry) {
        $html = "";

        foreach($entry as $key => $value) {
            if($value == "Alive") {
                $html .= "<tr><td scope=\"row\">" . $key . "</td><td class='alive'>" . $value . "</td></tr>";
            } else if($value == "") {
                $html .= "<tr></tr><td scope=\"row\">" . $key . "</td><td class='unknown'>Unknown</td></tr>";
            } else {
                $html .= "<tr><td scope=\"row\">" . $key . "</td><td class='dead'>" . $value . "</td></tr>";
            }
        }

        return $html;
    }
}
