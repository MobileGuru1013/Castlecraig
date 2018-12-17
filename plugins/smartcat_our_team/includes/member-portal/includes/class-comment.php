<?php

namespace ots_pro\portal;


class Comment {

    public $id;

    public $content = '';

    public $author_id = 0;

    public $post_id = 0;

    public $comment_date = '0000-00-00 00:00:00';

    public $comment_date_gmt = '0000-00-00 00:00:00';


    public function __construct( $comment ) {

        foreach ( get_object_vars( $comment ) as $key => $value ) {
            $this->$key = $value;
        }

    }


}
