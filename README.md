# ACL manager for Laravel 5

----------
> This package is based on [Bican/Roles](https://github.com/romanbican/roles) package, according to [MIT License](https://raw.githubusercontent.com/romanbican/roles/master/LICENSE).

This is a powerful package to manage actions permissions based on levels, roles, and users.

- [Installation](#installation)
    - [Composer](#composer)
    - [Bican/Roles installation steps](#bican)
    - [Service Provider](#service-provider)
    - [Assets and Seeders](#assets-and-seeders)
- [Usage](#usage)
	- [Roles](#roles)
	- [Users](#users)
	- [ACL](#acl)
- [License](#license)

## Installation

This package is very easy to set up. There are only couple of steps.

### Composer

Pull this package in through Composer (file `composer.json`).

```js
{
    "require": {
        "gustavo82mdq/acl": "1.0.*"
    }
}
```

### Bican
Follow the Bican/Roles installation steps described in  [Readme.md](https://github.com/romanbican/roles/blob/master/README.md)

### Service Provider
Add the package to your application service providers in `config/app.php` file.

```php
'providers' => [
		                                                                                              
    /**
     * Third Party Service Providers...
     */
    Gustavo82mdq\Acl\RolesServiceProvider::class,

],
```

### Assets And Seeders

Publish the package assets file and seeders to your application. Run these commands inside your terminal.

    php artisan vendor:publish --provider="Gustavo82mdq\Acl\AclServiceProvider" --tag=public
    php artisan vendor:publish --provider="Gustavo82mdq\Acl\AclServiceProvider" --tag=seeds

And also run seeders:

    php artisan db:seed

And that's it!


## Usage

### Roles

 - List
 
		 http://<_your_domain_>/role/index
 - Add
 
 		 http://<_your_domain_>/role/create

 - Edit

		 http://<_your_domain_>/role/edit

 - Remove
 
	 From Roles list, you could delete a role.

### Users

 - List
 
		 http://<_your_domain_>/user/index
 - Add
 
 		 http://<_your_domain_>/user/create

 - Edit

		 http://<_your_domain_>/user/edit

 - Remove
 
	 From Roles list, you could delete a user.

### ACL
You could manage ACL permission por roles trought:

	http://<_your_domain_>/acl

## License

This package is free software distributed under the terms of the MIT license.