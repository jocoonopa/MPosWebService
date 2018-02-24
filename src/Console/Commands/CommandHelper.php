<?php

namespace jocoonopa\MPosWebService\Console\Commands;

class CommandHelper
{
    /**
     * 產生 keywords 條件問句
     * 
     * @return string
     */
    public static function getKeywordsDesc()
    {
        $str = "What are your keywords?\n"; 
        $str.= "--------------------------------------------\n";
        $str.= "條件為 `or` 的关系用 `|` 隔开\n";
        $str.= "條件為 `and` 的关系用 `+` 隔开\n";
        $str.= "條件為范围 `(start，end)` 括起来\n";

        return $str;
    }
}
