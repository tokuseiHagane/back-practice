<?php

class IoTDataInstance
{
    public string $vin;
    public string $vout;
    public string $temperature;
    public string $pressure;
    public string $humidity;
    public string $soundLevel;

    /**
     * @param string $vin
     * @param string $vout
     * @param string $temperature
     * @param string $pressure
     * @param string $humidity
     * @param string $soundLevel
     */
    public function __construct(string $vin,
                                string $vout,
                                string $temperature,
                                string $pressure,
                                string $humidity,
                                string $soundLevel)
    {
        $this->vin = $vin;
        $this->vout = $vout;
        $this->temperature = $temperature;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->soundLevel = $soundLevel;
    }
}
