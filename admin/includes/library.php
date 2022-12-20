<?php
function category_validation($category, $descricao){
    return strlen($category) >= 2 && strlen($descricao) >= 12 && ctype_upper(substr($category, 0, 1));
}
?>