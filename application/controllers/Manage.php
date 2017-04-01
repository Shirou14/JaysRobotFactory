<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application 
{
    function __construct()
    {
        parent::__construct();
    }

    /*
        this is the manage page for the robotfactory. 
        this page is meant to manage varous "boss" activities.
    */

    function index()
    {
        $this->data['pagebody'] = 'manage';
		$this->render();  
    }

    function reboot()
    {
        //this runs the reboot api, likely from the model
    }

    
}