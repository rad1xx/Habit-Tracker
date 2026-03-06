<?php
$data = file_get_contents('php://input');
$habit = json_decode($data, true);

$habitsJson = file_get_contents('habits.json');
$habits = json_decode($habitsJson, true);

if (isset($habit['name'])) {
    
    if (isset($habit['index']) && $habit['index'] !== 'undefined') {
        $habits[(int)$habit['index']]['name'] = $habit['name'];

    } else {
        $habits[] = ['name' => $habit['name']];
    }
}

if (isset($habit['delete'])) {
    $index = (int)$habit['delete'];
    array_splice($habits, $index, 1);
}

if (isset($habit['index']) && isset($habit['days'])) {
    $habits[$habit['index']]['days'] = $habit['days'];
}

file_put_contents('habits.json', json_encode($habits, JSON_UNESCAPED_UNICODE));

echo "OK";
?>