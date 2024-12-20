<?php
    include('Extention.php');

    $config = array(
        'name' => "Garry&#x27;s Mod Engine Wiki", 
        'front_page' => 'gmod.md',
        'missing_page' => 'missing.md',
        'pages_path' => 'pages/',
        'issues_url' => 'https://github.com/Facepunch/garrysmod-issues/issues/',
        'code_language' => 'c++', // lua or c++
    );

    $categories = array(
        array(
            'name' => 'Wiki', 
            'categories' => array(
                array(
                    'mdi' => 'mdi-file-document-edit-outline',
                    'name' => 'Wiki',
                    'path' => 'wiki'
                ),
            ),
        ),
        array(
            'name' => 'C++', 
            'categories' => array(
                array(
                    'mdi' => 'mdi-code-array',
                    'name' => 'Types',
                    'path' => 'cpp/types',
                    'tags' => 'true',
                ),
            ),
        ),
        array(
            'name' => 'SourceSDK-Minimal', 
            'categories' => array(
                array(
                    'mdi' => 'mdi-code-braces',
                    'name' => 'Globals',
                    'path' => 'sourcesdk-minimal/globals',
                    'tags' => 'false',
                ),
                array(
                    'mdi' => 'mdi-book',
                    'name' => 'Classes',
                    'path' => 'sourcesdk-minimal/classes',
                    'tags' => 'true',
                ),
            ),
        ),
        array(
            'name' => 'Source Engine', 
            'categories' => array(
                array(
                    'mdi' => 'mdi-code-array',
                    'name' => 'Structures',
                    'path' => 'sourceengine/structures',
                    'tags' => 'true',
                ),
            ),
        ),
    );

    if ($config['code_language'] == 'c++') {
        $config['code_funcseparator'] = '::';
    } elseif ($config['code_language'] == 'lua') {
        $config['code_funcseparator'] = ':';
    }

    $Parsedown = new Extension();
    $Parsedown->config = $config;
    $Parsedown->categories = $categories;

    $title = $config['name'];
    if (isset($_GET["page"]))
    {
        $path = $Parsedown->FindFile($_GET["page"]);

        if (isset($path)) {
            $file = file_get_contents($path);
            $title = $Parsedown->PageTitle($file);  
        } else {
            $file = file_get_contents($config['pages_path'] . $config['missing_page']);
            $title = $Parsedown->PageTitle($file); 
        }
    } else {
        $file = file_get_contents($config['pages_path'] . $config['front_page']);
        $title = $Parsedown->PageTitle($file); 
    }
?>

