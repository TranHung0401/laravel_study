<?php

function getCategories($categoies = [],$old = '',$parentId = 0,$char='') {
    $id = request()->route()->category;
    if($categoies){
        foreach($categoies as $k => $category) {
            if($category->parent_id == $parentId && $id != $category->id){
                echo '<option value="'.$category->id.'" ';
                if($old == $category->id){
                    echo ' selected'; 
                }
                echo ' >'.$char.$category->name.'</option>';
                unset($categoies[$k]);
                getCategories($categoies, $old, $category->id,$char . ' |- ');
            }
        }
    }
}