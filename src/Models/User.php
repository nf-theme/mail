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
     * [$from description]
     * @var string
     */
    protected $from = '';

    /**
     * [$to description]
     * @var string
     */
    protected $to = '';

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
     * [setFrom description]
     * @param String $email [set user email]
     */
    public function setFrom($from_email)
    {
        $this->from = $from_email;
        return $this;
    }

    /**
     * [setTo description]
     * @param String $email [set user email]
     */
    public function setTo($to_email)
    {
        $this->to = $to_email;
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
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * [getTo description]
     * @return string [description]
     */
    public function getTo()
    {
        return $this->to;
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
            'name'    => $this->getName(),
            'from'    => $this->getFrom(),
            'to'      => $this->getTo(),
            'subject' => $this->getSubject(),
            'params'  => $this->getParams(),
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
