<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.2
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: crawltrack.base.php
//----------------------------------------------------------------------
//  Last update: 12/11/2011
//----------------------------------------------------------------------
//error_reporting(0);
@set_time_limit(10);

//var_dump(get_defined_functions());

$crawltattack=0;

//load functions
include 'scriptPHP/crawltrack3-3-2/include/functions_alternates.php';

//connection to database
include("scriptPHP/crawltrack3-3-2/include/configconnect.php");
$crawltconnexion = @mysql_connect($crawlthost,$crawltuser,$crawltpassword);
$selection = mysql_select_db($crawltdb);
//query to get the good site list
$sql = "SELECT host_site FROM crawlt_good_sites";
$requete = mysql_query($sql, $crawltconnexion);
$nbrresult=mysql_num_rows($requete);
if($nbrresult>=1)
{
	while ($ligne = mysql_fetch_row($requete))
	{
		$crawltlistgoodsite[]=$ligne[0];
	}
}
else
{
	$crawltlistgoodsite=array();
}
//echo $sql;


//include searchenginelist.php file
require_once("scriptPHP/crawltrack3-3-2/include/searchenginelist.php");
 //query to get the session id list
$sql = "SELECT sessionid FROM crawlt_sessionid";
$requete = mysql_query($sql, $crawltconnexion);
$nbrresult=mysql_num_rows($requete);
if($nbrresult>=1)
{
	while ($ligne = mysql_fetch_row($requete))
	{
		$crawltlistsessionid[]=$ligne[0];
	}
}
else
{
	$crawltlistsessionid=array();
}


