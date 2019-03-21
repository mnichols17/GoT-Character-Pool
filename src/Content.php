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

        foreach($jso as $entry => $key) {
            if($entry != 'answers') {
                $entries[$entry] = self::getPoints($jso->answers, $jso->$entry);
            }
        }

        foreach($entries as $entry => $points) {
            echo("<tr><td><a href='src/user.php?entry=" . $entry . "'>" . $entry . "</a></td><td>" . $points . "</td></tr>");
        }
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
                $html .= "<tr></tr><td scope=\"row\">" . $key . "</td><td class='alive'>" . $value . "</td></tr>";
            } else if($value == "") {
                $html .= "<tr></tr><td scope=\"row\">" . $key . "</td><td class='unknown'>Unknown</td></tr>";
            } else {
                $html .= "<tr></tr><td scope=\"row\">" . $key . "</td><td class='dead'>" . $value . "</td></tr>";
            }
        }

        return $html;
    }
}
