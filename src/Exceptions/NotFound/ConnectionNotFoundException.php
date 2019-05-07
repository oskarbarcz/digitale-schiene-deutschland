<?php declare(strict_types=1);

namespace App\Exceptions\NotFound;

use Doctrine\ORM\EntityNotFoundException;

/**
 * TrackObjectTypeNotFound
 *
 * @package App\Services\EntityServices
 */
class ConnectionNotFoundException extends EntityNotFoundException
{
    public const MESSAGE = 'connection.not-found';
}
