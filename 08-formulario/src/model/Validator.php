<?php

namespace Vidamrr\Formulario\model;

class Validator
{

    private array $result = [];

    public function __construct(private $value)
    {
        error_log($value);
    }

    public function isEmail()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->includeValidationError("Email not valid");
        }
        return $this;
    }

    public function minLen($n)
    {
        if (is_array($this->value)) {
            if (count($this->value) < $n) {
                $this->includeValidationError("Not minimum length");
            }
        } else {
            if (strlen((string)$this->value) < $n) {
                $this->includeValidationError("Not minimum length");
            }
        }
        return $this;
    }

    public function isNumber()
    {
        if (!is_numeric($this->value)) {
            $this->includeValidationError("Not a number");
        }
        return $this;
    }

    public function isUrl()
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->value)) {
            $this->includeValidationError("Not a URL");
        }
        return $this;
    }

    public function contains(array $options)
    {
        $contains = false;
        if (!is_array($options)) {
            throw 'Options is not an array';
            return $this;
        }

        foreach ($options as $option) {
            if (str_contains($this->value, $option)) {
                $contains = true;
                break;
            }
        }

        if (!$contains) {
            $this->includeValidationError("{$this->value} is not present");
        }

        return $this;
    }

    public function isDate()
    {
        if (!strtotime($this->value)) {
            $this->includeValidationError("{$this->value} is not a date");
        }
        return $this;
    }

    public function latestDate($date)
    {
        $d1 = strtotime($this->value);
        $d2 = strtotime($date);



        if ($d1 && $d2) {
            if ($d1 < $d2) {
                $this->includeValidationError("{$this->d1} is not the latest");
            }
        } else {
            $this->includeValidationError("Input is not a date");
        }
    }

    public function olderDate($date)
    {
        $d1 = strtotime($this->value);
        $d2 = strtotime($date);



        if ($d1 && $d2) {
            if ($d1 > $d2) {
                $this->includeValidationError("{$this->d1} is not older");
            }
        } else {
            $this->includeValidationError("Input is not a date");
        }
    }

    public function getErrors()
    {
        return $this->result;
    }

    private function includeValidationError($text)
    {
        array_push($this->result, ['validation' => $text]);
    }
}
