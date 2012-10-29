<?php
/**
 * @version             $Id: maiansearch.php 1.0 10/10/2009 Alao
 * @copyright           Are Times
 * @license             GNU/GPL
 */

//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgSearchMaianSearch extends JPlugin {

	//Now define the registerEvent and the language file.
	//$mainframe->registerEvent( 'onSearch', 'maiansearch' );
	//$mainframe->registerEvent( 'onSearchAreas', 'maiansearchAreas' );

	//JPlugin::loadLanguage( 'plg_search_nameofplugin' );
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	//Returns an array of search areas.
	function onContentSearchAreas()
	{
		$areas = array(
                'nameofplugin' => 'Maian Search'
                );
                return $areas;
	}

	//Then the real function has to be created. The database connection should be made.
	//The function will be closed with an } at the end of the file.
	/**
	 * Weblink Search method
	 *
	 * The sql must return the following fields that are used in a common display
	 * routine: href, title, section, created, text, browsernav
	 * @param string Target search string
	 * @param string mathcing option, exact|any|all
	 * @param string ordering option, newest|oldest|popular|alpha|category
	 * @param mixed An array if the search it to be restricted to areas, null if search all
	 */
	function onContentSearch($text, $phrase='', $ordering='', $areas=null)
	{
		$db    =& JFactory::getDBO();
		$user  =& JFactory::getUser();

		//If the array is not correct, return it:
		if (is_array( $areas )) {
			if (!array_intersect( $areas, array_keys( self::onContentSearchAreas()) )) {
				return array();
			}
		}

		//And define the parameters.
		$limit = $this->params->get( 'search_limit', 5);
		$album_name = $this->params->get( 'album_name', 1);
		$track_name = $this->params->get( 'track_name', 1);
		$comments = $this->params->get( 'comments', 1);
		$keywords = $this->params->get( 'keywords', 1);

		//Use the function trim to delete spaces in front of or at the back of the searching terms
		$text = trim( $text );

		//Return Array when nothing was filled in
		if ($text == '') {
			return array();
		}

		//After this, you have to add the database part. This will be the most difficult part, because this changes per situation.
		//In the coding examples later on you will find some of the examples used by Joomla! 1.5 core Search Plugins.
		//It will look something like this.
		$wheres = array();
		switch ($phrase) {

			//search exact
			case 'exact':
				$text          = $db->Quote( '%'.$db->getEscaped( $text, true ).'%', false );
				$wheres2       = array();
				if($album_name == '1'){
					$wheres2[]     = 'LOWER(a.name) LIKE '.$text;
				}
				if($track_name== '1'){
					$wheres2[]     = 'LOWER(t.track_name) LIKE '.$text;
				}
				if($comments == '1'){
					$wheres2[]     = 'LOWER(a.keywords) LIKE '.$text;
				}
				if($keywords == '1'){
					$wheres2[]     = 'LOWER(a.comments) LIKE '.$text;
				}
				$where         = '(' . implode( ') OR (', $wheres2 ) . ')';
				break;

				//search all or any
			case 'all':
			case 'any':

				//set default
			default:
				$words         = explode( ' ', $text );
				$wheres = array();
				foreach ($words as $word)
				{
					$word          = $db->Quote( '%'.$db->getEscaped( $word, true ).'%', false );
					$wheres2       = array();

					if($album_name == '1'){
						$wheres2[]     = 'LOWER(a.name) LIKE '.$word;
					}

					if($track_name== '1'){
						$wheres2[]     = 'LOWER(t.track_name) LIKE '.$word;
					}

					if($comments == '1'){
						$wheres2[]     = 'LOWER(a.keywords) LIKE '.$word;
					}

					if($keywords == '1'){
						$wheres2[]     = 'LOWER(a.comments) LIKE '.$word;
					}

					$wheres[]    = implode( ' OR ', $wheres2 );
				}
				$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
				break;
		}

		//ordering of the results
		switch ( $ordering ) {

			//alphabetic, ascending
			case 'alpha':
				$order = 'a.name ASC';
				break;

				//oldest first
			case 'oldest':
				$order = 'a.addDate ASC';
				break;
					
				//popular first
			case 'popular':
				$order = 'a.downloads DESC';
				break;
					
				//newest first
			case 'newest':
				$order = 'a.addDate DESC';
				break;
					
				//default setting: alphabetic, ascending
			default:
				$order = 'a.name ASC';
		}

		//replace nameofplugin
		$searchnameofplugin = JText::_( 'maiansearch' );

		//the database query; differs per situation! It will look something like this:
		$query = 'SELECT DISTINCT a.id AS id, a.name AS title, a.comments as text,'
		. ' CONCAT_WS( "-", '. $db->Quote($searchNameofplugin) .', a.artist )AS section,'
		. ' "1" AS browsernav'
		. ' FROM #__m15_albums AS a'
		. ' RIGHT JOIN #__m15_tracks AS t ON t.track_album = a.id'
		. ' WHERE ( '. $where .' )'
		. ' AND a.status = \'1\''
		. ' ORDER BY '. $order
		;

		//Set query
		$db->setQuery( $query, 0, $limit );
		$rows = $db->loadObjectList();

		//The 'output' of the displayed link
		foreach($rows as $key => $row) {
			$rows[$key]->href = 'index.php?option=com_maianmedia&view=album&album='.$row->id;
		}

		//Return the search results in an array
		return $rows;
	}
}
?>