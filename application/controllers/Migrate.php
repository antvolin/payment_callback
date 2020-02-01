<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function index($version): void
    {
        $this->load->library('migration');

        if (!$this->migration->version($version)) {
            show_error($this->migration->error_string());
        }
    }
}
