<?php
class Errors extends CI_Controller
{
    public function page_missing()
    {
        $data['heading'] = "Page not found";
        $data['message'] = "There isnt any page by this adress, please try another";
        $this->load->view('errors/html/error_404.php', $data);
    }
}