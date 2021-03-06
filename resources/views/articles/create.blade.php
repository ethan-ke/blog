@extends('layouts.default')
@section('title','Create')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="form-group">
          <input type="email" class="form-control" name="title" placeholder="Title">
        </div>
        <textarea name="" rows="" cols="" id="markdown"></textarea>
        <div class="text-center">
            <button class="btn btn-dark mt-3 create">Create</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scriptAfterJs')
<script type="text/javascript">
  $('.create').click(function() {
    axios.post('{{ route('articles.store') }}',{
      title: $("input[name='title']").val(),
      content: simplemde.value(),
    });
  });
  var simplemde = new SimpleMDE({
    autofocus: true,
    autosave: {
        enabled: false,
        uniqueId: "MyUniqueID",
        delay: 1000,
    },
    blockStyles: {
        bold: "__",
        italic: "_"
    },
    element: document.getElementById("markdown"),
    forceSync: true,
    hideIcons: ["guide", "heading"],
    indentWithTabs: false,
    initialValue: "### Hello",
    insertTexts: {
        horizontalRule: ["", "\n\n-----\n\n"],
        image: ["![](http://", ")"],
        link: ["[", "](http://)"],
        table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
    },
    lineWrapping: false,
    parsingConfig: {
        allowAtxHeaderWithoutSpace: true,
        strikethrough: false,
        underscoresBreakWords: true,
    },
    placeholder: "Type here...",
    promptURLs: true,
    renderingConfig: {
        singleLineBreaks: false,
        codeSyntaxHighlighting: true,
    },
    shortcuts: {
        drawTable: "Cmd-Alt-T"
    },
    showIcons: ["code", "table"],
    spellChecker: false,
    status: false,
    status: ["autosave", "lines", "words", "cursor"], // Optional usage
    status: ["autosave", "lines", "words", "cursor", {
        className: "keystrokes",
        defaultValue: function(el) {
            this.keystrokes = 0;
            el.innerHTML = "0 Keystrokes";
        },
        onUpdate: function(el) {
            el.innerHTML = ++this.keystrokes + " Keystrokes";
        }
    }], // Another optional usage, with a custom status bar item that counts keystrokes
    styleSelectedText: false,
    tabSize: 4,
  });
</script>
@stop
