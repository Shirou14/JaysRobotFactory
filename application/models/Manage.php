<?php

class manage extends CI_Model
{
    function reboot()
    {
        //this is the function that will send a request to the server and get a response for reboot
    }

    function register()
    {
        //this function is to check and submit the registration form on the manage page to the PRC servers
        $this->load->helper(['html', 'form']);

        //simple form, all it requires is our team name and our secret token
        $former = form_open('manage/handle_form');
        $former .= form_label("Team Name:"); 
        $former .= form_input(['name' => 'name']) . br();
        $former .= form_label("Secret Access Token:");
        $former .= form_input(['token' => 'token']).br();
        $former = form_close();

        $parse = array
        (
            'heading' => heading('Server Login'),
            'theform' => $former
        );
        $this->parser->parse("manage", $parse);
    }

    function handle_form()
    {
        
    }
}

