<?php

    use ishop\Router;

    // default routes for admin
    Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
    Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

    // ua
    Router::add('^ua$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'ua']);
    Router::add('^ua/?(?P<alias>[a-z-]+)/?$', ['controller' => 'Page', 'action' => 'view', 'prefix' => 'ua']); #for pages
    Router::add('^ua/service/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Blog', 'action' => 'view', 'prefix' => 'ua']);

    // en
    Router::add('^en', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'en']);
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