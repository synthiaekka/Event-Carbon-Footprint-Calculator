<?php

trait template{

    public function renderTemplate ($templateName) {
        
        $path = "../app/views/". $templateName .".php";

        $content = file_get_contents($path);

        // check for @component() statements
        
        // replacements for variables {{ $variable }}
        $content = preg_replace('/{{\S*(.+?)\S*}}/', '<?php echo $1; ?>', $content);

        // replacement for @if ( condition ) -------- @elseif ------- @else ------- @endif
        $content = preg_replace('/@if\(\s*(.+?)\s*\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@elseif\(\s*(.+?)\s*\)/', '<?php elseif($1): ?>', $content);
        $content = str_replace('@else', '<?php else: ?>', $content);
        $content = str_replace('@endif', '<?php endif; ?>', $content);
        
        // replacement for @while and @endwhile (loop)
        $content = preg_replace('/@while\(\s*(.+?)\s*\)/', '<?php while($1): ?>', $content);
        $content = str_replace('@endwhile', '<?php endwhile; ?>', $content);

        // replacement for @for and @endfor (loop)
        $content = preg_replace('/@for\(\s*(.+?)\s*\)/', '<?php for($1): ?>', $content);
        $content = str_replace('@endfor', '<?php endfor; ?>', $content);

        // replacement for @foreach and @endforeach (loop)
        $content = preg_replace('/@foreach\(\s*(.+?)\s*\)/', '<?php foreach($1): ?>', $content);
        $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);

        // replacement for heredoc 
        $content = str_replace('@template', '<?php $str = <<<HTML', $content);
        $content = str_replace('@endtemplate', ' HTML; echo $str; ?>', $content);
       

        // predefined variables for the template
        // replacements for csrf token field
        // replacements for csrf token

        // match print_if_exists var
        

        // match for all normal var 
       

        

        // replacements for @php, @endphp statements
        $content = str_replace('@php', '<?php ', $content);
        $content = str_replace('@endphp', '?>', $content);
        

        
        return $content;
    }

}