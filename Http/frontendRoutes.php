<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'blog'], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('posts', [
        'as' => $locale . '.blog',
        'uses' => 'PublicController@index',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $router->get('posts/{slug}', [
        'as' => $locale . '.blog.slug',
        'uses' => 'PublicController@show',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('categories', [
        'as' => $locale . '.categories',
        'uses' => 'PublicController@categories',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $router->get('category/{slug}', [
        'as' => $locale . '.category.slug',
        'uses' => 'PublicController@Categoryshow',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
});
