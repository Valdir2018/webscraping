<?php


/**
* @param criando webscraping com php 7.4 usando a blibioteca CURL
*
* @author Valdir Silva - 06/11/2020
*
*
*/

class WebScrapping {
	
	public static  $url = "url_site";

    
        /**
	* @param recebe  a variável de inicialização do CURL 
	* @param através da curl_setopt retorna os dados como string 
	*/

	public static function curl($curl, $url) 
	{
		$curl = $curl;
		$url  = $url;
		curl_setopt($curl, CURLOPT_URL,  $url);
		curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true); // return string 
	}

	public static function scrappingHtml() 
	{
		$curl = curl_init();
		WebScrapping::curl($curl, WebScrapping::$url);
		$html = curl_exec($curl);

		$dom = new DOMDocument();
		@$dom->loadHTML($html); // @ Para ocultar os erros 
		$dom->preserveWhiteSpace = false;

                // Seleciona os elementos deseja dos
		$imagens = $dom->getElementsByTagName('img');
		$links   = $dom->getElementsByTagName('a');

		WebScrapping::images($imagens);
		WebScrapping::link($links);

	}
	/**
	* @return todas as imagens do site
	*
	*/
	public static function images($image) 
	{
	     $imagens = $image;
	     foreach($imagens as $imagem) {
		     $posicao =  $imagem->getAttribute('src'). '<br/>';
		     echo "<img src='http://meusite.com.br/blog/resource/".$posicao."' />";
	    }
	}

	/**
	* @return todos os links do site
	*
	*/

	public static function link($link) 
	{
		$links = $link;
		foreach($links as $link ) {
		       $url = $link->getAttribute('href');
		       echo "<a href='http://meusite.com.br/blog/resource/". $url ."' >Link</a><br/>";
                }
	} 
}




