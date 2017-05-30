import TinyMCE from 'tinymce';

import 'tinymce/themes/modern/theme';

import 'tinymce/plugins/link/plugin';
import 'tinymce/plugins/autoresize/plugin';
import 'tinymce/plugins/code/plugin';
import 'tinymce/plugins/contextmenu/plugin';
import 'tinymce/plugins/hr/plugin';
import 'tinymce/plugins/lists/plugin';
import 'tinymce/plugins/table/plugin';
import 'tinymce/plugins/wordcount/plugin';

window.tinymce = TinyMCE;
window.editorOptions = {
    plugins: ['link', 'autoresize', 'code', 'contextmenu', 'hr', 'lists', 'table', 'wordcount'],
    contextmenu: "link hr inserttable | cell row column deletetable",
    menubar: '',
    language: 'pt_BR',
    toolbar: 'bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table insert | code',
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
};