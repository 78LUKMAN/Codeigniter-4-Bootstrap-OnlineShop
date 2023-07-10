<?php foreach ($dataUser as $key => $value) {
    if ($value['username'] == session()->get('username')) {
        echo $value['username'];
        echo $value['address'];
        echo $value['phone'];
        echo $value['email'];
    }
}