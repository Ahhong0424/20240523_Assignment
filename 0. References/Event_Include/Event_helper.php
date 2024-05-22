<?php
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_NAME", 'asm');

//validate Event Title
function validateEventTitle($title){
        if($title==null){
        return 'Please enter <b>Event Title</b>';
    }else if (strlen($title)>300){
        return '<b>Event Title</b> must not more than 300 character';
    }
    /*else if(!preg_match('/^([0-9]|[A-Z]) $/+', $title)){
        return 'Invalid <b>Student ID</b> format';       
    }*/  
}

//validate Event Info
function validateEventInfo($info){
        if($info==null){
        return 'Please enter <b>Event Info</b>';
    }else if (strlen($info)>1000){
        return '<b>Event Title</b> must not more than 1000 character';
    }
}

//validate Event Day
function validateEventDay($day){
        if($day==null){
        return 'Please enter <b>Event Day</b>';
    }
}


//validate Event Time
function validateEventTime($time){
        if($time==null){
        return 'Please enter <b>Event Time</b>';
    }
}

//validate Event Number of Participate
function validateNumberofParticipate($number){
        if($number==null){
        return 'Please enter <b>Number of Participate</b>';
    }else if($number > 50){
        return 'Can\'t more than 50 number of participate';
    }else if($number < 0){
        return 'Can\'t less than 0 bumber of participate';
    }
}

//validate Event Venue
function validateEventVenue($venue){
        if($venue==null){
        return 'Please enter <b>Event Venue</b>';
    }else if(strlen($venue) > 300){
        return 'Can\'t more than 300 number of participate';
    }
}


//validate Event Price
function validateEventPrice($price){
    if($price==null){
        return 'Please enter <b>Event Price</b>';
    }else if($price > 50){
        return 'Event price can\'t more than RM 50 ';
    }else if($price < 0){
        return 'Event price can\'t less than RM 0';
    }
}
