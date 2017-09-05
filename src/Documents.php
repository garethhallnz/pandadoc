<?php
declare(strict_types=1);

namespace PandaDoc;

use PandaDoc\Entity\DocumentBuilder;

/**
 * Class Documents.
 *
 * @package PandaDoc
 */
class Documents extends PandaDoc
{
    /**
     * REST resource.
     */
    const RESOURCE = '/documents';

    /**
     * List Documents.
     *
     * @param array $filters
     *  An associative array of additional options and may contain the following elements.
     *  - 'q': (string) Optional search query. Filter by document reference number or name.
     *  - 'tag': (string) Optional search tag. Filter by document tag.
     *  - 'count': (int) Optionally specify how many document results to return.
     *  - 'page': (int) Optionally specify which page of the dataset to return.
     *  - 'metadata': (string) Optionally specify metadata to filter by in the format
     *    of metadata_{metadata-key}={metadata-value} The metadata_ prefix is always required.
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#list-documents
     */
    public function list(array $filters = []): \stdClass
    {
        return $this->request('GET', self::RESOURCE, $filters);
    }

    /**
     * Document Details.
     *
     * @param string $id
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#document-details
     */
    public function details(string $id): \stdClass
    {
        return $this->request('GET', self::RESOURCE . "/{$id}/details");
    }

    /**
     * Document Status.
     *
     * @param string $id
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#document-status
     */
    public function status(string $id): \stdClass
    {
        return $this->request('GET', self::RESOURCE . "/{$id}");
    }

    /**
     * Download Document.
     *
     * @param string $id
     * @param string $destination
     *
     * @see Documents::document()
     * @see https://developers.pandadoc.com/v1/reference#download-document
     */
    public function download(string $id, string $destination)
    {
        $document = $this->details($id);

        $path = "{$destination}/{$document->name}.pdf";

        $this->request('GET', self::RESOURCE . "/{$id}/download", ['sink' => $path]);
    }

    /**
     * Create Document From a Template.
     *
     * @param \PandaDoc\Entity\DocumentBuilder $document
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#new-document
     */
    public function createFromTemplate(DocumentBuilder $document): \stdClass
    {
        return $this->request('POST', self::RESOURCE, ['json' => $document->getData()]);
    }

    /**
     * Create Document From a Pdf.
     *
     * @param \PandaDoc\Entity\DocumentBuilder $document
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#new-document
     */
    public function createFromPdf(DocumentBuilder $document): \stdClass
    {
        // @todo
    }


    /**
     * Send Document.
     *
     * @param string $id
     * @param string $message
     * @param bool $silent
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#send-document
     */
    public function send(string $id, string $message, $silent = false): \stdClass
    {
        return $this->request(
            'POST',
            self::RESOURCE . "/{$id}/send",
            [
            'json' => [
              'message' => $message,
              'silent' => $silent,
            ]
            ]
        );
    }

    /**
     * Create a Document Link.
     *
     * @param string $id
     * @param string $recipient
     * @param $lifetime
     *
     * @return \stdClass
     *
     * @see https://developers.pandadoc.com/v1/reference#link-to-a-document
     */
    public function share(string $id, string $recipient, $lifetime): \stdClass
    {
        return $this->request(
            'POST',
            self::RESOURCE . "/{$id}/session",
            [
            'json' => [
              'recipient' => $recipient,
              'lifetime' => $lifetime,
            ]
            ]
        );
    }
}
