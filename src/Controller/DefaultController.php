<?php

namespace App\Controller;

use App\Controller\AbstractApiController;
use App\Exception\Api\ApiException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractApiController
{
    /**
     * @Route(name="default",path="/check-connexion",methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json('ok', 200);
    }
}