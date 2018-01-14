<?php

namespace App\Controllers;

use App\Core\Controller,
    App\Models\Users,
    App\Helpers\Helper;

class homeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $user = new Users();
        if(!$user->isLoged()){
            Helper::Redirect("login");
        }
    }

    public function index()
    {
        $this->loadTemplate('home',$this->getData());
    }



}
