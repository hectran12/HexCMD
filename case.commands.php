<?php

class USING_CMD {
  
  #Commands exit
  public function exits ($LANG,$NULL) {
    die("\033[0;37m".TRANSTEXT("Running program has ended",$LANG,"","translate.googleapis.com"));
  }
  
  #Commands help cmd
  public function help ($LANG,$PROT) {
    $OUTPUT_DB = GET_NAME_DESCRIPTION($this->DB_NAME,"\033[0;37m");
    print "\033[0;37m";
    $GET_CMD   = COMMANDS_INPUT($OUTPUT_DB,$PROT,"");
    if(is_array($GET_CMD))
    {
      $BOX = "\033[0;31m[\033[0;34m"."BOOK"."\033[0;31m"."]\033[0;37m >>\033[0;32m ".$GET_CMD["NAME_COMMANDS"]." | ".TRANSTEXT($GET_CMD["DESCRIPTION"],$LANG,"","translate.googleapis. com")."\n";
      print($BOX);
    } else {
      print $GET_CMD;
    }
  }
  #commands list all commands
  public function helps ($LANG)
  {
    $OUTPUT_DB = GET_NAME_DESCRIPTION($this->DB_NAME,"\033[0;37m");
    
    print "\033[1;92m[\033[1;93m".TRANSTEXT("The current command has in system",$LANG,"","translate.googleapis.com")."\033[1;92m]\n";
    $NUM_COMMANDS = 0;
    foreach ($OUTPUT_DB as $ITEM)
    {
      $NUM_COMMANDS++;
      $BOX = "\033[0;31m[\033[0;34m".$NUM_COMMANDS."\033[0;31m"."]\033[0;37m >>\033[0;32m ".$ITEM["NAME_COMMANDS"]." | ".TRANSTEXT($ITEM["DESCRIPTION"],$LANG,"","translate.googleapis. com")."\n";
      print($BOX);
    }
  }
  #Function set lang 
  public function lang ($LANG, $TYPE)
  {
    $TYPE = str_replace(" ","",$TYPE);
    $LANG_DEF = TRANS_LANGUAGE_HEX("\033[0;37m");
    $CONNECT_FILE = file_get_contents("installation-language.hex");
    $REP_C        = str_replace($LANG_DEF,$TYPE,$CONNECT_FILE);
    $OPEN         = fopen("installation-language.hex","w+");
    fwrite($OPEN,$REP_C);
    $CHECK        = file_get_contents("installation-language.hex");
    $LANG_WA = TRANS_LANGUAGE_HEX("\033[0;37m");
    if(count(explode($TYPE,$CHECK)) == 2)
    {

      $BOX = "\033[0;31m[\033[0;34m"."LANG"."\033[0;31m"."]\033[0;37m >>\033[0;32m ".TRANSTEXT("Changed the language successfully, run the program again!",$LANG_WA,"","translate.googleapis.com")."\n";
      die($BOX);
    } else {
      print "Error :(.\n";
    }
  }
  #Run commands on hex evn 
  public function cons ($LANG, $CMD)
  {
    eval('system("'.$CMD.'");');
  }
  #downloads / view website 
  public function raws ($LANG, $CMD)
  {
    $EX_PROT = explode(' ', $CMD);
    $BOX     = "";
  //  print_r(count($EX_PROT));
    if(count($EX_PROT) == 4)
    {
      $TYPE = trim($EX_PROT[0]);
      $LINK = trim($EX_PROT[1]);
      $FILE = trim($EX_PROT[2]);
      switch ($TYPE)
        {
          case "view":
           $SOURCE = GET_SOURCE($LINK);
           print $SOURCE."\n";
           break;
          case "download":
            if(file_exists($FILE))
            {
             $BOX = "\033[0;31m[\033[0;34m"."RAWS"."\033[0;31m"."]\033[0;37m >>\033[0;31m ".TRANSTEXT("Unable to save to this file!!",$LANG,"","translate.googleapis.com")."\n";
             break;
            } else {
             $SOURCE     = GET_SOURCE($LINK);
             $COUNT_TEXT = strlen($SOURCE);
             $OPEN       = fopen($FILE,"w+");
             $C_TEXT     = round($COUNT_TEXT / 100);
             $N = $C_TEXT;
             $S = 1;
             $TEXT = TRANSTEXT("Downloading ",$LANG,"","translate.googleapis.com");
             for($V=0;$V<=$COUNT_TEXT-1;$V++)
             {
               if($V == $N)
               {
              $DOW = "\033[0;31m[\033[0;34m"."RAWS-DOWNLOAD"."\033[0;31m"."]\033[0;37m >>\033[0;32m ".$TEXT."\033[1;95m $S%        ";
              print "\r".$DOW."\r";
              $S++;
               }
               fwrite($OPEN,$SOURCE[$V]);
             }
            $BOX = "\033[0;31m[\033[0;34m"."RAWS"."\033[0;31m"."]\033[0;37m >>\033[0;32m ".TRANSTEXT("Successfully saved to file",$LANG,"","translate.googleapis.com")." "."\"\033[1;95m$FILE\033[0;32m\""."\n";
             break;
            }
          default:
            $BOX = "\033[0;31m[\033[0;34m"."RAWS"."\033[0;31m"."]\033[0;37m >>\033[0;31m ".TRANSTEXT("category not found ",$LANG,"","translate.googleapis.com")." "."\"\033[1;95m$TYPE\033[0;31m\""."\n";
        }
      
    } else {
      $BOX = "\033[0;31m[\033[0;34m"."RAWS"."\033[0;31m"."]\033[0;37m >>\033[0;31m ".TRANSTEXT("Missing attributes!!",$LANG,"","translate.googleapis.com")."\n";
    }
    print $BOX;
  }

  # cau lenh get image loli  // so nho them s vao func :) , so lon tji khong s 
  public function lolis ($LANG)
  {
    print "Có cái nịt :).\n";
  }

}