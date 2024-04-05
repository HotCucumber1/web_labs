<?php
const MAX_STR_LEN = 255;
const TYPE_LEN = 50;


function getPostsFromDB(mysqli $connect): mysqli_result
{
    $sql_query = "SELECT
                    id,
                    title,
                    subtitle,
                    image_url,
                    author,
                    author_url,
                    publish_date,
                    featured,
                    type
                  FROM post";
    return $connect -> query($sql_query);
}


function getPostFromDB(mysqli $connect, string $postId): mysqli_result
{
    $sql_query = "SELECT * FROM post WHERE id={$postId}";
    return $connect->query($sql_query);
}


function pushPost(mysqli $connect, array $data): void {
    $sql_query = "INSERT INTO
                    post(
                        title,
                        subtitle,
                        content,
                        author,
                        author_url,
                        publish_date,
                        image_url,
                        featured,
                        type
                    )
                  VALUES (
                       '{$data['title']}',
                       '{$data['subtitle']}',
                       '{$data['content']}',
                       '{$data['author']}',
                       '{$data['author_url']}',
                       '{$data['publish_date']}',
                       '{$data['image_url']}',
                        {$data['featured']},
                       '{$data['type']}'
                  );";
    if ($connect->query($sql_query)) {
        echo 'OK';
    } else {
        echo $connect->error;
    }
}