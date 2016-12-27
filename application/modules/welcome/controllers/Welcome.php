<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    // languages
    private $languages = array(
        'en' => 'english',
        'sw' => 'swahili'
    );

    function __construct() {
        parent::__construct();

        // you might want to just autoload these two helpers
        $this->load->helper('language');
        $this->load->helper('url');

        if ($this->get_uri_lang() == 'en') {
            $this->lang->load("messages", "english");
        } else if ($this->get_uri_lang() == 'sw') {
            $this->lang->load("messages", "swahili");
        } else {
            $this->lang->load("messages", "english");
            $this->lang->load("messages", "english");
        }
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function about_us() {
        $this->load->view('about_us');
    }

    private function get_uri_lang() {
        $result = $this->uri->segment(1);

        if (array_key_exists($result, $this->languages)) {
            return $result;
        }
    }

}
