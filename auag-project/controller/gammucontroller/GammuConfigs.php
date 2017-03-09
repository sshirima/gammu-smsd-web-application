<?php

class GammuConfig{
    public static $GAMMU_DIR = '/usr/bin/gammu ';
}

class SmsdConfig {
    
    public static $command_getPID = 'pidof';
    public static $command_Pause = 'sudo kill -SIGUSR1';
    public static $command_Resume = 'sudo kill -SIGUSR2';
    public static $GAMMU_SMSD_DIR = '/usr/bin/gammu-smsd ';
    
}

