<?php
namespace Vicoders\Mail\Models;

/**
 *
 */
class User
{
    /**
     * [$name description]
     * @var [type]
     */
    protected $name = '';

    /**
     * [$email description]
     * @var [type]
     */
    protected $email = '';

    /**
     * [$subject description]
     * @var string
     */
    protected $subject = '';

    /**
     * [$params description]
     * @var array
     */
    protected $params;

    /**
     * [__construct description]
     */
    public function __construct()
    {}

    /**
     * [setName description]
     * @param String $name [set user name]
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * [setEmail description]
     * @param String $email [set user email]
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * [setParams description]
     * @param array $params [an array of parameters]
     */
    public function setParams($params = [])
    {
        $this->params = $params;
        return $this;
    }

    /**
     * [setParams description]
     * @param array $params [an array of parameters]
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * [getName description]
     * @return string [description]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * [getEmail description]
     * @return string [description]
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * [getParams description]
     * @return array [description]
     */
    public function getParams()
    {
        return $this->params;
    }

    public function toArray()
    {
        return [
            'name_signer' => $this->getName(),
            'email'       => $this->getEmail(),
            'subject'     => $this->getSubject(),
            'params'      => $this->getParams(),
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
