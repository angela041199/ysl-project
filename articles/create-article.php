<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/article-table.css" rel="stylesheet" />
    <link href="./css/article-editor.css?=<?= time(); ?>" rel="stylesheet" />
    <link href="./css/insert-article.css?=<?= time(); ?>" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/5442bf158b.js" crossorigin="anonymous">
    </script>

</head>

<body class="sb-nav-fixed">
    <?php
    session_start();
    include("../style/admin-nav.php");
    include("../style/admin_dashboard.php");
    

    ?>

    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                <form action="InsertArticle.php" method="post" id="article-form" enctype="multipart/form-data">
                    <div class="container-fluid px-4">
                        <section class="main-header create-header">
                            <div class="title">
                                <input type="hidden" name="id" value="">
                                <input type="text" name="title" placeholder="請輸入文章標題..." value=""><i class="fa-solid fa-circle-info" style="color: #a52a2a;" title="文章標題，請務必填寫"></i>
                            </div>
                            <div class="button-wrap">
                                <a class="btn btn-primary" href="article-list.php">回到文章列表</a>

                                <button class="btn btn-warning text-white" type="submit" name="action" value="unpublish">儲存為草稿</button>
                                <button class="btn btn-success" value="publish" type="submit" name="action">發佈</button>

                            </div>

                        </section>

                        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alert-bar">
                            <i class="fa-solid fa-triangle-exclamation me-2" style="color: #8d0202;"></i>
                            <div class="alert-message">
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <section class="wrapper">
                            <h5>內容設定</h5>
                            <section class="main">
                                <div class="editor-wrap shadow-sm">
                                    <div class="mb-3">
                                        <label class="form-label category-input">文章分類 <i class="fa-solid fa-circle-info" style="color: #8a8e93;" title="請選擇要發佈文章的所屬分類類型"></i><span class="info-text">必填欄位</span></label>
                                        <select class="form-select" name="category_id">
                                            <option value="0">
                                                請選擇文章分類
                                            </option>
                                            <option value="1">
                                                遊戲攻略
                                            </option>
                                            <option value="2">
                                                發售資訊
                                            </option>
                                            <option value="3">
                                                遊戲報報
                                            </option>
                                            <option value="4">
                                                試玩報導
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">自訂義標籤 <i class="fa-solid fa-circle-info" style="color: #8a8e93;" title="請自行輸入文章標籤，文章標籤可以方便使用者搜尋文章"></i></label>
                                        <input type="text" name="tag" class="form-control tag-input" placeholder="請輸入標籤後按下enter，即可新增標籤">
                                        <div class="tags-container">
                                            <input type="hidden" name="tags" id="hiddenTags">
                                        </div>
                                    </div>
                                    <div id="container">
                                        <label class="form-label">文章內容 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></label>
                                        <textarea name="editorContent" id="hiddenEditorContent" style="display: none;"></textarea>
                                        <textarea name="editorContent" id="editor">
                                            <?= isset($article['content']) ? $article['content'] : '' ?>
                                        </textarea>

                                    </div>
                                </div>
                                <div class="right-wrap">
                                    <div class="author-wrap shadow-sm">
                                        <p>作者設定 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></p>
                                        <label class="form-label">作者名字</label>
                                        <input type="text" class="form-control" value="" name="author">
                                    </div>
                                    <div class="cover-img-wrap shadow-sm">
                                        <label for="imageUpload" class="form-label">文章預覽圖設定 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i><span class="info-text">必填欄位</span></label>
                                        <br>
                                        <!-- 圖片上傳按鈕 -->
                                        <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;" onchange="previewImg(event)">
                                        <!-- 預覽圖片 -->
                                        <p class="text-center">
                                            <img id="preview" src="<?= isset($article['URL_name']) ? './images/upload/' . $article['URL_name'] : 'https://via.placeholder.com/300x200?text=Upload+Image&font=roboto' ?>" alt="預覽圖" style="cursor: pointer;" onclick="document.getElementById('imageUpload').click()" class="object-fit-contain">
                                        </p>
                                    </div>
                                    <div class="article-admin-wrap shadow-sm">
                                        <p>文章更新紀錄 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></p>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                                <img src="./images/upload/Stitches.png" alt="twbs" class="rounded-circle flex-shrink-0 object-fit-contain upimg">
                                                <div class="d-flex gap-2 w-100 justify-content-between">
                                                    <div>
                                                        <h6 class="mb-0">玩具熊</h6>
                                                    </div>
                                                    <small class="opacity-50 text-nowrap updatetime">now</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </div>
                </form>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <?php include("../style/footer.php"); ?>
            </footer>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"> -->
    </script>
    <script src="./js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <!--
            The "super-build" of CKEditor&nbsp;5 served via CDN contains a large set of plugins and multiple editor types.
            See https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html#running-a-full-featured-editor-from-cdn
        -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
    <!--
            Uncomment to load the Spanish translation
            <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/translations/es.js"></script>
        -->
    <script>
        // This sample still does not showcase all CKEditor&nbsp;5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Welcome to CKEditor&nbsp;5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
    </script>
    <script src="./js/previewImg.js"></script>
    <script src="./js/enter-tags.js"></script>
    <script src="./js/check-content.js"></script>
    <script>
        //初始化CKEDITOR
        CKEDITOR.replace('editor');
    </script>
</body>

</html>