<?php


function isStaffKebersihan(){
    if (auth()->user()->idrole == 2){
        return true;
    }else{
        return false;
    }
}

function isAdmin(){
    if (auth()->user()->idrole == 1){
        return true;
    }else{
        return false;
    }
}

function isStaffReservasi(){
    if (auth()->user()->idrole == 3){
        return true;
    }else{
        return false;
    }
}

function user_id(){
    return auth()->user()->id;
}

function user_name(){
    return auth()->user()->name;
}

function user_roleid(){
    if (!is_null(auth()->user()->idrole)){
        return auth()->user()->idrole;
    }else{
        return '-';
    }
}

function user_rolename(){
    if (!is_null(auth()->user()->idrole)){
        return auth()->user()->roles->nmrole;
    }else{
        return '-';
    }
}

function render_badge($status){
    switch ($status){
        case 'kosong':
             echo 'success';
            break;
        case 'diperbaiki':
            echo 'warning';
            break;
        case 'dipesan':
            echo 'danger';
            break;
        default:
            echo 'secondary';
    }
}
