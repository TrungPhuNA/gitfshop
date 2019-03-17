<?php

    require_once __DIR__. '/../autoload.php';

    // B1  Lấy id sản phẩm được thêm vào yêu thích 
    
    $option     = Input::get('option');
    $id_product = Input::get('id_product');
    $id_comment = Input::get('id_comment');



    // echo  json_encode([
    //     'option'     => $option,
    //     'id_comment' => $id_comment,
    //     'id_product' => $id_product
    // ]);die;

    // kiem tra dang nhap 
    if (!isset($_SESSION['id_user']))
    {
        echo json_encode(['code' => 0]);die;
    }

    $id_user = $_SESSION['id_user'];

    // kiem tra xem user va comment do co trong bang comment_user_like chua 
    $comment_user_like = DB::fetchOne('comment_user_like',' cul_user_id = "'.$id_user.'" AND cul_comment_id = "'.$id_comment.'"  ');
    
    

    if ($comment_user_like)
    {
        // lay comment 
        $comment  = DB::fetchOne('comments',' id = '.(int)$id_comment);
         // update lai like or dislike
        
        // kiem tra xem nguoi dung da tung like hay dislike comment 
        // = 1 la like | 0 la dislike 

        // kiem tra xem neu ma nguoi dung da like roi  ma lai dislike hoac nguoc lai  thi 
        if ($comment_user_like['cul_like'] == 1 && $option != 'like' || $comment_user_like['cul_like'] == 0 && $option != 'dislike')
        {
            echo json_encode(['code' => 3]);die;
        }
        
        $flag_cmt = $comment_user_like['cul_like'];

        if ($option == 'like')
        {

            // neu nguoi dung da like thi huy bo cul_like = -1 
            if ($flag_cmt == 1)
            {
                $check_update = DB::update('comment_user_like',array('cul_like' => -1),' id = '.(int)$comment_user_like['id']);
                 // tru like 
                $check_update = DB::update('comments',array('cmt_like' => $comment['cmt_like'] - 1),' id = '.$id_comment);
            }
            else
            {
                // nguoc lai tang like 
                $check_update = DB::update('comment_user_like',array('cul_like' => 1),' id = '.(int)$comment_user_like['id']);
                 // tang like 
                $check_update = DB::update('comments',array('cmt_like' => $comment['cmt_like'] + 1),' id = '.$id_comment);
            }
        }
        else
        {
            // tuong tu nhu o tren thay li like thi dislike 
            

            if ($flag_cmt == 0)
            {
                $check_update = DB::update('comment_user_like',array('cul_like' => -1),' id = '.(int)$comment_user_like['id']);
                 // tru like 
                $check_update = DB::update('comments',array('cmt_dislike' => $comment['cmt_dislike'] - 1),' id = '.$id_comment);
            }
            else
            {
                // nguoc lai tang like 
                $check_update = DB::update('comment_user_like',array('cul_like' => 0),' id = '.(int)$comment_user_like['id']);
                 // tang like 
                $check_update = DB::update('comments',array('cmt_dislike' => $comment['cmt_like'] + 1),' id = '.$id_comment);
            }

        }
        echo json_encode(['code' => 2]);die;

    }
    else 
    {
        // them moi 
         $check_update = DB::update('comments',array('cmt_'.$option => 1),' id = '.$id_comment);

        $cul_like = $option == 'like' ? 1 : 0;
        if ($check_update)
        {
            $check_insert = DB::insert('comment_user_like',array(
                'cul_user_id'    => $id_user,
                'cul_comment_id' => $id_comment,
                'cul_like'       => $cul_like
            ));
        }

        echo json_encode(['code' => 1]);die;
    }

