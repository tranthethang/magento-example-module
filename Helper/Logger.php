<?php

namespace Gentoma\Helpdesk\Helper;

use \Zend\Log\Writer\Stream;
use \Zend\Log\Logger as Zend_Logger;

class Logger
{
    const PATH = BP . '/app/code/Gentoma/Helpdesk/log/%s.log';

    public static function log($message, $type = 'exception')
    {
        if (empty($message)) {
            return;
        }
        
        $writer = new Stream(sprintf(self::PATH, $type));
        $logger = new Zend_Logger();
        $logger->addWriter($writer);
        $logger->info($message);
    }
}
