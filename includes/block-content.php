<?php
	/*
	 * ------------------------------------------------------------------------
	 * Yt FrameWork for Joomla 2.5
	 * ------------------------------------------------------------------------
	 * Copyright (C) 2009 - 2012 The YouTech JSC. All Rights Reserved.
	 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
	 * Author: The YouTech JSC
	 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
	 * ------------------------------------------------------------------------
	*/
	
	$option = JRequest::getVar( 'option' , null );
	$view   = JRequest::getVar( 'view' , null );
	
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	
	//    echo'<pre>';print_r( $position );echo'</pre>'.__FILE__.' '.__LINE__;
	//    die(__FILE__ .' '. __LINE__ );
	
	if( $position[ 'group' ] == '' )
	{ // Position none group
		echo $yt->renPositionsContentNoGroup( $position );
		
	}
	else if( ( $position[ 'group' ] != 'left' ) && ( $position[ 'group' ] != 'main' ) && ( $position[ 'group' ] != 'right' ) )
	{     // Position has group's user created
		if( !isset( $countGSpe ) )
		{
			$countGSpe = 0;
		}
		$countGSpe++;
		
		
		if( $countGSpe == 1 )
		{
			
			echo '<div id="' . $position[ 'group' ] . '" class="' . $yt_render->arr_GI[ 'maintop' ][ 'class' ] . '">';
			echo $yt->renPositionsGroup( $position );
			
			if( $tagBD[ 'count-' . $position[ 'group' ] ] == 1 )
			{
				$countGSpe = null;
				echo '</div>';
			}
		}
		else if( $countGSpe == $tagBD[ 'count-' . $position[ 'group' ] ] && $tagBD[ 'count-' . $position[ 'group' ] ] > 1 )
		{
			
			echo $yt->renPositionsGroup( $position );
			
			$countGSpe = null;
			echo '</div>';
		}
		else
		{
			echo $yt->renPositionsGroup( $position );
		}
		
	}
	else if( ( $position[ 'group' ] == 'left' ) || ( $position[ 'group' ] == 'main' ) || ( $position[ 'group' ] == 'right' ) )
	{ // Position has group's framework fixed    - left, main, right
		
	
//	    die(__FILE__ .' '. __LINE__ );
		if( $position[ 'group' ] == 'left' )
		{
			$countL++;
			if( $countL == 1 )
			{
				
				echo '<aside id="content_left" class="' . $yt_render->arr_GI[ 'left' ][ 'class' ] . '">';
				echo $yt->renPositionsGroup( $position , 'block-content' );
				if( $tagBD[ 'count-group-left' ] == 1 )
				{
					echo '</aside>';
				}
				
			}
			else if( $tagBD[ 'count-group-left' ] == $countL && $tagBD[ 'count-group-left' ] > 1 )
			{
				echo $yt->renPositionsGroup( $position , 'block-content' );
				echo '</aside>';
			}
			else
			{
				echo $yt->renPositionsGroup( $position , 'block-content' );
			}
		}
		else if( $position[ 'group' ] == 'main' )
		{
			$countM++;
			
			if( $countM == 1 )
			{
				$class = $yt_render->arr_GI[ 'main' ][ 'class' ] ;
				
				# Дать карточке товара в {productdetails} - width: 100%;
				if( $view == 'productdetails' )
				{
					$class = 'col-xs-12' ;
				}#END IF
//				echo'<pre>';print_r( $class );echo'</pre>'.__FILE__.' '.__LINE__;
//				die(__FILE__ .' '. __LINE__ );
				
				echo '<div id="content_main" class="' . $class . '">';
				echo $yt->renPositionsGroup( $position , 'main' );
				
				if( $tagBD[ 'count-group-main' ] == 1 )
				{
					echo '    </div>';
					echo '</div>';
				}
				
			}
			else if( ( $tagBD[ 'count-group-main' ] == $countM ) && ( $tagBD[ 'count-group-main' ] > 1 ) )
			{
				echo $yt->renPositionsGroup( $position , 'main' );
				
				echo '</div>';
			}
			else
			{
				echo $yt->renPositionsGroup( $position , 'main' );
			}
		}
		else if( $position[ 'group' ] == 'right'   )
		{
			
			
			
			
			$countR++;
			if( $countR == 1 )
			{
				
				echo '<aside id="content_right" class="' . $yt_render->arr_GI[ 'right' ][ 'class' ] . '">';
				echo $yt->renPositionsGroup( $position , 'block-content' );
				if( $tagBD[ 'count-group-right' ] == 1 )
				{
					echo '</aside>';
				}
				
				
			}
			else if( $countR == $tagBD[ 'count-group-right' ] && $tagBD[ 'count-group-right' ] > 1 )
			{
				echo $yt->renPositionsGroup( $position , 'block-content' );
				echo '</aside>';
			}
			else
			{
				echo $yt->renPositionsGroup( $position , 'block-content' );
			}
		}
	}
?>
