<?php

    function get_holidays($date){
        global $DB;
        $query = ("SELECT * FROM table_name where date = '$date'");
        $iterator = $DB->request($query);
        return count($iterator);
    }

    $startDate =strtotime('2020-06-25');
    //$startDate = strtotime($data['start_date']);
    $endDate = strtotime('2020-07-01');

    // $solutionDate= date('2020-06-30');
    $solutionDate= date('2020-06-19');
    echo' date solucion de entrada: ' .$solutionDate;

    function new_solution_date($startDate, $endDate, $solutionDate){
      $date = '';
      $holidays = 0;
      $days_t = 0;
      $weekend = 0;
      $weekend_holidays = 0;
      for ($i = $startDate; $i <= $endDate; $i += 86400) {
        if ($startDate != null && $endDate != null) {
          $days_t++;
          $date = date("Y-m-d", $i);
          if (get_holidays($date)) {
              $holidays++;
              $weekend_holidays++;
          } else if (get_holidays($date) == 0) {
          $numb_day = date("w", strtotime($date));
            if ($numb_day > 5 or $numb_day < 1) {
                $weekend++;
                $weekend_holidays++;
            }
          }
        }
      }
      $businessday = $days_t - $weekend_holidays;
      // $businessday =7;
      $n=0;
      while ($n < $businessday){
        $numb_day_s= (date('w',strtotime($solutionDate)));
          if(get_holidays($solutionDate) || ($numb_day_s == 0)  || ($numb_day_s == 6) ){
            $solutionDate = date("Y-m-d",strtotime($solutionDate."+ 1 days"));
            $businessday=$businessday +1;
            $n++;
          }else{
            $n++;
            $solutionDate = date("Y-m-d",strtotime($solutionDate."+ 1 days"));
            $num_day = date("w", strtotime($solutionDate));
            if($num_day==6){
              $solutionDate = date("Y-m-d",strtotime($solutionDate."+ 2 days"));
            }else if(get_holidays($solutionDate)==true){
              $solutionDate = date("Y-m-d",strtotime($solutionDate."+ 1 days"));
              $num_day = date("w", strtotime($solutionDate));
              if($num_day==6){
                $solutionDate = date("Y-m-d",strtotime($solutionDate."+ 2 days"));
              }
            }
          }
      }
      return ($solutionDate);
    }

      echo "<br/>\n";
      echo 'Start Date: '. date('Y-m-d',($startDate ));
      echo "<br/>\n";
      echo 'End Date: '.date('Y-m-d',($endDate));
      echo "<br/>\n";
      echo ' Date Solution: ' .new_solution_date($startDate, $endDate, $solutionDate);

  ?>