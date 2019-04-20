<?php declare(strict_types=1);

namespace App\Exceptions\NotFound;


use Doctrine\ORM\EntityNotFoundException;

/**
 * TrackObjectTypeNotFound
 *
 * @package App\Services\EntityServices
 */
class TrackObjectTypeNotFoundException extends EntityNotFoundException
{
}
