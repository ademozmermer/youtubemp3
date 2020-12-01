<?php

namespace AdemOzmermer;

use AdemOzmermer\Exceptions\ConverterException;

abstract class Converter
{
    /**
     * Audio formats
     */
    const MIMES = ['best', 'aac', 'flac', 'mp3', 'm4a', 'opus', 'vorbis', 'wav'];

    /**
     * @var string|null
     */
    private $_mime = null;

    /**
     * @var string|null
     */
    private $_proxy = null;

    /**
     * @var string|null
     */
    private $_limit = null;

    /** File extension to be converted
     *
     * @param string|null $mime
     * @return $this
     * @throws ConverterException
     */
    public function extension(?string $mime): self
    {
        if (!in_array($mime, self::MIMES)) {
            throw new ConverterException('Unsupported extension');
        }

        $this->_mime = $mime;

        return $this;
    }

    /**
     * Set proxy address
     * sample: 127.0.0.1:1234
     *
     * @param string $proxy
     * @return $this
     */
    public function proxy(string $proxy): self
    {
        $this->_proxy = ' --proxy ' . $proxy;

        return $this;
    }

    /**
     * Do not download any videos larger than SIZE
     * (e.g. 50k or 44.6m)
     *
     * @param string $limit
     * @return $this
     */
    public function limit(string $limit): self
    {
        $this->_limit = ' --max-filesize ' . $limit;

        return $this;
    }

    /**
     * Get extension file
     *
     * @return string|null
     */
    public function getExtension(): ?string
    {
        return $this->_mime;
    }

    /**
     * Get proxy address
     *
     * @return string|null
     */
    public function getProxy()
    {
        return $this->_proxy ?: null;
    }

    /**
     * Maximum download rate in bytes per second
     *
     * @return string|null
     */
    public function getLimit(): ?string
    {
        return $this->_limit;
    }


    /**
     * Convert and download file
     *
     * @param string $path
     */
    public function download(string $path): array
    {
        $descriptorspec = [
            0 => ['pipe', 'r'],  // stdin
            1 => ['pipe', 'w'],  // stdout
            2 => ['pipe', 'w'],  // stderr
        ];

        $string = __DIR__ . './bin/youtube-dl -x --audio-format '
            . $this->getExtension()
            . $this->getProxy()
            . $this->getLimit()
            . '  -o ' . escapeshellarg($path)
            . '/%(title)s.%(ext)s '
            . escapeshellarg($this->getUrl());

        $process = proc_open($string, $descriptorspec, $pipes);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        $ret = proc_close($process);

        return [
            'status' => $ret,
            'errors' => $stderr,
            'url_orginal' => $this->getUrl(),
            'output' => $stdout,
            'command' => $string
        ];
    }

}