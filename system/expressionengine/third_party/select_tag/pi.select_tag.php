<?php if( ! defined('BASEPATH')) exit('No direct scripts access allowed');

$plugin_info = array(
	'pi_name' => 'Select Tag',
	'pi_version' => '1.0.0',
	'pi_author' => 'Brian Borman',
	'pi_author_url' => 'http://kingdesignllc.com',
	'pi_description' => 'Select Tag - Outputs a select tag with options to avoid PHP in template',
	'pi_usage' => Select_tag::usage()
);

class Select_tag {	
	// get instance of EE
	public function __construct() 
	{
		$this->EE =& get_instance();
	}
	
	/**
	* range will display a range of numbers from start to end as a drop down
	*/
	public function range() 
	{
		// collect params, false if not provided
		$start = $this->EE->TMPL->fetch_param('start', "1");
		$end = $this->EE->TMPL->fetch_param('end');
		$reverse = $this->EE->TMPL->fetch_param('reverse');
		
		// start building our output
		$output = $this->_open_tag();
		$options = $this->_default_option();
		
		// build our options
		if(is_numeric($start) && is_numeric($end)) {
			if($reverse == 'yes') {
				for($i=$end; $i>=$start; $i--) {
					$options .= '<option value="'.$i.'">'.$i.'</option>';
				}	
			} else {
				for($i=$start; $i<=$end; $i++) {
					$options .= '<option value="'.$i.'">'.$i.'</option>';
				}	
			}
		} else {
			$options = '<option>Invalid Range Provided</option>';
		}
		
		$output .= $options . '</select>';
		return $output;
	}
	
	/**
	* us_states will display the US states as a drop down
	*/
	public function us_states() 
	{
		// include file with predefined lists
		include PATH_THIRD.'select_tag/includes/predefined_lists.php';
	
		// collect params, false if not provided
		$value_format = $this->EE->TMPL->fetch_param('value_format', 'short');
		
		// start building our output
		$output = $this->_open_tag();
		$options = $this->_default_option();
		
		// build our options
		if($value_format == 'long') {
			foreach($us_states as $short => $long) {
				$options .= '<option value="'.$long.'">'.$long.'</option>';
			}
		} else {
			foreach($us_states as $short => $long) {
				$options .= '<option value="'.$short.'">'.$long.'</option>';
			}
		}
		
		$output .= $options . '</select>';
		return $output;
	}
	
	/**
	* _open_tag builds the opening select tag based on the parameters
	*/
	public function _open_tag() 
	{
		$id = $this->EE->TMPL->fetch_param('id');
		$name = $this->EE->TMPL->fetch_param('name');
		$class = $this->EE->TMPL->fetch_param('class');
		
		$return = '<select';
		if($id) {
			$return .= ' id="'.$id.'"';
		}
		if($name) {
			$return .= ' name="'.$name.'"';
		}
		if($class) {
			$return .= ' class="'.$class.'"';
		}
		$return .= ">";
		return $return;
	}
	
	/**
	* _default_option builds the first option value based on default parameter
	*/
	public function _default_option() 
	{
		$default_value = $this->EE->TMPL->fetch_param('default_value', '');
		$default = $this->EE->TMPL->fetch_param('default');
		$return = '';
		if($default) {
			$return .= '<option value="'.$default_value.'">'.$default.'</option>';
		}
		return $return;
	}
	
	public static function usage()
	{
		ob_start(); ?>

The Select_tag Plugin will output a select drop down tag,
taking in attributes for the select tag.


GLOBAL PARAMETERS
The following parameters are available to all tags:

	id: set the id attribute of the select tag
	name: set the name attribute of the select tag
	class: set the class attribute of the select tag, space separated
	default: an option to be displayed on page load
	default_value: the value of the default option
	
All of these parameters are optional, though you can not set a default_value
without setting a default. If they are not provided, the attributes and default
option will not be displayed. Here is an example:

	{exp:select_tag:<function> id="myid" name="myname" class="oneclass twoclass" default="- Select -" default_value="none"}
	
will produce:

	<select id="myid" name="myname" class="oneclass twoclass">
		<option value="none">- Select -</option>
	</select>
	
	
FUNCTIONS
There are two functions available to select_tag:

	{exp:select_tag:range}
	
	This function will output a range of numbers. It accepts three additional parameters:
		
		start: the number to start the range (inclusive), optional, defaults to 1
		end: the number to end the range (inclusive), required
		reverse: reverse the ordering of the options (yes|no), optional, defaults to no
		
	{exp:select_tag:us_states}
	
	This function will output a list of US States. It accepts one additional parameter:
		
		value_format: set option value to abbreviation or full name (short|long), optional, defaults to short
		
	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		
		return $buffer;
	}
}

/* End of file pi.select_tag.php */
/* Location: ./system/expressionengine/third_party/select_tag/pi.select_tag.php */