<?php


class TaskPrinter {
    
    public function printTask($taskName, $taskIncrement, $taskDate, $taskText, $taskId){
        
        echo '<div class="row">'. PHP_EOL;
        echo '<div class="col-md-2">'.$taskIncrement.'</div>'. PHP_EOL;
        echo '<div class="col-md-2">'.$taskName.'</div>'. PHP_EOL;
        echo '<div class="col-md-2">'.$taskDate.'</div>'. PHP_EOL;
        echo '<div class="col-md-4">'.$taskText.'</div>'. PHP_EOL;
        echo '<div class="col-md-2">';
        $this->printEditLink($taskId);
        $this->printDeleteLink($taskId);
        echo '</div></div>';
    }
    
    
    private function printEditLink($taskId){
        echo '<a href="editTask.php?taskId='.$taskId.'">edit task</a>';
    }
    
    private function printDeleteLink($taskId){
        echo '<a href="deleteTask.php?taskId='.$taskId.'">delete task</a>';
    }
       
}
