<?php

  /*
   -----------------------------------------------------------------------------
   Comments and Assumptions
   -----------------------------------------------------------------------------
   Author : Alan Wong
   Date   : 25-Jan-2013
   Version : 1.1
   
   1. Assume range can work in both descending and ascending order
   2. No numerical validation implemented
   3. Allow to user to select each task or both
   4. Input interface via HTML form
   5. PHP programming language is assumed
  */  

  $start_number = @$_REQUEST['start'];
  $end_number = @$_REQUEST['end'];
  $task_type = @$_REQUEST['type'];
  
  #---Assumption :
  #---If non-numrical value entered, system will set its value to =''
  #---System will not perform any task and return to input form
  #---Any number will be preserved and will be set as default value
  if (!is_numeric($start_number)) $start_number='';
  if (!is_numeric($end_number)) $end_number='';
     
  /*
   -----------------------------------------------------------------------------
   Task1 Function
   -----------------------------------------------------------------------------
   */
  function task1($start, $end)
  {
     #---Create range of number according to user input-------------------------
     $range = range($start,$end);

     #---Storage of accumulated result------------------------------------------
     $result = '';
     foreach ($range as $value)
     {
        #---Storing of result depend of range value-----------------------------
        $output = '';
        
        #---Apply Rules accordingly---------------------------------------------
        #---Note : value maybe statisfy both multiple of 3 and 5 ---------------
        #---     : just out the numerical value only----------------------------
        if ($value % 3 == 0 || $value % 5 == 0)
        {
           if ($value % 3 == 0) $output .= 'Fizz';
           if ($value % 5 == 0) $output .= 'Buzz';
        }
        else
        {
           $output .= $value;
        }

        #---Append to accumulate value------------------------------------------
        if ($result =='') $result .= "$output";  //Just to avoid leading space
        else $result .=" $output"; //Add a space in front
     }
     
     #---Final Result-----------------------------------------------------------
     return $result;
  }

  /*
   -----------------------------------------------------------------------------
   Task2 Function
   -----------------------------------------------------------------------------
   */
  function task2($start, $end)
  {
      #---Create range of number according to user input-------------------------
      $range = range($start,$end);

     #---Storage of accumulated result-------------------------------------------
      $result = array();
      foreach ($range as $index=>$value)
      {
          #---Decide which rule to be applied------------------------------------
          #---Assumption : when value satisfied both multiple of 3 and 5
          #              : Will treat as different new value "FizzBuzz"
          #              : Which will not be treated as consecutive Fizzes/Buzzes.
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
          
          #---Check the size of storage--------------------------------------------
          #---Need not bother the first two values---------------------------------
          $array_size = count($result); 
          if ($array_size>1)
          {
             #---Retrieve the previous two values----------------------------------
             $combine = "{$result[$array_size-1]}|{$result[$array_size-2]}";
             
             #---Verify if new rule statified--------------------------------------
             #---If satisfied, override output value as required-------------------
             if (strstr("*Fizz|Buzz*Buzz|Fizz*",$combine)) $output = 'Bazz';
          }
          
          #---Append to accumulated value-------------------------------------------
          $result[] = $output;
       }
       
    #---Final Value-----------------------------------------------------------------
    return implode(' ',$result);
  }
  
  /*
   -----------------------------------------------------------------------------
   Execution Function
   -----------------------------------------------------------------------------
   */
    switch ($task_type)
    {
        case 'task1':
          $checked_flag1='checked';
          break;
        case 'task2':
          $checked_flag2='checked';
          break;
        default:
          $checked_flag3='checked';
          break;            
    }
  
   $task1_result = '';
   $task2_result = '';
  

   if ($start_number!='' and $end_number!='')
   {
      switch ($task_type)
      {
        case 'task1':
          $task1_result = task1($start_number,$end_number);
          $checked_flag1='checked';
          break;
        case 'task2':
          $task2_result = task2($start_number,$end_number);
          $checked_flag2='checked';
          break;
        default:
          $task1_result = task1($start_number,$end_number);
          $task2_result = task2($start_number,$end_number);
          $checked_flag3='checked';
          break;            
      }
   }
?>

<!--
  1. HTML Input form for inputting numbers
  2. Selection of Tasks.
  3. Load previous input value into input textbox
  4. Assumption : 
-->
<html>
  <head>
    <title>Test</title> 
  </head>  
  <body>
    <form action='tasks.php'>
      <table border='0' cellpadding='1' cellspacing='0' width='30%'> 
      <tr>
        <td colspan='2'><b>Please Enter Number</b></td>
      </tr>
      <tr>
      <tr>
        <td width='30%'><b>Start Number : </b></td>
        <td><input name='start' value='<?php echo $start_number?>'/></td>
      </tr>
      <tr>
        <td><b>End Number : </b></td>
        <td><input name='end' value='<?php echo $end_number?>'/></td>
      </tr>
      <tr>
        <td><b>Tasks : </b></td>
        <td>
          Task 1<input type='radio' name='type' value='task1' <?php echo $checked_flag1; ?>/>
          Task 2<input type='radio' name='type' value='task2' <?php echo $checked_flag2; ?>/>
          Both <input type='radio' name='type' value='taskall' <?php echo $checked_flag3; ?>/>
        </td>
      </tr>
      <tr>
        <td colspan='2' align='center'><input type='submit' /></td>
      </tr>
      </table>
    </form>
    <!-- Output Result to Screen if there is any -->
    <?php
       
       #---Task 1 Result--------------------------------------------------------
       if ($task1_result) echo "<h2>Task 1 Result : <u>$task1_result</u></h2>";

       #---Task 2 Result--------------------------------------------------------       
       if ($task2_result) echo "<h2>Task 2 Result : <u>$task2_result</u></h2>";
    
    ?>
    
  </body>
</html>
