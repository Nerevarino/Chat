<?php

//definitions
  $max_messages=20;
  $message_text="";
  $message_file=null;
  $visible_messages=null;
  $chat_text="";
  $file_size = 0;
  

  function print_message($position)
  {
      global $visible_messages;
      global $max_messages;
      
      if($visible_messages!=null){
          $position=$max_messages-$position;
          if(isset($visible_messages[$position])){
              echo $visible_messages[$position];
          }
          else
          {
              echo "";
          }
      }
      else
      {
          echo "";
      }
  }



  function receive_input()
  {
      global $message_text;
      $message_text = $_POST['message_text'];          
  }

  function save_input()
  {
      global $message_text;
      global $message_file;
      
      $message_file=fopen("chat.log", "a");
      fwrite($message_file,$message_text . "\n");
      fclose($message_file);
      $message_file=null;    
  }

  function prepare_output()
  {
      global $visible_messages;
      global $message_file;
      global $max_messages;
      global $chat_text;
      global $file_size;
      
      $visible_messages=array();
      
      $message_file=fopen("chat.log","r");
      fseek($message_file, 0, SEEK_END);
      $file_size=ftell($message_file);
      fseek($message_file, 0, SEEK_SET);      
      $chat_text=fread($message_file, $file_size);
      fclose($message_file);
      $message_file=null;

      $messages_array=explode("\n",$chat_text);
      $messages_count = count($messages_array);
      if($messages_count > $max_messages){
          for($i=$messages_count - 1, $k=0; $k<$max_messages; $i--, $k++){
              $visible_messages[]=$messages_array[$i];
          }
      }
      else{
          for($i=$messages_count - 1; $i>=0; $i--){
              $visible_messages[]=$messages_array[$i];
          }          
      }
      
  }


//definitions








//script
if(isset($_POST['message_text'])){
    receive_input();
    save_input();
}

prepare_output();
//script

?>


<!DOCTYPE html>
<html>
	<head>
		<title> Тестовый чат </title>
		<style>@import url('style.css');</style>
	</head>
	<body>
		<div id="interface">
			<div id="chatview">
                <p><?php print_message(1);?></p>
				<p><?php print_message(2);?></p>
    			<p><?php print_message(3);?></p>
				<p><?php print_message(4);?></p>
				<p><?php print_message(5);?></p>
				<p><?php print_message(6);?></p>
    			<p><?php print_message(7);?></p>
				<p><?php print_message(8);?></p>
				<p><?php print_message(9);?></p>
				<p><?php print_message(10);?></p>
    			<p><?php print_message(11);?></p>
				<p><?php print_message(12);?></p>
				<p><?php print_message(13);?></p>
				<p><?php print_message(14);?></p>
    			<p><?php print_message(15);?></p>
				<p><?php print_message(16);?></p>
				<p><?php print_message(17);?></p>
				<p><?php print_message(18);?></p>
    			<p><?php print_message(19);?></p>
				<p><?php print_message(20);?></p>                 
			</div>
			<form id="form" method="post" action="index.php">
				<input name="message_text" type="text" id="usermsg" size="63" />
				<input type="submit" name="enter" id="enter" value="Send" />
			</form>
		</div>
	</body>
</html>
