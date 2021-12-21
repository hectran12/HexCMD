<?php

/***
 * Developer : Tran Trong Hoa
 * Support code: Overflower, Google, Different website
 * Theme desgin: Tran Trong Hoa
 * Language Coding: PHP
 * Version PHP Support: 7. -> 8
 * Run environment : Termux, Replit, Cmder, ISH , Terminal, Cmd
 * Pls don't share or public source code!
***/

# Include library 
require("libfunctions-curl.php"); #Functions extra server connection

require("libfunctions-tools.php");
  #Functions tools support code

require("libfunctions-commands.php"); #Funxtions commands 

include("case.commands.php");
include("class.commands.php"); #include class commands
;
#-- TIME 
$TIME_SET = date("h:i:s");

#-- DATA VARIABLES
$DATA_NAME_PATH_COMMANDS = "libcommands-list.hex";

# Warp color draw in the run 

$BLACK = "\033[0;30m";   // BLACK
$RED = "\033[0;31m";     // RED
$GREEN = "\033[0;32m";   // GREEN
$YELLOW = "\033[0;33m";  // YELLOW
$BLUE = "\033[0;34m";    // BLUE
$PURPLE = "\033[0;35m";  // PURPLE
$CYAN = "\033[0;36m";    // CYAN
$WHITE = "\033[0;37m";   // WHITE 

#--- Support print color
$TIME_BAR  = $YELLOW."[".$BLUE.$TIME_SET.$YELLOW."]"."  ";

$MSG_ERROR = $YELLOW."[".$PURPLE."WARNING".$YELLOW."]".$WHITE." - ".$RED;

$MSG_BOX_  = $YELLOW."[".$BLUE."MESSAGE-SERVER".$YELLOW."]".$WHITE." - ".$GREEN;

$LOAD_BAR  = $TIME_BAR.$BLUE."[".$PURPLE."CONNECTION-BAR".$BLUE."]".$GREEN;

$SYSTEM_NOTI = $PURPLE."[".$BLUE."SYSTEM".$PURPLE."]".$GREEN;

$MSG_CMD     = $PURPLE.">> ".$GREEN;
# End warp color

$GET_DOMAIN_WITH_SERVER = DOMAIN_CONNECT_SERVER();

CHECK_CONNECTION($GET_DOMAIN_WITH_SERVER, $MSG_ERROR); # Check Connection Get Doamin

print $LOAD_BAR." Successful retrieval of domain data\n";

$DOMAIN_SERVER = $GET_DOMAIN_WITH_SERVER; // Domain varibale
  

$VERY_INFORMATION = CONNECT_SERVER_ACTIVE_DEVICE($DOMAIN_SERVER); # check Info very 


CHECK_CONNECTION($VERY_INFORMATION, $MSG_ERROR); # Check connection very info 

print $LOAD_BAR." Successfully authenticate user identity\n";

$PARSE_JSON_SERVER = JSON_PARSE($VERY_INFORMATION); #Json parse info_ment get



#----------- AUTH DEVICE VERIFY --------
$TIME_VERYFI = $PARSE_JSON_SERVER->{"DATA"}->{"DATE"}; #Time very 

$IP_VISIT    = $PARSE_JSON_SERVER->{"DATA"}->{"IP"}; #IP VISIT

$USER_AGENT_VIST = $PARSE_JSON_SERVER->{"DATA"}->{"USER_AGENT"}; #USER_AGENT VISIT

$OS_CODE_VERI = $PARSE_JSON_SERVER->{"DIFFERENT"}->{"DATA"}->{"DEVICE_CODE"}; #Auth code device 

$OS_DEVICE  = $PARSE_JSON_SERVER->{"DIFFERENT"}->{"DATA_FULL"}->{"parse"}->{"operating_system"}; #Os 

$VISIT_VERI = $PARSE_JSON_SERVER->{"DIFFERENT"}->{"DATA_FULL"}->{"parse"}->{"simple_software_string"}; #Visit 
#----------------------------------------

print $SYSTEM_NOTI." Hello ".$YELLOW.$OS_CODE_VERI.$GREEN." hope you have a nice day!\n"; // Welcome user join tool 
print $SYSTEM_NOTI." Digital Information : \n";


