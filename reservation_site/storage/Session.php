<?php

abstract class Session implements JsonSerializable
{
    protected $id;
    protected $start;
    protected $end;
    protected $max_capacity;
    protected $attendants;

    public function __construct($id, $start, $end, $max_capacity, $attendants)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
        $this->max_capacity = $max_capacity;
        $this->attendants = $attendants;
    }

    protected static function load_sessions_array($filename, callable $loading_function) {
        $file_as_json = file_get_contents($filename);
        $sessions_json_array = json_decode($file_as_json, true);

        $sessions = [];

        foreach ($sessions_json_array as $session_json) {
            $new_session = $loading_function($session_json);
            $sessions[] = $new_session;
        }

        return $sessions;
    }


    public function add_attendant($name)
    {
        $this->attendants[] = $name;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getID()
    {
        return $this->id;
    }
}