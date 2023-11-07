<?php

namespace app\model;

class Posts extends Model
{
    public static function validateFields(object $data)
    {
        $isValid = true;

        foreach ($data as $field => $content)
        {
            if (!$content)
            {
                $isValid = false;
            }
        }

        return $isValid;
    }

    public static function getPost(int $id)
    {

    }

    public static function create(object $data)
    {
        self::database()
        ->query("INSERT INTO posts(post_author, post_title, post_content, post_data) VALUES (
            '$data->postAuthor',
            '$data->postTitle',
            '$data->postContent',
            '$data->postDate'
            )");
    }

    public static function getAllPosts()
    {
        
    }
}