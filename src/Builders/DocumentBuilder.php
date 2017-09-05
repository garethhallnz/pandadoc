<?php

namespace PandaDoc\Entity;

/**
 * Class DocumentBuilder
 *
 * @package PandaDoc\Builders
 */
class DocumentBuilder
{
    protected $name;
    protected $recipients;
    protected $tokens;
    protected $fields;
    protected $template_uuid;
    protected $meta;
    protected $file;

    /**
     * DocumentBuilder constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->recipients = [];
    }

    /**
     * Get document data for API request.
     *
     * @return array
     */
    public function getData()
    {

        $data = [
            'name' => $this->name,
            'recipients' => $this->recipients,
        ];

        if (!empty($this->template_uuid)) {
            $data['template_uuid'] = $this->template_uuid;
        }

        if (!empty($this->file)) {
            $data['file'] = $this->file;
        }

        if (!empty($this->fields)) {
            $data['fields'] = $this->fields;
        }

        if (!empty($this->meta)) {
            $data['meta'] = $this->meta;
        }

        if (!empty($this->tokens)) {
            $data['tokens'] = $this->tokens;
        }

        return $data;
    }

    /**
     * Add recipient to document.
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $role
     */
    public function addRecipient($first_name, $last_name, $email, $role = 'Client')
    {
        $this->recipients[] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'role' => $role,
        ];
    }

    /**
     * Add field to document.
     *
     * @param $field_name
     * @param $field_value
     */
    public function addField($field_name, $field_value)
    {
        $this->fields[$field_name]['value'] = $field_value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param mixed $tokens
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @return mixed
     */
    public function getTemplateUuid()
    {
        return $this->template_uuid;
    }

    /**
     * @param mixed $template_uuid
     */
    public function setTemplateUuid($template_uuid)
    {
        $this->template_uuid = $template_uuid;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}
