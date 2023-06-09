<?php

class OnetimeSession extends Session
{
    private string $day;
    private string $trainer;
    private string $creator;

    public function __construct($id, $day, $start, $end, $trainer, $max_capacity, $attendants, $creator)
    {
        parent::__construct($id, $start, $end, $max_capacity, $attendants);
        $this->day = $day;
        $this->trainer = $trainer;
        $this->creator = $creator;
    }

    public static function load_session(array $json): OnetimeSession
    {
        $attendants = [];

        foreach ($json["attendants"] as $name) {
            $attendants[] = $name;
        }
        return new OnetimeSession(
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

    public static function load_onetime_sessions_array($filename): array
    {
        return parent::load_sessions_array($filename, '\OnetimeSession::load_session');
    }

    public function is_overlapping(OnetimeSession $session): bool
    {
        if ($this->day == $session->day) {
            if ($this->start < $session->end && $this->end > $session->start) {
                return true;
            }
        }
        return false;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'day' => $this->day,
            'start' => $this->start,
            'end' => $this->end,
            'trainer' => $this->trainer,
            'max_capacity' => $this->max_capacity,
            'attendants' => $this->attendants,
            'creator' => $this->creator,
        ];
    }

    public function getDay()
    {
        return $this->day;
    }

    public function get_day_in_week(): int
    {
        return date('N', strtotime($this->day)) - 1;
    }
}