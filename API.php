<?php

if(isset($update)){
    if(isset($update->update_id)){
    }

    $path = parse_url($_SERVER['REQUEST_URI'])['path'];
    if ($path == '/add') {
        $task->add($update->text,$update->userId);
    }
}

if($_SERVER['REQUEST_URI'] === '/tasks'){
    echo json_encode($task->getAll());
    return;
}