<?

function constrain_image($src_file, $max_w, $max_h, &$image_info, $dst_file = null, $quality = 75, $overwrite = true)
{
    // check params
    $max_w = @(int)$max_w;
    $max_h = @(int)$max_h;
    if ((empty($src_file)) || ((null !== $dst_file) && empty($dst_file))
        || ($max_w <= 0) || ($max_h <= 0)
        || ($quality < 1) || ($quality > 100)
    )
        throw new Exception('Wrong incoming params specified.');

    // setup funcs for supported types
    $mime_types=array(
         'image/jpeg'  => array('imageCreateFromJpeg', 'imageJpeg')
        ,'image/gif'   => array('imageCreateFromGif',  'imageGif')
        ,'image/png'   => array('imageCreateFromPng',  'imagePng')
    );

    // check if file names are appropriate
    $src_file = realpath($src_file);
    $dst_real_file = realpath($dst_file);
    if (empty($src_file) || !file_exists($src_file))
        throw new Exception("Source file '{$src_file}' does not exist.");
    if (null !== $dst_file)
        if ((!$overwrite) && (!empty($dst_real_file)) && file_exists($dst_real_file))
            throw new Exception("Overwriting option is disabled, but target file '{$dst_real_file}' exists.");
    if ($src_file === $dst_real_file)
        throw new Exception('Source path equals to destination path.');

    // try to obtain source image size and type
    @list($src_w, $src_h, $src_type) = array_values(getimagesize($src_file));
    $src_type = image_type_to_mime_type($src_type);
    if (empty($src_w) || empty($src_h) || empty($src_type))
        throw new Exception('Failed to obtain source image properties.');

    // check if constraining required
    if (!(($src_w > $max_w) || ($src_h > $max_h)))
    {
        $image_info = array($src_w, $src_h, $src_type);

        // return raw contents
        if (null === $dst_file)
        {
            $raw_data = file_get_contents($src_file);
            if (empty($raw_data))
                throw new Exception('Constraining is not required, but failed to get source raw data.');
            return $raw_data;
        }

        // just copy the file
        if (!copy($src_file, $dst_file))
            throw new Exception('Constraining is not required, but failed to copy source file to destination file.');
        return null;
    }

    // calculate new dimensions
    $dst_w = $max_w;
    $dst_h = $max_h;
    if (($src_w - $max_w) > ($src_h - $max_h))
        $dst_h = (int)(($max_w / $src_w) * $src_h);
    else
        $dst_w = (int)(($max_h / $src_h) * $src_w);
    $image_info = array($dst_w, $dst_h, $src_type);

    // check if source type supported
    @list($create_callback, $write_callback) = $mime_types[$src_type];
    if (empty($mime_types[$src_type])
        || (!function_exists($create_callback))
        || (!function_exists($write_callback))
    )
        throw new Exception("Source image type '{$src_type}' is not supported.");

    // create source image resource and determine its colors number
    $src_img = call_user_func($create_callback, $src_file);
    if (empty($src_img))
        throw new Exception("Failed to create source image with {$create_callback}().");
    $src_colors = imagecolorstotal($src_img);

    // create destination image (indexed, if possible)
    if ($src_colors > 0 && $src_colors <= 256)
        $dst_img = imagecreate($dst_w, $dst_h);
    else
        $dst_img = imagecreatetruecolor($dst_w, $dst_h);
    if (empty($dst_img))
        throw new Exception("Failed to create blank destination image.");

    // preserve non-alpha transparency, if it is defined
    $transparent_index = imagecolortransparent($src_img);
    if ($transparent_index >= 0)
    {
        $t_c = imagecolorsforindex($src_img, $transparent_index);
        $transparent_index = imagecolorallocate($dst_img, $t_c['red'], $t_c['green'], $t_c['blue']);
        if (false === $transparent_index)
            throw new Exception('Failed to allocate transparency index for image.');
        if (!imagefill($dst_img, 0, 0, $transparent_index))
            throw new Exception('Failed to fill image with transparency.');
        imagecolortransparent($dst_img, $transparent_index);
    }

    // or preserve alpha transparency for png
    elseif ('image/png' === $src_type)
    {
        if (!imagealphablending($dst_img, false))
            throw new Exception('Failed to set alpha blending for PNG image.');
        $transparency = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
        if (false === $transparency)
            throw new Exception('Failed to allocate alpha transparency for PNG image.');
        if (!imagefill($dst_img, 0, 0, $transparency))
            throw new Exception('Failed to fill PNG image with alpha transparency.');
        if (!imagesavealpha($dst_img, true))
            throw new Exception('Failed to save alpha transparency into PNG image.');
    }

    // resample the image with new sizes
    if (!imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h))
        throw new Exception('Failed to resample image.');

    // recalculate quality value for png image
    if ('image/png' === $src_type)
    {
        $quality = round(($quality / 100) * 10);
        if ($quality < 1)
            $quality = 1;
        elseif ($quality > 10)
            $quality = 10;
        $quality = 10 - $quality;
    }

    // write into destination file or into output buffer
    if (null === $dst_file)
        ob_start();
    if (!call_user_func($write_callback, $dst_img, $dst_file, $quality))
    {
        // do not forget to cleanup buffer ;-)
        if (null === $dst_file)
            ob_end_clean();
        throw new Exception('Failed to write destination image.');
    }
    if (null === $dst_file)
        return ob_get_clean();

    return null;
}

	function setTransparencyGIF($dst_image, $src_image)
	{
		//$dst_image = imagecreatetruecolor( $width, $height );
		$colorcount = imagecolorstotal($src_image);
		imagetruecolortopalette($dst_image,true,$colorcount);
		imagepalettecopy($dst_image,$src_image);
		$transparentcolor = imagecolortransparent($src_image);
		imagefill($dst_image,0,0,$transparentcolor);
		imagecolortransparent($dst_image,$transparentcolor);
	}

	function setTransparencyPNG($dst_image, $src_image)
	{
		/* making the new image transparent */
		imageSaveAlpha($dst_image, true);
		$background = imagecolorallocate($dst_image, 0, 0, 0);
		ImageColorTransparent($dst_image, $background); // make the new temp image all transparent
		imagealphablending($dst_image, false); // turn off the alpha blending to keep the alpha channel
	}






	function CreateSmallPicByH($fs,$fd,$hneed,$quality)
	{
		$params = getimagesize($fs);
		switch ( $params[2] ) {
		  case 1: $pic = imagecreatefromgif($fs); break;
		  case 2: $pic = imagecreatefromjpeg($fs); break;
		  case 3: $pic = imagecreatefrompng($fs); break;
		}

		if($pic)
		{
		   $h_src = imagesy($pic);
		   $w_src = imagesx($pic);

		   $ratio = $h_src/$hneed;
		   $w_dest = round($w_src/$ratio);
		   $h_dest = round($h_src/$ratio);

		   $dest = imagecreatetruecolor($w_dest,$h_dest);
//		   $dest = imagecreatecolor($w_dest,$h_dest);

			switch ( $params[2] ) {
			  case 1: setTransparencyGIF($dest, $pic); break;
			  case 3: setTransparencyPNG($dest, $pic); break;
			}

		   imagecopyresampled($dest, $pic, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
		   
		switch ( $params[2] ) {
		  case 1: Imagegif($dest,$fd,$quality); break;
		  case 2: Imagejpeg($dest,$fd,$quality); break;
		  case 3: Imagepng($dest,$fd,9);  break;
		}

		   ImageDestroy($dest);
		   ImageDestroy($pic);
		}
		else copy($fs,$fd);
	}


	function CreateSmallPicByW($fs,$fd,$wneed,$quality)
	{
		$params = getimagesize($fs);
		switch ( $params[2] ) {
		  case 1: $pic = imagecreatefromgif($fs); break;
		  case 2: $pic = imagecreatefromjpeg($fs); break;
		  case 3: $pic = imagecreatefrompng($fs); break;
		}

/*		$pic = @ImageCreateFromjpeg($fs);
		if(!$pic) $pic = @ImageCreateFromGif($fs);
		if(!$pic) $pic = @ImageCreateFromPNG($fs);
//		if(!$pic) $pic = @ImageCreateFromBMP($fs);
*/
		if($pic)
		{
		   $h_src = imagesy($pic);
		   $w_src = imagesx($pic);

		   $ratio = $w_src/$wneed;
		   $w_dest = round($w_src/$ratio);
		   $h_dest = round($h_src/$ratio);

		   $dest = imagecreatetruecolor($w_dest,$h_dest);
		   
			switch ( $params[2] ) {
			  case 1: setTransparencyGIF($dest, $pic); break;
			  case 3: setTransparencyPNG($dest, $pic); break;
			}
		   
		   imagecopyresampled($dest, $pic, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

		switch ( $params[2] ) {
		  case 1: Imagegif($dest,$fd,$quality); break;
		  case 2: Imagejpeg($dest,$fd,$quality); break;
		  case 3: Imagepng($dest,$fd,9);  break;
		}

		   ImageDestroy($dest);
		   ImageDestroy($pic);
		}
		else copy($fs,$fd);
	}

	function CreateSmallPicByWH($fs,$fd,$wneed,$hneed,$quality)
	{
		$params = getimagesize($fs);
		switch ( $params[2] ) {
		  case 1: $pic = imagecreatefromgif($fs); break;
		  case 2: $pic = imagecreatefromjpeg($fs); break;
		  case 3: $pic = imagecreatefrompng($fs); break;
		}

		if($pic)
		{
		   $h_src = imagesy($pic);
		   $w_src = imagesx($pic);
		   $r1 = $w_src/$h_src;

		   $ftemp = "../fotos/temp".rand(1,10000).".jpg";
		   ImageDestroy($pic);
		   $r2 = $wneed/$hneed;
		   if($r1<$r2) CreateSmallPicByW($fs,$ftemp,$wneed,$quality);
		   else CreateSmallPicByH($fs,$ftemp,$hneed,$quality);

			switch ( $params[2] ) {
			  case 1: $pic = imagecreatefromgif($ftemp); break;
			  case 2: $pic = imagecreatefromjpeg($ftemp); break;
			  case 3: $pic = imagecreatefrompng($ftemp); break;
			}

			$dest = imagecreatetruecolor($wneed,$hneed);
			
			switch ( $params[2] ) {
			  case 1: setTransparencyGIF($dest, $pic); break;
			  case 3: setTransparencyPNG($dest, $pic); break;
			}
			
		   imagecopyresampled($dest, $pic, 0, 0, 0, 0, $wneed, $hneed, $wneed, $hneed);
		switch ( $params[2] ) {
		  case 1: Imagegif($dest,$fd,$quality); break;
		  case 2: Imagejpeg($dest,$fd,$quality); break;
		  case 3: Imagepng($dest,$fd,9);  break;
		}
		   ImageDestroy($dest);
		   ImageDestroy($pic);
		   if(is_file($ftemp)) @unlink($ftemp);
		}
		else copy($fs,$fd);
	}

	function CreateSmallPicByWHCenterH($fs,$fd,$wneed,$hneed,$quality)
	{
		$params = getimagesize($fs);
		switch ( $params[2] ) {
		  case 1: $pic = imagecreatefromgif($fs); break;
		  case 2: $pic = imagecreatefromjpeg($fs); break;
		  case 3: $pic = imagecreatefrompng($fs); break;
		}

		if($pic)
		{
		   $h_src = imagesy($pic);
		   $w_src = imagesx($pic);
		   $r1 = $w_src/$h_src;

		   $ftemp = "../fotos/temp".rand(1,10000).".jpg";
		   ImageDestroy($pic);
		   $r2 = $wneed/$hneed;
		   if($r1<$r2) CreateSmallPicByW($fs,$ftemp,$wneed,$quality);
		   else CreateSmallPicByH($fs,$ftemp,$hneed,$quality);

			switch ( $params[2] ) {
			  case 1: $pic = imagecreatefromgif($ftemp); break;
			  case 2: $pic = imagecreatefromjpeg($ftemp); break;
			  case 3: $pic = imagecreatefrompng($ftemp); break;
			}

		   $temph = imagesy($pic);
		   $hstart = (int)(($temph - $hneed)/2);

		   $dest = imagecreatetruecolor($wneed,$hneed);
		   
			switch ( $params[2] ) {
			  case 1: setTransparencyGIF($dest, $pic); break;
			  case 3: setTransparencyPNG($dest, $pic); break;
			}

		   imagecopyresampled($dest, $pic, 0, 0, 0, $hstart, $wneed, $hneed, $wneed, $hneed);
		switch ( $params[2] ) {
		  case 1: Imagegif($dest,$fd,$quality); break;
		  case 2: Imagejpeg($dest,$fd,$quality); break;
		  case 3: Imagepng($dest,$fd,9);  break;
		}
		   ImageDestroy($dest);
		   ImageDestroy($pic);
		   if(is_file($ftemp)) @unlink($ftemp);
		}
		else copy($fs,$fd);
	}

	
	function CreateSmallPicByWHCenterW($fs,$fd,$wneed,$hneed,$quality)
	{
		$params = getimagesize($fs);
		switch ( $params[2] ) {
		  case 1: $pic = imagecreatefromgif($fs); break;
		  case 2: $pic = imagecreatefromjpeg($fs); break;
		  case 3: $pic = imagecreatefrompng($fs); break;
		}

		if($pic)
		{
		   $h_src = imagesy($pic);
		   $w_src = imagesx($pic);
		   $r1 = $w_src/$h_src;

		   $ftemp = "../fotos/temp".rand(1,10000).".jpg";
		   ImageDestroy($pic);
		   $r2 = $wneed/$hneed;
		   if($r1<$r2) CreateSmallPicByW($fs,$ftemp,$wneed,$quality);
		   else CreateSmallPicByH($fs,$ftemp,$hneed,$quality);

			switch ( $params[2] ) {
			  case 1: $pic = imagecreatefromgif($ftemp); break;
			  case 2: $pic = imagecreatefromjpeg($ftemp); break;
			  case 3: $pic = imagecreatefrompng($ftemp); break;
			}

		   $tempw = imagesx($pic);
		   $wstart = (int)(($tempw - $wneed)/2);

		   $dest = imagecreatetruecolor($wneed,$hneed);
		   
			switch ( $params[2] ) {
			  case 1: setTransparencyGIF($dest, $pic); break;
			  case 3: setTransparencyPNG($dest, $pic); break;
			}

		   imagecopyresampled($dest, $pic, 0, 0, $wstart, 0, $wneed, $hneed, $wneed, $hneed);
		switch ( $params[2] ) {
		  case 1: Imagegif($dest,$fd,$quality); break;
		  case 2: Imagejpeg($dest,$fd,$quality); break;
		  case 3: Imagepng($dest,$fd,9);  break;
		}
		   ImageDestroy($dest);
		   ImageDestroy($pic);
		   if(is_file($ftemp)) @unlink($ftemp);
		}
		else copy($fs,$fd);
	}

	function CreateSmallPicByBigSize($fs,$fd,$wneed,$hneed,$quality)
	{
		$size = @getimagesize($fs);
		if($size[0]<=$wneed && $size[1]<$hneed)
		{
			copy($fs,$fd);
		}
		else
		{
			if($size[0]*$hneed > $size[1]*$wneed)
			{
				CreateSmallPicByW($fs,$fd,$wneed,$quality);
			}
			else
			{
				CreateSmallPicByH($fs,$fd,$hneed,$quality);
			}
		}
	}
	
	
	////////////////////////////////////////WATERMARK//////////////////////////////////
    function create_watermark( $main_img_obj, $position = 'right-bottom',  $alpha_level = 100 , $watermarkfile = 'adminfiles/water.png' ) 
	{
				$watermark_img_obj = imagecreatefrompng($watermarkfile);

				
                $alpha_level        /= 100;

                $main_img_obj_w        = imagesx( $main_img_obj );
                $main_img_obj_h        = imagesy( $main_img_obj );
                $watermark_img_obj_w        = imagesx( $watermark_img_obj );
                $watermark_img_obj_h        = imagesy( $watermark_img_obj );


				if($position == 'center')
				{
					$main_img_obj_min_x        = floor( ( $main_img_obj_w / 2 ) - ( $watermark_img_obj_w / 2 ) );
					$main_img_obj_max_x        = ceil( ( $main_img_obj_w / 2 ) + ( $watermark_img_obj_w / 2 ) );
					$main_img_obj_min_y        = floor( ( $main_img_obj_h / 2 ) - ( $watermark_img_obj_h / 2 ) );
					$main_img_obj_max_y        = ceil( ( $main_img_obj_h / 2 ) + ( $watermark_img_obj_h / 2 ) );
				}

				if($position == 'right-bottom')
				{
					$main_img_obj_min_x = $main_img_obj_w - $watermark_img_obj_w ;
					$main_img_obj_min_y = $main_img_obj_h - $watermark_img_obj_h ;
					$main_img_obj_max_x = $main_img_obj_min_x - $watermark_img_obj_w ;
					$main_img_obj_max_y = $main_img_obj_min_y - $watermark_img_obj_h ;
				}

                $return_img        = imagecreatetruecolor( $main_img_obj_w, $main_img_obj_h );


                for( $y = 0; $y < $main_img_obj_h; $y++ ) {
                        for( $x = 0; $x < $main_img_obj_w; $x++ ) {
                                $return_color        = NULL;


                                $watermark_x        = $x - $main_img_obj_min_x;
                                $watermark_y        = $y - $main_img_obj_min_y;


                                $main_rgb = imagecolorsforindex( $main_img_obj, imagecolorat( $main_img_obj, $x, $y ) );


                                if (        $watermark_x >= 0 && $watermark_x < $watermark_img_obj_w &&
                                                        $watermark_y >= 0 && $watermark_y < $watermark_img_obj_h ) {
                                        $watermark_rbg = imagecolorsforindex( $watermark_img_obj, imagecolorat( $watermark_img_obj, $watermark_x, $watermark_y ) );


                                        $watermark_alpha        = round( ( ( 127 - $watermark_rbg['alpha'] ) / 127 ), 2 );
                                        $watermark_alpha        = $watermark_alpha * $alpha_level;


                                        $avg_red                = get_ave_color( $main_rgb['red'],                $watermark_rbg['red'],                $watermark_alpha );
                                        $avg_green        = get_ave_color( $main_rgb['green'],        $watermark_rbg['green'],        $watermark_alpha );
                                        $avg_blue                = get_ave_color( $main_rgb['blue'],        $watermark_rbg['blue'],                $watermark_alpha );


                                        $return_color        = get_image_color( $return_img, $avg_red, $avg_green, $avg_blue );


                                } else {
                                        $return_color        = imagecolorat( $main_img_obj, $x, $y );

                                }


                                imagesetpixel( $return_img, $x, $y, $return_color );

                        }
                }


                return $return_img;

        }


        function get_ave_color( $color_a, $color_b, $alpha_level ) {
                return round( ( ( $color_a * ( 1 - $alpha_level ) ) + ( $color_b        * $alpha_level ) ) );
        }


        function get_image_color($im, $r, $g, $b) {
                $c=imagecolorexact($im, $r, $g, $b);
                if ($c!=-1) return $c;
                $c=imagecolorallocate($im, $r, $g, $b);
                if ($c!=-1) return $c;
                return imagecolorclosest($im, $r, $g, $b);
        }	

/*	
	function create_watermark( $image, $position = 'right', $alpha_level = 100, $watermarkfile = 'adminfiles/water.png' ) 
	{ 
	  $watermark = imagecreatefrompng($watermarkfile);
	  // ширина и высота водяного знака
	  $width = imagesx($watermark); 
	  $height = imagesy($watermark); 
	  if ( $position == 'right' ) { // водяной знак будет внизу справа
	    $dest_x = imagesx($image) - $width - 5; 
	    $dest_y = imagesy($image) - $height - 5;
	  } 
	  else if ( $position == 'right-top' ) { // водяной знак будет внизу справа
	    $dest_x = imagesx($image) - $width - 0; 
	    $dest_y = 10;
	  } 
	  else { // водяной знак будет по центру
	    $dest_x = intval(imagesx($image)*0.5) - intval($width*0.5); 
	    $dest_y = intval(imagesy($image)*0.5) - intval($height*0.5);     
	  }
	  imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $width, $height, $alpha_level);     
	  return $image; 
	}
*/

	function put_watermark($fs,$fd,$position = 'right', $alpha_level = 100,$watermarkfile = 'images/water.png')
	{
		$pic = @ImageCreateFromjpeg($fs);
		if(!$pic) $pic = @ImageCreateFromGif($fs);
		if(!$pic) $pic = @ImageCreateFromPNG($fs);
		if($pic)
		{
			$image_watermark = create_watermark($pic, $position, $alpha_level,$watermarkfile);
			imagejpeg($image_watermark,$fd,100);
		}
	}
	////////////////////////////////////////WATERMARK//////////////////////////////////
	
	
?>