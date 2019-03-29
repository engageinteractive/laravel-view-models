<h1 align="center">Laravel View Models</h1>

<p align="center">
<a href="https://travis-ci.org/engageinteractive/laravel-view-models"><img src="https://travis-ci.org/engageinteractive/laravel-view-models.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/engageinteractive/laravel-view-models"><img src="https://poser.pugx.org/engageinteractive/laravel-view-models/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/engageinteractive/laravel-view-models"><img src="https://poser.pugx.org/engageinteractive/laravel-view-models/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/engageinteractive/laravel-view-models"><img src="https://poser.pugx.org/engageinteractive/laravel-view-models/license.svg" alt="License"></a>
</p>

A straight forward pattern for using view models instead of database model in your blade files and JSON responses.

## Installation

```sh
composer require engageinteractive/laravel-view-models
```

Then, create a mapper that can build view models for your Eloquent model:

```php
namespace App\Domain\Posts;

use EngageInteractive\LaravelViewModels\Mapper;

use App\Domain\Posts\Post;

class PostShowMapper extends Mapper
{
    /**
     * Map a Post to a basic PHP array.
     *
     * @param \App\Domain\Posts\Post
     * @return array
     */
    public function map(Post $post)
    {
        return $post->only('title', 'author_name');
    }
}
```

Then finally, ask for an instance of the Mapper in your controller via the container:

```php
namespace App\Domain\Posts;

use App\Domain\Posts\Post;
use App\Domain\Posts\PostMapper;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Show a Post.
     *
     * @param \App\Domain\Posts\Post
     * @param \App\Domain\Posts\PostMapper
     * @return \Illuminate\Views\View
     */
    public function show(Post $post, PostShowMapper $model)
    {
        return view('post.show', [
            'model' => $mapper->one($post),
        ]),
    }
}
```

## Laravel Compatibility

Works on Laravel 5.5+.

## License

Laravel View Models is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
