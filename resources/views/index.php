<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Injector Calc</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div id="wrap">
    <div class="container content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <select class="form-control" name="skills" id="skills">
                        </select>
                        <button type="button" class="btn btn-primary btn-block btn-add">Add</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Selected Skills</div>
                        <div class="panel-body">

                        </div>

                        <ul class="list-group skill-list">
                        </ul>

                        <div class="panel-footer">
                            Total SP: <span class="total-sp">0</span>
                            Injectors needed: <span class="injectors">0</span>
                        </div>
                    </div>

                </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>