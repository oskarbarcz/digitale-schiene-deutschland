<?php declare(strict_types=1);

namespace App\Controller\Abstracts;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * AbstractValidatorFOSRestController
 *
 * @package App\Controller\Abstracts
 */
class AbstractValidatorFOSRestController extends AbstractFOSRestController
{
    /** @var ValidatorInterface */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param        $object
     * @return array
     */
    protected function validate($object): array
    {
        $errors = $this->validator->validate($object);
        if (count($errors) === 0) {
            return [];
        }

        $textErrors = [];
        foreach ($errors as $error) {
            $textErrors[] = $error->getMessage();
        }
        return [
            'code'    => 400,
            'message' => 'Bad request',
            'errors'  => $textErrors,
        ];
    }
}
