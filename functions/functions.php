<?php

/*************helper functions***************/

function clean($string)
{

    return htmlentities($string);
}

function redirect($location)
{

    return header("Location: {$location}");
}


//function to retrieve all brands of registered and active devices
function getDeviceBrand()
{

    $sql  = "SELECT * FROM device_prices WHERE status='1' AND SLD>0 AND (device_type='android' OR device_type='ios') GROUP BY device_manufacturer ORDER BY device_manufacturer ASC";
    $res  = query($sql, 'android');

    if (row_count($res) == "" || row_count($res) == null) {

        redirect("./register");

        die();
    } else {
        $deviceBrands = [];
        while ($row = fetch_array($res)) {
            $deviceBrands[] = $row['device_manufacturer'];
        }
        return $deviceBrands;
    }
}


function getDeviceName($brand)
{
    $sql = "SELECT * FROM device_prices WHERE device_manufacturer='$brand' AND status='1' AND SLD>0 AND (device_type='android' OR device_type='ios') ORDER BY device_name ASC";
    $res = query($sql, 'android');

    if (row_count($res) == "" || row_count($res) == null) {

        redirect("./register");

        die();
    } else {
        $deviceNames = [];
        while ($row = fetch_array($res)) {
            $deviceNames[] = $row['device_name'];
        }
        return $deviceNames;
    }
}
