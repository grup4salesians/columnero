<!-- ngTagsInput -->
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
<script>
    angular.module('myApp', ['ngTagsInput'])
            .controller('MyCtrl', function ($scope, $http) {
//        $scope.tags = [
//            {text: 'just'},
//            {text: 'some'},
//            {text: 'cool'},
//            {text: 'tags'}
//        ];
                $scope.loadTags = function (query) {
                    return $http.get('getCategories/' + query);
                };
            });
</script>
<!-- ----------- -->

<!-- Bootstrap Text Editor -->
<!-- TEXT EDITOR STYLES -->
<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/css/summernote.css" rel="stylesheet" type="text/css"/>

<!-- REQUIRED SCRIPTS FILES -->
<!-- TEXT EDITOR SCRIPT -->
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/js/summernote.js" type="text/javascript"></script>
<!-- REQUIRED SCRIPT FOR TEXT EDITOR -->

<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/highlight/styles/monokai_sublime.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/highlight/highlight.pack.js" type="text/javascript"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script>
    $(document).ready(function () {
        /* Initialize text-editor */
        $("#TextoNota").summernote({
            height: 250, // set height for editor
        });

        /* Botons al text-editor per al code-highlighter */
        $(".note-insert.btn-group").after('<div class="note-highlight btn-group">'
                + '<button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="highlight" data-hide="true" tabindex="-1" data-original-title="Highlighter"><i class="fa fa-code"></i></button>'
                + '<button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="highlight-paint" data-hide="true" tabindex="-1" data-original-title="Highlighter"><i class="fa fa-paint-brush"></i></button>'
                + '<button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="highlight-finish" data-hide="true" tabindex="-1" data-original-title="Highlighter"><i class="fa fa-check"></i></button>'
                + '</div>');
        $("button[data-event='codeview']").children().removeClass("fa-code").addClass("fa-html5");

        /* Tooltips botons code-highlighter */
        $("button[data-event='highlight'], button[data-event='highlight-paint'], button[data-event='highlight-finish']")
                .on("mouseenter", function () {
                    var pos = $(this).offset();
                    var tooltip = $("#tooltip-" + $(this).data("event"));

                    $(tooltip).css({'top': pos.top + 30, 'left': (pos.left + ($(this).width() / 2)) - (tooltip.width() / 2) + 11});
                    $(tooltip).css("display", "block");

                    setTimeout(function () {
                        $(tooltip).css("opacity", "1");
                    }, 1);
                })
                .on("mouseleave", function () {
                    var tooltip = $("#tooltip-" + $(this).data("event"));
                    $(tooltip).css("opacity", "0");

                    setTimeout(function () {
                        $(tooltip).css("display", "none");
                    }, 200);
                });

        $("button[data-event='highlight']").on("click", function () {
            var num = $.now();
            $(".note-editable").append('<pre id="codeblock-' + num + '"><code></code></pre>');

            $('#codeblock-' + num + ' code').each(function (i, block) {
                hljs.highlightBlock(block);
            });

            $('#codeblock-' + num + ' code').append("Paste your code here");
        });

        $("button[data-event='highlight-paint']").on("click", function () {
            $('pre code').each(function (i, block) {
                block.className = "";
                hljs.highlightBlock(block);
            });
        });
        $("button[data-event='highlight-finish']").on("click", function () {
            $(".note-editable").append('<p id="tst">...</p>');
        });

        //highlight();
        function highlight() {
            $('pre code').removeClass();
            console.log("res");
            $('pre code').each(function (i, block) {
                hljs.highlightBlock(block);
            });

            setTimeout(function () {
                highlight();
            }, 15000);
        }
        ;

//        $("pre code").on("keyup", function() {
//            console.log("res");
//            setTimeout(function() {
//               $(this).removeClass();
//               
//               $('pre code').each(function(i, block) {
//                    hljs.highlightBlock(block);
//                });
//           }, 50);
//        });
        //$("button[data-event='highlight']").on("mouseleave").css("display", "none");
        //$(".note-editable").text('<pre><code class="html">...</code></pre>');
    });
</script>
<!-- --------------------- -->
<div class="tooltip fade bottom in" role="tooltip" id="tooltip-highlight" style="opacity: 0; display: none;"><div class="tooltip-arrow"></div><div class="tooltip-inner">Start Code Block</div></div>
<div class="tooltip fade bottom in" role="tooltip" id="tooltip-highlight-paint" style="opacity: 0; display: none;"><div class="tooltip-arrow"></div><div class="tooltip-inner">Format Code</div></div>
<div class="tooltip fade bottom in" role="tooltip" id="tooltip-highlight-finish" style="opacity: 0; display: none;"><div class="tooltip-arrow"></div><div class="tooltip-inner">Confirm Code Block</div></div>
<style>
    .pads {
        padding-left: 10%;
        padding-right: 10%;
        position: relative;
    }
    .pads > p {
        margin: 0px;
        position: relative;
    }
    .pads > input, .pads > div, .pads > textarea {
        width: 100%;
    }
    .tagsinput {
        height: 64px;
    }
    .note-editor button {
        height: 30px;
    }
    .note-editable {
        background-color: #FFF;
    }
    #tooltip-highlight, #tooltip-highlight-paint {
        transition: opacity 0.2s ease-in-out;
    }
</style>
<div id="contingut_home" class="contingut_home">
    <div class="contingut">
        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error}}<br>        
            @endforeach
        </div>
        @endif
        {{ Form::open(array('url' => '/novanota')) }}
        <div class="pads">
            <p>Títol</p>
            <input id="Titol" name="Titol" type="text">
        </div>
        <div class="pads">
            <div style="width: 78%; float: left; position: relative;">
                <p>Categories</p>
                <!-- ngTagsInput -->
                <div class="tagsinput" ng-app="myApp" ng-controller="MyCtrl">
                    <tags-input id="ListadoTags" Name="ListadoTags" ng-model="tags">
                        <auto-complete  source="loadTags($query)"></auto-complete>
                    </tags-input>
                    <input type="hidden" id="ListadoTagsOculto" name="ListadoTagsOculto" /> 
                </div>
            </div>
            <div style="width: 18%; float: right; position: relative;">
                <p>Públic</p>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="1" checked>
                        Sí
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="0">
                        No
                    </label>
                </div>
                
<!--                <div>
                    <input type="radio" name="group1" value="1">Sí<br>
                    <input type="radio" name="group1" value="0" checked>No 
                </div>-->
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="pads">
            <p>Contingut</p>
            <!-- TinyMCE -->
            <textarea id="TextoNota" name="TextoNota"></textarea>
        </div>

        <div class="pads">
            <!--{{ Form::submit('Crear nova nota',array('class'=> 'btn btn-info','id'=>'BtnSubmitNovaNota','style'=>'margin-top: 15px'))}}-->
            {{ Form::submit('Crear nova nota',array('class'=> 'btn btn-info BtnSubmitNovaNota_EditarNota','id'=>'BtnSubmitNovaNota'))}}
        </div>
        {{ Form::close() }}
        <br>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#BtnSubmitNovaNota").click(function () {
            var textoFinal = "";
            $("#ListadoTags").find("span").each(function () {
                if ($(this).text() !== "Add a tag") {
                    textoFinal = textoFinal + $(this).text() + "|";
                }
            });
            $("#ListadoTagsOculto").val(textoFinal);
        });
    });
</script>