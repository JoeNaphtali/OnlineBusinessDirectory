<!doctype html>
<html lang="fr">
<head>
<meta charset="iso-8859-1">
<title>Untitled Document</title>
<script type="text/javascript" charset="iso-8859-1">
function readid(id){
"use strict";   
console.log("id=", id)
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("POST", "includes/view.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.onreadystatechange = function() {
    if (this.readyState === 4 || this.status === 200){ 
        console.log(this.responseText); // echo from php
    }       
};
xmlhttp.send("id=" + id);
}
</script>
</head>
<body>
<p>This is a test</p>
<input type="button" name="Submit" value="Submit" id="formsubmit" onClick="readid(id)">
</body>
</html>