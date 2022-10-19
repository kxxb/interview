<?php


class XMLHttpService extends XMLHTTPRequestService {}

class Http {
    private $service;

    /**
     * Наверное тут лучше от общего предка наследоваться в этом конструкторе
     * @param   XMLHTTPRequestService  $xmlHttpService
     */
    public function __construct(XMLHTTPRequestService $xmlHttpService) { }

    public function get(string $url, array $options) {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url) {
        $this->service->request($url, 'POST');
    }
}
