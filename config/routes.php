<?php

    use ishop\Router;

    // special routes for site
    Router::add('^service/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Blog', 'action' => 'view']);
    # Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
    # Router::add('^price-list/?$', ['controller' => 'Prices', 'action' => 'view']);#

    // default routes for admin
    Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
    Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

    #  Router::add('^blog/?$', ['controller' => 'Blog', 'action' => 'index']);

    #for pages (about, delivery, contacts)
    Router::add('^(?P<alias>[a-z-]+)/?$', ['controller' => 'Page', 'action' => 'view']);

    // default routes for site
    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');