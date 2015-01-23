<?="<?xml version='1.0' encoding='UTF-8' standalone='yes'?>";?>
<Partidos>
   <titulo><?=$title?></titulo>
   <fecha><?=time()?></fecha>
   <refresh>120</refresh>
<?php
$response="";

foreach($mttd as $row): 

	if($row->result=="")
		$row->result="0 - 0";

	$aux=strpos(trim($row->result),'-');
	
	$response.="<Partido>
							<local>
								<nombre>".$row->hname."</nombre>
								<corto>".$row->hsname."</corto>
								<resultado>".trim(substr(trim($row->result), 0, $aux))."</resultado>
								<escudo>".base_url().$row->hshield."</escudo>
								<thumb>".base_url().$row->hthumb."</thumb>
							</local>
							<visitante>
								<nombre>".$row->aname."</nombre>
								<corto>".$row->asname."</corto>
								<resultado>".trim(mb_substr(trim($row->result), $aux+1))."</resultado>
								<escudo>".base_url().$row->ashield."</escudo>
								<thumb>".base_url().$row->athumb."</thumb>
							</visitante>
							<copa>".$row->championship."</copa>\n".
							$this->timer->cal_time($row->id)."
							<id>".$row->id."</id>
							<date>".ucfirst(strftime('%B %d - %H:%M',$row->hour))."</date>
						 </Partido>\n";
endforeach;
echo $response;
?>
</Partidos>