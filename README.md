LaravelArtisanExtended
================
<!-- [![Build Status](https://travis-ci.org/mateusjatenee/laravel-artisan-extended.svg?branch=master)](https://travis-ci.org/mateusjatenee/laravel-artisan-extended) -->

Life is too short to only use default Artisan commands. Give some new ones a try!

#### Installation via Composer
``` bash
$ composer require mateusjatenee/laravel-artisan-extended
```

### Use  
## make:transformer  

This command is particularly useful for people who build APIs. Instead of having to write a Transformer everytime, just run `make:transformer {name of the transformer} {Model}`

For instance, `make:transformer Book App\Book` will give you the following code:   

```  

<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    public function transform(App\Book $book)
    {
        return [

        ];
    }
}
```

 in the `app/Transformers/BookTransformer.php` file.


#### License
This library is licensed under the MIT license. Please see [LICENSE](LICENSE.md) for more details.

#### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more details.

#### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for more details.
