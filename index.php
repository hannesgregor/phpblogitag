<?php
//index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
</head>
<body>
<br />
<div class="container">
    <div class="row">
        <br />
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <span id="success_message"></span>
            <form method="post" id="programmer_form">
                <div class="form-group">
                    <label>Blogi postitus</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Lisa postitusele tag (kliki kasti peale ja vali sobiv tag)</label>
                    <input type="text" name="tag_name" id="tag_name" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){

        $('#tag_name').tokenfield({
            autocomplete:{
                source: ['Loodus','Sport','Vabaaeg','Kultuur','Haridus','Ajalugu','Reisimine','Toit','Raha','Vesi','Poliitika','Majandus','Infotehnoloogia','Tehnika','Köök','Lamp'],
                delay:100
            },
            showAutocompleteOnFocus: true
        });

        $('#programmer_form').on('submit', function(event){
            event.preventDefault();
            if($.trim($('#name').val()).length == 0)
            {
                alert("Kirjuta postitus");
                return false;
            }
            else if($.trim($('#tag_name').val()).length == 0)
            {
                alert("Sisesta vähemalt üks tag");
                return false;
            }
            else
            {
                var form_data = $(this).serialize();
                $('#submit').attr("disabled","disabled");
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:form_data,
                    beforeSend:function(){
                        $('#submit').val('Submitting...');
                    },
                    success:function(data){
                        if(data != '')
                        {
                            $('#name').val('');
                            $('#tag_name').tokenfield('setTokens',[]);
                            $('#success_message').html(data);
                            $('#submit').attr("disabled", false);
                            $('#submit').val('Submit');
                        }
                    }
                });
                setInterval(function(){
                    $('#success_message').html('');
                }, 5000);
            }
        });

    });
</script>