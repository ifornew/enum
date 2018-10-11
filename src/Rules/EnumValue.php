<?php

namespace Iwannamaybe\Enum\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Rule:EnumValue
 * @package Iwannamaybe\Enum\Rules
 */
class EnumValue implements Rule
{
	/**
	 * @var \Illuminate\Support\Collection $validValues
	 */
	private $validValues;

	/**
	 * EnumValue constructor.
	 * @param string $enum
	 * @param array|\Illuminate\Support\Collection|null   $excepts
	 */
	public function __construct(string $enum,$excepts=null)
	{
		$this->validValues = $enum::getCollection();
		if($excepts!=null){
			$this->validValues=$this->validValues->except($excepts);
		}
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