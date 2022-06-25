<?php

namespace App\App\Controller;

class Response {
    private Array $rawOutput;
    private String $jsonOutput;
    private int $httpCode;
    private Array $headers;
    
    public function __construct(Array $output) {
        $this->rawOutput = $output;
        $this->jsonOutput = json_encode($output,1);

        $funcNum = func_num_args();

        if ($funcNum > 1) {
            $this->httpCode = func_get_arg(1);
        } else {
            $this->httpCode = 200;
        }

        //add default headers
        $headers = array();
        $headers['Content-type'] = 'application/json';
        $headers['Access-Control-Allow-Origin'] = '*';

        $this->headers = $headers;
    }

    public function setHeader(String $headerName, String $headerContent) : Void {
        $this->headers[$headerName] = $headerContent;
    }

    public function __toString() : String {
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $content) {
            $createdHeader = $key.': '.$content;
            header($createdHeader);
        }
        return $this->jsonOutput;
    }
}