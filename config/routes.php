<?php

    use ishop\Router;

    // default routes for admin
    Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
    Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

    // ua
    Router::add('^ru$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'ru']);
    Router::add('^ru/?(?P<alias>[a-z-]+)/?$', ['controller' => 'Page', 'action' => 'view', 'prefix' => 'ru']); #for pages
    Router::add('^ru/service/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Blog', 'action' => 'view', 'prefix' => 'ru']);

    // en
    Router::add('^en$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'en']);
    Router::add('^en/?(?P<alias>[a-z-]+)/?$', ['controller' => 'Page', 'action' => 'view', 'prefix' => 'en']); #for pages
    Router::add('^en/service/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Blog', 'action' => 'view', 'prefix' => 'en']);

    // special routes for site
    Router::add('^service/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Blog', 'action' => 'view']);

    #for pages (about, delivery, contacts)
    Router::add('^(?P<alias>[a-z-]+)/?$', ['controller' => 'Page', 'action' => 'view']);

    // default routes for site
    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');




# Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
# Router::add('^price-list/?$', ['controller' => 'Prices', 'action' => 'view']);#
#  Router::add('^blog/?$', ['controller' => 'Blog', 'action' => 'index']);