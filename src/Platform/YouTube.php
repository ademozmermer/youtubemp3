<?php

namespace AdemOzmermer\Platform;

use AdemOzmermer\Converter;
use AdemOzmermer\Interfaces\VideoInterface;

class YouTube extends Converter implements VideoInterface
{
    private $_url;

    /**
     * @todo
     * @var null
     */
    private $_title = null;

    /**
     * @todo
     *
     * @var null
     */
    private $_image = null;

    /**
     * Video url
     *
     * @param $url
     * @return $this|VideoInterface
     */
    public function url($url): VideoInterface
    {
        $this->_url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_url;
    }

    /**
     * @todo Videonun başlğını getirme yapılacak
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->_title;
    }

    /**
     * @todo Videonun küçük resmini getirme yapılacak
     *
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->_image;
    }
}