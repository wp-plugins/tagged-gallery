<?php
header('Content-type: image/jpeg');
$type=$_GET["type"];

$img=$_GET["img"];
$image = new Imagick($img);

// getting dimentions
$size=$_GET["size"];
$size=split("x", $size);
$width = $size[0];
$height = $size[1];

if($type=="thumb")
{	
	$image->cropThumbnailImage($height,$width);
}
else
{
$iheight=$image->getImageHeight(); 
$iwidth=$image->getImageWidth(); 
	if ($iheight < $iwidth)
	{	
		$image->scaleImage($height,0); 
	}
	else 
	{
		$image->scaleImage(0,$width); 
	}

}

echo $image;
?>