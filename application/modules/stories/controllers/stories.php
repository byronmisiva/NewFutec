<?php

class Stories extends MY_Controller
{
    public $model = 'mdl_stories';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('home');
    }

    public function tags()
    {
        redirect('home');
    }

    public function publica()
    {
        $this->db->select('s.*', FALSE);
        $this->db->where('s.id', $this->uri->segment(3));
        $aux = current($this->db->get('stories s')->result());

        $nombre = $this->_urlFriendly($aux->title);
        redirect(base_url() . 'site/noticia/' . $nombre . '/' . $offset = $this->uri->segment(3));
    }

    function _clearStringGion($string)
    {
        $tempSting = str_replace(' ', '-', $this->_clearString($string));

        $tempSting = str_replace(
            array("\\", "¨", "º", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "`", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                ".", '"', '“', '”',"‘", "’", ' ' ),
            '',
            $tempSting
        );

        $tempSting = str_replace('---', '-', $tempSting);
        $tempSting = str_replace('--', '-', $tempSting);

        return $tempSting;
    }

    function _clearString($string)
    {

        $string = trim($string);
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', 'ã'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'a'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô', 'õ', 'ø'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'o', 'o'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño

        return $string;
    }

    function _urlFriendly($string)
    {
        $cadena = strtolower($this->_clearStringGion($string));
        $cadena = preg_replace('/[^a-zA-Z0-9-]/', "", $cadena);

        return $cadena ;
    }

    
    function rssRotativas(){
    	$this->config->set_item('compress_output', 'FALSE');
    	$data['name'] = 'XML RSS';
    	$data['views'] = 1;
    	$this->sum($data);
    	header('Content-type: text/xml; charset=utf-8');
    	$request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/"
					     xmlns:atom="http://www.w3.org/2005/Atom"
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"
					     xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/imagenes/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>' . date('r', time()) . '</pubDate>
				 ';    	
    	$news = $this->mdl_stories->rssnewRotativas();    	
    	
    	foreach ($news as $row):
            $posicionInicio = 0;
            $texto = strip_tags($row->body);
            $texto = (string)$texto;
            $total = strlen($texto);
            $posicionInicio = strpos($texto, "iframe");
            if ($posicionInicio > 0) {
                $video = substr($texto, $posicionInicio, $total);
                $posicionInicio = (int)$posicionInicio - 4;
                $texto2 = substr($texto, 0, $posicionInicio);
                $video = "<figure><" . $video . "</figure>";
            } else {
                $texto2 = strip_tags ($row->body);
                $video = "";
            }

            $linkbody = $row->subtitle;
            if ($linkbody == "") {
                $linkbody = $row->title;
            }

            $request = $request . '
				<item>
				  <title>' . $row->title . '</title>
 	      			  <link>http://www.futbolecuador.com/site/noticia/' . $this->_urlFriendly($linkbody) . '/' . $row->id . '</link>
	      			  <guid>http://www.futbolecuador.com/site/noticia/' . $this->_urlFriendly($linkbody) . '/' . $row->id . '</guid>
	      			  <pubDate>' . date('r', $row->ntime) . '</pubDate>
				  	  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://www.futbolecuador.com/' . $row->thumb640 . '"/><br>' . $row->lead . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <figure>
				          <img src="http://www.futbolecuador.com/' . $row->thumb640 . '"  />
				          <figcaption>

				          </figcaption>
				        </figure>
				        <p>' . $texto2 . '</p>
					  ' . $video . '
					]]>
				  </content:encoded>
				</item>';
        endforeach;
    	$request = $request . '
			</channel></rss>';
    	print $request;
    	
    }

    function rssmarcador()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/"
					     xmlns:atom="http://www.w3.org/2005/Atom"
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"
					     xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/imagenes/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>' . date('r', time()) . '</pubDate>
				 ';
        if ($this->uri->segment(3) != 3)
            $news = $this->mdl_stories->rssmarcador($this->uri->segment(3));
        else
            $news = $this->mdl_stories->rssmarcador(FALSE);

        foreach ($news->result() as $row):

            $request = $request . '
				<item>
				  <title>' . $row->texto . '</title>
 	      			  <link>' . $row->link . '</link>
	      			  <guid>' . $row->link . '</guid>
	      			  <pubDate>' .   $row->creado  . '</pubDate>
				  	  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://new.futbolecuador.com/getmarcador/' .  $row->imagen . '"/><br>' . $row->texto . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <figure>
				          <img src="http://new.futbolecuador.com/getmarcador/' . $row->imagen . '"  />
				          <figcaption>

				          </figcaption>
				        </figure>
				        <p>' .  $row->texto . '</p>
					]]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
			</channel></rss>';
        print $request;
    }

    function rssmarcadorprueba()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/"
					     xmlns:atom="http://www.w3.org/2005/Atom"
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"
					     xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/imagenes/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>' . date('r', time()) . '</pubDate>
				 ';
        if ($this->uri->segment(3) != 3)
            $news = $this->mdl_stories->rssmarcadorprueba($this->uri->segment(3));
        else
            $news = $this->mdl_stories->rssmarcadorprueba(FALSE);

        foreach ($news->result() as $row):

            $request = $request . '
				<item>
				  <title>' . $row->texto . '</title>
 	      			  <link>' . $row->link . '</link>
	      			  <guid>' . $row->link . '</guid>
	      			  <pubDate>' .   $row->creado  . '</pubDate>
				  	  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://new.futbolecuador.com/getmarcador/' .  $row->imagen . '"/><br>' . $row->texto . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <figure>
				          <img src="http://new.futbolecuador.com/getmarcador/' . $row->imagen . '"  />
				          <figcaption>

				          </figcaption>
				        </figure>
				        <p>' . $row->texto . '</p>
					]]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
			</channel></rss>';
        print $request;
    }

    function rss()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/"
					     xmlns:atom="http://www.w3.org/2005/Atom"
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"
					     xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/imagenes/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>' . date('r', time()) . '</pubDate>
				 ';
        if ($this->uri->segment(3) != 3)
            $news = $this->mdl_stories->rss($this->uri->segment(3));
        else
            $news = $this->mdl_stories->rss(FALSE);

        foreach ($news->result() as $row):
            $posicionInicio = 0;
            $texto = strip_tags($row->body);
            $texto = (string)$texto;
            $total = strlen($texto);
            $posicionInicio = strpos($texto, "iframe");
            if ($posicionInicio > 0) {
                $video = substr($texto, $posicionInicio, $total);
                $posicionInicio = (int)$posicionInicio - 4;
                $texto2 = substr($texto, 0, $posicionInicio);
                $video = "<figure><" . $video . "</figure>";
            } else {
                $texto2 = strip_tags ($row->body);
                $video = "";
            }

            $linkbody = $row->subtitle;
            if ($linkbody == "") {
                $linkbody = $row->title;
            }

            $request = $request . '
				<item>
				  <title>' . $row->title . '</title>
 	      			  <link>http://www.futbolecuador.com/site/noticia/' . $this->_urlFriendly($linkbody) . '/' . $row->id . '</link>
	      			  <guid>http://www.futbolecuador.com/site/noticia/' . $this->_urlFriendly($linkbody) . '/' . $row->id . '</guid>
	      			  <pubDate>' . date('r', $row->ntime) . '</pubDate>
				  	  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://www.futbolecuador.com/' . $row->thumb640 . '"/><br>' . $row->lead . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <figure>
				          <img src="http://www.futbolecuador.com/' . $row->thumb640 . '"  />
				          <figcaption>

				          </figcaption>
				        </figure>
				        <p>' . $texto2 . '</p>
					  ' . $video . '
					]]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
			</channel></rss>';
        print $request;
    }


    function rss2()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $this->output->cache(CACHE_DEFAULT);
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->statistic->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen"
			  href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen"
			  href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/"
			                     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
					     xmlns:atom="http://www.w3.org/2005/Atom"
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"
					     xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/imagenes/logo_rss.png</url>
					</image>
					<language>es-ec</language>';

        if ($this->uri->segment(3) != 3)
            $news = $this->model->rss($this->uri->segment(3));
        else
            $news = $this->model->rss(FALSE);

        foreach ($news->result() as $row):

            $request = $request . '
				<item>
				  <title>' . $row->title . '</title>
 	      			  <link>http://www.futbolecuador.com/site/noticia/' . $this->stories->_urlFriendly($row->title) . '/' . $row->id . '</link>
	      			  <guid>http://www.futbolecuador.com/site/noticia/' . $this->stories->_urlFriendly($row->title) . '/' . $row->id . '</guid>
	      			  <pubDate>' . date('r', $row->ntime) . '</pubDate>
				  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://www.futbolecuador.com/' . $row->thumb640 . '"/><br>' . $row->lead . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <p class="fl-title">' . $row->title . '</p>
				        <figure>
				          <img src="http://www.futbolecuador.com/' . $row->thumb640 . '"  />
				          <figcaption>
				           <strong>' . $row->title . '</strong>
				          </figcaption>
				        </figure>
				         ' . strip_tags($row->body) . ']]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
		</channel></rss>';
        print $request;
    }

    function news_section()
    {
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->statistic->sum($data);
        $request = '<?xml version="1.0" encoding="UTF-8"?>
				  <rotativa>';
        if ($this->uri->segment(3) != 3)
            $news = $this->model->rss($this->uri->segment(3));
        else
            $news = $this->model->rss(FALSE);
        foreach ($news->result() as $row):
            $request = $request . '<noticia>
								<link>http://www.futbolecuador.com/site/noticia/' . $this->stories->_urlFriendly($row->title) . '/' . $row->id . '</link>
								<titulo>' . $row->title . '</titulo>
								<subtitulo>' . $row->subtitle . '</subtitulo>
								<imagen>' . $row->thumb300 . '</imagen>
								<thumb>' . $row->thumbh50 . '</thumb>
								<noticia><![CDATA[' . mb_convert_encoding($row->lead, 'UTF-8', 'HTML-ENTITIES') . ']]></noticia>
								<id>' . $row->id . '</id>
							   </noticia>';
        endforeach;
        $request = $request . '</rotativa>';
        header('Content-type: text/xml; charset=utf-8');
        print $request;
    }

    function sum($data)
    {

        $query = $this->db->query('Select * From statistics Where name="' . $data['name'] . '"');

        if ($query->num_rows() == 0) {
            $this->db->insert('statistics', $data);
            $last = $this->db->insert_id();
        } else {
            $q = $query->result();
            $data['views'] = $q[0]->views + 1;
            $this->db->where('name', $q[0]->name);
            $this->db->update('statistics', $data);
            $last = $q[0]->id;
        }

        $query = $this->db->query('Select * From statistics_days Where statistic_id=' . $last . ' AND date="' . $this->mdate('%Y-%m-%d', time()) . '"');

        unset($data['name']);
        $data['statistic_id'] = $last;
        $data['views'] = 1;
        if ($query->num_rows() == 0) {
            $data['date'] = $this->mdate('%Y-%m-%d', time());
            $this->db->insert('statistics_days', $data);
        } else {
            $q = $query->result();
            $data['views'] = $q[0]->views + 1;
            $this->db->where('id', $q[0]->id);
            $this->db->update('statistics_days', $data);
        }


    }

    function mdate($datestr = '', $time = '')
    {
        if ($datestr == '')
            return '';

        if ($time == '')
            $time = now();

        $datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
        return date($datestr, $time);
    }
}