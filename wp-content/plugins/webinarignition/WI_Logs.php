<?php

/**
 * Created by PhpStorm.
 * User: CodeMonkey 1
 * Date: 04-02-2015
 * Time: 15:58
 */
class WI_Logs
{
    const NOTICE = 1;
    const LIVE_EMAIL = 2;
    const LIVE_SMS = 3;
    const AUTO_EMAIL = 4;
    const AUTO_SMS = 5;

    static $table_name = "wi_logs";
    static $per_page = 25;
    static $show_pages = 5;
    static $page = 0;
    static $number_of_rows = 0;
    static $total = 0;

    /**
     * @return int
     */
    public static function getPerPage()
    {
        return self::$per_page;
    }

    /**
     * @param int $per_page
     */
    public static function setPerPage($per_page)
    {
        self::$per_page = $per_page;
    }


    /**
     * @return int
     */
    public static function getShowPages()
    {
        return self::$show_pages;
    }

    /**
     * @param int $show_pages
     */
    public static function setShowPages($show_pages)
    {
        self::$show_pages = $show_pages;
    }

    /**
     * @return int
     */
    public static function getPage()
    {
        return self::$page;
    }

    /**
     * @param int $page
     */
    public static function setPage($page)
    {
        self::$page = $page;
    }

    /**
     * @return int
     */
    public static function getNumberOfRows()
    {
        return self::$number_of_rows;
    }

    /**
     * @param int $number_of_rows
     */
    public static function setNumberOfRows($number_of_rows)
    {
        self::$number_of_rows = $number_of_rows;
    }

    /**
     * @return int
     */
    public static function getTotal()
    {
        return self::$total;
    }

    /**
     * @param int $total
     */
    public static function setTotal($total)
    {
        self::$total = $total;
    }


    public static function add($message, $campaign_id = null, $type = self::NOTICE)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$table_name;

        $wpdb->insert($table, array('campaign_id' => $campaign_id, 'type' => $type, 'message' => $message));
    }

    public static function showType($type)
    {
        $types = array(
            self::NOTICE => "Notice",
            self::LIVE_EMAIL => "Live Email",
        );

        return $types[$type];
    }

    public static function getLogs($campaign_id, $type, $page = 0, $timezone = false, $orderby = 'date', $orderbydirection = 'ASC')
    {
        global $wpdb;
        $table = $wpdb->prefix . self::$table_name;
        if (is_array($type)) {
            $type = implode(' OR type = ', $type);
        }
        //echo "SELECT count(*) as total, date, message FROM $table WHERE campaign_id = $campaign_id AND type = $type ORDER BY $orderby $orderbydirection LIMIT $limit";
        $total = $wpdb->get_row("SELECT count(*) as total FROM $table WHERE campaign_id = $campaign_id AND type = $type");
        self::setTotal($total->total);

        $date_querystr = "date";
        if ($timezone) {
            $svr_tz = date_default_timezone_get();
            $svr_utc = date('P', time());
            date_default_timezone_set($timezone);
            $webinar_utc = date('P', time());
            date_default_timezone_set($svr_tz);
            $date_querystr = "CONVERT_TZ(date,'{$svr_utc}','{$webinar_utc}') as date";
        }

        self::setPage($page);

        $offset = ($page - 1) * self::$per_page;
        $logs = $wpdb->get_results("SELECT $date_querystr, message FROM $table WHERE campaign_id = $campaign_id AND type = $type ORDER BY $orderby $orderbydirection LIMIT {$offset}, " . self::getPerPage(), OBJECT);
        self::setNumberOfRows(count($logs));
        return $logs;
    }

    public static function pagination($campaign_id)
    {
//        "rows" => self::getNumberOfRows(),
//            "page" => self::getPage(),
//            "pages" => ceil(self::getTotal() / self::getPerPage()),
//            "total" => self::getTotal(),
//            "per_page" => self::getPerPage(),
//        );
        $number_of_pages_to_show = self::getShowPages();
        $current_page = self::getPage();
        $current_last_page = ceil(self::getTotal() / self::getPerPage());
        $per_page = self::getPerPage();
        $total_records = self::getTotal();

        $first_page = 1;
        $prev_page = $current_page - 1;
        $next_page = $current_page + 1;
        $last_page = $current_last_page;

        $first = $current_page == $first_page;
        $last = $current_page == $current_last_page;
        $first_record = $current_page * $per_page - $per_page + 1;
        $last_record = $current_page * $per_page;
        $range = $current_last_page >= $number_of_pages_to_show ? $number_of_pages_to_show : $current_last_page;
        $center = ceil($range / 2);
        $start_page = $current_page - $center;
        $last_page = $current_last_page - $range;
        $start_page = ($start_page <= 0 ? 0 : ($start_page >= $last_page ? $last_page : $start_page));

        if ($last_record > $total_records) {
            $last_record = $total_records;
        }

        ?>

        <div class="pagination clearfix">

                <a <?php if (!$first) { ?>class="paginate" page="<?php echo $first_page; ?>" <?php } ?>href="javascript:void(0);">First</a>
                <a <?php if (!$first) { ?>class="paginate" page="<?php echo $prev_page; ?>" <?php } ?>href="javascript:void(0);">«</a>
            <?php for ($i = $start_page + 1; $i <= $start_page + $range; $i++) {
                if ($current_page == $i) {
                    ?>
                    <strong><?php echo $i; ?></strong>
                <?php } else { ?>
                    <a class="paginate" page="<?php echo $i; ?>" href="javascript:void(0);"><?php echo $i; ?></a>
                <?php }
            }
            ?>

            <a <?php if (!$last) { ?>class="paginate" page="<?php echo $next_page; ?>" <?php } ?>href="javascript:void(0);">»</a>
            <a <?php if (!$last) { ?>class="paginate" page="<?php echo $current_last_page; ?>" <?php } ?>href="javascript:void(0);">Last</a>
        </div>

        <div style="margin: 10px 20px 0 0; padding: 0;">
            <span style="color: #444; font: 13px/1.7em Open Sans,trebuchet ms,arial,sans-serif;">
                <?php echo "Showing {$first_record} to {$last_record} of {$total_records} entries"; ?>
            </span>
        </div>

    <?php
    }
}
