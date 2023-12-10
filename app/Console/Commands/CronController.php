<?php

use Illuminate\Console\Command;
use App\Http\Controllers\HelperTrait;

class CronController extends Command
{
    use HelperTrait;

    public function checkExpiringTasks()
    {
        $this->checkTasks();
    }

    public function checkAntiVir()
    {
        $this->checkVir();
    }

    public function backupSql()
    {
        $this->sqlDump();
    }
}