<?php

#Check Code Libary
function CHECK_CODE_COMMANDS ($SOURCE_COMMANDS_FILE , $SOURCE_CONNECT_COMMANDS,$MSG_ERROR)
{
  
  if ($SOURCE_COMMANDS_FILE == $SOURCE_CONNECT_COMMANDS)
  {
    return "success";
  } else {
    $CODE_ERROR = 10;
    $MESSAGE    = "Load Library failed";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    CHECK_CONNECTION($EXPORT_ERR, $MSG_ERROR);
  }
}
# Total commands list
function TOTAL_COMMANDS ($NAME_PATH, $MSG_ERROR)
{
  CHECK_FILE_EXIT($NAME_PATH,$MSG_ERROR);
  $DATA = CONNECT_FILE_READ($NAME_PATH,$MSG_ERROR);
  $DATA_MAIN = EXPRI_MAIN_CLASS_IMPORT($DATA);
  $LIST_DATA = GET_NAME_AND_DATA($DATA_MAIN);
  return count($LIST_DATA);
}
#DATA NAME AND DESCRIPTION COMMANDS 
function GET_NAME_DESCRIPTION ($NAME_PATH, $MSG_ERROR)
{
  CHECK_FILE_EXIT($NAME_PATH,$MSG_ERROR);
  $DATA = CONNECT_FILE_READ($NAME_PATH,$MSG_ERROR);
  $DATA_MAIN = EXPRI_MAIN_CLASS_IMPORT($DATA);
  $LIST_DATA = GET_NAME_AND_DATA($DATA_MAIN);
  return $LIST_DATA;
}
#Get data commands in data code
function EXPRI_MAIN_CLASS_IMPORT ($DATA)
{
  $EXP_MAIN_CLASS = explode('<main note="{command_name} - {description}">', $DATA);
  $EXP_MAIN_CLASS_TWO = explode('<end=main>', $EXP_MAIN_CLASS[1])[0];
  $SKIP_THE_INLINE    = explode("\n", $EXP_MAIN_CLASS_TWO);
  $CREATE_ARRAY_ITEM  = [];
  foreach ($SKIP_THE_INLINE as $ITEM_DATA)
  {
    $TRIM_DATA = trim($ITEM_DATA);
    if($TRIM_DATA){ $CREATE_ARRAY_ITEM[] = $TRIM_DATA; }
  }
  return $CREATE_ARRAY_ITEM;
}
#Get commands name and description 
function GET_NAME_AND_DATA ($DATA_ARRAY)
{
  $DATA_COMMANDS = [];
  foreach ($DATA_ARRAY as $ITEM_DATA)
  {
    $EXP_NAME_AND_DES = explode("-", $ITEM_DATA);
    $NAME_COMMANDS    = trim($EXP_NAME_AND_DES[0]);
    $DESC_COMMANDS    = trim($EXP_NAME_AND_DES[1]);
    $ARRAY_DATAS      = array(
      "NAME_COMMANDS" => $NAME_COMMANDS,
      "DESCRIPTION"   => $DESC_COMMANDS
    );
    $DATA_COMMANDS[]  = $ARRAY_DATAS;
  }
  return $DATA_COMMANDS;
}

#Check Commands 
function COMMANDS_INPUT($LIST_COMMANDS,$COMMANDS,$MSG_ERROR)
{
  $LEN = strlen($COMMANDS);
  #print $LEN; die();
  if($LEN < 5)
  {
    $RESULT = FALSE;
  } else {
  foreach ($LIST_COMMANDS as $CMD)
  {
    $RESULT = FALSE;
    $CMD_S  = $CMD["NAME_COMMANDS"];
    $SESSION_1 = $CMD_S[0].$CMD_S[1].$CMD_S[2].$CMD_S[3];
    $SESSION_2 = $COMMANDS[0].$COMMANDS[1].$COMMANDS[2].$COMMANDS[3];
    if($SESSION_1 == $SESSION_2)
    {
      $RESULT = $CMD;
      break;
    }
    
  }
  }
    if($RESULT == FALSE)
    {
    $CODE_ERROR = 234;
    $MESSAGE    = "Command not found!";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    return CHECK_CONNECTION_NO_EXIT($EXPORT_ERR, $MSG_ERROR);
    
    } else {
      return $RESULT;
    }
  
}