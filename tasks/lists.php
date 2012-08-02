<?php

class Mailchimp_Lists_Task
{
	public function run()
	{
		// get lists
		$lists = Mailchimp::lists();
		
		// return
		echo print_r($lists, true);
	}
}