<?php

namespace lib;

class classHash {

    public function toText($hash) {
        $class = "";

        switch($hash) {
            // HUNTER
            case '671679327':
                $class = "Hunter";
            break;

            // TITAN
            case '3655393761':
                $class = "Titan";
            break;

            // WARLOCK
            case '2271682572':
                $class = "Warlock";
            break;

            default:
            break;
        }

        return $class;
    }

}

class raceHash {

    public function toText($hash) {
        $race = "";

        switch($hash) {

            // AWOKEN
            case '2803282938':
                $race = "Awoken";
            break;

            // EXO
            case '898834093':
                $race = "Exo";
            break;

            // HUMAN
            case '3887404748':
                $race = "Human";
            break;

            default:
            break;

        }

        return $race;
    }

}

class genderHash {

    public function toText($hash) {
        $gender = "";

        switch($hash) {

            // FEMALE
            case '2204441813':
                $gender = "Female";
            break;

            // MALE
            case '3111576190':
                $gender = "Male";
            break;

            default:
            break;

        }

        return $gender;
    }

}