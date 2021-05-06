<?php

/*~~~~~~~~~~~~ Autoload Class Function ~~~~~~~~~~~~~~~
  --------spl_autoload_register(autoloader)---------

        If a class is needed during process, the
        autoloader function will try to load
        that class before print an error message
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
function autoloader($className) {
    $file = '../views/classes/' . $className . '.php';
    include $file;
}
spl_autoload_register('autoloader');

/*    ~~~~~~~~~~~~~Post method~~~~~~~~~~~~~~~~~    */
if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
    echo "<h3>Child's Details Part</h3>";
//    $childFirstNameX = new nameValidator($_POST['childfirstName'],"Child's First Name");
//    $errors = $childFirstNameX->validate_name();
//    $prnt = new errorDisplay($errors,"First Name",$childFirstNameX,$_POST['childfirstName']);
//    $prnt->display_error();
    echo count($_POST);
    $postArrayKeys = array_keys($_POST);
    $counter = count($_POST);
    $indexCounter = 0;
    for($i = 0; $i < $counter-1; $i++){
        if(!is_array($_POST[$postArrayKeys[$i]])) {
            $value = strval($postArrayKeys[$i]);
            if (!str_contains($value,'Middle') && !str_contains($value,'Time') && !str_contains($value,'Date') && !str_contains($value,'Number')) {
                $person = '';
                if(str_contains($value,'child')) {
                    $person = "Child";
                }else if(str_contains($value,'mother')){
                    $person = "Mother";
                }else if(str_contains($value,'father')){
                    $person = "Father";
                }
                $prnt = '';
                if (str_contains($value, 'firstName')) {
                    $nameX = new nameValidator($_POST[$value], "$person's First Name");
                    $errors = $nameX->validate_name();
                    $prnt = new errorDisplay($errors,"First Name",$nameX,$_POST[$value]);
                }else if(str_contains($value, 'LastName')){
                    $nameX = new nameValidator($_POST[$value], "$person's Last Name");
                    $errors = $nameX->validate_name();
                    $prnt = new errorDisplay($errors,"First Name",$nameX,$_POST[$value]);
                }else{
                    $nameX = new nameValidator($_POST[$value], "$value");
                    $errors = $nameX->validate_name();
                    $prnt = new errorDisplay($errors,"$value",$nameX,$_POST[$value]);
                }
                $prnt->display_error();
            }
        }
    }
}