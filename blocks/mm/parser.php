<?php
class Writer {
    public function main($text, $posts = NAN){ 
        $_bbcode = array('[b]','[/b]','[i]','[/i]','[s]','[/s]','[u]','[/u]','[code]','[/code]','[sm]','[/sm]');
        $_tegs = array('<span class="b">','</span>','<span class="i">','</span>','<span class="s">','</span>','<span class="u">','</span>','<code>','</code>'
        ,'<img src="../../img/writer/smiles/','.jpg" />');
            if($posts === 1) {
                array_push($_bbcode, '[sp]','[/sp]');
                array_push($_tegs, '<div class="spoiler">','</div>');
            }
            if($posts === 2) {
                array_push($_bbcode,'[sp]','[/sp]','[v]','[/v]');
                array_push($_tegs, '<div class="spoiler">','</div>','<br><div style="color:#fff; background:#000; padding:5px">','</div><br>');
            }
        $comment_text = htmlspecialchars($text);
        $comment_text = str_replace($_bbcode, $_tegs, $comment_text);
        preg_match_all("/(?:https?:\/\/)(?:www\.)?(?:[-а-яa-zёЁцушщхъфырэчстью0-9_\.]{2,}\.?)(?:(?:\w|\.|рф){2,6})(?:(?:\/|\?)?(?:\w|\/|\?|\&|=|\.|-|%|#|\+|;){0,})?/", $comment_text, $result_array);
        if($result_array[0]) {
            $comment_text = $this->tlink($result_array, $comment_text);
        }
        return $comment_text;
    }
    public function tlink($link, $text) {
        $drep = '';
        foreach ($link[0] as $key) {
            preg_match("/(?:https?\:\/\/)?(?:www\.)?((?:[-а-яa-zёЁцушщхъфырэчстью0-9_\.]{2,}))/",$key,$link_result);
            if($key !== $drep) {
                    switch ($link_result[1]) {
                    case 'youtube.com':
                        $z = 'youtebe';
                        $result = str_replace($key, $z, $text);
                        break;
                    default:
                        $img = $this->images($key);
                        if($img) {
                            $drep = $key;
                            $z = '<img class="writer_img" src="'.$key.'"/>';
                            $result = str_replace($key, $z, $text);
                        }
                        else if(!$img) {
                            $z = '<a href="'.$key.'">'.$key.'</a>';
                            $result = str_replace($key, $z, $text);
                        }
                        break;
                }
                $text = $result;
            }
            $drep = $key;
        }
        return $result;
    }
    public function images($link) {
        if (preg_match("/\.jpg|\.jpeg|\.png|\.bmp$/", $link)) {return true;}
        else{return false;}
    }
}

