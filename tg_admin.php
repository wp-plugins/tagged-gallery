<?php
class wctg{
    public function __construct(){
        if(is_admin()){
	    add_action('admin_menu', array($this, 'add_plugin_page'));
	    add_action('admin_init', array($this, 'page_init'));
	}
    }
	
    public function add_plugin_page(){
		add_menu_page('Settings Admin', 'Tagged Gallery', 'manage_options', 'tg-setting-admin', array($this, 'create_admin_page'));
    }

    public function create_admin_page(){
        ?>
	<div class="wrap">
	    <h2>Tagged Gallery Settings</h2>			
	    <form method="post" action="options.php">
	        <?php
			// This prints out all hidden setting fields
		    settings_fields('tg_option_group');	
		    do_settings_sections('tg-setting-admin');
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
	
    public function page_init()
	{		
		register_setting('tg_option_group', 'array_key', array($this, 'set_thumb_size'));
		
        add_settings_section(
			'thumb_section_id',
			'Thumb',
			array($this, 'print_section_info'),
			'tg-setting-admin'
		);	
		
		add_settings_field(
			'thumb_height', 
			'Thumb height', 
			array($this, 'create_thumb_height_field'), 
			'tg-setting-admin',
			'thumb_section_id'			
		);		
		
		add_settings_field(
			'thumb_width', 
			'Thumb width', 
			array($this, 'create_thumb_width_field'), 
			'tg-setting-admin',
			'thumb_section_id'			
		);	
    }
	
    public function set_thumb_size($input){
		
        if(is_numeric($input['thumb_width']))
		{
			$mid = $input['thumb_width'];			
			if(get_option('tg_thumb_width') === FALSE)
			{
				add_option('tg_thumb_width', $mid);
			}else{
				update_option('tg_thumb_width', $mid);
			}
		}else{
			$mid = '';
		}
		
		if(is_numeric($input['thumb_height']))
		{
			$mid = $input['thumb_height'];			
			if(get_option('tg_thumb_height') === FALSE)
			{
				add_option('tg_thumb_height', $mid);
			}else{
				update_option('tg_thumb_height', $mid);
			}
		}else{
			$mid = '';
		}
		return $mid;
    }
	
    public function print_section_info(){
	print 'Enter your setting below:';
    }
	
	public function create_thumb_height_field(){
        ?><input type="text" id="tgtheight" name="array_key[thumb_height]" value="<?=get_option('tg_thumb_height');?>" /><?php
    }
	
    public function create_thumb_width_field(){
        ?><input type="text" id="tgtwidth" name="array_key[thumb_width]" value="<?=get_option('tg_thumb_width');?>" /><?php
    }
}
?>