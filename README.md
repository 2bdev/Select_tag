#Select_tag

## Description

The Select_tag Plugin will output a select tag with a range of numbers or other predefined lists.

## Installation

1. Copy the select_tag folder to ./system/expressionengine/third_party/
2. In the CP, go to Add-Ons > Plugins and confirm that the Select Tag Plugin is listed

## Single Tags

### {exp:select_tag:range}
This tag will output a range of numbers in a select tag.

#### id = [string] 
(optional) set the id attribute of the select tag

#### name = [string]
(optional) set the name attribute of the select tag

#### class = [string]
(optional) set the class attribute of the select tag, space seperated

#### default = [string]
(optional) an option tag to be added at the top of the select list

#### default_value = [string]
(optional) the value of the default option tag, will be ignored if default is not provided

#### start = [int]
(optional, defaults to 1) the number to start the range (inclusive)

#### end = [int]
(required) the number to end the range (inclusive)

#### reverse = ['yes'|'no']
(optional, defaults to 'no') reverse the ordering of the options

#### Examples

	{exp:select_tag:range id="myid" name="myname" end="5"}
	
	*** produces ***
	
	<select id="myid" name="myname">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>
	
===
	
	{exp:select_tag:range class="oneclass twoclass" default="Select Year" default_value="none" start="2008" end="2012" reverse="yes"}
	
	*** produces ***
	
	<select class="oneclass twoclass">
		<option value="none">Select Year</option>
		<option value="2012">2012</option>
		<option value="2011">2011</option>
		<option value="2010">2010</option>
		<option value="2009">2009</option>
		<option value="2008">2008</option>
	</select>
	
	
### {exp:select_tag:us_states}
This tag will output the US States in a select tag.

#### id = [string] 
(optional) set the id attribute of the select tag

#### name = [string]
(optional) set the name attribute of the select tag

#### class = [string]
(optional) set the class attribute of the select tag, space seperated

#### default = [string]
(optional) an option tag to be added at the top of the select list

#### default_value = [string]
(optional) the value of the default option tag, will be ignored if default is not provided

#### value_format = ['short'|'long']
(optional, defaults to short) set option value to abbreviation or full name

#### Examples

	{exp:select_tag:us_states id="states" name="states"}
	
	*** produces ***
	
	<select id="states" name="states">
		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		...
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
	</select>
	
===
	
	{exp:select_tag:us_states class="oneclass twoclass" default="Select State" value_format="long"}
	
	*** produces ***
	
	<select class="oneclass twoclass">
		<option value="Alabama">Alabama</option>
		<option value="Alaska">Alaska</option>
		...
		<option value="Wisconsin">Wisconsin</option>
		<option value="Wyoming">Wyoming</option>
	</select>