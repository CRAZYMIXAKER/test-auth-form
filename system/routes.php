<?php

return [
  [
    'route' => '/^\/?$/',
    'method' => 'index',
    'controller' => 'News',
    'request_method' => 'GET',
  ],
  [
    'route' => '/^\/login?$/',
    'method' => 'showLoginForm',
    'controller' => 'Auth',
    'request_method' => 'GET',
  ],
  [
    'route' => '/^\/login?$/',
    'method' => 'login',
    'controller' => 'Auth',
    'request_method' => 'POST',
  ],
  [
    'route' => '/^\/logout?$/',
    'method' => 'logout',
    'controller' => 'Auth',
    'request_method' => 'POST',
  ],
  [
    'route' => '/^\/news?$/',
    'method' => 'index',
    'controller' => 'News',
    'request_method' => 'GET',
  ],
  [
    'route' => '/^\/news?$/',
    'method' => 'store',
    'controller' => 'News',
    'request_method' => 'POST',
  ],
  [
    'route' => '/^\/news\/update?$/',
    'method' => 'update',
    'controller' => 'News',
    'request_method' => 'POST',
  ],
  [
    'route' => '/^\/news\/delete?$/',
    'method' => 'destroy',
    'controller' => 'News',
    'request_method' => 'DELETE',
  ],
];