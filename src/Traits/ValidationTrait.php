<?php

namespace Samsin33\Foundation\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Samsin33\Foundation\Models\BaseModel;

trait ValidationTrait
{
    //=============== return errors after validation ===================

    /**
     * @var MessageBag|null $errors
     */
    private ?MessageBag $errors = null;

    /**
     * @var array $validation_type
     */
    private array $validation_type = [];

    /**
     * @var bool $skip_validations
     */
    private bool $skip_validations = false;

    /**
     * @return array
     */
    protected function getValidationRules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getValidationMessages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getValidationType(): array
    {
        return $this->validation_type;
    }

    /**
     * @param string ...$value
     * @return array
     */
    public function setValidationType(string ...$value): array
    {
        foreach ($value as $val)
        {
            $this->validation_type[] = $val;
        }
        return $this->validation_type;
    }

    /**
     * @param string $val
     * @return bool
     */
    public function isValidationType(string $val): bool
    {
        return in_array($val, $this->validation_type);
    }

    /**
     * @param string ...$value
     * @return bool
     */
    public function removeValidationType(string ...$value): bool
    {
        foreach ($value as $val) {
            if (in_array($val, $this->validation_type)) {
                unset($this->validation_type[array_search($val, $this->validation_type)]);
            }
        }
        return true;
    }

    /**
     * @param $val
     * @return void
     */
    public function setSkipValidation($val): void
    {
        $this->skip_validations = $val;
    }

    /**
     * @return bool
     */
    public function getSkipValidation(): bool
    {
        return $this->skip_validations;
    }

    /**
     * @param array $arr
     * @return MessageBag
     */
    public function errors(array $arr = []): MessageBag
    {
        return $this->errors = $this->errors != null ? $this->errors : new MessageBag($arr);
    }

    /**
     * @param string|null $return_type
     * @return array
     */
    public function showErrors(string $return_type = null): array
    {
        if (empty($this->errors())) {
            $this->addError(new MessageBag(['error' => [
                    $return_type != null ? $return_type : 'Something went wrong.'
                ]
            ]));
        }
        return $this->errors()->toArray();
    }

    /**
     * @param MessageBag $messages
     * @return void
     */
    public function addError(MessageBag $messages): void
    {
        $this->errors()->merge($messages);
    }

    /**
     * Function to add other model object errors to this model object
     *
     * @param BaseModel $object
     * @return void
     **/
    public function addErrors(BaseModel $object): void
    {
        $this->addError($object->errors(['error' => ['Something went wrong.']]));
    }

    /**
     * @return bool
     */
    public function validateObject(): bool
    {
        $v = Validator::make($this->getAttributes(), $this->getValidationRules(), $this->getValidationMessages());
        if ($v->fails()) {
            // set errors and return false
            $this->addError($v->errors());
            return false;
        }
        // validation pass
        return true;
    }
}
