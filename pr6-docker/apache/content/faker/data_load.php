<?php

function get_raw_data(): array {
    $input = file_get_contents('results.json');
    # echo print_r(json_decode($input));
    return json_decode($input);
}

function get_temp_count($data): array
{
    $temp_count = array();
    foreach ($data as $row) {
        $temperature = number_format($row->temperature, 1, '.', '');
        if (!isset($temp_count[$temperature])) {
            $temp_count[$temperature] = 0;
        }
        $temp_count[$temperature] += 1;
    }
    return $temp_count;
}

function get_blood_type_count($data): array
{
    $blood_type_count = array();
    foreach ($data as $row) {
        $bloodType = $row->bloodType;
        if(!isset($blood_type_count[$bloodType])) {
            $blood_type_count[$bloodType] = 0;
        }
        $blood_type_count[$bloodType] += 1;
    }
    return $blood_type_count;
}

function get_month_count($data): array
{
    $count = array();
    foreach ($data as $row) {
        $value = $row->month;
        if(!isset($count[$value])) {
            $count[$value] = 0;
        }
        $count[$value] += 1;
    }
    return $count;
}

function get_day_blood_tuple(): array {
    $data = get_raw_data();
    $humidity_array = array();
    $time_array = array();
    $humidity_keys = array();
    $time_keys = array();
    foreach ($data as $row) {
        if (!in_array($row->humidity, $humidity_keys)) {
            $humidity_keys[] = $row->humidity;
        }
        if (!in_array($row->time, $time_keys)) {
            $time_keys[] =$row->time;
        }
    }
    $day_keys = array_flip($day_keys);
    $time_keys = array_flip($time_keys);
    foreach ($data as $row) {
        $day_array[] = $day_keys[$row->weekday];
        $blood_array[] = $time_keys[$row->bloodType];
    }
    return array(
        "day" => $day_array,
        "blood" => $blood_array,
        "day_keys" => array_values($day_keys),
        "blood_keys" => array_values($blood_keys)
    );
}

function get_labels_and_values($func) {
    $raw_data = get_raw_data();
    $day_count = $func($raw_data);
    $labels = array_keys($day_count);
    $values = array_values($day_count);
    return array("labels" => $labels, "values" => $values);
}