<?php

namespace app\model;

class Posts extends Model
{

    public static function deletePost(int $id)
    {
        try {
            self::database()
            ->query("DELETE FROM posts WHERE id=$id");

            return true;
        } catch (Exception $e)
        {
            return false;
        }
    }

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

    public static function getPost(int $id, $limit=0)
    {
        if ($limit)
        {

            $data = self::database()
                ->query("SELECT * FROM posts WHERE id='$id'")
                ->fetch_all(MYSQLI_ASSOC);

            foreach ($data as $post => $content)
            {
                foreach ($data[$post] as $key => $content)
                {
                    if ($key == 'post_content' || $key == 'post_title')
                    {
                        $data[$post][$key] = mb_strimwidth($data[$post][$key], 0, $limit, '...');
                    }
                }
            }

            return $data;

        } else {
            return self::database()
            ->query("SELECT * FROM posts WHERE id='$id'")
            ->fetch_all(MYSQLI_ASSOC);
        }
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

    public static function getAllPosts(int $limit = 0): array
    {
        if ($limit)
        {
            $posts = self::database()
            ->query("SELECT * FROM posts")
            ->fetch_all(MYSQLI_ASSOC);


            foreach ($posts as $post => $data)
            {
                foreach($posts[$post] as $key => $data)
                {
                    if ($key == 'post_content' || $key == 'post_title')
                    {
                        $posts[$post][$key] = mb_strimwidth($posts[$post][$key], 0, $limit, '...');
                    }
                }
            }

            return $posts;

        } else {
            return $posts = self::database()
            ->query("SELECT * FROM posts")
            ->fetch_all(MYSQLI_ASSOC);
        }

    }
}