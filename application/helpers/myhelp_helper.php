<?php if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');
/*
	Author		: Md Salahuddin Khan
	Occupation	: Sr. Web & Application Developer
	E-mail		: cisrony@gmail.com
	Skype		: rony_khan2
	Mobile		: 01821720819, 01917827230, 01724754649
*/
	
	 

	// Site Final Launching Date to Get Number of days
	function sitefinalLaunchingNumOfDays(){
		
		$now = time(); // or your date as well
		$your_date = strtotime("2016-07-01");
		$datediff = $now - $your_date;
		return floor($datediff/(60*60*24));
		
	}

	// Sitetitle
	function sitetitle(){
		return 'Where hand made fashion jewelary introducing new style.';
	}

	// Sitetitle admin panel
	function admintitle($breadcrumb){
		return sitename().'.com portal admin panel :: '. $breadcrumb;
	}
	

	// version
	function betaversion(){
		return 'Beta Version 1.0';
	}

	// Listing fee
	function listingfee(){
		return number_format(.20,2);
	}


	// per sales commission
	function salescommission(){
		return 3;
	}


	// Per page records
	function perpagerecords(){
		return 12;
	}
	
	
	// show next payment month
	function nextpaymentmonth(){
		
		$cmonth = date('F Y');
		$year = date('Y');
		
		if($cmonth == "January $year"){
			
			echo "February 1, $year";
			
		}if($cmonth == "February $year"){
			
			echo "March 1, $year";
			
		}if($cmonth == "March $year"){
			
			echo "April 1, $year";
			
		}if($cmonth == "April $year"){
			
			echo "May 1, $year";
			
		}if($cmonth == "May $year"){
			
			echo "June 1, $year";
			
		}else if($cmonth == "June $year"){
			
			echo "July 1, $year";
			
		}else if($cmonth == "July $year"){
			
			echo "August 1, $year";
			
		}else if($cmonth == "August $year"){
			
			echo "September 1, $year";
			
		}else if($cmonth == "September $year"){
			
			echo "October 1, $year";
			
		}else if($cmonth == "October $year"){
			
			echo "Nobember 1, $year";
			
		}else if($cmonth == "Nobember $year"){
			
			echo "December 1, $year";
			
		}else{
			echo "January 1, $year";
		}
		
	}
	
	
	// show payment within this
	function paymentwithin(){
		
		$cmonth = date('F Y');
		$year = date('Y');
		
		if($cmonth == "January $year"){
			
			echo "February (( 1<sup>st</sup> to 3<sup>rd</sup> )), $year";
			
		}if($cmonth == "February $year"){
			
			echo "March ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}if($cmonth == "March $year"){
			
			echo "April ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}if($cmonth == "April $year"){
			
			echo "May ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}if($cmonth == "May $year"){
			
			echo "June ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "June $year"){
			
			echo "July ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "July $year"){
			
			echo "August ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "August $year"){
			
			echo "September ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "September $year"){
			
			echo "October ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "October $year"){
			
			echo "Nobember ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else if($cmonth == "Nobember $year"){
			
			echo "December ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
			
		}else{
			echo "January ( 1<sup>st</sup> to 3<sup>rd</sup> ), $year";
		}
		
	}


	
	// Claculating product rating
	function calculateStarRating($prate,$numrev){ 
		
		$maxNumberOfStars = 5; // Define the maximum number of stars possible.
		$totalRating = $numrev; // Calculate the total number of ratings.
		
		if($totalRating > 0){
			echo $likePercentageStars = number_format(($prate / $totalRating),2);
		}else{
			echo $likePercentageStars = number_format((0 / 1),2);
		}
		
		
		if($likePercentageStars > 0.00 && $likePercentageStars < 1.00){
			$rating = '
			<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars < 1.00){
			$rating = '
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars > 0.00 && $likePercentageStars < 1.50){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 1.50 && $likePercentageStars < 2.00){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 2.00 && $likePercentageStars < 2.50){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 2.50 && $likePercentageStars < 3.00){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 3.00 && $likePercentageStars < 3.50){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 3.50 && $likePercentageStars < 4.00){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 4.00 && $likePercentageStars < 4.50){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 4.50 && $likePercentageStars < 5.00){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star-half-o" style="color:#ffdc1e"></i>
			';
		}elseif($likePercentageStars == 5.00){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			';
		}else{
			$rating = '
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}
		
		return $rating;
	}
	
	
	// Claculating product rating
	function cuserreviewStarRating($numrev){ 
		
		$likePercentageStars = $numrev / 1;
		
		if($likePercentageStars < 1){
			$rating = '
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >=1 && $likePercentageStars < 2){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 2 && $likePercentageStars < 3){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 3 && $likePercentageStars < 4){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars >= 4 && $likePercentageStars < 5){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}elseif($likePercentageStars == 5){
			$rating = '
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			<i class="fa fa-star" style="color:#ffdc1e"></i>
			';
		}else{
			$rating = '
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			<i class="fa fa-star" style="color:#ccc"></i>
			';
		}
		
		return $rating;
	}
	
	
	function fixedcountry(){
		
		return array('USA','Canada','Maxico','England','German','France','Australia','Switzerland','Singapur','Malaysia','Korea','Chaina','Japan','Italy','Netherland','Ireland','India','Bangladesh');
		
	}
	
	
	function shipprocessingtimes($processtime){
		
		if($processtime == '1 business day'){
			$schedule = '+1 Weekday';
		}else if($processtime == '1-2 business days'){
			$schedule = '+2 Weekday';
		}else if($processtime == '1-3 business days'){
			$schedule = '+3 Weekday';
		}else if($processtime == '3-5 business days'){
			$schedule = '+5 Weekday';
		}else if($processtime == '1-2 weeks'){
			$schedule = '+2 Weeks';
		}else if($processtime == '2-3 weeks'){
			$schedule = '+3 Weeks';
		}else if($processtime == '3-4 weeks'){
			$schedule = '+4 Weeks';
		}else if($processtime == '4-6 weeks'){
			$schedule = '+6 Weeks';
		}else if($processtime == '6-8 weeks'){
			$schedule = '+8 Weeks';
		}else{ $schedule = '0 business day'; }
		
		return $schedule;
		
	}


	// Company sitename
	function sitename(){
		return 'CitiSell';
	}


	// Today Date
	function currenTDay(){
		return date("l");
	}
	
	
	// Current Month
	function thisMonth(){
		return date("F Y");
	}
	
	
	// Current Time
	function thisTime(){
		date_default_timezone_set("Asia/Dhaka");
		return date("h:i:s A");
	}
	
	
	
	// add any month to current month
	function addmonths($numberofmonth){
		// replace time() with the time stamp you want to add one day to
		$currentTime = time();
		return date('Y-m-d H:i:s', strtotime("+$numberofmonth months", $currentTime));
	}
	
	
	
	
	// add any month to current month
	function newexpiredate($numberofmonth){
		// replace time() with the time stamp you want to add one day to
		$currentTime = time();
		return date('F d, Y', strtotime("+$numberofmonth months", $currentTime));
	}
	
	
	
	// Current date time
	function cdatetime(){
		// replace time() with the time stamp you want to add one day to
		$currentTime = time();
		return date('Y-m-d H:i:s');
	}
	
	
	// Add custom days in current date of times
	function adddays($numberofdays){
		// replace time() with the time stamp you want to add one day to
		$currentTime = time();
		return date('Y-m-d H:i:s', strtotime("+$numberofdays days", $currentTime));
	}
	
	
	// Add custom days in current date of times
	function lessdays($cdate,$numberofdays){
		// replace time() with the time stamp you want to add one day to
		$currentTime = time();
		return date('$cdate', strtotime("-$numberofdays days", $currentTime));
	}
	
	
	
	// A local time zone function
	function bd_time() 
	{
		// Call this function 
		// date("F j, Y, H:i:s ", bd_time());
		return mktime((gmdate('H').'GMT')+6, date("i"), date("s"), date("m"), date("d"), date("y"));
	}
	

	// Compare date month year 	
	$timezone = "Asia/Dhaka";
	if(function_exists('date_default_timezone_set')) 
	{
		date_default_timezone_set($timezone);
		
		// Today function
		function today() 
		{
			return date('Y-m-d', bd_time());
		}
		
		// Yesterday function
		function yesterday() 
		{
			return date("Y-m-d", strtotime("yesterday"));
		}
		
		// Current week function
		function currentweek() 
		{
			return date('Y-m-d'). ' To ' .date('Y-m-d', strtotime('-7 days'));
		}
		
		// Last week function
		function lastweek() 
		{
			return date('Y-m-d', strtotime('-7 days')). ' To ' . date('Y-m-d', strtotime('-13 days'));
		}
		
		// Currrent month function
		function currentmonth() 
		{
			return date('Y-m');
		}
		
		// Last month function
		function lastmonth() 
		{
			return date("Y-m", strtotime("previous month"));
		}
		
		// Next month function
		function nextmonth() 
		{
			return date("Y-m", strtotime("next month"));
		}
		
		// Currrent year function
		function currentyear() 
		{
			return date("Y");
		}
		
		// Last year function
		function lastyear() 
		{
			return date("Y", strtotime("last year"));
		}
		
		// Difference between day
		function diff_day($sDay, $eDay)
		{
			$sDay = new DateTime(date($sDay));
			$eDay = new DateTime(date($eDay));
			return  $eDay->diff($sDay)->d;
			// Call this function diff_day($v1, $v2);
		}
		
		// Difference between month
		function diff_month($sMonth, $eMonth)
		{
			$sMonth = new DateTime(date($sMonth));
			$eMonth = new DateTime(date($eMonth));
			return  $eMonth->diff($sMonth)->m;
		}
		
		// Difference between year
		function diff_year($sYear, $eYear)
		{
			$sYear = new DateTime(date($sYear));
			$eYear = new DateTime(date($eYear));
			return  $edate->diff($sYear)->y;
		}
		
		// Age calculation 
		function age_cal ($dob)
		{
			$bday = new DateTime($dob);
			$today = new DateTime(date('F.j.Y', time())); // for testing purposes
			$diff = $today->diff($bday);
			printf('%d years, %d months, %d days', $diff->y, $diff->m, $diff->d);
			// Cal this fuction as age_cal('Y-m-d');
		}
		
		// Year calculation 
		function year_cal ($dob)
		{
			$bday = new DateTime($dob);
			$today = new DateTime(date('F.j.Y', time())); // for testing purposes
			$diff = $today->diff($bday);
			printf('%d', $diff->y);
			// Cal this fuction as year_cal('Y-m-d');
		}
	}

	// Bangla Date function
	function bng_date_time($str)
	{
		/* 
			This is a function that convert english date to bangla date
			Call this function
			bng_date_time(date('d-m-Y h:i:s A', bd_time()));
		*/

		$eng = array('January','February','March','April','May','June','July','August','September','October','November','December',
		'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',
		'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',
		'Sat','Sun','Mon','Tue','Wed','Thu','Fri',
		'1','2','3','4','5','6','7','8','9','0',
		'am','pm');
		
		$bng = array('জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর',
		'জানু','ফেব্রু','মার্চ','এপ্রি','মে','জুন','জুলা','আগ','সেপ্টে','অক্টো','নভে','ডিসে',
		'শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার',
		'শনি','রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র',
		'১','২','৩','৪','৫','৬','৭','৮','৯','০',
		'পূর্বাহ্ণ','অপরাহ্ণ');
		
		return str_ireplace($eng, $bng, $str);
	}

	/*
		This function convert number bangla/english
		Call this function
		input $val1='0123456789'; $val2='০১২৩৪৫৬৭৮৯';
		output echo enbn($val1); echo bnen($val2);
	*/

	// Convert bangali to english
	function bnen($val)
	{
		$bn = array ( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
		$en = array ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		return str_ireplace($bn, $en, $val);
	}
	
	// Convert english to bangali
	function enbn($val)
	{
		$en = array ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		$bn = array ( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
		return str_ireplace($en, $bn, $val);
	}
	
	/*
		This is convert number to word in english
		Call this function
		$number = 10523; 
		$str = engNumberToWords(round($number),0);
	*/
	// Taka in word function 
	 function engNumberToWords($number)
	 {
        // A function to convert numbers into Bangladesh readable words with Cores, Lakhs and Thousands.
        $words = array(
        '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
        '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
        '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
        '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
        '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
        '80' => 'eighty','90' => 'ninty');
        // First find the length of the number
        $number_length = strlen($number);
        // Initialize an empty array
        $number_array = array(0,0,0,0,0,0,0,0,0);       
        $received_number_array = array();
        // Store all received numbers into an array
        for($i=0;$i<$number_length;$i++) 
		{ 
			$received_number_array[$i] = substr($number,$i,1); 
		}
        // Populate the empty array with the numbers received - most critical operation
        for($i=9-$number_length,$j=0;$i<9;$i++,$j++) 
		{ 
			$number_array[$i] = $received_number_array[$j]; 
		}
        $number_to_words_string = "";       
        // Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
        for($i=0,$j=1;$i<9;$i++,$j++)
		{
            if($i==0 || $i==2 || $i==4 || $i==7)
			{
                if($number_array[$i]=="1")
				{
                    $number_array[$j] = 10+$number_array[$j];
                    $number_array[$i] = 0;
                }       
            }
        }
        $value = "";
        for($i=0;$i<9;$i++)
		{
            if($i==0 || $i==2 || $i==4 || $i==7)
			{    
				$value = $number_array[$i]*10; 
			}
            else
			{ 
				$value = $number_array[$i];    
			}           
            if($value!=0)
			{ 
				$number_to_words_string.= $words["$value"]." "; 
			}
            if($i==1 && $value!=0)
			{    
				$number_to_words_string.= "Crores "; 
			}
            if($i==3 && $value!=0)
			{    
				$number_to_words_string.= "Lakhs ";    
			}
            if($i==5 && $value!=0)
			{    
				$number_to_words_string.= "Thousand "; 
			}
            if($i==6 && $value!=0)
			{    
				$number_to_words_string.= "Hundred "; 
			}
        }
        if($number_length>9)
		{ 
			$number_to_words_string = "Sorry This does not support more than 99 Crores"; 
		}
        return ucwords(strtolower("In words : ".$number_to_words_string)." Taka Only.");
    }
	
	/*
		This is convert number to word in english
		Call this function
		$number = 10523; 
		$str = bngNumberToWords(round($number),0);
	*/
	
	// Taka in word function 
	 function bngNumberToWords($number)
	 {
        // A function to convert numbers into bangladesh readable words with Cores, Lakhs and Thousands.
        $words = array('0'=>'','1'=>'এক','2'=>'দুই','3'=>'তিন','4'=>'চার','5'=>'পাঁচ','6'=> 'ছয়','7'=>'সাত','8'=>'আট','9'=>'নয়','10'=>'দশ','11'=>'এগার','12'=>'বার','13'=>'তের','14'=>'চৌদ্দ','15'=>'পনের','16'=>'ষোল','17'=>'সতের','18'=>'আঠার','19'=>'ঊনিশ','20'=>'বিশ','21'=>'একুশ','22'=>'বাইশ','23'=>'তেইশ','24'=>'চব্বিশ','25'=>'পঁচিশ',
		'26'=>'ছাব্বিশ','27'=>'সাতাশ','28'=>'আঠাশ','29'=>'ঊনত্রিশ','30'=>'ত্রিশ','31'=>'একত্রিশ','32'=>'বত্রিশ','33'=>'তেত্রিশ','34'=>'চৌত্রিশ','35'=>'পয়ত্রিশ','36'=>'ছত্রিশ','37'=>'সাইত্রিশ','38'=>'আটত্রিশ','39'=>'ঊনচল্লিশ','40'=>'চল্লিশ','41'=>'একচল্লিশ','42'=>'বিয়াল্লিশ','43'=>'তিতাল্লিশ','44'=>'চুয়াল্লিশ','45'=>'পয়তাল্লিশ','46'=>'ছেচল্লিশ','47'=>'সাতচল্লিশ','48'=>'আটচল্লিশ','49'=>'ঊনপঞ্ঝাশ','50'=>'পঞ্ঝাশ',
		'51'=>'একান্ন','52'=>'বায়ান্ন','53'=>'তিপ্পান্ন','54'=>'চুয়ান্ন','55'=>'পঞ্ঝান্ন','56'=>'ছাপ্পান্ন','57'=>'সাতান্ন','58'=>'আটান্ন','59'=>'ঊনষাট','60'=>'ষাট ','61'=>'একষট্রি','62'=>'বাষট্রি','63'=>'তেষট্রি','64'=>'চৌষট্রি','65'=>'পয়ষট্রি','66'=>'ছেষট্রি','67'=>'সাতষট্রি','68'=>'আটষট্রি','69'=>'ঊনসত্তর','70'=>'সত্তর','71'=>'একাত্তর','72'=>'বায়াত্তর','73'=>'তেয়াত্তর','74'=>'চুয়াত্তর','75'=>'পচাত্তর',
		'76'=>'ছিয়াত্তর','77'=>'সাতাত্তর','78'=>'আটাত্তর','79'=>'ঊনআশি','80'=>'আশি','81'=>'একাশি','82'=>'বিরাশি ','83'=>'তিরাশি','84'=>'চুরাশি','85'=>'পঁচাশি','86'=>'ছিয়াশি','87'=>'সাতাশি','88'=>'আটাশি','89'=>'ঊননব্বই','90'=>'নব্বই','91'=>'একানব্বই','92'=>'বিরানব্বই','93'=>'তিরানব্বই','94'=>'চুরানব্বই','95'=>'পচানব্বই','96'=>'ছিয়ানব্বই','97'=>'সাতানব্বই','98'=>'আটানব্বই','99'=>'নিরানব্বই');
        // First find the length of the number
        $number_length = strlen($number);
        // Initialize an empty array
        $number_array = array(0,0,0,0,0,0,0,0,0);       
        $received_number_array = array();
        // Store all received numbers into an array
        for($i=0;$i<$number_length;$i++)
		{    
			$received_number_array[$i] = substr($number,$i,1);
		}
        // Populate the empty array with the numbers received - most critical operation
        for($i=9-$number_length,$j=0;$i<9;$i++,$j++)
		{ 
			$number_array[$i] = $received_number_array[$j];
		}
        $number_to_words_string = "";       
        // Finding out whether it is teen, tweenty......ninety 
        for($i=0,$j=1;$i<9;$i++,$j++)
		{
            if($i==0 || $i==2 || $i==4 || $i==7)
			{
                if($number_array[$i]=="1")
				{
                    $number_array[$j] = 10+$number_array[$j];
                    $number_array[$i] = 0;
				}  
				if($number_array[$i]=="2")
				{
                    $number_array[$j] = 20+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="3")
				{
                    $number_array[$j] = 30+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="4")
				{
                    $number_array[$j] = 40+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="5")
				{
                    $number_array[$j] = 50+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="6")
				{
                    $number_array[$j] = 60+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="7")
				{
                    $number_array[$j] = 70+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="8")
				{
                    $number_array[$j] = 80+$number_array[$j];
                    $number_array[$i] = 0;
				}
				if($number_array[$i]=="9")
				{
                    $number_array[$j] = 90+$number_array[$j];
                    $number_array[$i] = 0;
				}
            }
        }
        $value = "";
        for($i=0;$i<9;$i++)
		{
            if($i==0 || $i==2 || $i==4 || $i==7)
			{
				$value = $number_array[$i]*10;
			}
            else
			{
				$value = $number_array[$i];
			}           
            if($value!=0)
			{		
				$number_to_words_string.= $words["$value"]." ";
			}
            if($i==1 && $value!=0)
			{		
				$number_to_words_string.= "কোটি ";
			}
            if($i==3 && $value!=0)
			{		
				$number_to_words_string.= "লক্ষ ";
			}
            if($i==5 && $value!=0)
			{		
				$number_to_words_string.= "হাজার ";
			}
            if($i==6 && $value!=0)
			{		
				$number_to_words_string.= "শত ";
			}
        }
        if($number_length>9)
		{
			$number_to_words_string = '<span style="color:red">'."দুঃখিত এই ফাংশনটি ৯৯ কোটির উপরে সাপোর্ট করে না।".'</span>';
		}
        return ucwords(strtolower('কথায়ঃ '.$number_to_words_string)."টাকা মাত্র।");
    }
	
	

// number check for less than 10 or Greater
	function checkNumber($parameter){
		
		if($parameter < 10){
			return '0'.$parameter;
		}else{ return $parameter; }
		
	}
		
	
	
	
	// Month days count
	function monthdaycount($cmonth){
		
		//$cmonth = date('F Y');
		$year = date('Y');
		
		if($cmonth == "January $year"){
			
			return 31;
			
		}if($cmonth == "February $year"){
			
			return 29;
			
		}if($cmonth == "March $year"){
			
			return 31;
			
		}if($cmonth == "April $year"){
			
			return 30;
			
		}if($cmonth == "May $year"){
			
			return 31;
			
		}else if($cmonth == "June $year"){
			
			return 30;
			
		}else if($cmonth == "July $year"){
			
			return 31;
			
		}else if($cmonth == "August $year"){
			
			return 31;
			
		}else if($cmonth == "September $year"){
			
			return 30;
			
		}else if($cmonth == "October $year"){
			
			return 31;
			
		}else if($cmonth == "Nobember $year"){
			
			return 30;
			
		}else{
			return 31;
		}
		
	}

	

// Shorten/Truncate very long text
	
	function longtoshorttext($text, $length = 0)
	{
		
		if ($length > 0 && strlen($text) > $length) // Truncate the item text if it is too long.
		{
			$tmp = substr($text, 0, $length); // Find the first space within the allowed length.
			$tmp = substr($tmp, 0, strrpos($tmp, ' '));
			if (strlen($tmp) >= $length - 3) { // If we don't have 3 characters of room, go to the second space within the limit.
				$tmp = substr($tmp, 0, strrpos($tmp, ' '));
			}
			$text = $tmp.'...';
		}
		return $text;
		
	}

	//$string = 'The behavior will not truncate an individual word, it will find the first space that is within the limit and truncate.';
	//echo longtoshorttext($string,100);
	
	
	
