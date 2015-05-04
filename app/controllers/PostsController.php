<?php

class PostsController extends BaseController {
    
    public function showPosts() {
//        $post = Post::all();
//        
//        return $post;
   
        
           return View::make('pages.posts');
    }
}