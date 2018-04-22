# laravel-dynamic-serving

[![Build Status](https://travis-ci.org/matthewbdaly/laravel-dynamic-serving.svg?branch=master)](https://travis-ci.org/matthewbdaly/laravel-dynamic-serving)
[![Coverage Status](https://coveralls.io/repos/github/matthewbdaly/laravel-dynamic-serving/badge.svg?branch=master)](https://coveralls.io/github/matthewbdaly/laravel-dynamic-serving?branch=master)

Middleware for detecting mobile/tablet users and adding data to the session so that other parts of the application can dynamically serve different content as required, in order to implement [dynamic serving](https://developers.google.com/search/mobile-sites/mobile-seo/dynamic-serving).

How do I install it?
--------------------

```bash
$ composer require matthewbdaly/laravel-dynamic-serving
```

What does it do?
----------------

The package provides the middleware `Matthewbdaly\LaravelDynamicServing\Http\Middleware\DetectMobile`, which you can set globally, or use on just a subset of your routes as appropriate. It sets a key of `mobile` in your session when a user first navigates to a page behind this middleware, which you can then use to determine which views to show a user, based on whether this returns a value of `true` or `false`. In addition, it sets the `Vary` header to `User-Agent` in the response, which tells search engines and caching systems that the response will vary by user agent. If you want to be able to let the user override the default based on the user agent (which is a good idea), all you need to do is provide a means to toggle the `mobile` flag in the session - typically you'll want to do this via AJAX and reload the page afterwards.

It also provides the `is_mobile()` and `is_desktop()` helper functions. While you can use these to determine which view to load, it's likely to be more useful in views in order to determine whether or not to show a particular part of the view.
