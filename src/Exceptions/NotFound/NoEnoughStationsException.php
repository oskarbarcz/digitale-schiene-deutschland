<?php declare(strict_types=1);

namespace App\Exceptions\NotFound;

use Doctrine\ORM\EntityNotFoundException;
use Exception;

/**
 * TrackObjectTypeNotFound
 *
 * @package App\Services\EntityServices
 */
class NoEnoughStationsException extends EntityNotFoundException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct(null, null, $previous);
    }
}
