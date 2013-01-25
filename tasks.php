<?php

  /*
   -----------------------------------------------------------------------------
   Comments and Assumptions
   -----------------------------------------------------------------------------
   Author : Alan Wong
   Date   : 25-Jan-2013
   
   1. Assume range can work in both descending and ascending order
   2. No numerical validation implemented
   3. Allow to user to select each task or both
   4. Input interface via HTML form
   5. PHP programming language is assumed
  */  

  $start_number = @$_REQUEST['start'];
  $end_number = @$_REQUEST['end'];
  $task_type = @$_REQUEST['type'];

  /*
   -----------------------------------------------------------------------------
   Task1 Function
   -----------------------------------------------------------------------------
   */
  function task1($start, $end)
  {
     $range = range($start,$end);
     $result = '';  
     foreach ($range as $value)
     {
        $output = '';
     
        if ($value % 3 == 0 || $value % 5 == 0)
        {
           if ($value % 3 == 0) $output .= 'Fizz';
           if ($value % 5 == 0) $output .= 'Buzz';
        }
        else
        {
           $output .= $value;
        }

        if ($result =='') $result .= "$output";
        else $result .=" $output";
     }
     return $result;      
  }

  /*
   -----------------------------------------------------------------------------
   Task2 Function
   -----------------------------------------------------------------------------
   */
  function task2($start, $end)
  {

    $range = range($start,$end);
    $result = array();  
    
    foreach ($range as $index=>$value)
    {
        $output = '';
     
        if ($value % 3 == 0 || $value % 5 == 0)
        { 
           if ($value % 3 == 0) $output = 'Fizz';
           if ($value % 5 == 0) $output = 'Buzz';
        }
        else
        {
            $output .= $value;
        }
    
        $array_size = count($result); 
        if ($array_size>1)
        {
           $combine = $result[$array_size-1] . "|" . $result[$array_size-2];
        
           if (strstr("Fizz|Buzz*Buzz|Fizz",$combine)) $output = 'Bazz';
        }
    
     $result[] = $output;
     
    }
    return implode(' ',$result);
  }
  
  /*
   -----------------------------------------------------------------------------
   Execution Function
   -----------------------------------------------------------------------------
   */
   $task1_result = '';
   $task2_result = '';
   if ($start_number!='' and $end_number!='')
   {
      switch ($task_type)
      {
        case 'task1':
          $task1_result = task1($start_number,$end_number);
          break;
        case 'task2':
          $task2_result = task2($start_number,$end_number);
          break;
        default:
          $task1_result = task1($start_number,$end_number);
          $task2_result = task2($start_number,$end_number);
          break;            
      }
   }
?>




<html>
  <head>
    <title>Test</title> 
  </head>  
  <body>
    <form action='tasks.php'>
      <b>Start Number : </b><input name='start' value='<?php echo $start_number?>'/><br/>
      <b>End Number : </b><input name='end' value='<?php echo $end_number?>'/><br/>
      <b>Tasks : </b>
      Task 1<input type='radio' name='type' value='task1'/>
      Task 2<input type='radio' name='type' value='task2'/>
      Both <input type='radio' name='type' value='taskall' checked='check'/>
      <input type='submit' /><br/>
    </form>
    <?php
       
       if ($task1_result)
       {
          echo "<h2>Task 1 Result : <u>$task1_result</u></h2>";
       }
       
       if ($task2_result)
       {
          echo "<h2>Task 2 Result : <u>$task2_result</u></h2>";
       }
    
    ?>
    
    
  </body>
</html>