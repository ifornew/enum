<?php

namespace Iwannamaybe\Enum\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnumValue implements Rule
{
	private $validValues;

	/**
	 * Create a new rule instance.
	 */
	public function __construct(string $enum)
	{
		$this->validValues = $enum::getCollection();
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param string $attribute
	 * @param mixed  $value
	 *
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		return $this->validValues->has($value);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return trans('validation.enum_value');
	}
}