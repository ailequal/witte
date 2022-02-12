<?php

namespace Ailequal\Plugins\Witte\Models;

use Ailequal\Plugins\Witte\Utilities\Log;

/**
 * The ExecutionTime plugin class.
 * This class will log the execution time for a specific part of the code.
 */
class ExecutionTime
{

    // TODO: Use debug_backtrace() to also log the last function/method that called this class.

    /**
     * The start time of the execution.
     *
     * @var float $startTime
     */
    protected $startTime = 0;

    /**
     * The end time of the execution.
     *
     * @var float $endTime
     */
    protected $endTime = 0;

    /**
     * The log instance.
     *
     * @var null|Log
     */
    protected $log = null;

    /**
     * ExecutionTime constructor.
     *
     * @param  null  $log
     */
    public function __construct($log = null)
    {
        if (true == is_null($log) || false == is_a($log, '\Ailequal\Plugins\Witte\Utilities\Log'))
            return;

        $this->log = $log;
    }

    /**
     * Log the start time execution.
     */
    public function start()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Log the end time execution.
     */
    public function end()
    {
        $this->endTime = microtime(true);
    }

    /**
     * Get the calculated run time (optionally formatted).
     * It will be optionally logged into a file.
     *
     * @param  bool  $format
     * @param  bool  $log
     *
     * @return string
     */
    public function getRunTime($format = false, $log = false)
    {
        $runTime = number_format($this->endTime - $this->startTime, 10);
        if (true == $format)
            $runTime = "This process took ".$runTime." to complete.";

        if (true == $log && true == is_a($this->log, '\Ailequal\Plugins\Witte\Utilities\Log'))
            $this->log->log(['runTime' => $runTime]);

        return $runTime;
    }

}
