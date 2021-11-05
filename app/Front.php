<?php

namespace App;

class Front
{
    /**
     * Metodo responsavel por retornar o conteudo de uma view
     * @param mixed $view 
     * @return void 
     */
    private static function getContentsView(string $view):?string
    {
        $file = __DIR__ . '/../src/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }


    /**
     * Metodo responsavel por retornar o conteudo renderizado
     * @param mixed $view 
     * @return void 
     */
    public static function render(string $view, array $vars = [])
    {
        $contentView = self::getContentsView($view);

        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}
