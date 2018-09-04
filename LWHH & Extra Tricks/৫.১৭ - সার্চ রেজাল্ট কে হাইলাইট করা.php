<?php

// put this code in functions.php

function alpha_highlight_search_results($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'alpha_highlight_search_results');
add_filter('the_excerpt', 'alpha_highlight_search_results');
add_filter('the_title', 'alpha_highlight_search_results');

// put CSS for search-highlight class
// like
/*.search-highlight{
    background-color: #ff0;
    font-weight: bold;
}*/

// So, search result er text ke highlight korbe

