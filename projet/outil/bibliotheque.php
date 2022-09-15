<?php


function cartouche($name) {
                $panel = "<div class='panel panel-danger'>";
                $panel .= "  <div class='panel-heading'>";
                $panel .= "    <h3 class='panel-title'>SuperGlobale " . $name . "</h3>";
                $panel .= "  </div>";   
                $panel .= "</div>";
                return $panel;
            }


// =========================
// form_begin
// =========================

function form_begin($class, $method, $action) {
    echo ("\n<!-- ============================================== -->\n");
    echo ("<!-- form_begin : $class $method $action) -->\n");
    printf("<form class='%s' method='%s' action='%s'>\n", $class, $method, $action);
}

// =========================
// form_input_text
// =========================

function form_input_text($label, $name, $size, $value) {
    echo ("\n<!-- form_input_text : $label $name $size $value -->\n");

    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    echo (" <input type='text' class='form-control' name='$name' size='$size' value='$value' >");
    echo ("</div>");
}

function form_input_hidden($name,$value){
    echo "<input type='hidden' name='$name' value='$value'>";
}

// =========================
// form_select
// =========================

// Parametre $label    : permet un affichage (balise label)
// Parametre $name     : attribut pour identifier le composant du formulaire
// Parametre $multiple : si cet attribut n'est pas vide alors sélection multiple possible
// Parametre $size     : attribut size de la balise select
// Parametre $liste    : un liste d'options. Vous utiliserez un foreach pour générer les balises option

function form_select($label, $name, $multiple, $size, $liste) {
// todo ...
    $multiple_flag= (isset($multiple) ? "multiple" : "" );
    echo ("\n<!-- form_select : $label $name $size -->\n");
    echo ("<div class='form-group'>");
    echo (" <label for='$name'>$label</label>");
    echo (" <select name='$name"."[]' $multiple_flag size=$size>");
    foreach ($liste as $option) {
        echo("<option>$option</option>");
    }
    echo ("</select>");
    echo ("</div>");
}

// =========================

function form_input_reset($value) {
    echo ("\n<!-- form_input_reset : $value -->\n");
    echo ("<div class='form-group'>");
    echo (" <input type='reset' class='form-control' value='$value' >");
    echo ("</div>");
}

// =========================

function form_input_submit($value) {
    echo ("\n<!-- form_input_reset : $value -->\n");
    echo ("<div class='form-group'>");
    echo (" <input type='submit' class='form-control' value='$value' >");
    echo ("</div>");    
}

// =========================


function form_end() {
printf("</form>");
}

// =========================

function table_line($line_cells,$line_classes= array(),$cells_classes= array(),$is_th=false){
    $cell_type="td";
    if($is_th){
           $cell_type="th"; 
    }else{
           $cell_type="td"; 
    }

    $impl_line_classes = implode(" ", $line_classes);
    $impl_cells_classes = implode(" ", $cells_classes);
    $output = "<tr class=$impl_line_classes>";
    foreach ($line_cells as  $value) {
        $output.="<$cell_type $impl_cells_classes>$value</$cell_type>";
    }
    $output.= "</tr>";
    return $output;
}
        
function validate_checkbox($SOURCE_INPUT,$name,$checked_value,$unchecked_value){
    switch ($SOURCE_INPUT) {
        case "GET":
            if(isset($_GET[$name])){
                $_GET[$name]=$checked_value;
                return ;
            }else{
                $_GET[$name]=$unchecked_value;
                return ;
            }
            break;
        case "POST":
            if(isset($_POST[$name])){
                $_POST[$name]=$checked_value;
                return ;
            }else{
                $_POST[$name]=$unchecked_value;
                return ;
            }
    }
    return;
}

function make_link($page,$data=null,$text=null){
    $href="?";

    if(isset($data) && is_array($data)){
        foreach ( $data as $key => $value) {
            $href.="$key=".urlencode($value);
        }
    }
    $link=$page.$href;
    if(!isset($text)){
        $text=$link;
    }
    return "<a href=$link>$text</a>";
}
        
function panel_head($titre){
    echo "<div class='panel panel-primary'>
                <div class='panel-heading'>
                    <h3 class='panel-title'><strong>$titre</strong> </h3>
                </div>
            </div>";
}

function panel($titre,$body,$bt_class="panel-primary"){
    echo "<div class='panel $bt_class'>
                <div class='panel-heading'>
                    <h3 class='panel-title'><strong>$titre</strong> </h3>
                </div>
                <div class='panel-body'>
                    $body
                </div>
            </div>";
}

function addDropdownMenuItem($label="",$itemList=array(array("action"=>"","label"=>""))){
    /**
     * $itemList = array(
     *                      array("action"=>"","label"=>""),
     *                      array("action"=>"","label"=>""),
     *                      ...
     *              )
     */
    echo "<li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" 
           aria-haspopup=\"true\" aria-expanded=\"false\">$label <span class=\"caret\"></span></a>
        <ul class=\"dropdown-menu\">";
    foreach ( $itemList as $item) {
    echo "<li><a href=\"router.php?action=".$item["action"]."\">".$item["label"]."</a></li>";

    }
    echo "</ul>";
    echo "</li>";
}
    