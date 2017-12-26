<?php 
if ( ! function_exists( 'dd' ))
{
    /**
     * @param $data
     */
    function dd( $data ) {
        echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto;border:1px solid green">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);
        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';
        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }
}

if ( ! function_exists( 'createFolder' ))
{
	/**
	 *  Ham tao  thuc muc 
	 * return 0  => errors
	 * return 1  => success
	 *  tao moi thu muc
	**/
	function createFolder($path , $name)
	{
		$respons = 
		[
			'code' => 0,
			'message' => ' Thư mục '.$name.' đã tồn tại ' 
		];
		if(is_dir($path . $name))
		{
			return $respons;
		}
		$check_create = mkdir( $path . $name, 0777); 
		if($check_create)
		{
			$respons['message']  =  ' Tạo thư mục thành công ';
			$respons['code']  =  1;
			return $respons;
		}
		$respons['message']  = ' Lỗi tạo thư mục';
		return $respons;
	}
}

if( ! function_exists( '' ))
{
	/**
	 *  xoa thu muc va file tong thu muc do 
	 */
	function deleteFolder($dir = null) {
	  	if (is_dir($dir)) {
	    	$objects = scandir($dir);
		    foreach ($objects as $object) {
		      	if ($object != "." && $object != "..")
		      	{
		        	if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
	        		else unlink($dir."/".$object);
		      	}
		    }
		    reset($objects);
		    rmdir($dir);
	  	}
	}
}