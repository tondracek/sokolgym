<?php

class RegularSessions extends Session
{
    private array $days;
    private string $last_updated;

    public function __construct($id, $days, $start, $end, $max_capacity, $attendants, $last_updated)
    {
        parent::__construct($id, $start, $end, $max_capacity, $attendants);
        $this->days = $days;
        $this->last_updated = $last_updated;
    }

    private static function load_session($json): RegularSessions
    {
        $attendants = [];
        foreach ($json["attendants"] as $name) {
            $attendants[] = $name;
        }
        return new RegularSessions(
            $json["id"],
            $json["days"],
            $json["start"],
            $json["end"],
            $json["max_capacity"],
            $attendants,
            $json["last_updated"]
        );
    }

    public static function load_regular_sessions_array($filename): array
    {
        return parent::load_sessions_array($filename, '\RegularSessions::load_session');
    }

    public function is_overlapping(OnetimeSession $session): bool
    {
        if (in_array($session->get_day_in_week(), $this->days)) {
            if ($this->start < $session->end && $this->end > $session->start) {
                return true;
            }
        }
        return false;
    }

    public function getDay(): string
    {
        $days_in_week = [" Po", " Út", " St", " Čt", " Pá", " So", " Ne"];

        return $days_in_week[date("N") - 1];
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'day' => $this->days,
            'start' => $this->start,
            'end' => $this->end,
            'max_capacity' => $this->max_capacity,
            'attendants' => $this->attendants,
            'creator' => $this->last_updated,
        ];
    }
}