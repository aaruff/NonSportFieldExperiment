<?php namespace SportExperiment\Model\Eloquent;

class UserRole
{
    public static $RESEARCHER = 1;
    public static $SUBJECT = 2;

    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
}

