<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dompdf_test extends CI_Controller {
 
    /**
     * Example: DOMPDF 
     *
     * Documentation: 
     * http://code.google.com/p/dompdf/wiki/Usage
     *
     */
    public function index() {   
        // Load all views as normal
        $this->load->view('login');
        // Get output html
        $html = $this->output->get_output();
         
        // Load library
        $this->load->library('dompdf_gen');
         
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf",array('Attachment'=>0));
        //or without preview in browser
        //$this->dompdf->stream("welcome.pdf");
    }
}