<?php
namespace NF\Mail\Models;

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
     * [$cc description]
     * @var [type]
     */
    protected $cc = [];

    /**
     * [$bcc description]
     * @var [type]
     */
    protected $bcc = [];

    /**
     * [$subject description]
     * @var string
     */
    protected $subject = '';

    /**
     * [$domain description]
     * @var string
     */
    protected $domain = '';

    /**
     * [$app_id description]
     * @var [type]
     */
    protected $app_id;

    /**
     * [$user_id description]
     * @var [type]
     */
    protected $user_id;

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
     * [setDomain description]
     * @param [type] $domain [description]
     */
    public function setDomain($domain) {
        $this->domain = $domain;
        return $this;
    }

    /**
     * [setUserId description]
     * @param [type] $user_id [description]
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * [setAppId description]
     * @param [type] $app_id [description]
     */
    public function setAppId($app_id) {
        $this->app_id = $app_id;
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

    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
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

    public function getCc()
    {
        return $this->cc;
    }

    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * [getUserId description]
     * @return integer [description]
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * [getAppId description]
     * @return integer [description]
     */
    public function getAppId()
    {
        return $this->app_id;
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

    public function formatUser()
    {
        return [
            'name'    => $this->getName(),
            'email'      => $this->getTo()
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
