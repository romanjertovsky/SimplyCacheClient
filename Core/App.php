<?php


class App
{


    public function startCLI()
    {

        Core::getRouter()->routeCLI();

    }


    public function startWEB()
    {

        Core::getRouter()->routeWEB();

    }


}