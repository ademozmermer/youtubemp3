<?php

namespace AdemOzmermer\Interfaces;

interface VideoInterface
{
    /**
     * Set video url
     *
     * @param $url
     * @return $this
     */
    public function url($url): self;

    /**
     * Get video url
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * @todo Get video title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * @todo Get video thumb image
     *
     * @return string|null
     */
    public function getImage(): ?string;
}