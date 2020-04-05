<?php

namespace YouTube;

class YoutubeStreamer
{
    // 4096
    protected $buffer_size = 256 * 1024;

    protected $headers = array();
    protected $headers_sent = false;

    protected $debug = false;

    protected function sendHeader($header)
    {
        if ($this->debug) {
            var_dump($header);
        } else {
            header($header);
        }
    }

    public function headerCallback($ch, $data)
    {
        // this should be first line
        if (preg_match('/HTTP\/[\d.]+\s*(\d+)/', $data, $matches)) {
            $status_code = $matches[1];

            // if Forbidden or Not Found -> those are "valid" statuses too
            if ($status_code == 200 || $status_code == 206 || $status_code == 403 || $status_code == 404) {
                $this->headers_sent = true;
                $this->sendHeader(rtrim($data));
            }

        } else {

            // only headers we wish to forward back to the client
            $forward = array('content-type', 'content-length', 'accept-ranges', 'content-range');

            $parts = explode(':', $data, 2);

            if ($this->headers_sent && count($parts) == 2 && in_array(trim(strtolower($parts[0])), $forward)) {
                $this->sendHeader(rtrim($data));
            }
        }

        return strlen($data);
    }

    public function bodyCallback($ch, $data)
    {
        if (true) {
            echo $data;
            flush();
        }

        return strlen($data);
    }

    public function stream($url)
    {
        $ch = curl_init();

        $headers = array();
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0';

        if (isset($_SERVER['HTTP_RANGE'])) {
            $headers[] = 'Range: ' . $_SERVER['HTTP_RANGE'];
        }

        // otherwise you get weird "OpenSSL SSL_read: No error"
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_BUFFERSIZE, $this->buffer_size);
        curl_setopt($ch, CURLOPT_URL, $url);

        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        // we deal with this ourselves
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_HEADERFUNCTION, [$this, 'headerCallback']);

        // if response is empty - this never gets called
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, [$this, 'bodyCallback']);

        $ret = curl_exec($ch);

        // TODO: $this->logError($ch);
        $error = ($ret === false) ? sprintf('curl error: %s, num: %s', curl_error($ch), curl_errno($ch)) : null;

        curl_close($ch);

        // if we are still here by now, then all must be okay
        return true;
    }
}
