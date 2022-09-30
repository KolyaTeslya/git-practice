<?php

class Weather
{

    public function getWeather($url, $options){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($options));

        $response = curl_exec($ch);
        $data = json_decode($response, true);
        curl_close($ch);

        echo '<pre>';
        return $data;
    }
}