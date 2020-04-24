<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Support\Facades\App;
use Modules\Blog\Entities\Category;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Repositories\PostRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class PublicController extends BasePublicController
{
    /**
     * @var PostRepository
     */
    private $post;
    private $category;

    public function __construct(PostRepository $post,CategoryRepository $category)
    {
        parent::__construct();
        $this->post = $post;
        $this->category = $category;
    }

    public function index()
    {
        $posts = $this->post->allTranslatedIn(App::getLocale());

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->post->findBySlug($slug);
        $categories = Category::take(5)->get();
        $latesposts = $this->post->latest(3);

        return view('blog.show', compact('post','categories','latesposts'));
    }
}
