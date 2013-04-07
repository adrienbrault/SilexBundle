AdrienBraultSilexBundle
=======================

Integrate Silex into symfony2 full stack (without pimple and without the services providers ... because we already have
awesome bundles :>).

Note that this doesn't use Pimple, so you'll have to register your services with the DIC.

Motivation
----------

My experience of silex is that it's very fast to write a few controllers, and have a website working, but as soon as
you need some advanced functionality (already available as a bundle for example), you need to write a service provider,
and you end up loosing time writing service providers.

The idea here is to define your controllers like in a silex application (*fast prototyping*), while keeping symfony 2 full
stack advantages (fast advanced feature integration with bundles).

I started a symfony2 silex distribution using this bundle at (https://github.com/adrienbrault/symfony-silex-edition/compare/2.2...2.2-silex)[https://github.com/adrienbrault/symfony-silex-edition/compare/2.2...2.2-silex].
You can view a diff of what's needed to integrate the bundle into your app and use it : (https://github.com/adrienbrault/symfony-silex-edition/compare/2.2...2.2-silex)[https://github.com/adrienbrault/symfony-silex-edition/compare/2.2...2.2-silex].

WIP
---

Still a WIP, no tests, and still part of the Silex\Application interface to implement :)
