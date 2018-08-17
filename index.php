<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>TEST GAC TECHNOLOGY</h2>
  <button type="button" id="import_csv" class="btn btn-default">Import CSV</button>
  <button type="button" id="exploiter_donnees" class="btn btn-primary">Exploiter Données</button>
  <div id="datas"></div>
</div>

<script>
$(document).ready(function(){
    //click on button Import CSV to upload the csv to the db

    $("#import_csv").click(function(){
        $.get("load_datas.php", function(data){
            if(data == 'ok'){
                alert("CSV file successfully uploaded.");
            } else {
                alert("CSV file already uploaded.")
            }
        });
    });
    //click on button exploiter données to load the results
    $("#exploiter_donnees").click(function(){
    $.get({url: "get_datas.php", success: function(result){
        $("#datas").html(result);
    }});
    });
});
</script>
</body>
</html>

