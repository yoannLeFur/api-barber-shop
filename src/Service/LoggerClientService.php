<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service;

use Psr\Log\LoggerInterface;

class LoggerClientService
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LoggerClientService constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $error
     */
    public function logError(string $message, $error = [])
    {
        $this->logger->error((string) $message, $error);
    }
}
