<?php
declare(strict_types=1);

namespace PandaDoc;

/**
 * Class Documents.
 *
 * @package PandaDoc
 */
class Templates extends PandaDoc
{
    /**
     * REST resource.
     */
    const RESOURCE = '/templates';

    /**
     * List Templates.
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#list-templates
     */
    public function list(): \stdClass
    {
        return $this->request('GET', self::RESOURCE);
    }

    /**
     * Template Details.
     *
     * @param string $id
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#template-details
     */
    public function details(string $id): \stdClass
    {
        return $this->request('GET', self::RESOURCE . "/{$id}/details");
    }
}
