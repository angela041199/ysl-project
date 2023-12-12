<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/article-table.css" rel="stylesheet" />
    <link href="./css/article-editor.css" rel="stylesheet" />
    <link href="./css/insert-article.css?=<?=time();?>" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/5442bf158b.js" crossorigin="anonymous">
    </script>

</head>

<body>
    <nav class="sb-topnav navbar navbar-expand shadow-sm">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 fw-bold text-white" href="index.html">YOUR SWITCH LIFE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu shadow-sm">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading ">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <form action="InsertArticle.php" method="post" id="article-form" enctype="multipart/form-data">
                    <div class="container-fluid px-4">
                        <section class="main-header my-3 position-sticky">
                            <div class="title">
                                <input type="hidden" name="id" value="">
                                <input type="text" name="title" placeholder="請輸入文章標題..." value=""><i
                                    class="fa-solid fa-circle-info" style="color: #8a8e93;" title="文章標題"></i>
                            </div>
                            <div class="button-wrap">
                                <a class="btn btn-primary" href="article-list.php">回到文章列表</a>

                                <button class="btn btn-warning text-white" type="submit" name="action"
                                    value="unpublish">儲存為草稿</button>
                                <button class="btn btn-success" value="publish" type="submit" name="action">發佈</button>

                            </div>

                        </section>

                        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alert-bar">
                            <i class="fa-solid fa-triangle-exclamation me-2" style="color: #8d0202;"></i>
                            <div class="alert-message">
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <main class="wrapper">
                            <h5>內容設定</h5>
                            <section class="main">
                                <div class="editor-wrap shadow-sm">
                                    <div class="mb-3">
                                        <label class="form-label category-input">文章分類 <i class="fa-solid fa-circle-info"
                                                style="color: #8a8e93;" title="請選擇要發佈文章的所屬分類類型"></i></label>
                                        <select class="form-select" name="category_id">
                                            <option class="0">
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
                                        <label class="form-label">自訂義標籤 <i class="fa-solid fa-circle-info"
                                                style="color: #8a8e93;" title="請自行輸入文章標籤，文章標籤可以方便使用者搜尋文章"></i></label>
                                        <input type="text" name="tag" class="form-control tag-input"
                                            placeholder="請輸入標籤後按下enter，即可新增標籤">
                                        <div class="tags-container">
                                            <input type="hidden" name="tags" id="hiddenTags">
                                        </div>
                                    </div>
                                    <div id="container">
                                        <label class="form-label">文章內容 <i class="fa-solid fa-circle-info"
                                                style="color: #8a8e93;"></i></label>
                                        <textarea name="editorContent" id="hiddenEditorContent"
                                            style="display: none;"></textarea>
                                        <textarea name="editorContent" id="editor">
                                            <?= isset($article['content']) ? $article['content'] : '' ?>
                                        </textarea>

                                    </div>
                                </div>
                                <div class="right-wrap">
                                    <div class="author-wrap shadow-sm">
                                        <h5>作者設定 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></h5>
                                        <label class="form-label">作者名字</label>
                                        <input type="text" class="form-control" value="" name="author">
                                    </div>
                                    <div class="cover-img-wrap shadow-sm">
                                        <label for="imageUpload" class="form-label">文章預覽圖設定 <i
                                                class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></label>
                                        <br>
                                        <!-- 圖片上傳按鈕 -->
                                        <input type="file" id="imageUpload" name="image" accept="image/*"
                                            style="display: none;" onchange="previewImg(event)">
                                        <!-- 預覽圖片 -->
                                        <p class="text-center">
                                            <img id="preview"
                                                src="<?=isset($article['URL_name']) ? './images/upload/'.$article['URL_name'] : 'https://via.placeholder.com/300x200?text=Upload+Image&font=roboto' ?>"
                                                alt="預覽圖" style="cursor: pointer;"
                                                onclick="document.getElementById('imageUpload').click()"
                                                class="object-fit-contain">
                                        </p>
                                    </div>
                                    <div class="article-admin-wrap shadow-sm">
                                        <h5>文章更新紀錄 <i class="fa-solid fa-circle-info" style="color: #8a8e93;"></i></h5>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                                aria-current="true">
                                                <img src="./images/upload/Stitches.png" alt="twbs"
                                                    class="rounded-circle flex-shrink-0 object-fit-contain upimg">
                                                <div class="d-flex gap-2 w-100 justify-content-between">
                                                    <div>
                                                        <h6 class="mb-0">玩具熊</h6>
                                                    </div>
                                                    <small class="opacity-50 text-nowrap updatetime">now</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            </section>
                </form>
            </main>
        </div>

        <!-- <div style="height: 100vh"></div> -->

        </main>
    </div>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="./js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


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