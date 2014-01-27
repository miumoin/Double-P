<?php
/*If this module has a form then follow the following instructions:
 * call the form_processor() function to initiate processing
 * Create form with action equal to BASEurl/modulename/?processing=formname
 * Create a function anywhere in that module's script with name process_formname()
 */
 
form_processor();

heading();

echo "<form action='".BASE."/example/?process=exampleform' method='post'><input type='text' name='hi'><input type='submit'></form>";

function process_exampleform()
{
	echo "Hello";
}

footing();
?>
