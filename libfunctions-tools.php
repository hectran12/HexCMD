<?php


# read file 
function CONNECT_FILE_READ ($NAME_PATH, $MSG_ERROR)
{
  CHECK_FILE_EXIT($NAME_PATH,$MSG_ERROR);
  return file_get_contents($NAME_PATH);
}
# JSON PARSE 
function JSON_PARSE ($DATA)
{
  $JSON_DECODE_DATA = json_decode($DATA);
  
  return $JSON_DECODE_DATA;
}
#TRANS LANGUAGE. .HEX 
function TRANS_LANGUAGE_HEX ($MSG_ERROR)
{
  $CONNECT_FILE = file_get_contents("installation-language.hex");
  $EXP_LANGUAGE = explode("<SET_DEFAULT_LANGUAGE_TOOL_RUN> : ", $CONNECT_FILE);
  $AMOUNT = count($EXP_LANGUAGE);
  if($AMOUNT == 2)
  {
    return trim($EXP_LANGUAGE[1]);
  } else {
    $CODE_ERROR = 9;
    $MESSAGE    = "Unknown language for translation [error]";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    CHECK_CONNECTION($EXPORT_ERR, $MSG_ERROR);
  }
}
#CHECK FILE EXITS
function CHECK_FILE_EXIT ($NAME_PATH, $MSG_ERROR)
{
  if(!file_exists($NAME_PATH))
  {
    $CODE_ERROR = 8;
    $MESSAGE    = "There is a problem with the download resource, there is a deficiency in the \033[1;93m".$NAME_PATH."\033[0;31m file";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    CHECK_CONNECTION($EXPORT_ERR, $MSG_ERROR);
  }
}

#Function bar
function FOR_OUTPUT ($AMOUNT)
{
  for($V = 1;$V <= $AMOUNT;$V++)
  {
    print "\033[0;37m"."- ";
  }
  print "\n";
}

#LEFT EXPLODE 
function LEFT_EXPLODE($DATA,$CHAR)
{
  $EP = explode($CHAR, $DATA);
  $DB = $EP[0];
  $LF = "";
  for($V=1;$V<=count($EP)-1;$V++)
  {
    $LF .= $EP[$V].$CHAR;
  }
  if($LF == FALSE)
  {
  $AR = array(0=>$DB);
  } else {
  $AR = array(0=>$DB,1=>$LF);
  }
  return $AR;
}