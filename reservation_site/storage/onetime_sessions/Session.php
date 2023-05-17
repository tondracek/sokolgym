<?php

class Session
{
    private $id;
    private $day;
    private $start;
    private $end;
    private $trainer;
    private $max_capacity;
    private $attendants;
    private $creator;

    public function __construct($id, $day, $start, $end, $trainer, $max_capacity, $attendants, $creator)
    {
        $this->id = $id;
        $this->day = $day;
        $this->start = $start;
        $this->end = $end;
        $this->trainer = $trainer;
        $this->max_capacity = $max_capacity;
        $this->attendants = $attendants;
        $this->creator = $creator;
    }

    public static function load_session($json)
    {
        $attendants = [];
        foreach ($json["attendants"] as $name) {
            $attendants[] = $name;
        }
        return new Session(
            $json["id"],
            $json["day"],
            $json["start"],
            $json["end"],
            $json["trainer"],
            $json["max_capacity"],
            $attendants,
            $json["creator"]
        );
    }

    public static function load_sessions_array($filename)
    {
        $file_as_json = file_get_contents($filename);
        $sessions_json_array = json_decode($file_as_json, true);

        $sessions = [];

        foreach ($sessions_json_array as $session_json) {
            $new_session = self::load_session($session_json);
            $sessions[] = $new_session;
        }

        return $sessions;
    }

    public function add_attendant($name)
    {
        $this->attendants[] = $name;
    }

    public function is_overlapping(Session $session)
    {
        if ($this->day == $session->day) {
            if ($this->start < $session->end && $this->end > $session->start) {
                return true;
            }
        }
        return false;
    }

    public function getDay()
    {
        return $this->day;
    }
}