<?php if (!isset($_GET["format"])): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $title; ?> - <?php echo $config['name']; ?></title>
        <link rel="icon" type="image/png" href="https://files.facepunch.com/garry/822e60dc-c931-43e4-800f-cbe010b3d4cc.png">
        <link rel="search" title="<?php echo $config['name']; ?>" type="application/opensearchdescription+xml" href="https://wiki.facepunch.com/gmod/~searchmanifest" />
        <script href="https://wiki.facepunch.com/cdn-cgi/apps/head/JodREY1zTjWBVnPepvx61z0haaQ.js"></script>
        <link rel="stylesheet" href="https://wiki.facepunch.com/styles/gmod.css?n=7fe51698-72dd-4fa7-aee6-7942d119990a" />
        <script src="https://wiki.facepunch.com/script.js?n=7fe51698-72dd-4fa7-aee6-7942d119990a"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <meta name="theme-color" content="#0082ff">

        <meta property="og:title" name="og:title" content="<?php echo $config['name']; ?>">
	    <meta property="og:site_name" name="og:site_name" content="<?php echo $config['name']; ?>">
	    <meta property="og:type" name="og:type" content="website">
	    <meta property="og:description" name="og:description" content="Welcome to the Garry&#x27;s Mod Engine Wiki.&#xA;Here you will find mainly documentation about Garry&#x27;s Mod and its Engine.&#xA;">
        <script>WikiRealm = "gmod";</script>
    </head>
    <style>
        @font-face {
        font-family: "Material Design Icons";
        src: url("https://wiki.facepunch.com/fonts/materialdesignicons-webfont.eot?v=5.9.55");
        src: url("https://wiki.facepunch.com/fonts/materialdesignicons-webfont.eot?#iefix&v=5.9.55") format("embedded-opentype"), url("https://wiki.facepunch.com/fonts/materialdesignicons-webfont.woff2?v=5.9.55") format("woff2"), url("https://wiki.facepunch.com/fonts/materialdesignicons-webfont.woff?v=5.9.55") format("woff"), url("../../fonts/materialdesignicons-webfont.ttf?v=5.9.55") format("truetype");
        font-weight: normal;
        font-style: normal;
        }
        .mdi:before,
        .mdi-set {
        display: inline-block;
        font: normal normal normal 24px/1 "Material Design Icons";
        font-size: inherit;
        text-rendering: auto;
        line-height: inherit;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        }
    </style>
    <body>
        <div id="toolbar">
            <div>
                <div>
                    <button onclick="ToggleClass( 'sidebar', 'visible' )"><i class="mdi mdi-menu"></i></button>
                </div>

                <div class="grow"></div>

                <h1 class="title">
                    <a href="/"><?php echo $config['name']; ?></a>
                </h1>
            </div>
        </div>

        <div class="body">
            <div class="body-tabs">
                <div class="pagetitle" id="tabs_page_title"><a href="/" class="parent">Home</a> / 
                    <?php
                        echo '<a href="';
                        if (isset($_GET["page"]))
                        {
                            echo '/?page=' . $_GET["page"];
                        } else {
                            echo '/';
                        }
                        echo '">';
                        echo $title;
                        echo '</a>';
                    ?>
                </div>

                <ul id="pagelinks">
                </ul>
            </div>

            <div class="content">
                <div class="content">
                    <?php
                        echo $Parsedown->ViewText($file);      
                    ?>
                </div>
            </div>

            <div class="footer" id="pagefooter">
            </div>
        </div>

        <div id="sidebar">
			<div>
				<div id="ident">
					<div class="icon">
						<a href="/">
							<img src="https://files.facepunch.com/garry/822e60dc-c931-43e4-800f-cbe010b3d4cc.png" />
						</a>
					</div>
					<h1 class="title">
						<a href="/"><?php echo $config['name']; ?></a>
					</h1>
				</div>

				<div id="topbar">
					<div class="search">
						<input autocomplete="off" id="search" type="search" placeholder="press / to quick search" />
					</div>
				</div>

				<div id="searchresults"></div>

                <div id="contents">
                    <?php
                        foreach ($categories as &$category) {
                            echo '<div class="sectionheader">' . $category['name'] . '</div>';
                            echo '<div class="section">';

                            foreach ($category['categories'] as &$chapter) {
                                echo '<details class="level1">';

                                $path = $config['pages_path'] . $chapter['path'] . '/';
                                $files = array_diff(scandir($path), array('..', '.'));
                                echo '<summary><div><i class="mdi ' . $chapter['mdi'] . '"></i>' . $chapter['name'] . ' <span class="child-count">' . count($files) . '</span></div></summary>';

                                echo '<ul>';
                                foreach ($files as &$page) {
                                    echo '<li>';
                                    if (is_dir($path . $page)) {
                                        echo '<details class="level2 cm type e">';
                                            echo '<summary>';
                                                $categoryfile = file_get_contents($path . '/' . $page . '/' . $page . '.md');
                                                echo '<a class="' . $Parsedown->GetTags($categoryfile) . '" href="/?page=' . $page . '">' . $Parsedown->PageTitle($categoryfile) . '</a>';
                                            echo '</summary>';
                                            echo '<ul>';
                                                $fullpath = $path . $page;
                                                $files2 = array_diff(scandir($fullpath), array('..', '.', $page . '.md'));
                                                foreach($files2 as &$page2) {
                                                    $file = file_get_contents($fullpath . '/' . $page2);
                                                    $pagetitle = $Parsedown->PageTitle($file); 

                                                    $page2 = substr($page2, 0, strripos($page2, '.'));

                                                    echo '<li>';
                                                        echo '<a class="' . $Parsedown->GetTags($file) . '" href="/?page=' . $page2 . '" search="' . $pagetitle . '">' . $Parsedown->PageTitle($file) . '</a>';
                                                    echo '</li>';
                                                }
                                            echo '</ul>';
                                        echo '</details>';
                                    } else {
                                        $file = file_get_contents($path . '/' . $page);
                                        $page = substr($page, 0, strripos($page, '.'));

                                        echo '<a class="' . (isset($chapter['tags']) ? $Parsedown->GetTags($file) : '') . '" href="/?page=' . $page . '" search="' . $page . '">' . $Parsedown->PageTitle($file) . '</a>';
                                    }

                                    echo '</li>';
                                }

                                echo '</ul>';
                                echo '</details>';
                            }

                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <script>
            function InitSearch() {
                SearchInput = document.getElementById("search");
                SearchResults = document.getElementById("searchresults");
                SidebarContents = document.getElementById("contents");
                SearchInput.addEventListener("input", e => {
                    clearTimeout(SearchDelay);
                    SearchDelay = setTimeout(UpdateSearch, 200);
                });
            }
            // We removed enter. (We don't support it yet.)
            function AddSearchTitle() {
                if (Titles.length == 0)
                    return;
                if (SectionHeader != null) {
                    var copy = SectionHeader.cloneNode(true);
                    SearchResults.appendChild(copy);
                    SectionHeader = null;
                }
                for (var i = 0; i < Titles.length; i++) {
                    var cpy = Titles[i].cloneNode(true);
                    if (cpy.href)
                        cpy.onclick = e => location.replace(cpy.href);
                    cpy.className = "node" + ((TitleCount - Titles.length) + i);
                    SearchResults.appendChild(cpy);
                }
                Titles = [];
            }

            function SearchRecursive(str, el, tags) {
                var title = null;
                if (el.children.length > 0 && el.children[0].tagName == "SUMMARY") {
                    title = el.children[0].children[0];
                    Titles.push(title);
                    TitleCount++;
                }
                var children = el.children;
                for (var i = 0; i < children.length; i++) {
                    var child = children[i];
                    if (child.className == "sectionheader")
                        SectionHeader = child;
                    if (child.tagName == "A") {
                        if (child.parentElement.tagName == "SUMMARY")
                            continue;
                        var txt = child.getAttribute("search");
                        if (txt != null) {
                            var found = txt.match(str);
                            if (found && tags.length > 0) {
                                var tagClasses = { "is:server": "rs", "is:sv": "rs", "is:client": "rc", "is:cl": "rc", "is:menu": "rm", "is:mn": "rm" };
                                var tagNotClasses = { "not:server": "rs", "not:sv": "rs", "not:client": "rc", "not:cl": "rc", "not:menu": "rm", "not:mn": "rm" };
                                tags.forEach(str => {
                                    if (tagClasses[str] != null && !child.classList.contains(tagClasses[str])) {
                                        found = null;
                                    }
                                    if (tagNotClasses[str] != null && child.classList.contains(tagNotClasses[str])) {
                                        found = null;
                                    }
                                    if (str == "is:global" && child.getAttribute("href").indexOf("Global.") == -1) {
                                        found = null;
                                    }
                                    if (str == "is:enum" && child.getAttribute("href").indexOf("Enums/") == -1) {
                                        found = null;
                                    }
                                    if (str == "is:struct" && child.getAttribute("href").indexOf("Structures/") == -1) {
                                        found = null;
                                    }
                                });
                            }
                            if (found) {
                                if (ResultCount < MaxResultCount) {
                                    AddSearchTitle();
                                    var copy = child.cloneNode(true);
                                    copy.onclick = e => location.replace(cpy.href);
                                    copy.classList.add("node" + TitleCount);
                                    SearchResults.appendChild(copy);
                                }
                                ResultCount++;
                            }
                        }
                    }
                    SearchRecursive(str, child, tags);
                }
                if (title != null) {
                    TitleCount--;
                    if (Titles[Titles.length - 1] == title) {
                        Titles.pop();
                    }
                }
            }

            function UpdateSearch(limitResults = true) {
                if (limitResults)
                    MaxResultCount = 100;
                else
                    MaxResultCount = 2000;
                var child = SearchResults.lastElementChild;
                while (child) {
                    SearchResults.removeChild(child);
                    child = SearchResults.lastElementChild;
                }
                var string = SearchInput.value;
                var tags = [];
                var searchTerms = string.split(" ");
                searchTerms.forEach(str => {
                    if (str.startsWith("is:") || str.startsWith("not:")) {
                        tags.push(str);
                        string = string.replace(str, "");
                    }
                });
                if (string.length < 2) {
                    SidebarContents.classList.remove("searching");
                    SearchResults.classList.remove("searching");
                    var sidebar = document.getElementById("sidebar");
                    var active = sidebar.getElementsByClassName("active");
                    if (active.length == 1) {
                        active[0].scrollIntoView({ block: "center" });
                    }
                    return;
                }
                SidebarContents.classList.add("searching");
                SearchResults.classList.add("searching");
                ResultCount = 0;
                Titles = [];
                TitleCount = 0;
                SectionHeader = null;
                if (string.toUpperCase() == string && string.indexOf("_") != -1) {
                    string = string.substring(0, string.indexOf("_"));
                }
                var parts = string.split(' ');
                var q = "";
                for (var i in parts) {
                    if (parts[i].length < 1)
                        continue;
                    var t = parts[i].replace(/([^a-zA-Z0-9_-])/g, "\\$1");
                    q += ".*(" + t + ")";
                }
                q += ".*";
                var regex = new RegExp(q, 'gi');
                SearchRecursive(regex, SidebarContents, tags);
                if (limitResults && ResultCount > MaxResultCount) {
                    var moreresults = document.createElement('a');
                    moreresults.href = "#";
                    moreresults.classList.add('noresults');
                    moreresults.innerHTML = (ResultCount - 100) + ' more results - show more?';
                    moreresults.onclick = (e) => { UpdateSearch(false); return false; };
                    SearchResults.append(moreresults);
                }
                if (SearchResults.children.length == 0) {
                    var noresults = document.createElement('span');
                    noresults.classList.add('noresults');
                    SearchResults.appendChild(noresults);
                }
            }

			var sidebar = document.getElementById( "sidebar" );
			var active = sidebar.getElementsByClassName( "active" );
			if ( active.length == 1 )
			{
				active[0].scrollIntoView( { smooth: true, block: "center" } );
			}

			InitSearch();
		</script>
    </body>
</html>
<?php else:
    header('Content-Type:text/plain');
    if ($_GET["format"] === 'text') {
        echo $file;
    } elseif ($_GET["format"] === 'html') {
        echo $Parsedown->text($file);
    } elseif ($_GET["format"] === 'json') {
        //echo '{"title":"' . $title .'","wikiName":"' . $config['name'] . '","wikiIcon":"https://files.facepunch.com/garry/822e60dc-c931-43e4-800f-cbe010b3d4cc.png","wikiUrl":"gmod","address":"' . (isset($_GET["page"]) ? $_GET["page"] : '') . '","createdTime":"2020-01-21T17:09:42.1+00:00","updateCount":0,"markup":"' . $file . '","html":"' . $Parsedown->text($file) . '","footer":"","revisionId":0,"pageLinks":[{"url":"/gmod/Global.CreateSound","label":"View","icon":"file","description":""},{"url":"","label":"Edit","icon":"pencil","description":""},{"url":"","label":"History","icon":"history","description":""}]}';
    }

    endif;
?>