<?php
if(session('nofitication')){
    echo '<div class="alert alert-warning">'.session('nofitication').'</div>';
}