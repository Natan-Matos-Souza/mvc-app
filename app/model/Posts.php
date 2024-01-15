<?php

namespace app\model;

class Posts extends Database
{

    public static function deletePost(int $id)
    {
        $query = "DELETE FROM posts WHERE id=?";
        
        $stmt = self::database()->prepare($query);
        $stmt->execute([
            $id
        ]);

    }

    public static function validateFields(object $data)
    {
        $isValid = true;

        foreach ($data as $field => $content)
        {
            if (!$content) $isValid = false;
        }

        return $isValid;
    }

    public static function getPost(int $id, $limit=0)
    {
        $query = "SELECT * FROM posts WHERE id=?";
        $stmt = self::database()->prepare($query);
        $stmt->execute([
            $id
        ]);

        if ($limit)
        {
            $data = $stmt->fetchAll();

            foreach($data as $post)
            {
                $post->post_title = mb_strimwidth($post->post_title, 0, $limit);
                $post->post_content = mb_strimwidth($post->post_content, 0, $limit);
            }

            return $data;
        }
        
        return $stmt->fetchAll();
    }

    public static function create(object $data)
    {
        $query = "INSERT INTO posts(post_author, post_title, post_content, post_data) VALUES (?, ?, ?, ?)";
        $stmt = self::database()->prepare($query);
        $stmt->execute([
            $data->postAuthor,
            $data->postTitle,
            $data->postContent,
            $data->postDate
        ]);
    }

    public static function getAllPosts(int $limit = 0): array
    {

        $query = "SELECT * FROM posts";
        $stmt = self::database()->prepare($query);
        $stmt->execute();


        if ($limit)
        {
            $posts = $stmt->fetchAll();

            foreach($posts as $post)
            {
                $post->post_content = mb_strimwidth($post->post_content, 0, $limit);
                $post->post_title = mb_strimwidth($post->post_title, 0, $limit);
            }

            return $posts;
        }

        return $stmt->fetchAll();
    }

}