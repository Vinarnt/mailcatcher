<?php

namespace Alex\MailCatcher;

class Person
{
    protected $name;
    protected $email;

    /**
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        $this->name  = null === $name  ? null : (string) $name;
        $this->email = null === $email ? null : (string) $email;
    }

    /**
     * @param $text
     *
     * @return bool
     */
    public function match($text)
    {
        if ($this->name) {
            return false !== strpos($this->name, $text);
        } else if ($this->email) {
            return false !== strpos($this->email, $text);
        }

        return false;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Person $person
     *
     * @return bool
     */
    public function equals(Person $person)
    {
        return $person->getName() === $this->name && $person->getEmail() === $this->email;
    }

    /**
     * @param $string
     *
     * @return Person
     */
    public static function createFromString($string)
    {
        if (preg_match('/^(?:(.+) )?<(.+)>$/', $string, $vars)) {
            $name  = $vars[1] === '' ? null : $vars[1];
            $email = $vars[2] === '' ? null : $vars[2];
            return new Person($name, $email);
        }

        throw new \InvalidArgumentException(sprintf('Unable to parse Person "%s".', $string));
    }
}
