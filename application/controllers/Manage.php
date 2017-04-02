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
        //$this->data['registerform'] = 'Manage/register';
        $this->load->model('Register');
        
        $form = $this->Register->makeForm();
       // $this->_registerForm->data['header'] = $form->header;
        //$this->data['registerForm'] = $this->load->view('_registerForm');//$this->_registerForm;
        //$this->Register->makeForm();
        //$theform = $this->parser->parse("_registerForm", $form['theform']);
        $this->data['header'] = $form['heading'];
        $this->data['teamname'] = $form['teamname'];
        $this->data['secrettoken'] = $form['secrettoken'];
        $this->data['submit'] = $form['submit'];
        $this->data['pagebody'] = 'manage';
		$this->render();  
    }

    function reboot()
    {
        //this runs the reboot api, likely from the model
    }

    function register()
    {

        //here we're trying to connect to the server by obtaining login info
        if(isset($_POST['name']) && isset($_POST['token']))
        {
            $server = $this->data['umbrella'] . '/work/registerme';
            //this is where we pull the login info and send it to the server for a response
            $result = file_get_contents($server . '/' . $_POST['name']. '/' . $_POST['token']);
            $this->data['result'] = $result;

            //here we want to deal with the registration response
            if(substr($result, 0, 2) == 'Ok')//obviously this means good things for us
            {
                $key = substr($result, 3);//I keep spelling result wrong what is my problem XP
                $this->data['message'] = "[Registration success. key = ". $key . "]";//a success message for all who care
                $this->properties->put('apikey', $key);//now we put the key where its needed
                $balance = file_get_contents($this->data['umbrella'] . '/info/balance/' . $_POST['plant']);//now we get our munny$$$
                $this->properties->put('balance', $balance);//we apply our monetary balance to the object
            }
            else //whoops, didn't work for some unfathomable reason
            {
                $this->data['message'] = "[Registration failure.]";
                $this->properties->put('balance', 0);//we have failed to register, we are undeserving of money$$$$
                $this->properties->remove('apikey');//or our api key
            }

           // $this->factory->clear('parts'); //this comes from the factory model that clears these variables.
            //$this->factory->clear('bots');
            //$this->factory->
            //$this->polish();
        }
    }
    
}