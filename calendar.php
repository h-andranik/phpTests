<?php

/**
 * Class calendar
 */
class calendar 
{
    const YEAR_MONTHS_CNT = 13;
    const MONTH_DAYS      = 21;
    const LEEP            = 5;
    const WEEK_DAYS_CNT   = 7;
    const START_DATE      = '1.1.1990';
    const WEEK_DAYS       = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    
    /**
     * @var float|int $startDay
     */
    private $startDay;
    
    public function __construct()
    {
        $this->startDay = $this->get_days(self::START_DATE);
    }
    
    /**
     * @param $date
     */
    public function show_day($date)
    {
        $daysNum = ($this->startDay - $this->get_days($date)) % self::WEEK_DAYS_CNT;
        $index   = ($daysNum > 0) ? self::WEEK_DAYS_CNT - $daysNum : abs($daysNum);

        echo $date . " is " . self::WEEK_DAYS[$index] . "<hr>";
    }
    
    /**
     * @param $day
     * @return float|int
     */
    private function get_days($day)
    {
        $arr   = explode('.', $day);
        $day   = $arr[0];
        $month = (int)$arr[1] - 1;
        $year  = (int)$arr[2] - 1;

        return $this->get_year_days($year) + $this->get_month_days($month) + $day;
    }
    
    /**
     * @param $year
     * @return float|int
     */
    private function get_year_days($year)
    {
        return $year * self::YEAR_MONTHS_CNT * self::MONTH_DAYS + $year * ceil(self::YEAR_MONTHS_CNT / 2) - floor(($year) / self::LEEP);
    }
    
    /**
     * @param $month
     * @return float|int
     */
    private function get_month_days($month)
    {
         return $month * self::MONTH_DAYS + ceil($month / 2);
    }
}

$calendar = new calendar();
$dates    = ['15.13.1989', '16.13.1989', '17.13.1989', '18.13.1989', '19.13.1989', '20.13.1989', '21.13.1989', '22.13.1989', '1.1.1990', '2.1.1990', '3.1.1990', '8.1.1990', '17.11.2013'];

foreach ($dates as $date) {
    $calendar->show_day($date);
}