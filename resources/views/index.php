<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Injector Calculator</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div id="wrap">
    <div class="container content">

        <div class="page-header">
            <h1>Skill Injector Calculator</h1>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">How to use</h3>
            </div>
            <div class="panel-body">
                Add the skills you want to the list. Prerequisits for a skill will be added automatically. To change a
                skill level just klick on the level.
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sp">Current SP</label>
                    <input type="number" class="form-control" id="sp" placeholder="0" step="1" min="0">
                </div>

                <div class="form-group">
                    <select class="form-control" name="skills" id="skills">
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-block btn-add">Add</button>

            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Selected Skills</div>
                    <ul class="list-group skill-list">
                    </ul>

                    <div class="panel-footer">
                        Total SP: <span class="total-sp">0</span>
                        <strong class="pull-right ">Injectors needed: <span class="injectors">0</span></strong>
                    </div>
                </div>

            </div>

            <footer class="small text-muted footer">
                Released under the MIT licence by Grimm Venris -
                <a href="https://github.com/Necrotex/injectors">Github</a> -
                All EVE related materials are property of <a href="http://www.ccpgames.com/">CCP Games</a>
            </footer>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js"></script>
<script
    src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>