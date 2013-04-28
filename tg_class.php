<?php

	function tg_gallery($content)
	{
		$foo = get_option('tg_thumb_height');
		$bar = get_option('tg_thumb_width');
	
		$posttags= get_the_tags();
	
		$count=0;
		
		if ($posttags)
		{
			$height = get_option('tg_thumb_height');
			$width = get_option('tg_thumb_width');
			
			foreach($posttags as $tag)
			{
				$count++;
				if(preg_match("/tg:/",$tag->name))
				{
					$gArr[]=substr($tag->name,3,strlen($tag->name)-1);	     
				}
			}
			$querystr="SELECT p.guid, p.post_mime_type FROM wp_posts p inner join wp_term_relationships tr on p.id=tr.object_id inner join wp_term_taxonomy tt on tt.term_taxonomy_id=tr.term_taxonomy_id inner join wp_terms t on t.term_id=tt.term_id where ";
			$or = "";
			for($i=0;$i<count($gArr);$i++)
			{
				if($i>0) $or=" or ";
				$querystr.=$or."t.name='$gArr[$i]'";
			} 
			global $wpdb;
			
			$test = $wpdb->get_results($querystr, OBJECT);
			//3$sup.="<h2>".$querystr."</h2>";
			if($wpdb->num_rows>0)
			{	
				$i=0;
				foreach ($test as $post){
					$i++;
					$postmime=explode('/',$post->post_mime_type);
					if($postmime[0]=="image")
					{
						$img=substr($post->guid,strlen($server),strlen($post->guid)-strlen($server));
						
						$string="<img src=\"".$img."\" class=\"tagged-gallery\" style=\"max-width: none;\" thumb-width=\"".$width."\" picnum=\"".$i."\" thumb-height=\"".$height."\" data-larger=\"".$img."\" alt=\"Descritption\" /> ";
						$sup.="<div class=\"tg-thumb\">".$string."</div>";
						//$sup.=$string;
					}
				}	 
			}
		}
		
		
		
		$new_content = $content . $sup;
	
		return $new_content;
	}
	
?>