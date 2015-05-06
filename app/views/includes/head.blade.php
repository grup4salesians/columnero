
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Columnero grup 4</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    {{ HTML::style('css/bootstrap.css'); }}
    {{ HTML::script('js/bootstrap.js'); }}
    {{ HTML::style('css/bootstrap-horizon.css'); }}
    {{ HTML::style('css/style.css'); }}
    {{ HTML::style('css/font-awesome.css'); }}

    <script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
    <script>
        angular.module('myApp', ['ngTagsInput'])
            .controller('MyCtrl', function($scope, $http) {
                $scope.tags = [
                    { text: 'just' },
                    { text: 'some' },
                    { text: 'cool' },
                    { text: 'tags' }
                ];
                $scope.loadTags = function(query) {
                     return $http.get('/tags?query=' + query);
                };
            });
    </script>
    <script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea"
     });
    </script>
    <script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
    <script>
        angular.module('myApp', ['ngTagsInput'])
            .controller('MyCtrl', function($scope, $http) {
                $scope.tags = [
                    { text: 'just' },
                    { text: 'some' },
                    { text: 'cool' },
                    { text: 'tags' }
                ];
                $scope.loadTags = function(query) {
                     return $http.get('/tags?query=' + query);
                };
            });
    </script>
    <script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea"
     });
    </script>
