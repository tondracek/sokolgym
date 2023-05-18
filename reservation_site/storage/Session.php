<?php

abstract class Session implements JsonSerializable
{
    protected int $id;
    protected string $start;
    protected string $end;
    protected int $max_capacity;
    protected array $attendants;

    public function __construct($id, $start, $end, $max_capacity, $attendants)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
        $this->max_capacity = $max_capacity;
        $this->attendants = $attendants;
    }

    protected static function load_sessions_array($filename, callable $loading_function): array
    {
        $file_as_json = file_get_contents($filename);
        $sessions_json_array = json_decode($file_as_json, true);

        $sessions = [];

        foreach ($sessions_json_array as $session_json) {
            $new_session = $loading_function($session_json);
            $sessions[] = $new_session;
        }

        return $sessions;
    }

    public abstract function is_overlapping(OnetimeSession $session): bool;

    public function is_full(): bool
    {
        return $this->max_capacity <= count($this->attendants);
    }

    public function add_attendant($name): void
    {
        $this->attendants[] = $name;
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    public function getID(): int
    {
        return $this->id;
    }
}