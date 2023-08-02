<?php

class Booking
{

    public function get_all_by_date($date)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT tbl_bookings.*, tbl_daily_trains.*, tbl_bookings.id AS mainID
      FROM tbl_bookings
      INNER JOIN tbl_daily_trains ON tbl_bookings.daily_train_id = tbl_daily_trains.id
      WHERE tbl_daily_trains.`date` = '$date'";
        $result = $con->query($sql);
        return $result;
    }

    public function get_all_by_date2($date)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT tbl_bookings.*, tbl_daily_trains.*, tbl_bookings.id AS mainID
      FROM tbl_bookings
      INNER JOIN tbl_daily_trains ON tbl_bookings.daily_train_id = tbl_daily_trains.id
      WHERE tbl_daily_trains.`date` like '$date%'";
        $result = $con->query($sql);
        return $result;
    }


    public function get_all_by_temp($id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM temp_booking_details WHERE booking_id='$id'";
        $result = $con->query($sql);
        return $result;
    }

    public function customer($id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result = $con->query($sql);
        $row_data = $result->fetch_array();
        $name = $row_data['cus_name'];
        return $name;
    }


    public function count_all_month()
    {
        $con = $GLOBALS['con'];
        $month = date('Y-m');
        $sql = "SELECT SUM(total_payment) FROM tbl_bookings WHERE DATE_FORMAT(date, '%Y-%m') = '$month' AND payment_status = 'yes';";
        $result = $con->query($sql);
        $row_data = $result->fetch_array();
        $sum = $row_data[0];
        return $sum;
    }


    public function count_all()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT SUM(total_payment) FROM tbl_bookings WHERE payment_status='yes'";
        $result = $con->query($sql);
        $row_data = $result->fetch_array();
        $sum = $row_data[0];
        return $sum;
    }


    public function income_array()
    {
        $con = $GLOBALS['con'];
        $month = date('Y-m');
        $sal = [];

        for ($i = 1; $i < 13; $i++) {
            $expo_amt = 0;
            $sql_expo = "SELECT SUM(total_payment) FROM tbl_bookings WHERE  date LIKE '$month%' AND payment_status = 'yes'";
            $result_expo = $con->query($sql_expo);
            $row_expo = $result_expo->fetch_array();
            $expo_amt = $row_expo[0];
            $sal[] = $expo_amt;
        }


        return $sal;
    }
}
