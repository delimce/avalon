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


}