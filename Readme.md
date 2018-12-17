# Nova breadcrumbs

An easy way to manage breadcrumbs in Laravel.



## Installation

Like most of the laravel packages, it's on packagist, github, and works with composer. Just run

```shell
composer require nova/breadcrumbs
```

If you're using `laravel >= 5.5`, laravel will find the new package through the **auto-discover** feature.

If don't, just add the service provider to the **config/app.php** file:

```php
'providers' => [
	//...
	Nova\Breadcrumbs\BreadcrumbsServiceProvider::class
	//...
];
```



## Configuration

You can change the breadcrumbs classes by passing an array when initializing the **Breadcrumb** class, with the directive or with plain php:

```php
// Directive way
@breadcrumbs($config)

// Plain php
$breadcrumbs = new \Nova\Breadcrumbs\Classes\Breadcrumb($config);
```

The possible values that `$config` can receive are:

```php
// Those are the default $config values
$config = [
    'main-wrapper-class' => '__nova_breadcrumbs',
    'first-wrapper-class' => 'nav-wrapper',
    'second-wrapper-class' => 'col s12 no-padding',
    'breadcrumb-common-class' => 'breadcrumb',
    'breadcrumb-first-class' => 'text-uppercase',
    'breadcrumb-before-last-class' => 'grey-text',
    'breadcrumb-last-class' => 'cyan-text'
];
```





## Where to render the list?

Wherever you want, you can use the `@breadcrumbs` directive. The template is configurable (see **Config** above).

```html
<nav class="__nova_breadcrumbs">
    <div class="first-wrapper-class">
        <div class="second-wrapper-class">
            <a href="#!" class="breadcrumb common-class first-item-class">
                FIRST
            </a>
            <a href="#!" class="breadcrumb common-class">
                Second
            </a>
            <a href="#!" class="breadcrumb common-class">
                Third
            </a>
            <a href="#!" class="breadcrumb common-class last-item-class">
                Last item
            </a>
        </div>
    </div>
</nav>
```

If you won't use any directive, you can just echo the **Breadcrumb** class, like this:

```php
<?php
    $breadcrumbs = new \Nova\Breadcrumbs\Classes\Breadcrumb();
	echo $breadcrumbs;
```



## How to push a breadcrumb?

Again, there is a `@pushBreadcrumb` directive for pushing breadcrumbs to the main list. This directive receives two parameters: **display (required)** and **route(optional = '#')**.

```html
@pushBreadcrumb('Employees', '/employees')

<!-- 
	If you are adding many consecutive breadcrumbs, 
	you must add them in the inverse order: from down 
	(first) to up (last).
-->

@pushBreadcrumb('My company')
@pushBreadcrumb('Companies')
```

Again, if you won't to use directives, you can push them with plain php like this:

```php
<?php
    $breadcrumbs->push('Employees', '/employees');

	// And adding multiple consecutive breadcrumbs:
	$breadcrumbs->push('My company');
    $breadcrumbs->push('Companies');
```

