<?php

/********CODE BY TRẦN TRỌNG HÒA*********/


class CMD_on extends USING_CMD {
  
  public $COMMANDS;
  public $LANG;
  public $DB_NAME;
  public $ERROR;
  
  public function SET_CMD ($CMD) # Set commands input
  {
    $this->COMMANDS = $CMD;
  }
  public function SET_LANG ($TYPE) # Set lang output
  {
    $this->LANG     = $TYPE;
  }
  public function SET_ERROR ($ERROR)
  {
    $this->ERROR    = $ERROR;
  }
  public function SET_DB_COMMANDS_NAME ($NAME) # Set name data comamnds
  {
    $this->DB_NAME = $NAME;
  }
  public function GET_FUNCTION () # get func commands!
  {
    $EX_COMMANDS = LEFT_EXPLODE($this->COMMANDS," ");
    
    if(count($EX_COMMANDS) == 2)
    {
    $COM = $EX_COMMANDS[0];
    $CONNECT_FILE = file_get_contents(str_replace("class.","case.",__FILE__));
    if(count(explode("function ".$COM." (",$CONNECT_FILE)) == 2)
    {
     eval('return $this->'.$COM.'("'.$this->LANG.'","'.$EX_COMMANDS[1].'");');
     return "True";
    } else {
    $CODE_ERROR = 234;
    $MESSAGE    = "Command not found!";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    print CHECK_CONNECTION_NO_EXIT($EXPORT_ERR, $this->ERROR);
    
    }
    } else {
      
    $this->COMMANDS .= "s";
    $CMD_S = explode("\n", $this->COMMANDS);
    $COM   = $CMD_S[0].$CMD_S[1];
    $CONNECT_FILE = file_get_contents(str_replace("class.","case.",__FILE__));
    if(strpos($CONNECT_FILE,"function ".$COM))
    {
     eval('return $this->'.$COM.'("'.$this->LANG.'","");');
     return "True";
    } else {
    $CODE_ERROR = 234;
    $MESSAGE    = "Command not found!";
    $URL        = "elizhex.com";
    $EXPORT_ERR = DIS_TEXT_CONVERT_TO_ERROR($CODE_ERROR, $MESSAGE, $URL);
    print CHECK_CONNECTION_NO_EXIT($EXPORT_ERR, $this->ERROR);
    
    }

    }
  
}
}