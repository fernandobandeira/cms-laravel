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
    toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table insert | code'
};