#--------------- Info input device ------
print $GREEN.'

      $$$$$$$$$$   
     $_________$$ '.$BLUE."DEVICE-CODE: ".$PURPLE.substr($OS_CODE_VERI,0,30)."...".$GREEN.'
     $_$$$$$$$_$$ '.$BLUE."OS         : ".$PURPLE.substr($OS_DEVICE,0,30)."...".$GREEN.'
     $_$_____$_$$ '.$BLUE."VISIT-SITE : ".$PURPLE.substr($VISIT_VERI,0,30)."...".$GREEN.'
     $_$_____$_$$ '.$BLUE."VISIT-TIME : ".$PURPLE.$TIME_VERYFI.$GREEN.'
     $_$_____$_$$ '.$BLUE."IP-VISIT   : ".$PURPLE.substr($IP_VISIT,0,30)."...".$GREEN.'
     $_$_____$_$$ '.$BLUE."USER-AGENT : ".$PURPLE.substr($USER_AGENT_VIST,0,30)."...".$GREEN.'
     $_$$$$$$$_$$ '.$GREEN."■  ".$RED."■  ".$PURPLE."■  ".$CYAN."■  ".$WHITE."■  ".$BLUE."■  ".$GREEN.'
     $_________$$ '.$YELLOW.'Your device is pretty good!'.$GREEN.'
      $$$$$$$$$$

'."\n";
#-------------- end info input device 

CHECK_FILE_EXIT("installation-language.hex", $MSG_ERROR);

$LANGUAGE_DEFAULT = TRANS_LANGUAGE_HEX($MSG_ERROR);


print $LOAD_BAR." ".TRANSTEXT("Language installation successful", $LANGUAGE_DEFAULT, $MSG_ERROR, "translate.googleapis.com")."\n";

#---------- COMMANDER LOADS -----------------

$LIB_COMMANDS = GET_CODE_SERVER_COMMANDS();
CHECK_CONNECTION($LIB_COMMANDS, $MSG_ERROR); # Check connection include lib commands

print $LOAD_BAR." ".TRANSTEXT("Loading the command library!", $LANGUAGE_DEFAULT, $MSG_ERROR, "translate.googleapis.com")."\n";

CHECK_FILE_EXIT($DATA_NAME_PATH_COMMANDS, $MSG_ERROR); # check commands file list 

$DATA_CONNECT_LIB_COMMANDS = CONNECT_FILE_READ($DATA_NAME_PATH_COMMANDS,$MSG_ERROR); // GET DATA COMMANDS

#CHECK_CODE_COMMANDS($DATA_CONNECT_LIB_COMMANDS, $LIB_COMMANDS,$MSG_ERROR);

$TOTAL_COMMANDS = TOTAL_COMMANDS($DATA_NAME_PATH_COMMANDS, $MSG_ERROR); #TOTAL COMMANDS GET 

print $LOAD_BAR." ".TRANSTEXT("Yes ".$TOTAL_COMMANDS." the command can execute. ", $LANGUAGE_DEFAULT, $MSG_ERROR, "translate.googleapis.com")."\n";

$NAME_AND_DES_COMMANDS = GET_NAME_DESCRIPTION($DATA_NAME_PATH_COMMANDS, $MSG_ERROR);// This name and des commands list 
FOR_OUTPUT(30);

$CMD = new CMD_on(); # new class COMMANDS
$CMD->SET_LANG($LANGUAGE_DEFAULT); # set lang output
$CMD->SET_DB_COMMANDS_NAME($DATA_NAME_PATH_COMMANDS); #Set name db commands
$CMD->SET_ERROR($MSG_ERROR); #Set error msg
while(true)
{
  print $MSG_CMD;
  $CMD_GET = fgets(STDIN);
  $RES_CMD = COMMANDS_INPUT($NAME_AND_DES_COMMANDS,$CMD_GET,$MSG_ERROR);
  if (is_array($RES_CMD))
  {
    $CMD->SET_CMD($CMD_GET);
    $GET_STATUS = $CMD->GET_FUNCTION();
    
  } else {
    print $RES_CMD;
  }
}