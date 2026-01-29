<?php declare(strict_types=1);

namespace HelloWorld\Storefront\Controller;

use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends StorefrontController
{
    #[Route(
        path: '/hello-world',
        name: 'frontend.hello.world',
        methods: ['GET'],
        defaults: ['_routeScope' => ['storefront']]
    )]
    public function hello(): Response
    {
        return $this->renderStorefront(
            '@HelloWorld/storefront/page/hello.html.twig',
            [
                'message' => '🎉 Hello from my FIRST Shopware plugin!',
            ]
        );
    }
}
