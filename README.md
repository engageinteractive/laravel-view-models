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

## Mappers

Create a mapper that can build view models for your Eloquent model:

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

Ask for an instance of the Mapper in your controller via the container:

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

## View models

Create a view model, to build data to pass into your view:
```php
namespace App\Domain\Posts;

use EngageInteractive\LaravelViewModels\ViewModel;
use Illuminate\Support\Str;

class PostViewModel extends ViewModel
{
    protected $post;

    /**
     * Intialise the View ViewModel.
     *
     * @param \App\Domain\Posts\Post
     * @return void
     */
    public function __construct(Post $post): void
    {
        $this->post = $post;
    }
    
    /**
     * Returns the post title in title-case.
     *
     * @return string
     */
    public function postTitle(): string
    {
        if (!isset($this->post->title)) {
            return 'Untitled';
        }

        return Str::title($this->post->title);
    }
}
```

Pass the ViewModel array into the view:
```php
namespace App\Domain\Posts;

use App\Domain\Posts\Post;
use App\Domain\Posts\PostViewModel;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Show a Post.
     *
     * @param \App\Domain\Posts\Post
     * @return \Illuminate\Views\View
     */
    public function show(Post $post)
    {
        $model = new PostViewModel($post);

        return view('post.show', $model->array()),
    }
}
```

Below is an example of the data passed into the view:
```
[
    'model' => [
        'post_title' => 'This Is The Title',
    ],
]
```

## Combining View models and Mappers

First, create a mapper for posts.
```php
namespace App\Domain\Posts;

use EngageInteractive\LaravelViewModels\Mapper;

use App\Domain\Posts\Post;

class PostsMapper extends Mapper
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

Create a ViewModel, and call the mapper.
```php
namespace App\Domain\Posts;

use EngageInteractive\LaravelViewModels\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PostArchiveViewModel extends ViewModel
{
    protected $posts;

    /**
     * Initialise the View model.
     *
     * @param \Illuminate\Database\Eloquent\Collection
     * @return void
     */
    public function __construct(Collection $posts): void
    {
        $this->posts = $posts;
    }
    
    /**
     * Returns an array of posts.
     *
     * @return string
     */
    public function posts(): array
    {
        return (new PostsMapper)->all($this->posts);
    }

    /**
     * Returns the application home URI.
     *
     * @return string
     */
    public function HomeUri(): string
    {
        return route('home');
    }
}
```

Pass the view model into the view, with the posts mapped into the required format.
```php
namespace App\Domain\Posts;

use App\Domain\Posts\Post;
use App\Domain\Posts\PostArchiveViewModel;
use App\Http\Controllers\Controller;

class PostArchiveController extends Controller
{
    /**
     * Show a Post.
     *
     * @return \Illuminate\Views\View
     */
    public function show()
    {
        $posts = Post::all();
        $model = new PostArchiveViewModel($posts);

        return view('post-archive.show', $model->array()),
    }
}
```



## Laravel Compatibility

Works on Laravel 5.5+.

## License

Laravel View Models is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
