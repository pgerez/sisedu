<?php
namespace App\Menu;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Knp\Menu\FactoryInterface;


class MenuBuilder
{
    protected $security;
    protected $factory;
    protected $request;
    
    public function __construct(
        TokenStorageInterface $security,
        FactoryInterface $factory,
        RequestStack $request_stack)
    {
        $this->security = $security;
        $this->factory = $factory;
        $this->request = $request_stack->getCurrentRequest();
    }

    public function createMainMenu(array $options)
    {   
        $root = $this->factory->createItem('root')
            ->setChildrenAttribute('class', 'navbar-nav mr-auto')
            ;
        
        $route = $this->request->attributes->get('_route');

        $menu = $root->addChild('Menu',['route' => 'homepage'])
            ->setAttributes(['class'=>'nav-item dropdown'])
            ->setLinkAttributes([
                'class'=>'nav-link dropdown-toggle',
                'data-toggle'=>'dropdown'])
            ;
        
        $menu->addChild('Home', ['route' => 'homepage'])
            ;
        $menu->addChild('Certificado', ['uri' => '/validarcertificado'])
            ;

        return $root;
    }
}
