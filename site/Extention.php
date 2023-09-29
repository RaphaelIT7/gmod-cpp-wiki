<?php
    include('Parsedown.php');
    include('utils.php');

    $function = array();

    class Extension extends Parsedown
    {

        private $baseImagePath = 'https://wiki.facepunch.com/';
        public $config;
        public $categories;
        protected $lua_keywords = array('and', 'break', 'do', 'else', 'elseif', 'end', 'false', 'for', 'function', 'if', 'in', 'local', 'nil', 'not', 'or', 'repeat', 'return', 'then', 'true', 'until', 'while');
        protected $cpp_keywords = array(
            'alignas', 'alignof', 'and', 'and_eq', 'asm', 'auto',
            'bitand', 'bitor', 'bool', 'break', 'case', 'catch', 'char', 'char16_t', 'char32_t', 'class', 'compl', 'const', 'constexpr', 'const_cast', 'continue',
            'decltype', 'default', 'delete', 'do', 'double', 'dynamic_cast',
            'else', 'enum', 'explicit', 'export', 'extern',
            'false', 'float', 'for', 'friend',
            'goto',
            'if', 'inline', 'int',
            'long',
            'mutable',
            'namespace', 'new', 'noexcept', 'not', 'not_eq', 'nullptr',
            'operator', 'or', 'or_eq',
            'private', 'protected', 'public',
            'register', 'reinterpret_cast', 'return',
            'short', 'signed', 'sizeof', 'static', 'static_assert', 'static_cast', 'struct', 'switch',
            'template', 'this', 'thread_local', 'throw', 'true', 'try', 'typedef', 'typeid', 'typename',
            'union', 'unsigned', 'using',
            'virtual', 'void', 'volatile',
            'wchar_t', 'while', 'xor', 'xor_eq'
        );
        #
        # Utilities
        #
        function FindFile($file) {
            foreach($this->categories as &$category) {
                foreach ($category['categories'] as &$chapter) {
                    $shortpath = $this->config['pages_path'] . $chapter['path'] . '/';
                    $path = $shortpath  . $file . '.md';

                    $files = array_diff(scandir($shortpath), array('..', '.'));
                    foreach($files as $file2) {
                        if (is_dir($shortpath . $file2)) {
                            if (file_exists($shortpath . $file2 . '/' . $file . '.md'))
                            {
                                return $shortpath . $file2 . '/' . $file . '.md';
                            }
                        }
                    }

                    if (file_exists($path))
                    {
                        return $path;
                    }
                }
            }
        }

        function PageTitle($text)
        {
            $title = $this->config['name'];
            if (preg_match('/<title>(.*?)<\/title>/', $text, $matches)) {
                $title = $matches[1];
            }

            if (preg_match('/<function name="([^"]+)" parent="([^"]+)" type="([^"]+)">([\s\S]+?)<\/function>/s', $text, $matches)) {
                 $title = $matches[1];
            }

            return $title;
        }

        function ClassPageTitle($text)
        {
            $title = $this->config['name'];
            if (preg_match('/<title>(.*?)<\/title>/', $text, $matches)) {
                $title = $matches[1];
            }

            if (preg_match('/<function name="([^"]+)" parent="([^"]+)" type="([^"]+)">([\s\S]+?)<\/function>/s', $text, $matches)) {
                if($matches[3] == 'classfunc') {
                    $title = $matches[2] . ':' . $matches[1];
                } else {
                    $title = $matches[1];
                }
            }

            return $title;
        }

        function LableRealm($text) 
        {
            if (preg_match('/<function name="([^"]+)" parent="([^"]+)" type="([^"]+)">([\s\S]+?)<\/function>/s', $text, $matches)) {
                if (preg_match('/<realm>(.*?)<\/realm>/s', $text, $matches)) {
                    $realm = $matches[1];

                    if ($realm === 'Client and Menu') {
                        return 'rc rm';
                    } elseif ($realm === 'Menu') {
                        return 'rm';
                    } elseif ($realm === 'Client') {
                        return 'rc';
                    } elseif ($realm === 'Server') {
                        return 'rs';
                    } elseif ($realm === 'Shared') {
                        return 'rs rc';
                    } elseif ($realm === 'Shared and Menu') {
                        return 'rs rc rm';
                    }
                } else {
                    return '';
                }
            }

            return '';
        }

        #
        # Overrides
        #
        protected function inlineImage($excerpt)
        {
            $image = parent::inlineImage($excerpt);

            if ( ! isset($image))
            {
                return null;
            }

            $image['element']['attributes']['src'] = $this->baseImagePath . $image['element']['attributes']['src'];

            return $image;
        }

        protected function blockHeader($Line)
        {
            $Block = parent::blockHeader($Line);

            $arg = $Block['element']['handler']['argument'];
            $Block['element']['handler']['argument'] = '<a name="' . $arg . '" class="anchor_offset"></a>' . $arg . '<a class="anchor" href="#' . $arg . '"><i class="mdi mdi-link-variant"></i></a>';

            return $Block;
        }

        private $function = array();
        protected function buildFunction($func)
        {
            $html = '<div class="function ' . $func['type'] . ' ' . $func['realm'] . '">';
                $html .= '<div class="function_line">';
                    $html .= '<a href="gmod/States" class="realm_icon" title="' . $func['realmdesc'] . '">&nbsp;</a>';
                    #$html .= '<a class="link-page exists" href="/gmod/number">number</a>';

                    if(isset($func['parent']) && $func['parent'] != '')
                    {
                        $func['parent'] = '<a class="link-page ' . ($this->FindFile($func['parent']) != null ? 'exists' : 'missing') . '" href="/?page=' . $func['parent'] . '">' . $func['parent'] . '</a>';
                    }

                    $func['args'] = isset($func['args']) ? $func['args'] : array();
                    $func['rets'] = isset($func['rets']) ? $func['rets'] : array();
                    if (sizeof($func['args']) != 0 || sizeof($func['rets']) != 0) {
                        $args = '';
                        foreach ($func['args'] as $arg) {
                            if (! str_ends_with($args, ',') && $args !== '')
                            {
                                $args .= ',';
                            }

                            $args .= ' ' . '<a class="link-page ' . ($this->FindFile($func['parent']) != null ? 'exists' : 'missing') . '" href="/?page=' . $arg['type'] . '">' . $arg['type'] . '</a>' . ' ' . $arg['name'];

                            if (isset($arg['default']) && $arg['default'] !== '')
                            {
                                $args .= ' = ' . $arg['default'];
                            }
                        }

                        $rets = '';
                        foreach ($func['rets'] as $ret) {
                            if (! str_ends_with($rets, ',') && $rets !== '')
                            {
                                $rets .= ',';
                            }

                            $rets .= ' ' . '<a class="link-page ' . ($this->FindFile($func['parent']) != null ? 'exists' : 'missing') . '" href="/?page=' . $ret['type'] . '">' . $ret['type'] . '</a>';

                            if (isset($ret['default']) && $ret['default'] !== '')
                            {
                                $rets .= ' = ' . $ret['default'];
                            }
                        }

                        $html .= $rets . ' ' . (isset($func['parent']) ? $func['parent'] . ':' : '') . $func['name'] . '(' . $args .' )';
                    } else {
                        $html .= ' ' . (isset($func['parent']) ? $func['parent'] . ':' : '') .$func['name'] . "()";
                    }
                $html .= '</div>';

                $html .= '<div class="function_links">';
                    if (isset($func['source']) && $func['source'] != '')
                    {
                        $html .= '<a href="' . $func['source'] . '">';
                            $html .= '<i class=mdi mdi-source-branch">';
                            $html .= '</i>';
                            $html .= ' View Source';
                        $html .= '</a>';
                    }
                $html .= '</div>';
                
                if (isset($func['desc']))
                {
                    $html .= '<h1>Description</h1>';
                    $html .= '<div class="description_section function_description section">';
                        $html .= $func['desc'];
                    $html .= '</div>';
                }

                if (isset($func['args']) && sizeof($func['args']) > 0)
                {
                    $html .= '<h1>Arguments</h1>';
                    $html .= '<div class="function_arguments section">';
                    $i = 0;
                    foreach($func['args'] as $arg)
                    {
                        $i = $i + 1;
                        $html .='<div>';
                            $html .= '<span class="numbertag">' . $i . '</span>';
                            $html .= '<a class="link-page ' . ($this->FindFile($func['parent']) != null ? 'exists' : 'missing') . ' href="/?page=' . $arg['type'] . '">' . $arg['type'] . '</a>';
                            $html .= '<span class="name"> ' . $arg['name'] . '</span>';
                            if(isset($arg['default']) && $arg['default'] != '') {
                                $html .= '<span class="default"> = ' . $arg['default'] . '</span>';
                            }
                            $html .= '<div class="numbertagindent">';
                                $html .= $arg['desc'];
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }

                if (isset($func['rets']) && sizeof($func['rets']) > 0)
                {
                    $html .= '<h1>Returns</h1>';
                    $html .= '<div class="function_returns section">';
                    $i = 0;
                    foreach($func['rets'] as $arg)
                    {
                        $i = $i + 1;
                        $html .='<div>';
                            $html .= '<span class="numbertag">' . $i . '</span>';
                            $html .= '<a class="link-page ' . ($this->FindFile($func['parent']) != null ? 'exists' : 'missing') . ' href="/?page=' . $arg['type'] . '">' . $arg['type'] . '</a>';
                            $html .= '<span class="name"> ' . $arg['name'] . '</span>';
                            if(isset($arg['default']) && $arg['default'] != '') {
                                $html .= '<span class="default"> = ' . $arg['default'] . '</span>';
                            }
                            $html .= '<div class="numbertagindent">';
                                $html .= $arg['desc'];
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
            $html .= '</div>';

            return $html;
        }

        protected function buildNote($text)
        {
            $html = '<div class="note">';
                $html .= '<div class="inner">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildWarning($text)
        {
            $html = '<div class="warning">';
                $html .= '<div class="inner">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildKey($text)
        {
            $html = '<span title="' . $text .'" class="key key-' . $text . '">';
                $html .= $text;
            $html .= '</span>';

            return $html;
        }

        protected function buildRemoved($text)
        {
            $html = '<div class="removed">';
                $html .= '<div class="inner">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildDeprecated($text)
        {
            $html = '<div class="deprecated">';
                $html .= '<div class="inner">';
                    $html .= 'We advise against using this. It may be changed or removed in a future update. ' . $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildValidate($text)
        {
            $html = '<div class="validate">';
                $html .= '<div class="inner">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildInternal($text)
        {
            $html = '<div class="internal">';
                $html .= '<div class="inner">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildURL($name, $url)
        {
            $html = '<a href="';
            $html .= $url;
            $html .= '">';
                $html .= $name;
            $html .= '</a>';

            return $html;
        }

        protected function buildPageURL($page)
        {
            $file = $this->FindFile($page);
            $html = '<a class="link-page ' . (isset($file) ? 'exists' : 'missing') . '" href="';
            $html .= "/?page=" . $page;
            $html .= '">';
                $html .= $page;
            $html .= '</a>';

            return $html;
        }

        protected function buildAmbig($text, $page)
        {
            $file = $this->FindFile($page);

            $html = '<div class="ambig">';
                $html .= '<div class="target">';
                    $html .= '<a class="link-page ' . (isset($file) ? 'exists' : 'missing') . '" href="/?page=' . $page . '">' . (isset($file) ? $this->ClassPageTitle(file_get_contents($file)) : $page) . '</a>';
                $html .= '</div>';
                $html .= '<div class="desc">';
                    $html .= $text;
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildBug($text, $issue)
        {
            $html = '<div class="bug">';
                $html .= '<div class="inner">';
                    $html .= $text;
                    $html .= '<br><br>Issue Tracker: ';
                    $html .= '<a href=' . $this->config['issues_url'] . $issue . '>' . $issue . '</a>';
                $html .= '</div>';
            $html .= '</div>';

            return $html;
        }

        protected function buildCode($code, $language)
        {
            $html = '<pre>';
                $html .= $code;
            $html .= '</pre>';

            return $html;
        }

        protected function buildExample($exam)
        {
            $html = '<h2>Example</h2>';
            $html .= '<div class="example">';
                $html .= '<div class="description">';
                    $html .= $exam['desc'];
                $html .= '</div>';
                $html .= '<div class="code">';
                    $code = $exam['code'];

                    if ($this->config['code_language'] == 'lua') {
                        foreach($this->lua_keywords as $keyword)
                        {
                            $code = preg_replace('/\b' . preg_quote($keyword, '/') . '\b/', '<span class="keyword">' . $keyword . '</span>', $code);
                        }
                        $code = preg_replace('/--(.*?)\n/', '<span class="comment">--$1</span>', $code);
                        $code = preg_replace('/\/\/(.*?)\n/', '<span class="comment">//$1</span>', $code);
                        $code = preg_replace('/--\[\[(.*?)\]\]/s', '<span class="multiline-comment">--[[$1]]</span>', $code);

                        $code = preg_replace('/local function (\w+)\(/', 'local function <span class="methoddef">$1</span>(', $code);
                    } elseif ($this->config['code_language'] == 'c++') {
                        foreach($this->cpp_keywords as $keyword)
                        {
                            $code = preg_replace('/\b' . preg_quote($keyword, '/') . '\b/', '<span class="keyword">' . $keyword . '</span>', $code);
                        }

                        $code = preg_replace('///(.*?)\n/', '<span class="comment">//$1</span>', $code);
                        $code = preg_replace('#/\*(.*?)\*/#s', '<span class="multiline-comment">/* $1 */</span>', $code);
                    }

                    $html .= $code;
                $html .= '</div>';
                if (isset($exam['output'])) {
                    $html .= '<div class="output">';
                        $html .= $exam['output'];
                    $html .= '</div>';
                }
            $html .= '</div>';

            return $html;
        }

        function getrealm($realm) 
        {
            if ($realm === 'Client and Menu') {
                $this->function['realm'] = 'realm-client realm-menu';
                $this->function['realmdesc'] = "This function is available in client and menu state(s)";
            } elseif ($realm === 'Menu') {
                $this->function['realm'] = 'realm-menu';
                $this->function['realmdesc'] = "This function is available in menu state";
            } elseif ($realm === 'Client') {
                $this->function['realm'] = 'realm-client';
                $this->function['realmdesc'] = "This function is available in client state";
            } elseif ($realm === 'Server') {
                $this->function['realm'] = 'realm-server';
                $this->function['realmdesc'] = "This function is available in server state";
            } elseif ($realm === 'Shared') {
                $this->function['realm'] = 'realm-client realm-server';
                $this->function['realmdesc'] = "This function is available in client and server state(s)";
            } elseif ($realm === 'Shared and Menu') {
                $this->function['realm'] = 'realm-client realm-server realm-menu';
                $this->function['realmdesc'] = "This function is available in client, server and menu state(s)";
            }
        }

        function GetStuff($text, $name, $prefix)
        {
            $ret = array();

            preg_match_all('/<' . $prefix . ' name="([^"]*)" type="([^"]+)"(?: default="([^"]+)")?>(.*?)<\/' . $prefix . '>/s', $text, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $name = $match[1];
                $type = $match[2];
                $default = isset($match[3]) ? $match[3] : null;
                $desc = trim($match[4]);

                $aArray = array(
                    'name' => $name,
                    'type' => $type,
                    'desc' => $desc,
                );

                if ($default !== null) {
                    $aArray['default'] = $default;
                }

                $ret[] = $aArray;
            }

            return $ret;
        }

        function text($text)
        {
            $markup = '';

            $lines = explode("\n", $text);

            foreach ($lines as &$line) {
                if (!preg_match('/^#/', $line) && preg_match('/\s{2}$/', $line)) {
                    $line .= '<br>';
                }
            }

            $text = implode("\n", $lines);
            //$text = preg_replace('/(?<!^#)\s{2}$/m', '<br>', $text); // Add <br> tag at the end of lines with two spaces

            if (preg_match_all('/<note>(.*?)<\/note>/s', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<note>' . $match[1] . '</note>', $this->buildNote($match[1]), $text);
                }
            }

            if (preg_match_all('/<warning>(.*?)<\/warning>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<warning>' . $match[1] . '</interwarningnal>', $this->buildWarning($match[1]), $text);
                }
            }

            if (preg_match_all('/<removed>(.*?)<\/removed>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<removed>' . $match[1] . '</removed>', $this->buildRemoved($match[1]), $text);
                }
            }

            if (preg_match_all('/<deprecated>(.*?)<\/deprecated>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<deprecated>' . $match[1] . '</deprecated>', $this->buildDeprecated($match[1]), $text);
                }
            }

            if (preg_match_all('/<validate>(.*?)<\/validate>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<validate>' . $match[1] . '</validate>', $this->buildValidate($match[1]), $text);
                }
            }

            if (preg_match_all('/<internal>(.*?)<\/internal>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<internal>' . $match[1] . '</internal>', $this->buildInternal($match[1]), $text);
                }
            }

            if (preg_match_all('/<key>(.*?)<\/key>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<key>' . $match[1] . '</key>', $this->buildKey(strtolower($match[1])), $text);
                }
            }

            if (preg_match_all('/<key>(.*?)<\/key>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<key>' . $match[1] . '</key>', $this->buildKey(strtolower($match[1])), $text);
                }
            }

            if (preg_match_all('/\[([^]]+)\]\(([^)]+)\)/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('[' . $match[1] . '](' . $match[2] . ')', $this->buildURL($match[1], $match[2]), $text);
                }
            }

            if (preg_match_all('/<ambig\s+page="([^"]+)">(.*?)<\/ambig>/s', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    if (preg_match('/<function name="([^"]+)" parent="([^"]+)" type="([^"]+)">([\s\S]+?)<\/function>/s', $text, $_)) {
                        $markup .= $this->buildAmbig($match[2], $match[1]);
                    }
                    $text = str_replace('<ambig page="' . $match[1] . '">' . $match[2] . '</ambig>', $this->buildAmbig($match[2], $match[1]), $text);
                }
            }

            if (preg_match_all('/<bug\s+issue="([^"]+)">([^<]+)<\/bug>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('<bug issue="' . $match[1] . '">' . $match[2] . '</bug>', $this->buildBug($match[2], $match[1]), $text);
                }
            }

            if (preg_match_all('/```([a-zA-Z0-9_-]*)\n(.*?)\n```/s', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $text = str_replace('```' . $match[1] . '\n' . $match[2] . '```', $this->buildCode($match[1], $match[2]), $text);
                }
            }

            if (preg_match_all('/<page(?:\s+text="([^"]*)")?>([^<]+)<\/page>/', $text, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    if (isset($match[1]) && $match[1] != '') {
                        $rep = '<page text=' . $match[1] . '>' . $match[2] . '</page>';
                    } else {
                        $rep = '<page>' . $match[2] . '</page>';
                    }
                    $text = str_replace($rep, $this->buildPageURL($match[2]), $text);
                }
            }

            $special = false;
            if (preg_match('/<function name="([^"]+)" parent="([^"]+)" type="([^"]+)">([\s\S]+?)<\/function>/s', $text, $matches)) {
                $special = true;
                $this->function['name'] = $matches[1];
                $this->function['parent'] = $matches[2];
                $this->function['type'] = $matches[3];

                $textContent = $matches[4];

                if (preg_match('/<description>\s*(.*?)\s*<\/description>/s', $text, $matches)) {
                    $this->function['desc'] = $matches[1];
                }

                if (preg_match('/<source>\s*(.*?)\s*<\/source>/s', $text, $matches)) {
                    $this->function['source'] = $matches[1];
                }

                if (preg_match('/<realm>(.*?)<\/realm>/s', $text, $matches)) {
                    $this->getrealm($matches[1]);
                } else {
                    $this->function['realm'] = '';
                    $this->function['realmdesc'] = "No";
                }

                if (preg_match('/<args>(.*?)<\/args>/s', $text, $matches)) {
                    $this->function['args'] = $this->GetStuff($matches[1], 'args', 'arg');
                }

                if (preg_match('/<rets>(.*?)<\/rets>/s', $text, $matches)) {
                    $this->function['rets'] = $this->GetStuff($matches[1], 'rets', 'ret');
                }

                $markup .= $this->buildFunction($this->function);
            }

            if (preg_match_all('/<example>\s*<description>(.*?)<\/description>\s*<code>(.*?)<\/code>(?:\s*<output>(.*?)<\/output>)?\s*<\/example>/s', $text, $matches, PREG_SET_ORDER)) {
                $special = true;

                foreach ($matches as $match) {
                    $markup .= $this->buildExample(array(
                        'out' => isset($match[3]) ? trim($match[3]) : '',
                        'code' => trim($match[2]),
                        'desc' => parent::text(trim($match[1])),
                    ));
                }
            }

            if (preg_match('/<type name="([^"]+)" category="([^"]+)" is="([^"]+)">([\s\S]+?)<\/type>/s', $text, $matches)) {
                $type = array();
                $type['name'] = $matches[1];
                $type['category'] = $matches[2];
                $type['is'] = $matches[3];

                $content = $matches[4];
            }

            if (!$special) {
                $markup .= parent::text($text);
            }

            $title = $this->config['name'];
            if (preg_match('/<title>(.*?)<\/title>/', $text, $matches))
            {
                $title = $matches[1];
            }

            return $markup;
        }

        function ViewText($text)
        {
            $title = $this->config['name'];
            if (preg_match('/<title>(.*?)<\/title>/', $text, $matches))
            {
                $title = $matches[1];
            }   

            $html = '<h1 class="pagetitle" id="pagetitle">' . $title .'</h1>';
            $html .= '<div class="markdown" id="pagecontent">';
            $html .= $this->text($text);
            $html .= '</div>';

            return $html;
        }

        private $desc = false;
        protected function blockMarkup($Line)
        {
            if (preg_match('/^<description>/', $Line['text'])) {
                $Block = array(
                    'name' => 'description',
                    'markup' => '',
                );
                return $Block;
            }

            if (preg_match('/<\/function>/i', $Line['text'], $matches)) {
                $Block = array(
                    'name' => 'function',
                    'element' => array(
                        'text' => $this->function,
                        'handler' => 'blockFunction', // Custom handling function for <function> tags
                        'rawHtml' => $Line['text'],
                    ),
                );

                return $Block;
            }

            $Block = parent::blockMarkup($Line);

            if (! isset($Block['name']))
            {
                return;
            }

            if (strcmp($Block['name'], 'image') == 0 && ! str_contains($Line['text'], 'class="image"'))
            {
                $Block['element']['rawHtml'] = substr($Line['text'], 0, -2) . ' class="image"/>';
            }

            return $Block;
        }
    }
?>