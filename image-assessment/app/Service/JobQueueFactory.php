<?php

namespace App\Service;

use Pheanstalk\Pheanstalk;

class JobQueueFactory
{
    private $host = 'localhost';
    private $port = '11300';

    const QUEUE_IMAGE_ANALYZE = 'analyze';

    public function createQueue(): Pheanstalk
    {
        return new Pheanstalk($this->host, $this->port);
    }
}
