<?php
/**
 * Created by PhpStorm.
 * User: delimce
 * Date: 09/02/2015
 * Time: 09:50 PM
 */
require_once(__DIR__ . "/log4php/Logger.php");

class Log extends Logger
{

    private $configPath;
    private $log;
    private $customLogLevel = '';

    public function __construct($logname = false)
    {

        $currentLog = (!$logname) ? "default" : $logname;
        $configPath = __DIR__ . '/../../config/logConfig.xml';
        Logger::configure($configPath);
        $this->log = Logger::getLogger($currentLog);
    }


    /**
     * @param mixed $message
     */
    public function trace($message)
    {
        $this->log->trace($message);
    }

    /**
     * @param mixed $message
     */
    public function debug($message)
    {
        $this->log->debug($message);
    }

    /**
     * @param mixed $message
     */
    public function info($message)
    {
        $this->log->info($message);
    }

    /**
     * @param mixed $message
     */
    public function warn($message)
    {
        $this->log->warn($message);
    }

    /**
     * @param mixed $message
     */
    public function error($message)
    {
        $this->log->error($message);
    }

    /**
     * @param mixed $message
     */
    public function fatal($message)
    {
        $this->log->fatal($message);
    }

    /**
     * @param string $customLogLevel
     */
    public function setCustomLogLevel($customLogLevel)
    {
        $this->customLogLevel = $customLogLevel;
    }


    /**registra el error segun la variable customLogLevel
     * @param $message
     */
    public function customLog($message)
    {


        switch (strtoupper($this->customLogLevel)) { ////verifica el nivel del log
            case "TRACE":
                $this->log->trace($message);
                break;

            case "DEBUG":
                $this->log->debug($message);
                break;
            case "WARN":
                $this->log->warn($message);
                break;
            case "ERROR":
                $this->log->error($message);
                break;

            default:
                $this->log->info($message);
                breake;
        }

    }


}