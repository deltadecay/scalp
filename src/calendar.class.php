<?php

namespace scalp;

class Calendar
{
    protected $countrycode;
    protected $opening_time;
    protected $closing_time;

    protected $has_lunch_break = false;
    protected $lunch_start = '12:00';
    protected $lunch_end = '13:00';
    protected $timezone = 'UTC';

    protected $market_closed = [];
    protected $market_halfday = [];


    public function __construct($options = [])
    {   
        foreach($options as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function addClosedDay($date, $reason = "")
    {
        $this->market_closed[$date] = $reason;
    }

    public function addHalfDay($date, $closing_time = "13:00")
    {
        $this->market_halfday[$date] = $closing_time;
    }

    public function isMarkedClosed($ts, $check_time = false)
    {
        if(\is_string($ts))
        {
            $ts = strtotime($ts);
        }   
        $weekday = (int)date('N', $ts);
        if($weekday == 6 || $weekday == 7) {
            // Weekends are closed
            return true;
        }

        if($check_time)
        {
            $time = date("H:i:s", $ts);
            if($this->has_lunch_break)
            {
                if($time >= $this->lunch_start && $time < $this->lunch_end)
                {
                    // Market is closed during lunch break
                    return true;
                }
            }
            
            if($time < $this->getOpeningTime($ts) || $time >= $this->getClosingTime($ts))
            {
                // Market is closed outside of opening hours
                return true;
            }
        }

        $ymd = date("Y-m-d", $ts);
        return isset($this->market_closed[$ymd]);
    }

    public function isHalfDay($ts)
    {
        if(\is_string($ts))
        {
            $ts = strtotime($ts);
        }   
        $ymd = date("Y-m-d", $ts);
        // Half days
        return isset($this->market_halfday[$ymd]);
    }

    public function getOpeningTime($ts)
    {
        if(\is_string($ts))
        {
            $ts = strtotime($ts);
        }  
        if($this->isMarkedClosed($ts))
        {
            return null;
        }
        return $this->opening_time;
    }

    public function getClosingTime($ts)
    {
        if(\is_string($ts))
        {
            $ts = strtotime($ts);
        }  
        if($this->isMarkedClosed($ts))
        {
            return null;
        }
        if($this->isHalfDay($ts))
        {
            $ymd = date("Y-m-d", $ts);
            return $this->market_halfday[$ymd];
        }
        return $this->closing_time;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

}