//get information
$crawltispostdata=0;
if (!isset($_SERVER))
{
	$_SERVER = $HTTP_SERVER_VARS;
}
if(isset($_POST['agent']) && isset($_POST['ip']) && isset($_POST['url']) && isset($_POST['site']) && isset($_POST['cookie']))
{
	$crawltagent = $_POST['agent'];
	$crawltispostdata=1;
}
else
{
	$crawltagent = $_SERVER['HTTP_USER_AGENT'];
}
if($crawltispostdata==1)
{
	$crawltip = $_POST['ip'];
}
else
{
	$crawltip = $_SERVER['REMOTE_ADDR'];
}
if($crawltispostdata==1)
{
	$crawlturl2 = $_POST['url'];
	$crawltpostrequest=1;
}
else
{
	if(isset($_ENV['REQUEST_URI']) && substr($_ENV['REQUEST_URI'], -3)!='cgi')
	{
		$crawlturl2 = $_ENV['REQUEST_URI'];
	}
	else
	{
		$crawlturl2 = $_SERVER['REQUEST_URI'];
	}
	$crawltpostrequest=0;
}
if($crawltispostdata==1)
{
	$crawltsite = $_POST['site'];
}
else
{
	if(!isset($crawltsite))
	{
	$crawltsite=$site;
	}
}
if($crawltispostdata==1)
{
	$_COOKIE["crawltrackstats".$crawltsite] = $_POST['cookie'];
}
if($crawltispostdata==1)
{
	$crawlthttpcode = $_POST['httpcode'];
}
else
{
	if(isset($_SERVER['REDIRECT_STATUS'])){
	$crawlthttpcode = $_SERVER['REDIRECT_STATUS'];
	}else{
	$crawlthttpcode = 400;
	}
}
//get config parameters
$sqlcrawltconfig = "SELECT mail, datelastmail, timeshift, lang, addressmail, datelastseorequest, loop1, loop2, typemail, typecharset, blockattack, datelastcleaning, sessionid,includeparameter FROM crawlt_config";
$requetecrawltconfig = mysql_query($sqlcrawltconfig, $crawltconnexion);
$nbrresultcrawlt=mysql_num_rows($requetecrawltconfig);
if($nbrresultcrawlt>=1)
{
	$lignecrawlt = mysql_fetch_row($requetecrawltconfig);
	$crawltmail=$lignecrawlt[0];
	$crawltdatemail=$lignecrawlt[1];
	$crawlttime=$lignecrawlt[2];
	$crawltlang=$lignecrawlt[3];
	$crawltdest=$lignecrawlt[4];
	$crawltdatelastseorequest=$lignecrawlt[5];
	$crawltloop=$lignecrawlt[6];
	$crawltloop2=$lignecrawlt[7];
	$crawltmailishtml=$lignecrawlt[8];
	$crawltcharset=$lignecrawlt[9];
	$crawltblockattack=$lignecrawlt[10];
	$datecleaning=$lignecrawlt[11];
	$crawltsessionid=$lignecrawlt[12];
	$crawltincludeparameter=$lignecrawlt[13];
	if( $crawltcharset !=1)
	{
		$crawltlang = $crawltlang."iso";
	}
	$crawltcheck=1;
}
$crawlturl = crawlturltreatment($crawlturl2);
//count all the hits---------------------------------------------------
//check if the date exist in the crawlt_hits table for that site
$crawlttodaylocal = date("Y-m-d",(time() - ($crawlttime * 3600)));
$crawltresult = mysql_query("SELECT id FROM crawlt_hits
	WHERE  date='".crawlt_sql_quote($crawlttodaylocal)."'
	AND idsite='".crawlt_sql_quote($crawltsite)."'",$crawltconnexion);
$crawltnum_rows = mysql_num_rows($crawltresult);
if($crawltnum_rows>0)
{
	//the date already exist in the table
	while ($crawltligne = mysql_fetch_row($crawltresult))
	{
		$crawltid=$crawltligne[0];
	}
	//add 1 in the date count
	$crawltsqlupdate="UPDATE crawlt_hits SET count=count+1 WHERE id='".crawlt_sql_quote($crawltid)."'";
	$crawltrequeteupdate = mysql_query($crawltsqlupdate, $crawltconnexion);
}
else
{
	//the link didn't exist in the table, create it
	$crawltsql="INSERT INTO crawlt_hits ( count,date, idsite) VALUES ('1','".crawlt_sql_quote($crawlttodaylocal)."','".crawlt_sql_quote($crawltsite)."')";
	$crawltrequete = mysql_query($crawltsql, $crawltconnexion);
}
//---------------------------------------------------------------------
//check if it's an attack
$crawlturl3 = str_replace($crawltcssaattack,'http:',$crawlturl2);
$crawlturl4 = str_replace($crawltsqlaattack,'%20select%20',$crawlturl2);
if(preg_match("/http\:/i", ltrim($crawlturl3,"h")))
{
	$crawlttypeattack=65500;
	$crawltattack=1;
	$crawlturl=$crawlturl2;
	$crawltnbrattack = substr_count($crawlturl3,'http:');
	$crawltnbrgoodsite=0;
	foreach($crawltlistgoodsite as $crawltgoodsite)
	{
		if(strpos($crawlturl, $crawltgoodsite))
		{
			$crawltnbrgoodsite++;
		}
	}
	if($crawltnbrgoodsite == $crawltnbrattack && $crawltnbrattack !=0)
	{
		$crawltattack=0;
	}
}
elseif(preg_match("/%20select%20/i", $crawlturl4))
{
	$crawlttypeattack=65501;
	$crawltattack=1;
	$crawlturl=$crawlturl2;
	$crawltnbrattack=substr_count($crawlturl, 'http:');
	$crawltnbrgoodsite=0;
	foreach($crawltlistgoodsite as $crawltgoodsite)
	{
		if(strpos($crawlturl, $crawltgoodsite))
		{
			$crawltnbrgoodsite++;
		}
	}
	if($crawltnbrgoodsite == $crawltnbrattack && $crawltnbrattack !=0)
	{
		$crawltattack=0;
	}
}
else
{
	$crawlttypeattack=0;
}
if($crawlttypeattack != 0 && $crawltattack==1)
{
	$crawltdate  = date("Y-m-d H:i:s");
	if($crawlthttpcode==404)
	{
		//we just count the number of 404 attack to avoid server overload and to big increase of database size
		//check if the date exist in the crawlt_error table for that site
		$crawltresult = mysql_query("SELECT id FROM crawlt_error
		WHERE  date='".crawlt_sql_quote($crawlttodaylocal)."'
		AND idsite='".crawlt_sql_quote($crawltsite)."'
		AND attacktype='".crawlt_sql_quote($crawlttypeattack)."'",$crawltconnexion);
		$crawltnum_rows = mysql_num_rows($crawltresult);
		if($crawltnum_rows>0)
		{
			//the date already exist in the table
			while ($crawltligne = mysql_fetch_row($crawltresult))
			{
				$crawltid=$crawltligne[0];
			}
			//add 1 in the date count
			$crawltsqlupdate="UPDATE crawlt_error SET count=count+1
			WHERE id='".crawlt_sql_quote($crawltid)."'";
			$crawltrequeteupdate = mysql_query($crawltsqlupdate, $crawltconnexion);
		}
		else
		{
			//the link didn't exist in the table, create it
			$crawltsql="INSERT INTO crawlt_error ( count,date, idsite, attacktype) VALUES ('1','".crawlt_sql_quote($crawlttodaylocal)."','".crawlt_sql_quote($crawltsite)."','".crawlt_sql_quote($crawlttypeattack)."')";
			$crawltrequete = mysql_query($crawltsql, $crawltconnexion);
		}
	}
	else
	{
		//check if the page already exist, if not add it to the table
		$result2 = mysql_query("SELECT id_page FROM crawlt_pages_attack WHERE url_page='".crawlt_sql_quote($crawlturl)."'",$crawltconnexion);
		$num_rows2 = mysql_num_rows($result2);
		if ($num_rows2>0)
		{
			$crawltdata2 = mysql_fetch_row($result2);
			$crawltpage= $crawltdata2[0];
		}
		else
		{
			mysql_query("INSERT INTO crawlt_pages_attack (url_page) VALUES ('".crawlt_sql_quote($crawlturl)."')",$crawltconnexion);
			$crawltid_insert = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()",$crawltconnexion));
			$crawltpage = $crawltid_insert[0];
		}
		//insertion of the visit datas in the visits database
		mysql_query("INSERT INTO crawlt_visits (crawlt_site_id_site, crawlt_pages_id_page, crawlt_crawler_id_crawler, date, crawlt_ip_used, crawlt_error) VALUES ('".crawlt_sql_quote($crawltsite)."', '".crawlt_sql_quote($crawltpage)."', '".crawlt_sql_quote($crawlttypeattack)."', '".crawlt_sql_quote($crawltdate)."', '".crawlt_sql_quote($crawltip)."','0')",$crawltconnexion);
	}
}
else
{
	//treatment of ip to prepare the mysql request
	$crawltcptip=1;
	$crawltlgthip=strlen($crawltip);
	while($crawltcptip <=$crawltlgthip)
	{
		$crawlttableip[]=substr($crawltip,0,$crawltcptip);
		$crawltcptip++;
	}
	$crawltlistip=implode("','",$crawlttableip);
	// check if the user agent or the ip exist in the crawler table
	$result = mysql_query("SELECT crawler_user_agent, crawler_ip,id_crawler FROM crawlt_crawler
	 WHERE INSTR('".crawlt_sql_quote($crawltagent)."',crawler_user_agent) > 0
	OR crawler_ip IN ('$crawltlistip') ",$crawltconnexion);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$crawltdata = mysql_fetch_row($result);
		$crawltcrawler = $crawltdata[2];
		$crawltdate  = date("Y-m-d H:i:s");
		//check if the page already exist, if not add it to the table
		$result2 = mysql_query("SELECT id_page FROM crawlt_pages WHERE url_page='".crawlt_sql_quote($crawlturl)."'",$crawltconnexion);
		$num_rows2 = mysql_num_rows($result2);
		if ($num_rows2>0)
		{
			$crawltdata2 = mysql_fetch_row($result2);
			$crawltpage= $crawltdata2[0];
		}
		else
		{
			mysql_query("INSERT INTO crawlt_pages (url_page) VALUES ('".crawlt_sql_quote($crawlturl)."')",$crawltconnexion);
			$crawltid_insert = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()",$crawltconnexion));
			$crawltpage = $crawltid_insert[0];
		}
		if($crawlthttpcode==404)
		{
			$crawlterror=1;
		}
		else
		{
			$crawlterror=0;
		}
		//insertion of the visit datas in the visits database
		mysql_query("INSERT INTO crawlt_visits (crawlt_site_id_site, crawlt_pages_id_page, crawlt_crawler_id_crawler, date, crawlt_ip_used, crawlt_error) VALUES ('".crawlt_sql_quote($crawltsite)."', '".crawlt_sql_quote($crawltpage)."', '".crawlt_sql_quote($crawltcrawler)."', '".crawlt_sql_quote($crawltdate)."', '".crawlt_sql_quote($crawltip)."', '".crawlt_sql_quote($crawlterror)."')",$crawltconnexion);
	}
	else
	{
	//check if it's really a visitor and if it's not you !!!
	$crawltbrowserconcat=implode("|",$crawltbrowserlist);
	$crawltbrowserconcat = "/".$crawltbrowserconcat."/";
	$crawltnonebrowserconcat=implode("|",$crawltnonebrowserlist);
	$crawltnonebrowserconcat = "/".$crawltnonebrowserconcat."/";
	//echo $crawltbrowserconcat."___".$crawltnonebrowserconcat;
	if((!isset($_COOKIE["crawltrackstats".$crawltsite]) || $_COOKIE["crawltrackstats".$crawltsite]!='nocountinstats') && (preg_match($crawltbrowserconcat, $crawltagent) && !preg_match($crawltnonebrowserconcat, $crawltagent)))
	{
		//case human visit
		$crawltbrowser = crawltbrowserid($crawltagent);
		$crawltdate  = date("Y-m-d H:i:s");
		if(isset($_POST['referer']) && $crawltispostdata==1 && $_POST['referer']!='')
		{
			$crawltreferer = $_POST['referer'];
			$crawltrefereok=1;
		}
		elseif(isset($_SERVER['HTTP_REFERER']))
		{
			$crawltreferer= $_SERVER['HTTP_REFERER'];
			$crawltrefereok=1;
		}
		else
		{
			$crawltrefereok=0;
		}
		if($crawltrefereok==1)
		{
			$crawltreferertreatment = parse_url($crawltreferer);
			$crawltsearchengine=0;
			//test google
			if(in_array("$crawltreferertreatment[host]",$crawltgooglelist))
			{
				$crawltsearchengine=1;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['q'];
				if($crawltkeyword=='')
				{
					$crawltkeyword = $crawlttabvar['as_q'];
					if($crawltkeyword=='')
					{
						$crawltkeyword = $crawlttabvar['as_epq'];
						if($crawltkeyword=='')
						{
							$crawltkeyword = $crawlttabvar['as_oq'];
							if($crawltkeyword=='')
							{
								$crawltkeyword = $crawlttabvar['as_eq'];
								if($crawltkeyword=='')
								{
									$crawltkeyword = $crawlttabvar['as_occt'];
									if($crawltkeyword=='')
									{
									$crawltkeyword='(not provided)';
									}
								}
							}
						}
					}
				}
			//test to see if it's Google Image
			if(isset($crawlttabvar['imgurl']))
				{
				$crawltsearchengine=6;	
				}				
			}
			//test yahoo
			elseif(in_array("$crawltreferertreatment[host]",$crawltyahoolist))
			{
				$crawltsearchengine=2;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['p'];
				if($crawltkeyword=='')
				{
					$crawltkeyword='(not provided)';
				}
			}
			//test bing
			elseif(in_array("$crawltreferertreatment[host]",$crawltmsnlist))
			{
				$crawltsearchengine=3;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['q'];
				if($crawltkeyword=='')
				{
					$crawltkeyword = $crawlttabvar['MT'];
					if($crawltkeyword=='')
					{
						$crawltkeyword='(not provided)';
					}
				}
			}
			//test ask
			elseif(in_array("$crawltreferertreatment[host]",$crawltasklist))
			{
				$crawltsearchengine=4;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['q'];
				if($crawltkeyword=='')
					{
					$crawltkeyword = $crawlttabvar['aid'];
					if($crawltkeyword=='')
						{
						$crawltkeyword='(not provided)';
						}
					}
			}
			//test baidu (replace exalead since crawltrack 3.2.0)
			elseif(in_array("$crawltreferertreatment[host]",$crawltbaidulist))
			{
				$crawltsearchengine=5;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['wd'];
				if($crawltkeyword=='')
				{
					$crawltkeyword = $crawlttabvar['word'];
					if($crawltkeyword=='')
					{
						$crawltkeyword='(not provided)';
					}
				}
			}
			//test yandex
			elseif(in_array("$crawltreferertreatment[host]",$crawltyandexlist))
			{
				$crawltsearchengine=7;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['text'];
				if($crawltkeyword=='')
				{
					$crawltkeyword='(not provided)';
				}
			}
			//test Aol
			elseif(in_array("$crawltreferertreatment[host]",$crawltaollist))
			{
				$crawltsearchengine=8;
				parse_str($crawltreferertreatment['query'],$crawlttabvar);
				$crawltkeyword = $crawlttabvar['q'];
				if($crawltkeyword=='')
				{
					$crawltkeyword = $crawlttabvar['query'];
					if($crawltkeyword=='')
					{
						$crawltkeyword='(not provided)';
					}
				}
			}						
			//case visit send by one of the 8 searchengines
			if($crawltsearchengine !=0)
			{
				//check if the referer already exist, if not add it to the table
				$result5 = mysql_query("SELECT id_referer FROM crawlt_referer WHERE referer='".crawlt_sql_quote($crawltreferer)."'");
				$num_rows5 = mysql_num_rows($result5);
				if ($num_rows5>0)
				{
					$crawltdata5 = mysql_fetch_row($result5);
					$crawltrefererid= $crawltdata5[0];
				}
				else
				{
					mysql_query("INSERT INTO crawlt_referer (referer) VALUES ('".crawlt_sql_quote($crawltreferer)."')");
					$crawltid_insert3 = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
					$crawltrefererid = $crawltid_insert3[0];
				}
				//check if the keyword already exist, if not add it to the table
				$result4 = mysql_query("SELECT id_keyword FROM crawlt_keyword WHERE keyword='".crawlt_sql_quote($crawltkeyword)."'");
				$num_rows4 = mysql_num_rows($result4);
				if ($num_rows4>0)
				{
					$crawltdata4 = mysql_fetch_row($result4);
					$crawltkeywordid= $crawltdata4[0];
				}
				else
				{
					mysql_query("INSERT INTO crawlt_keyword (keyword) VALUES ('".crawlt_sql_quote($crawltkeyword)."')");
					$crawltid_insert2 = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
					$crawltkeywordid = $crawltid_insert2[0];
				}
				//check if the page already exist, if not add it to the table
				$result2 = mysql_query("SELECT id_page FROM crawlt_pages WHERE url_page='".crawlt_sql_quote($crawlturl)."'");
				$num_rows2 = mysql_num_rows($result2);
				if ($num_rows2>0)
				{
					$crawltdata2 = mysql_fetch_row($result2);
					$crawltpage= $crawltdata2[0];
				}
				else
				{
					mysql_query("INSERT INTO crawlt_pages (url_page) VALUES ('".crawlt_sql_quote($crawlturl)."')");
					$crawltid_insert = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
					$crawltpage = $crawltid_insert[0];
				}
				//insertion of the visit datas in the visits_human database
				if($crawlthttpcode==404)
				{
					$crawlterror=1;
				}
				else
				{
					$crawlterror=0;
				}
				mysql_query("INSERT INTO crawlt_visits_human (crawlt_site_id_site, crawlt_keyword_id_keyword, crawlt_id_crawler, date, crawlt_id_page, crawlt_id_referer, crawlt_ip, crawlt_error, crawlt_browser) VALUES ('".crawlt_sql_quote($crawltsite)."', '".crawlt_sql_quote($crawltkeywordid)."', '".crawlt_sql_quote($crawltsearchengine)."', '".crawlt_sql_quote($crawltdate)."', '".crawlt_sql_quote($crawltpage)."','".crawlt_sql_quote($crawltrefererid)."','".crawlt_sql_quote($crawltip)."', '".crawlt_sql_quote($crawlterror)."','".crawlt_sql_quote($crawltbrowser)."')");
			}
			else
			{
				//case other referer
				//check if the referer already exist, if not add it to the table
				$result5 = mysql_query("SELECT id_referer FROM crawlt_referer WHERE referer='".crawlt_sql_quote($crawltreferer)."'");
				$num_rows5 = mysql_num_rows($result5);
				if ($num_rows5>0)
				{
					$crawltdata5 = mysql_fetch_row($result5);
					$crawltrefererid= $crawltdata5[0];
				}
				else
				{
					mysql_query("INSERT INTO crawlt_referer (referer) VALUES ('".crawlt_sql_quote($crawltreferer)."')");
					$crawltid_insert3 = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
					$crawltrefererid = $crawltid_insert3[0];
				}
				//check if the page already exist, if not add it to the table
				$result2 = mysql_query("SELECT id_page FROM crawlt_pages WHERE url_page='".crawlt_sql_quote($crawlturl)."'");
				$num_rows2 = mysql_num_rows($result2);
				if ($num_rows2>0)
				{
					$crawltdata2 = mysql_fetch_row($result2);
					$crawltpage= $crawltdata2[0];
				}
				else
				{
					mysql_query("INSERT INTO crawlt_pages (url_page) VALUES ('".crawlt_sql_quote($crawlturl)."')");
					$crawltid_insert = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
					$crawltpage = $crawltid_insert[0];
				}
				//insertion of the visit datas in the visits_human database
				if($crawlthttpcode==404)
				{
					$crawlterror=1;
				}
				else
				{
					$crawlterror=0;
				}
				mysql_query("INSERT INTO crawlt_visits_human (crawlt_site_id_site, crawlt_keyword_id_keyword, crawlt_id_crawler, date, crawlt_id_page, crawlt_id_referer, crawlt_ip, crawlt_error, crawlt_browser) VALUES ('".crawlt_sql_quote($crawltsite)."', '0', '0','".crawlt_sql_quote($crawltdate)."', '".crawlt_sql_quote($crawltpage)."','".crawlt_sql_quote($crawltrefererid)."','".crawlt_sql_quote($crawltip)."', '".crawlt_sql_quote($crawlterror)."','".crawlt_sql_quote($crawltbrowser)."')");
			}
		}
		else
		{
			//case direct arrival
			//check if the page already exist, if not add it to the table
			$result2 = mysql_query("SELECT id_page FROM crawlt_pages WHERE url_page='".crawlt_sql_quote($crawlturl)."'");
			$num_rows2 = mysql_num_rows($result2);
			if ($num_rows2>0)
			{
				$crawltdata2 = mysql_fetch_row($result2);
				$crawltpage= $crawltdata2[0];
			}
			else
			{
				mysql_query("INSERT INTO crawlt_pages (url_page) VALUES ('".crawlt_sql_quote($crawlturl)."')");
				$crawltid_insert = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID()"));
				$crawltpage = $crawltid_insert[0];
			}
			//insertion of the visit datas in the visits_human database
			if($crawlthttpcode==404)
			{
				$crawlterror=1;
			}
			else
			{
				$crawlterror=0;
			}
			mysql_query("INSERT INTO crawlt_visits_human (crawlt_site_id_site, crawlt_keyword_id_keyword, crawlt_id_crawler, date, crawlt_id_page, crawlt_id_referer, crawlt_ip, crawlt_error, crawlt_browser) VALUES ('".crawlt_sql_quote($crawltsite)."', '0', '0','".crawlt_sql_quote($crawltdate)."', '".crawlt_sql_quote($crawltpage)."','0','".crawlt_sql_quote($crawltip)."', '".crawlt_sql_quote($crawlterror)."','".crawlt_sql_quote($crawltbrowser)."')");
		}
	  }
	}
}
//Email daily stats
//take in account timeshift
$crawltts = time()-($crawlttime*3600);
$crawltdatetoday = date("j",$crawltts);
$crawltdatetoday2 = date("Y-m-d",$crawltts);
$url_crawlt="/scriptPHP/crawltrack3-3-2/";
if(($crawltdatetoday != $crawltdatelastseorequest) && $crawltcheck==1)
{
	$crawltpath="scriptPHP/crawltrack3-3-2";
	require_once("scriptPHP/crawltrack3-3-2/include/searchenginesposition.php");
}
if(($crawltdatetoday != $crawltdatemail) && $crawltmail==1 && ($crawltdatetoday == $crawltdatelastseorequest) && $crawltcheck==1)
{
	$crawltpath="scriptPHP/crawltrack3-3-2";
	require_once("scriptPHP/crawltrack3-3-2/include/mail.php");
}
mysql_close($crawltconnexion);
if($crawltattack==1 && $crawltblockattack==1 && $crawltpostrequest==1)
{
	echo "crawltrack1";
}
elseif($crawltattack==1 && $crawltblockattack==1)
{
	$GLOBALS = array();
	$_COOKIES = array();
	$_FILES = array();
	$_ENV = array();
	$_REQUEST = array();
	$_POST = array();
	$_GET = array();
	$_SERVER = array();
	$_SESSION = array();
	@session_destroy();
	@mysql_close();
	@header("Location: http://besancon25.fr/erreurs/index.php?num=18");
	echo "<head>";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=http://besancon25.fr/erreurs/index.php?num=18'>";
	echo "</head>";
}

?>
