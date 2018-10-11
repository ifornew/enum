<?php

namespace Iwannamaybe\Enum\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Rule:EnumKey
 * @package Iwannamaybe\Enum\Rules
 */
class EnumKey implements Rule
{
	/**
	 * @var array $validValues
	 */
	private $validValues;

	/**
	 * 大小写敏感
	 * @var boolean $isCaseSensitive
	 */
	private $isCaseSensitive;

	/**
	 * EnumValue constructor.
	 * @param string                                    $enum
	 * @param boolean                                   $isCaseSensitive
	 * @param array|\Illuminate\Support\Collection|null $excepts
	 */
	public function __construct(string $enum, $excepts = null, bool $isCaseSensitive = false)
	{
		$this->validValues = $enum::members();
		if ($excepts != null) {
			$this->validValues = array_except($this->validValues, $excepts);
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
		if (!$this->isCaseSensitive) {
			$value = strtoupper($value);
		}
		return array_has($this->validValues, $value);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return trans('validation.enum_key');
	}
}